<?php

namespace App\Livewire;

use App\Models\Worker;
use Livewire\Component;
use App\Models\Bookings;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;
use Carbon\Carbon;

class PengerjaanAdmin extends Component
{
    public $bookingId;
    public $booking;
    public $showAssignModal = false;
    public $selectedWorker = null;
    public $rfidReading = false;
    public $rfidData = '';
    public $assignedWorker = null;
    public $showSuccess = false;
    public $deviceStatus = 'unknown';
    public $lastRfidScan = null;
    public $deviceInfo = null;
    public $showCompleteModal = false;
    public $completionNotes = '';

    // Firebase configuration
    private $firebaseUrl = 'https://blink-reservation-default-rtdb.asia-southeast1.firebasedatabase.app/';
    private $deviceId = 'ESP32_RFID_STATION_01';

    public function mount($id)
    {
        $this->bookingId = $id;
        $this->loadBooking();
        $this->checkDeviceStatus();
    }

    public function loadBooking()
    {
        $this->booking = Bookings::with(['customer', 'packagePrice.servicePackage', 'packagePrice.carCategory', 'checklist', 'assignedWorker'])->findOrFail($this->bookingId);
    }

    public function checkDeviceStatus()
    {
        try {
            Log::info("Checking device status for: {$this->deviceId}");

            $response = Http::timeout(10)->get("{$this->firebaseUrl}/devices/{$this->deviceId}.json");

            if ($response->successful() && $response->json()) {
                $device = $response->json();
                $this->deviceInfo = $device;

                Log::info('Device data received', $device);

                $lastSeen = $device['last_seen'] ?? 0;
                $currentTime = now()->timestamp * 1000; // Convert to milliseconds

                // Increase threshold to 45 seconds to give more buffer
                $threshold = 45000; // 45 seconds in milliseconds
                $timeDiff = $currentTime - $lastSeen;

                $this->deviceStatus = $timeDiff < $threshold ? 'online' : 'offline';

                Log::info('Device status check', [
                    'last_seen' => $lastSeen,
                    'current_time' => $currentTime,
                    'time_diff' => $timeDiff,
                    'threshold' => $threshold,
                    'status' => $this->deviceStatus,
                    'device_data' => $device,
                ]);
            } else {
                Log::warning('No device data found or request failed', [
                    'response_status' => $response->status(),
                    'response_body' => $response->body(),
                ]);
                $this->deviceStatus = 'offline';
                $this->deviceInfo = null;
            }
        } catch (\Exception $e) {
            Log::error('Failed to check device status', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            $this->deviceStatus = 'error';
            $this->deviceInfo = null;
        }
    }

    public function refreshDeviceStatus()
    {
        $this->checkDeviceStatus();

        if ($this->deviceStatus === 'online') {
            session()->flash('success', 'Device is online and ready!');
        } else {
            session()->flash('error', "Device is {$this->deviceStatus}. Please check the connection.");
        }
    }

    public function openAssignModal()
    {
        $this->checkDeviceStatus();
        $this->showAssignModal = true;
        $this->reset(['selectedWorker', 'rfidData', 'assignedWorker']);
    }

    public function closeAssignModal()
    {
        $this->showAssignModal = false;
        $this->stopRfidReading();
    }

    public function openCompleteModal()
    {
        $this->showCompleteModal = true;
        $this->completionNotes = '';
    }

    public function closeCompleteModal()
    {
        $this->showCompleteModal = false;
        $this->completionNotes = '';
    }

    public function startRfidReading()
    {
        // Check if device is online first
        $this->checkDeviceStatus();

        if ($this->deviceStatus !== 'online') {
            session()->flash('rfid-error', "RFID device is {$this->deviceStatus}. Please check the connection and try again.");
            return;
        }

        $this->rfidReading = true;
        $this->rfidData = '';

        // Clear any previous scan data
        $this->clearPreviousRfidData();

        // Start listening to Firebase for new RFID scans
        $this->dispatch('start-rfid-listening');

        // Set timeout for RFID reading (60 seconds - increased)
        $this->dispatch('set-rfid-timeout', timeout: 60000);

        Log::info('Started RFID reading session');
    }

    public function stopRfidReading()
    {
        $this->rfidReading = false;
        $this->dispatch('stop-rfid-listening');
        Log::info('Stopped RFID reading session');
    }

    /**
     * Clear previous RFID scan data to avoid processing old scans
     */
    private function clearPreviousRfidData()
    {
        try {
            // Mark any unprocessed scans as processed with timestamp check
            $currentTime = now()->timestamp * 1000;

            // Only clear scans from the last 5 minutes to avoid clearing valid scans
            $response = Http::get("{$this->firebaseUrl}/rfid_scans.json?orderBy=\"timestamp\"&startAt=\"" . ($currentTime - 300000) . "\"");

            if ($response->successful() && $response->json()) {
                $scans = $response->json();

                foreach ($scans as $timestamp => $scanData) {
                    if ($timestamp !== 'latest' && !($scanData['processed'] ?? false)) {
                        Http::patch("{$this->firebaseUrl}/rfid_scans/{$timestamp}.json", [
                            'processed' => true,
                            'processed_by' => 'system_cleanup',
                        ]);
                    }
                }
            }

            // Also clear latest
            Http::patch("{$this->firebaseUrl}/rfid_scans/latest.json", [
                'processed' => true,
            ]);

            Log::info('Cleared previous RFID scan data');
        } catch (\Exception $e) {
            Log::warning('Failed to clear previous RFID data: ' . $e->getMessage());
        }
    }

    #[On('rfid-detected')]
    public function handleRfidDetected($card_uid = null, $timestamp = null, $device_id = null)
    {
        if (!$this->rfidReading) {
            Log::info('RFID scan ignored - not currently reading');
            return; // Ignore if not currently reading
        }

        $this->stopRfidReading();

        try {
            Log::info('Processing RFID scan', [
                'card_uid' => $card_uid,
                'timestamp' => $timestamp,
                'device_id' => $device_id,
            ]);

            // Validate scan data
            if (!$card_uid || !$timestamp) {
                throw new \Exception('Invalid scan data structure - missing card_uid or timestamp');
            }

            $this->rfidData = $card_uid;

            // Find worker by RFID tag (sync with Firebase data)
            $worker = $this->findWorkerByRfid($card_uid);

            if ($worker) {
                // Check if worker is available
                if (!$worker->isAvailable()) {
                    session()->flash('rfid-error', "Pekerja {$worker->name} sedang mengerjakan booking lain.");
                    $this->sendAssignmentFeedback('no_available_worker', null);
                    return;
                }

                $this->selectedWorker = $worker->id;
                $this->assignedWorker = $worker;

                // Mark scan as processed
                $this->markScanAsProcessed($timestamp);

                session()->flash('rfid-success', "RFID berhasil dibaca: {$worker->name}");

                Log::info('RFID scan successful', [
                    'worker_id' => $worker->id,
                    'worker_name' => $worker->name,
                    'card_uid' => $card_uid,
                ]);
            } else {
                session()->flash('rfid-error', 'RFID tidak ditemukan atau tidak aktif dalam database pekerja');
                $this->sendAssignmentFeedback('worker_not_found', null);

                Log::warning('Worker not found for RFID', [
                    'card_uid' => $card_uid,
                ]);
            }
        } catch (\Exception $e) {
            Log::error('RFID handling error', [
                'error' => $e->getMessage(),
                'card_uid' => $card_uid,
                'timestamp' => $timestamp,
            ]);
            session()->flash('rfid-error', 'Terjadi kesalahan saat memproses RFID: ' . $e->getMessage());
            $this->sendAssignmentFeedback('processing_error', null);
        }
    }
    /**
     * Find worker by RFID with Firebase sync
     */
    private function findWorkerByRfid($cardUid)
    {
        try {
            Log::info("Finding worker by RFID: {$cardUid}");

            // First, check Firebase for card registration
            $response = Http::timeout(10)->get("{$this->firebaseUrl}/workers_cards/{$cardUid}.json");

            if ($response->successful() && $response->json()) {
                $cardData = $response->json();

                Log::info('Firebase card data', $cardData);

                if (!($cardData['is_active'] ?? false)) {
                    Log::info('Card is not active in Firebase');
                    return null;
                }

                $workerId = $cardData['worker_id'] ?? null;

                if (!$workerId) {
                    Log::info('No worker_id found in Firebase card data');
                    return null;
                }

                // Find worker in Laravel database
                $worker = Worker::where('id', $workerId)->where('is_active', true)->first();

                if ($worker) {
                    // Sync RFID tag if not set in Laravel
                    if (!$worker->rfid_tag) {
                        $worker->update(['rfid_tag' => $cardUid]);
                        Log::info('Synced RFID tag to worker', [
                            'worker_id' => $worker->id,
                            'rfid_tag' => $cardUid,
                        ]);
                    }
                }

                return $worker;
            }

            Log::info('No Firebase data found, checking Laravel database');

            // Fallback: search directly in Laravel database
            return Worker::where('rfid_tag', $cardUid)->where('is_active', true)->first();
        } catch (\Exception $e) {
            Log::error('Error finding worker by RFID', [
                'error' => $e->getMessage(),
                'card_uid' => $cardUid,
            ]);

            // Final fallback: Laravel database only
            return Worker::where('rfid_tag', $cardUid)->where('is_active', true)->first();
        }
    }

    /**
     * Mark RFID scan as processed in Firebase
     */
    private function markScanAsProcessed($timestamp)
    {
        try {
            Http::patch("{$this->firebaseUrl}/rfid_scans/{$timestamp}.json", [
                'processed' => true,
                'processed_at' => now()->toISOString(),
                'processed_by' => auth()->user()->name ?? 'System',
            ]);
            Log::info("Marked scan as processed: {$timestamp}");
        } catch (\Exception $e) {
            Log::warning('Failed to mark scan as processed: ' . $e->getMessage());
        }
    }

    public function assignWorker()
    {
        if (!$this->selectedWorker) {
            session()->flash('error', 'Pilih pekerja terlebih dahulu');
            return;
        }

        try {
            $worker = Worker::findOrFail($this->selectedWorker);

            // Double-check worker availability
            if (!$worker->isAvailable()) {
                session()->flash('error', "Pekerja {$worker->name} sedang mengerjakan booking lain.");
                $this->sendAssignmentFeedback('worker_not_available', $worker);
                return;
            }

            // Update booking status and assign worker
            $this->booking->update([
                'status' => Bookings::STATUS_CONFIRMED,
                'assigned_worker_id' => $this->selectedWorker,
                'assigned_at' => now(),
            ]);

            $worker->update( [
                'is_active' => false,
            ]);

            // Send feedback to Firebase/ESP32
            $this->sendAssignmentFeedback('success', $worker);

            $this->assignedWorker = $worker;
            $this->showSuccess = true;
            $this->closeAssignModal();

            // Refresh booking data
            $this->loadBooking();

            session()->flash('success', "Pekerja {$worker->name} berhasil ditugaskan untuk booking #{$this->booking->queue_number}");

            Log::info('Worker assigned successfully', [
                'booking_id' => $this->booking->id,
                'worker_id' => $worker->id,
                'worker_name' => $worker->name,
            ]);
        } catch (\Exception $e) {
            Log::error('Assignment error', [
                'error' => $e->getMessage(),
                'booking_id' => $this->bookingId,
                'worker_id' => $this->selectedWorker,
            ]);
            session()->flash('error', 'Terjadi kesalahan saat menugaskan pekerja');
            $this->sendAssignmentFeedback('assignment_failed', null);
        }
    }

    /**
     * Send assignment feedback to ESP32 via Firebase
     */
    private function sendAssignmentFeedback($status, $worker = null)
    {
        try {
            $feedback = [
                'status' => $status,
                'timestamp' => now()->toISOString(),
                'booking_id' => $this->booking->id,
                'queue_number' => $this->booking->queue_number,
                'message' => $this->getFeedbackMessage($status, $worker),
            ];

            if ($worker) {
                $feedback['worker_name'] = $worker->name;
                $feedback['worker_id'] = $worker->id;
            }

            $response = Http::put("{$this->firebaseUrl}/assignment_feedback/{$this->deviceId}.json", $feedback);

            Log::info('Assignment feedback sent', [
                'status' => $status,
                'feedback' => $feedback,
                'response_status' => $response->status(),
            ]);
        } catch (\Exception $e) {
            Log::warning('Failed to send assignment feedback: ' . $e->getMessage());
        }
    }

    private function getFeedbackMessage($status, $worker = null)
    {
        switch ($status) {
            case 'success':
                return $worker ? "Berhasil assign {$worker->name}" : 'Assignment berhasil';
            case 'worker_not_found':
                return 'RFID tidak terdaftar';
            case 'worker_not_available':
                return $worker ? "{$worker->name} sedang sibuk" : 'Pekerja tidak tersedia';
            case 'no_available_worker':
                return 'Pekerja sedang mengerjakan booking lain';
            case 'processing_error':
                return 'Terjadi kesalahan sistem';
            case 'assignment_failed':
                return 'Gagal melakukan assignment';
            default:
                return 'Status tidak dikenal';
        }
    }

    public function startProgress()
    {
        try {
            $this->booking->update([
                'status' => Bookings::STATUS_PROGRESS,
                'started_at' => now(),
            ]);

            $this->loadBooking();
            session()->flash('success', 'Pengerjaan dimulai');
        } catch (\Exception $e) {
            Log::error('Start progress error: ' . $e->getMessage());
            session()->flash('error', 'Terjadi kesalahan saat memulai pengerjaan');
        }
    }

    public function completeWork()
    {
        try {
            $this->booking->update([
                'status' => Bookings::STATUS_COMPLETED,
                'completed_at' => now(),
                'notes' => $this->booking->notes ? $this->booking->notes . "\n\nCatatan penyelesaian: " . $this->completionNotes : "Catatan penyelesaian: " . $this->completionNotes,
            ]);

            $this->loadBooking();
            $this->closeCompleteModal();

            session()->flash('success', 'Pengerjaan berhasil diselesaikan');

            Log::info('Work completed successfully', [
                'booking_id' => $this->booking->id,
                'worker_id' => $this->booking->assigned_worker_id,
                'completion_notes' => $this->completionNotes,
            ]);
        } catch (\Exception $e) {
            Log::error('Complete work error: ' . $e->getMessage());
            session()->flash('error', 'Terjadi kesalahan saat menyelesaikan pengerjaan');
        }
    }

    #[On('rfid-timeout')]
    public function handleRfidTimeout()
    {
        if ($this->rfidReading) {
            $this->stopRfidReading();
            session()->flash('rfid-error', 'Timeout menunggu scan RFID. Silakan coba lagi.');
            Log::info('RFID scan timeout');
        }
    }

    public function render()
    {
        $workers = Worker::where('is_active', true)->with('activeBookings')->get();

        return view('livewire.pengerjaan-admin', compact('workers'))->layout('layouts.base', [
            'title' => 'Detail Booking #' . $this->booking->queue_number,
        ]);
    }
}

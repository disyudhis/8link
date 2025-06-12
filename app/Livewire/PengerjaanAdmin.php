<?php

namespace App\Livewire;

use App\Models\Worker;
use Livewire\Component;
use App\Models\Bookings;

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

    public function mount($id)
    {
        $this->bookingId = $id;
        $this->loadBooking();
    }

    public function loadBooking()
    {
        $this->booking = Bookings::with(['customer', 'packagePrice.servicePackage', 'packagePrice.carCategory', 'checklist'])->findOrFail($this->bookingId);
    }

    public function openAssignModal()
    {
        $this->showAssignModal = true;
        $this->reset(['selectedWorker', 'rfidData', 'assignedWorker']);
    }

    public function closeAssignModal()
    {
        $this->showAssignModal = false;
        $this->stopRfidReading();
    }

    public function startRfidReading()
    {
        $this->rfidReading = true;
        $this->rfidData = '';

        // Dispatch event to start RFID reading on frontend
        $this->dispatch('start-rfid-reading');
    }

    public function stopRfidReading()
    {
        $this->rfidReading = false;
        $this->dispatch('stop-rfid-reading');
    }

    #[On('rfid-detected')]
    public function handleRfidDetected($rfidData)
    {
        $this->rfidData = $rfidData;
        $this->stopRfidReading();

        // Find worker by RFID
        $worker = Worker::where('rfid_tag', $rfidData)->first();

        if ($worker) {
            $this->selectedWorker = $worker->id;
            $this->assignedWorker = $worker;
        } else {
            session()->flash('rfid-error', 'RFID tidak ditemukan dalam database pekerja');
        }
    }

    public function assignWorker()
    {
        if (!$this->selectedWorker) {
            session()->flash('error', 'Pilih pekerja terlebih dahulu');
            return;
        }

        $worker = Worker::find($this->selectedWorker);

        // Update booking status and assign worker
        $this->booking->update([
            'status' => Bookings::STATUS_CONFIRMED,
            'assigned_worker_id' => $this->selectedWorker,
            'assigned_at' => now(),
        ]);

        $this->assignedWorker = $worker;
        $this->showSuccess = true;
        $this->closeAssignModal();

        // Refresh booking data
        $this->loadBooking();

        session()->flash('success', "Pekerja {$worker->name} berhasil ditugaskan untuk booking #{$this->booking->queue_number}");
    }

    public function confirmBooking()
    {
        $this->booking->update([
            'status' => Bookings::STATUS_CONFIRMED,
        ]);

        $this->loadBooking();
        session()->flash('success', 'Booking berhasil dikonfirmasi');
    }

    public function startProgress()
    {
        $this->booking->update([
            'status' => Bookings::STATUS_PROGRESS,
            'started_at' => now(),
        ]);

        $this->loadBooking();
        session()->flash('success', 'Pengerjaan dimulai');
    }

    public function render()
    {
        $workers = Worker::where('is_active', true)->get();

        return view('livewire.pengerjaan-admin', compact('workers'))->layout('layouts.base', [
            'title' => 'Detail Booking #' . $this->booking->queue_number,
        ]);
    }
}

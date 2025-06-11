<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Bookings;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Reservasi extends Component
{
    public $booking;
    public $bookingId;
    public $checklistItems = [];
    public $completedItems = [];
    public $showChecklistModal = false;
    public $showConfirmModal = false;
    public $rejectionReason = '';

    // Define status mapping
    protected $statusMap = [
        'pending' => ['label' => 'Menunggu Konfirmasi', 'order' => 1],
        'confirmed' => ['label' => 'Dikonfirmasi', 'order' => 2],
        'in_progress' => ['label' => 'Dalam Pengerjaan', 'order' => 3],
        'completed' => ['label' => 'Selesai', 'order' => 4],
    ];

    // Checklist items based on service package
    protected $defaultChecklistItems = ['Pembersihan awal mobil', 'Pengecekan kondisi cat', 'Aplikasi coating layer 1', 'Pengeringan layer 1', 'Aplikasi coating layer 2', 'Pengeringan layer 2', 'Aplikasi coating layer 3', 'Pengeringan layer 3', 'Aplikasi coating layer 4', 'Pengeringan layer 4', 'Quality control akhir'];

    protected $listeners = ['refreshBookingDetail' => '$refresh'];

    public function mount($id)
    {
        $this->bookingId = $id;
        $this->loadBooking();
        $this->initializeChecklist();
    }

    public function loadBooking()
    {
        $this->booking = Bookings::with(['customer', 'packagePrice.servicePackage'])->findOrFail($this->bookingId);
    }

    public function initializeChecklist()
    {
        // In a real app, you might fetch this from a checklist table
        // Here we're setting up demo data
        $this->checklistItems = $this->defaultChecklistItems;

        // For demo purposes, let's say some items are completed based on status
        if ($this->booking->status == 'in_progress') {
            $this->completedItems = [0, 1, 2, 3]; // First 4 items completed
        } elseif ($this->booking->status == 'completed') {
            $this->completedItems = range(0, count($this->checklistItems) - 1); // All completed
        }
    }

    // Admin Functions
    public function isAdmin()
    {
        return Auth::user()->user_type === User::ROLE_ADMIN;
    }

    public function canConfirm()
    {
        return $this->isAdmin() && $this->booking->status === Bookings::STATUS_PENDING;
    }

    public function confirmBooking()
    {
        if (!$this->canConfirm()) {
            session()->flash('error', 'Tidak dapat mengkonfirmasi reservasi ini.');
            return;
        }

        $this->booking->update([
            'status' => Bookings::STATUS_CONFIRMED,
        ]);

        session()->flash('message', 'Reservasi berhasil dikonfirmasi!');
        $this->loadBooking(); // Refresh data
    }

    public function showConfirmationModal()
    {
        if (!$this->canConfirm()) {
            return;
        }

        $this->showConfirmModal = true;
    }

    public function hideConfirmationModal()
    {
        $this->showConfirmModal = false;
        $this->rejectionReason = '';
    }

    public function rejectBooking()
    {
        if (!$this->canConfirm()) {
            session()->flash('error', 'Tidak dapat menolak reservasi ini.');
            return;
        }

        $this->validate(
            [
                'rejectionReason' => 'required|min:10|max:500',
            ],
            [
                'rejectionReason.required' => 'Alasan penolakan harus diisi.',
                'rejectionReason.min' => 'Alasan penolakan minimal 10 karakter.',
                'rejectionReason.max' => 'Alasan penolakan maksimal 500 karakter.',
            ],
        );

        $this->booking->update([
            'status' => Bookings::STATUS_CANCELLED,
            'notes' => $this->booking->notes . "\n\nDitolak oleh admin: " . $this->rejectionReason,
        ]);

        session()->flash('message', 'Reservasi berhasil ditolak.');
        $this->hideConfirmationModal();
        $this->loadBooking(); // Refresh data
    }

    // Existing Customer Functions
    public function toggleChecklistModal()
    {
        $this->showChecklistModal = !$this->showChecklistModal;
    }

    public function updateChecklist()
    {
        // In a real app, you would save the checklist to database
        // For now, we'll just toggle the modal and update status if all checked

        // Check if all items are completed
        if (count($this->completedItems) == count($this->checklistItems)) {
            $this->booking->status = 'completed';
            $this->booking->save();
        } elseif (count($this->completedItems) > 0) {
            $this->booking->status = 'in_progress';
            $this->booking->save();
        }

        $this->toggleChecklistModal();
        session()->flash('message', 'Checklist berhasil diperbarui!');
    }

    public function toggleChecklistItem($index)
    {
        if (in_array($index, $this->completedItems)) {
            $this->completedItems = array_diff($this->completedItems, [$index]);
        } else {
            $this->completedItems[] = $index;
        }
    }

    public function getWhatsappUrl()
    {
        $phone = '+6281332448868'; // In a real app, get from a technician or admin user

        $message = "Halo, saya {$this->booking->customer->name} pemilik {$this->booking->car_name} dengan nomor plat {$this->booking->license_plate}. Saya ingin menanyakan status pengerjaan mobil saya.";

        return "https://wa.me/{$phone}?text=" . urlencode($message);
    }

    public function getStatusesProperty()
    {
        $currentFound = false;
        $statuses = $this->statusMap;

        // Sort by order
        uasort($statuses, function ($a, $b) {
            return $a['order'] <=> $b['order'];
        });

        foreach ($statuses as $key => &$status) {
            if ($key == $this->booking->status) {
                $status['current'] = true;
                $currentFound = true;
            } else {
                $status['current'] = false;
            }

            $status['completed'] = !$currentFound && $status['order'] < $this->getStatusOrder($this->booking->status);
        }

        return $statuses;
    }

    protected function getStatusOrder($status)
    {
        return $this->statusMap[$status]['order'] ?? 0;
    }

    public function render()
    {
        return view('livewire.reservasi')->layout('layouts.base', [
            'title' => 'Detail Reservasi',
        ]);
    }
}
<?php

namespace App\Livewire;

use App\Models\Bookings;
use Livewire\Component;
use Livewire\WithPagination;

class AntrianAdmin extends Component
{
    use WithPagination;

    public $selectedStatus = 'pending';
    public $search = '';
    public $showConfirmModal = false;
    public $selectedBooking = null;

    protected $paginationTheme = 'tailwind';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingSelectedStatus()
    {
        $this->resetPage();
    }

    public function confirmBooking($bookingId)
    {
        $this->selectedBooking = Bookings::find($bookingId);
        $this->showConfirmModal = true;
    }

    public function processConfirmation()
    {
        if ($this->selectedBooking) {
            $this->selectedBooking->update([
                'status' => Bookings::STATUS_CONFIRMED,
            ]);

            $this->dispatch('booking-confirmed', [
                'message' => 'Booking berhasil dikonfirmasi!',
            ]);

            $this->closeModal();
        }
    }

    public function cancelBooking($bookingId)
    {
        $booking = Bookings::find($bookingId);
        if ($booking) {
            $booking->update([
                'status' => Bookings::STATUS_CANCELLED,
            ]);

            $this->dispatch('booking-cancelled', [
                'message' => 'Booking berhasil dibatalkan!',
            ]);
        }
    }

    public function closeModal()
    {
        $this->showConfirmModal = false;
        $this->selectedBooking = null;
    }

    public function render()
    {
        $query = Bookings::with(['customer', 'packagePrice'])
            ->when($this->selectedStatus !== 'all', function ($q) {
                $q->where('status', $this->selectedStatus);
            })
            ->when($this->search, function ($q) {
                $q->where(function ($query) {
                    $query
                        ->where('license_plate', 'like', '%' . $this->search . '%')
                        ->orWhere('car_name', 'like', '%' . $this->search . '%')
                        ->orWhere('queue_number', 'like', '%' . $this->search . '%')
                        ->orWhereHas('customer', function ($q) {
                            $q->where('name', 'like', '%' . $this->search . '%');
                        });
                });
            })
            ->orderBy('created_at', 'desc');

        $bookings = $query->paginate(10);

        $statusCounts = [
            'pending' => Bookings::where('status', Bookings::STATUS_PENDING)->count(),
            'confirmed' => Bookings::where('status', Bookings::STATUS_CONFIRMED)->count(),
            'in_progress' => Bookings::where('status', Bookings::STATUS_PROGRESS)->count(),
            'completed' => Bookings::where('status', Bookings::STATUS_COMPLETED)->count(),
            'cancelled' => Bookings::where('status', Bookings::STATUS_CANCELLED)->count(),
        ];

        return view('livewire.antrian-admin', [
            'bookings' => $bookings,
            'statusCounts' => $statusCounts,
        ])->layout('layouts.base', [
            'title' => 'Dashboard Admin - Antrian Mobil',
        ]);
    }
}

<?php

namespace App\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Bookings;

class Home extends Component
{
    public $bookings = [];
    public $loading = true;

    // Status labels
    protected $statusLabels = [
        'pending' => 'Menunggu',
        'processing' => 'Diproses',
        'completed' => 'Selesai',
        'cancelled' => 'Dibatalkan'
    ];

    public function mount()
    {
        $this->loadBookings();
    }

    public function loadBookings()
    {
        $this->loading = true;

        $this->bookings = Bookings::where('customer_id', auth()->id())
            ->with('packagePrice')
            ->orderByRaw("FIELD(status, 'processing', 'pending', 'completed', 'cancelled')")
            ->orderBy('booking_date', 'desc')
            ->get();

        $this->loading = false;
    }

    public function cancelBooking($bookingId)
    {
        $booking = Bookings::find($bookingId);

        if (!$booking || $booking->customer_id !== auth()->id()) {
            $this->dispatchBrowserEvent('show-message', [
                'type' => 'error',
                'message' => 'Booking tidak ditemukan!'
            ]);
            return;
        }

        if ($booking->status !== 'pending') {
            $this->dispatchBrowserEvent('show-message', [
                'type' => 'error',
                'message' => 'Hanya booking dengan status menunggu yang dapat dibatalkan!'
            ]);
            return;
        }

        $booking->status = 'cancelled';
        $booking->save();

        $this->dispatchBrowserEvent('show-message', [
            'type' => 'success',
            'message' => 'Booking berhasil dibatalkan!'
        ]);

        // Reload bookings
        $this->loadBookings();
    }

    public function formatDate($date)
    {
        return Carbon::parse($date)->locale('id')->isoFormat('dddd, D MMMM YYYY');
    }

    public function getStatusLabels()
    {
        return $this->statusLabels;
    }

    public function render()
    {
        return view('livewire.home', [
            'statusLabels' => $this->statusLabels
        ])->layout('layouts.base', [
            'title' => 'Dashboard',
            'description' => 'Selamat datang di dashboard Anda. Kelola reservasi dan layanan Anda dengan mudah.',
        ]);
    }
}
<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Bookings;
use Livewire\WithPagination;

class ListReservasi extends Component
{
    use WithPagination;

    public $search = '';
    public $status = '';
    public $sortField = 'booking_date';
    public $sortDirection = 'desc';

    protected $queryString = [
        'search' => ['except' => ''],
        'status' => ['except' => ''],
        'sortField' => ['except' => 'booking_date'],
        'sortDirection' => ['except' => 'desc'],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function render()
    {
        $bookings = Bookings::query()
            ->where('customer_id', auth()->id())
            ->when($this->search, function ($query) {
                $query->where(function ($query) {
                    $query->where('license_plate', 'like', '%' . $this->search . '%')
                        ->orWhere('car_name', 'like', '%' . $this->search . '%')
                        ->orWhereHas('customer', function ($query) {
                            $query->where('name', 'like', '%' . $this->search . '%')
                                ->orWhere('email', 'like', '%' . $this->search . '%')
                                ->orWhere('phone', 'like', '%' . $this->search . '%');
                        });
                });
            })
            ->when($this->status, function ($query) {
                $query->where('status', $this->status);
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->with(['customer', 'packagePrice'])
            ->paginate(10);

        return view('livewire.list-reservasi', [
            'bookings' => $bookings,
        ])->layout('layouts.base', [
            'title' => 'List Reservasi',
        ]);
    }
}

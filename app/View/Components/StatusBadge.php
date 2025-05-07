<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class StatusBadge extends Component
{
    /**
     * Status dari badge.
     *
     * @var string
     */
    public $status;

    /**
     * Create a new component instance.
     *
     * @param  string  $status
     * @return void
     */
    public function __construct($status)
    {
        $this->status = $status;
    }

    /**
     * Get the color class based on status.
     *
     * @return string
     */
    public function colorClass()
    {
        return [
            'pending' => 'bg-yellow-100 text-yellow-800',
            'confirmed' => 'bg-blue-100 text-blue-800',
            'in_progress' => 'bg-indigo-100 text-indigo-800',
            'completed' => 'bg-green-100 text-green-800',
            'cancelled' => 'bg-red-100 text-red-800',
        ][$this->status] ?? 'bg-gray-100 text-gray-800';
    }

    /**
     * Get the label text based on status.
     *
     * @return string
     */
    public function label()
    {
        return [
            'pending' => 'Menunggu',
            'confirmed' => 'Terkonfirmasi',
            'in_progress' => 'Proses',
            'completed' => 'Selesai',
            'cancelled' => 'Batal',
        ][$this->status] ?? $this->status;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.status-badge');
    }
}
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
            'pending' => 'bg-yellow-500 text-black',
            'confirmed' => 'bg-blue-500 text-white',
            'in_progress' => 'bg-indigo-500 text-white',
            'completed' => 'bg-green-500 text-white',
            'cancelled' => 'bg-red-500 text-white',
        ][$this->status] ?? 'bg-gray-500 text-black';
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

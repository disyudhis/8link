<?php

namespace App\Livewire;

use Livewire\Component;

class Reservasi extends Component
{
    public function render()
    {
        return view('livewire.reservasi')->layout('layouts.base', [
            'title' => 'Reservasi'
        ]);
    }
}
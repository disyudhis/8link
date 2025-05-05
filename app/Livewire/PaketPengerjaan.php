<?php

namespace App\Livewire;

use Livewire\Component;

class PaketPengerjaan extends Component
{
    public $activeToggle = true;

    public function render()
    {
        // Simulasi data paket
        $paketData = [
            [
                'name' => 'Paket Silver 1 Layer',
                'description' => 'Interior, Eksterior, Mesin, Coating',
                'price_range' => 'Rp.1.000.000 - Rp.1.900.000',
                'sizes' => ['S', 'M', 'L', 'XL']
            ],
            [
                'name' => 'Paket Gold 3 Layer',
                'description' => 'Interior, Eksterior, Mesin, Coating',
                'price_range' => 'Rp.1.750.000 - Rp.3.250.000',
                'sizes' => ['S', 'M', 'L', 'XL']
            ],
            [
                'name' => 'Paket Diamond 4 Layer',
                'description' => 'Interior, Eksterior, Mesin, Coating',
                'price_range' => 'Rp.2.100.000 - Rp.4.000.000',
                'sizes' => ['S', 'M', 'L', 'XL']
            ],
            [
                'name' => 'Poles Eksterior',
                'description' => 'Eksterior, Coating',
                'price_range' => 'Rp.500.000 - Rp.1.250.000',
                'sizes' => ['S', 'M', 'L', 'XL']
            ],
        ];

        return view('livewire.paket-pengerjaan', [
            'paketData' => $paketData
        ])->layout('layouts.base', [
            'title' => 'Paket Pengerjaan'
        ]);
    }
}
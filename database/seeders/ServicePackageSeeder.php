<?php

namespace Database\Seeders;

use App\Models\ServicePackages;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServicePackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ServicePackages::insert([
            [
                'id' => 1,
                'name' => 'Paket Exterior & Body',
                'description' => 'Paket ini mencakup perawatan eksterior mobil, termasuk pencucian, waxing, dan perlindungan cat.',
            ],
            [
                'id' => 2,
                'name' => 'Paket List Gold 1 Layer',
                'description' => 'Paket ini mencakup pemasangan list gold pada mobil, memberikan sentuhan mewah dan elegan.',
            ],
            [
                'id' => 3,
                'name' => 'Paket List Platinum 3 Layer',
                'description' => 'Paket ini mencakup pemasangan list platinum pada mobil, memberikan tampilan yang lebih premium.',
            ],
        ]);
    }
}
<?php

namespace Database\Seeders;

use App\Models\PackagePrices;
use Illuminate\Database\Seeder;

class PackagePriceSeeder extends Seeder
{
    public function run(): void
    {
        $prices = [];

        foreach (range(1, 3) as $packageId) {
            foreach (range(1, 5) as $categoryId) {
                $base = match ($packageId) {
                    1 => [1000, 1300, 1300, 1500, 1800],
                    2 => [1650, 1950, 1950, 2250, 2750],
                    3 => [2400, 3000, 3000, 3500, 4000],
                };
                $prices[] = [
                    'service_package_id' => $packageId,
                    'car_category_id' => $categoryId,
                    'price' => $base[$categoryId - 1]
                ];
            }
        }

        PackagePrices::insert($prices);
    }

}
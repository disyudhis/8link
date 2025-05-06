<?php

namespace Database\Seeders;

use App\Models\CarCategories;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CarCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CarCategories::insert([
            [
                'id' => 1,
                'name' => 'LCGC',
                'code' => 'S',
                'description' => 'A Low Cost Green Car (LCGC) is a type of car that is designed to be affordable and environmentally friendly.',
            ],
            [
                'id' => 2,
                'name' => 'HATCHBACK',
                'code' => 'M',
                'description' => 'A hatchback is a car design featuring a rear door that swings upwards, providing access to the car\'s interior.',
            ],
            [
                'id' => 3,
                'name' => 'SEDAN',
                'code' => 'M',
                'description' => 'A sedan is a passenger car with a three-box configuration, typically featuring four doors and a separate trunk.',
            ],
            [
                'id' => 4,
                'name' => 'MPV',
                'code' => 'L',
                'description' => 'A Multi-Purpose Vehicle (MPV) is a versatile vehicle designed for transporting passengers and cargo.',
            ],
            [
                'id' => 5,
                'name' => 'LUXURY',
                'code' => 'XL',
                'description' => 'A luxury car is a high-end vehicle that offers superior comfort, performance, and features compared to standard cars.',
            ],
        ]);
    }
}
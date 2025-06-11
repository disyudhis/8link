<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'user_type' => 'ADMIN'
        ]);
        
        $this->call([
            CarCategorySeeder::class,
            ServicePackageSeeder::class,
            PackagePriceSeeder::class,
            // Add other seeders here
        ]);
    }
}

<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class WorkerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $workers = [
            [
                'name' => 'Ahmad Fauzi',
                'email' => 'ahmad.fauzi@example.com',
                'phone' => '081234567890',
                'rfid_tag' => '8D2D3402',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Budi Santoso',
                'email' => 'budi.santoso@example.com',
                'phone' => '081234567891',
                'rfid_tag' => 'F69BC801',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Candra Wijaya',
                'email' => 'candra.wijaya@example.com',
                'phone' => '081234567892',
                'rfid_tag' => 'RFID_CW003',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dedi Kurniawan',
                'email' => 'dedi.kurniawan@example.com',
                'phone' => '081234567893',
                'rfid_tag' => 'RFID_DK004',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Eko Prasetyo',
                'email' => 'eko.prasetyo@example.com',
                'phone' => '081234567894',
                'rfid_tag' => 'RFID_EP005',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Farid Rahman',
                'email' => 'farid.rahman@example.com',
                'phone' => '081234567895',
                'rfid_tag' => 'RFID_FR006',
                'is_active' => false, // Worker tidak aktif untuk testing
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('workers')->insert($workers);
    }
}

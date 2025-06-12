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
                'specialization' => 'Cat Body',
                'rfid_tag' => 'RFID_AF001',
                'is_active' => true,
                'hire_date' => Carbon::now()->subMonths(12),
                'hourly_rate' => 50000,
                'notes' => 'Ahli cat body dengan pengalaman 5 tahun',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Budi Santoso',
                'email' => 'budi.santoso@example.com',
                'phone' => '081234567891',
                'specialization' => 'Cat Bumper',
                'rfid_tag' => 'RFID_BS002',
                'is_active' => true,
                'hire_date' => Carbon::now()->subMonths(8),
                'hourly_rate' => 45000,
                'notes' => 'Spesialis cat bumper dan trim',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Candra Wijaya',
                'email' => 'candra.wijaya@example.com',
                'phone' => '081234567892',
                'specialization' => 'Poles & Detail',
                'rfid_tag' => 'RFID_CW003',
                'is_active' => true,
                'hire_date' => Carbon::now()->subMonths(6),
                'hourly_rate' => 40000,
                'notes' => 'Ahli poles dan detailing kendaraan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dedi Kurniawan',
                'email' => 'dedi.kurniawan@example.com',
                'phone' => '081234567893',
                'specialization' => 'Cat & Dempul',
                'rfid_tag' => 'RFID_DK004',
                'is_active' => true,
                'hire_date' => Carbon::now()->subMonths(15),
                'hourly_rate' => 55000,
                'notes' => 'Senior worker dengan keahlian dempul dan cat',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Eko Prasetyo',
                'email' => 'eko.prasetyo@example.com',
                'phone' => '081234567894',
                'specialization' => 'Touch Up',
                'rfid_tag' => 'RFID_EP005',
                'is_active' => true,
                'hire_date' => Carbon::now()->subMonths(3),
                'hourly_rate' => 35000,
                'notes' => 'Spesialis touch up dan perbaikan minor',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Farid Rahman',
                'email' => 'farid.rahman@example.com',
                'phone' => '081234567895',
                'specialization' => 'Cat Body',
                'rfid_tag' => 'RFID_FR006',
                'is_active' => false, // Worker tidak aktif untuk testing
                'hire_date' => Carbon::now()->subMonths(24),
                'hourly_rate' => 60000,
                'notes' => 'Sedang cuti panjang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('workers')->insert($workers);
    }
}
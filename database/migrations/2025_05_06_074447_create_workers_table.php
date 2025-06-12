<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('workers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->string('phone')->nullable();
            $table->string('specialization')->nullable()->comment('e.g., Cat Body, Cat Bumper, Poles, Detail');
            $table->string('rfid_tag')->unique()->nullable()->comment('RFID tag untuk identifikasi worker');
            $table->boolean('is_active')->default(true)->comment('Status aktif worker');
            $table->date('hire_date')->nullable()->comment('Tanggal mulai kerja');
            $table->decimal('hourly_rate', 10, 2)->nullable()->comment('Tarif per jam (opsional)');
            $table->text('notes')->nullable()->comment('Catatan tambahan tentang worker');
            $table->timestamps();

            // Indexes untuk performa
            $table->index('is_active');
            $table->index('specialization');
            $table->index('rfid_tag');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workers');
    }
};

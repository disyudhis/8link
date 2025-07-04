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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('queue_number')->nullable();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->foreign('customer_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('package_price_id')->nullable();
            $table->foreign('package_price_id')->references('id')->on('package_prices')->onDelete('cascade');
            $table->string('license_plate')->nullable();
            $table->string('car_name')->nullable();
            $table->string('car_color')->nullable();
            $table->date(column: 'booking_date')->nullable();
            $table->enum('status', ['pending', 'confirmed', 'in_progress', 'completed', 'cancelled'])->nullable();
            $table->string('total_price')->nullable();
            $table->text('notes')->nullable();
            $table->unsignedBigInteger('assigned_worker_id')->nullable();
            $table->time('assigned_at')->nullable();
            $table->time('started_at')->nullable();
            $table->datetime('completed_at')->nullable();
            $table->foreign('assigned_worker_id')->references('id')->on('workers')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};

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
        Schema::create('package_prices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('service_package_id')->nullable();
            $table->foreign('service_package_id')->references('id')->on('service_packages')->onDelete('cascade');
            $table->unsignedBigInteger('car_category_id')->nullable();
            $table->foreign('car_category_id')->references('id')->on('car_categories')->onDelete('cascade');
            $table->decimal('price', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('package_prices');
    }
};
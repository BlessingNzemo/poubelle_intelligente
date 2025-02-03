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
        Schema::create('bin_datas', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('bin_id')->constrained()->cascadeOnDelete();
            $table->float('fill_level');
            $table->float('temperature')->nullable();
            $table->float('battery_voltage');
            $table->json('sensor_data')->nullable(); // Données brutes
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bin_datas');
    }
};

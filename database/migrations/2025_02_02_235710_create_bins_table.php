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
        Schema::create('bins', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('location');
            $table->decimal('latitude', 10, 8)->default(0);
            $table->decimal('longitude', 10, 8)->default(0);
            $table->float('fill_level')->default(0);
            $table->float('battery_level')->default(100);
            $table->integer('signal_strength')->default(3); // 1-3 (faible/moyen/fort)
            $table->boolean('is_connected')->default(true);
            $table->timestamp('last_communication')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bins');
    }
};

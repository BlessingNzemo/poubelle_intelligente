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
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 10, 8)->nullable();
            $table->float('fill_level')->nullable();
            $table->float('temperature')->nullable();
            $table->float('humidity')->nullable();
            $table->boolean('is_open')->nullable(); // Ajout pour l'état du servomoteur
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

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
        Schema::create('assigned_bins', function (Blueprint $table) {
            $table->foreignUuid('bin_id')->constrained()->cascadeOnDelete(); // Notez "bin_id" au lieu de "bins_id"
    $table->foreignId('user_id')->constrained()->cascadeOnDelete();
    $table->primary(['bin_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assigned_bins');
    }
};

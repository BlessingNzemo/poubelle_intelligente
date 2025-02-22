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
            $table->id(); // UUID unique de la poubelle
            $table->string('serial_number')->unique(); // Numéro de série unique
            $table->string('name')->nullable(); // Nom de la poubelle (optionnel)
            $table->string('location')->nullable(); // Emplacement de la poubelle (optionnel)
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // Clé étrangère vers la table users
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

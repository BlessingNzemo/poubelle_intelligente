<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrashcandataTable extends Migration
{
    public function up()
    {
        Schema::create('trashcan_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trashcan_id')->constrained();
            $table->float('fill_percentage');
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);
            $table->boolean('is_full')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('trashcandata');
    }
}

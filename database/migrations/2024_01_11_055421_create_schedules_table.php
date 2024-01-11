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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->string('bus');
            $table->string('line');
            $table->unsignedBigInteger('from_place_id');
            $table->unsignedBigInteger('to_place_id');
            $table->string('departure_time');
            $table->string('arrival_time');
            $table->string('distance');
            $table->string('speed');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};

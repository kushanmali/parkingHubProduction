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
        Schema::create('parking_locations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parking_id');
            $table->foreign('parking_id')->references('id')->on('parkings')->onDelete('cascade');
            $table->string('address_address');
            $table->decimal('address_latitude', 10, 8);
            $table->decimal('address_longitude', 11, 8);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parking_locations');
    }
};

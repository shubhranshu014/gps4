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
        Schema::create('allocated_bar_codes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mfg_id');  // Add the foreign key column
            $table->foreign('mfg_id')                          // Define the foreign key constraint
                  ->references('id')->on('manufacturers')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->unsignedBigInteger('distributor_id');
            $table->foreign('distributor_id')->references('id')->on('distributors')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('dealer_id')->nullable();
            $table->foreign('dealer_id')->references('id')->on('dealers')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('barcode_id');
            $table->foreign('barcode_id')->references('id')->on('bar_codes')->onUpdate('cascade')->onDelete('cascade');
            $table->enum('status', ['0','1'])->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('allocated_bar_codes');
    }
};

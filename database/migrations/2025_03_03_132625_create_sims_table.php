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
        Schema::create('sims', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('barcode_id');
            $table->foreign('barcode_id')->references('id')->on('bar_codes')->onUpdate('cascade')->onDelete('cascade');
            $table->string('simNo');
            $table->string('ICCIDNo');
            $table->string('validity');
            $table->string('operator');
            $table->string('manufacture')->default('wemis');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sims');
    }
};

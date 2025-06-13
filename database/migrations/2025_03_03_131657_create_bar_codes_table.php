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
        Schema::create('bar_codes', function (Blueprint $table) {
            $table->id();
            // Manufacturer information
            $table->unsignedBigInteger('mfg_id');
            $table->foreign('mfg_id')->references('id')->on('manufacturers')->onUpdate('cascade')->onDelete('cascade');
            //  Device information
            $table->unsignedBigInteger('element_id');
            $table->foreign('element_id')->references('id')->on('elements')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('type_id');
            $table->foreign('type_id')->nullable()->references('id')->on('element_types')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('model_id');
            $table->foreign('model_id')->nullable()->references('id')->on('model_nos')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger(column: 'part_id');
            $table->foreign('part_id')->nullable()->references('id')->on('part_nos')->onUpdate('cascade')->onDelete('cascade');
            //  Technical Specifications
            $table->unsignedBigInteger(column: 'tac_id');
            $table->foreign('tac_id')->nullable()->references('id')->on('tacs')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger(column: 'cop_id');
            $table->foreign('cop_id')->nullable()->references('id')->on('cops')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger(column: 'testing_agencyId');
            $table->foreign('testing_agencyId')->nullable()->references('id')->on('testing_agencies')->onUpdate('cascade')->onDelete('cascade');
            $table->string('serialNumber');
            $table->string('barcodeNo');
            $table->string('IMEINO');
            $table->string('batchNo');
            $table->enum('is_renew', ['0', '1'])->nullable();
            $table->enum('status', ['0', '1', '2'])->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bar_codes');
    }
};

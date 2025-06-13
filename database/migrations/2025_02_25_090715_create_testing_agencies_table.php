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
        Schema::create('testing_agencies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('element_id')->nullable();
            $table->foreign('element_id')->references('id')->on('elements')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('type_id')->nullable();
            $table->foreign('type_id')->references('id')->on('element_types')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('model_id')->nullable();
            $table->foreign('model_id')->references('id')->on('model_nos')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('part_id')->nullable();
            $table->foreign('part_id')->references('id')->on('part_nos')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('tacNo')->nullable();
            $table->foreign('tacNo')->references('id')->on('tacs')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('copNo')->nullable();
            $table->foreign('copNo')->references('id')->on('cops')->onUpdate('cascade')->onDelete('cascade');
            $table->string('testingAgency');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testing_agencies');
    }
};

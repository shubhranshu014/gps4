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
        Schema::create('cops', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('element_id')->nullable();
            $table->foreign('element_id')->nullable()->references('id')->on('elements')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('type_id')->nullable();
            $table->foreign('type_id')->nullable()->references('id')->on('element_types')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('model_id')->nullable();
            $table->foreign('model_id')->nullable()->references('id')->on('model_nos')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('part_id')->nullable();
            $table->foreign('part_id')->nullable()->references('id')->on('part_nos')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('tacNo')->nullable();
            $table->foreign('tacNo')->nullable()->references('id')->on('tacs')->onUpdate('cascade')->onDelete('cascade');
            $table->string('COPNo');
            $table->string('validTill');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cops');
    }
};

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
        Schema::create('element_types', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('element_id')->nullable();
            $table->foreign('element_id')->nullable()->references('id')->on('elements')->onUpdate('cascade')->onDelete('cascade');
            $table->string('type');
            $table->integer('sim_count')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('element_types');
    }
};

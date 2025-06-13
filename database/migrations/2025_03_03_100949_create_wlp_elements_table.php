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
        Schema::create('wlp_elements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->foreign('admin_id')->references('id')->on('admins')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('wlp_id')->nullable();
            $table->foreign('wlp_id')->references('id')->on('wlps')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('element_id')->nullable();
            $table->foreign('element_id')->references('id')->on('elements')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wlp_elements');
    }
};

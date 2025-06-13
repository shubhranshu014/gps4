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
        Schema::create('manufacturers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_id');
            $table->foreign('parent_id')->references('id')->on('wlps')->onUpdate('cascade')->onDelete('cascade');
            $table->string('country');
            $table->string('state');
            $table->string('code');
            $table->string('businees_name');
            $table->string('gst_no');
            $table->string('name');
            $table->string('mobile_no');
            $table->string('email');
            $table->string('password');
            $table->string('passwordText');
            $table->string('tollfreeNo');
            $table->string('website');
            $table->longText('address');
            $table->longText('logo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manufacturers');
    }
};

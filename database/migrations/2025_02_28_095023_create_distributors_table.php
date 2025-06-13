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
        Schema::create('distributors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('manuf_id');
            $table->foreign('manuf_id')->references('id')->on('manufacturers')->onUpdate('cascade')->onDelete('cascade');
            $table->string('business_name');
            $table->string('name');
            $table->string('email');
            $table->string('password');
            $table->string('passwordText');
            $table->string('gender');
            $table->string('mobile');
            $table->string('dob');
            $table->string('is_map_device_edit');
            $table->string('pan_number');
            $table->string('occupation');
            $table->string('advance_payment');
            $table->string('language_known');
            $table->string('country');
            $table->string('state');
            // $table->string('rto_devision');
            $table->longText('districts');
            // $table->string('pincode');
            // $table->string('area');
            $table->longText('address');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('distributors');
    }
};

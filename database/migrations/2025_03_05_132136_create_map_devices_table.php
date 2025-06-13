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
        Schema::create('map_devices', function (Blueprint $table) {
            $table->id();
            // $table->string('name');
            // $table->string('email');
           
            $table->string('customer_name')->nullable();
            $table->string('customer_email')->nullable();
            $table->string('password');
            $table->string('passwordText');
            $table->string('customer_mobile')->nullable();
            $table->string('customer_gst_no')->nullable();
            $table->string('customer_state')->nullable();
            $table->string('customer_district')->nullable();
            $table->string('customer_arear')->nullable();
            $table->string('customer_pincode')->nullable();
            $table->string('customer_address')->nullable();
            $table->string('customer_rto_division')->nullable();
            $table->string('customer_aadhaar')->nullable();
            $table->string('customer_pan')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('map_devices');
    }
};

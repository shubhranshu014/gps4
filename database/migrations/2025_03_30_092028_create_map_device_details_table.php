<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('map_device_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mapDevice_id')->nullable();
            $table->foreign('mapDevice_id')->references('id')->on('map_devices')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('dealer_id')->nullable();
            $table->foreign('dealer_id')->references('id')->on('dealers')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('technician_id')->nullable();
            $table->foreign('technician_id')->references('id')->on('technicians')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('package_id')->nullable();
            $table->foreign('package_id')->references('id')->on('subscriptions')->onUpdate('cascade')->onDelete('cascade');
            $table->string('device_type')->nullable();
            $table->string('device_seriel_no')->nullable();
            $table->string('vehicle_birth')->nullable();
            $table->string('vehicle_registration_number')->nullable();
            $table->string('date')->nullable();
            $table->string('vehicle_chassis_no')->nullable();
            $table->string('vehicle_engine_no')->nullable();
            $table->string('vehicle_type')->nullable();
            $table->string('vehicle_make_model')->nullable();
            $table->string('vehicle_model_year')->nullable();
            $table->string('vehicle_insurance_renew_date')->nullable();
            $table->string('vehicle_pollution_renew_date')->nullable();
            $table->string('invoice_no')->nullable();
            $table->string('vehicle_km_reading')->nullable();
            $table->string('driver_license_no')->nullable();
            $table->string('mapped_date')->nullable();
            $table->string('no_of_panic_buttons')->nullable();
            $table->string('vehicle')->nullable();
            $table->string('rc')->nullable();
            $table->string('device')->nullable();
            $table->string('pan')->nullable();
            $table->string('aadhaar')->nullable();
            $table->string('invoice')->nullable();
            $table->string('signature')->nullable();
            $table->string('panic_button')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('map_device_details');
    }
};

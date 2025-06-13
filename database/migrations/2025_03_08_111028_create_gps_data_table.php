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
        Schema::create('gps_data', function (Blueprint $table) {
            $table->id();
            $table->string('packetHeader');
            $table->string('vendorID');
            $table->string('firmwareVersion');
            $table->string('packetType');
            $table->string('alertID');
            $table->string('packetStatus');
            $table->string('IMEINumber');
            $table->string('vehicleNo');
            $table->string('GPSFix');
            $table->string('currentDate');
            $table->string('currentTime');
            $table->string('latitude');
            $table->string('latitudeDirection');
            $table->string('longitude');
            $table->string('longitudeDirection');
            $table->string('speed');
            $table->string('headDegree');
            $table->string('numberofSatellites');
            $table->string('altitude');
            $table->string('PDOP');
            $table->string('HDOP');
            $table->string('networkOperator');
            $table->string('ignitionStatus');
            $table->string('mainsPowerStatus');
            $table->string('mainsInputVoltage');
            $table->string('internalBatteryVoltage');
            $table->string('SOSstatus');
            $table->string('tamperAlert');
            $table->string('GSMSignal');
            $table->string('MCC');
            $table->string('MNC');
            $table->string('LAC');
            $table->string('cellID');
            $table->string('NMR1');
            $table->string('NMR2');
            $table->string('NMR3');
            $table->string('NMR4');
            $table->string('NMR5');
            $table->string('NMR6');
            $table->string('NMR7');
            $table->string('NMR8');
            $table->string('NMR9');
            $table->string('NMR10');
            $table->string('NMR11');
            $table->string('NMR12');
            $table->string('digitalInputs');
            $table->string('digitalOutput');
            $table->string('analogInput1');
            $table->string('frameNo');
            $table->string('checksumandEnd');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gps_data');
    }
};

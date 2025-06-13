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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mfg_id');
            $table->foreign('mfg_id')->references('id')->on('manufacturers')->onUpdate('cascade')->onDelete('cascade');
            $table->string('packageType');
            $table->string('packageName');
            $table->string('billingCycle');
            $table->string('description');
            $table->decimal('price');
            $table->string('isRenewal')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};

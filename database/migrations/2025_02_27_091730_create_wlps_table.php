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
        Schema::create('wlps', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id');
            $table->foreign('admin_id')->references('id')->on('admins')->onUpdate('cascade')->onDelete('cascade');
            $table->string('country');
            $table->string('state');
            $table->string('default_lan')->nullable();
            $table->string('name')->nullable();
            $table->string('mobile_no');
            // $table->string('parent_name')->nullable();
            // $table->string('parent_code')->nullable();
            // $table->string('website')->nullable();
            // $table->string('web_url')->nullable();
           
            $table->string('sales_mobile_no')->nullable();
            $table->string('sales_landline_no')->nullable();
            $table->string('email');

            $table->string('smart_parent_app_package');
            $table->string('show_powered_by');
            $table->string('power_by')->nullable();

            $table->string('account_limit');
            $table->string('http_sms_url')->nullable();
            $table->string('http_sms__gateway_method')->nullable();
            $table->string('gstn_no')->nullable();
            $table->string('billing_email')->nullable();
            $table->string('isallowthirdpartyapi')->nullable();
            $table->string('weburl')->nullable();
            $table->string('logo')->nullable();
            $table->string('address');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wlps');
    }
};

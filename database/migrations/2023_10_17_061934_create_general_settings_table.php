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
        Schema::create('general_settings', function (Blueprint $table) {
            $table->id();
             $table->string('Currency',10);
             $table->integer('Visitors');
             $table->string('WhatsApp',50);
             $table->tinyInteger('Coupon')->nullable();
             $table->tinyInteger('DeliveryFirstOrder')->nullable();
             $table->double('OrderTime');
             $table->string('OrderMessage',250);
             $table->string('OrderMessageEN',250);
             $table->string('Thanks',500);
             $table->string('ThanksEN',500);
             $table->string('AppVersion',50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('general_settings');
    }
};

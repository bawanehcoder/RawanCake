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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('UserID');
            $table->unsignedBigInteger('ZoneID');
            $table->dateTime('OrderDate');
            $table->dateTime('DeliveryTime');
            $table->string('Name',255);
            $table->string('delivery_type',255);
            $table->string('Phone',50);
            $table->string('address',500);
            $table->string('ZonePrice',50);
            $table->string('Total',50);
            $table->string('AddValue',50);
            $table->string('Discount',50);
            $table->integer('Points');
            $table->integer('Status');
            $table->integer('PaymentMethod')->nullable();
            $table->string('PaymentNo',50)->nullable();
            $table->text('PaymentData')->nullable();
            $table->integer('BranchID');
            $table->integer('Source');
            $table->string('Note',500)->nullable();
            $table->string('blob',150);
            $table->foreign('UserID')->references('id')->on('users');
            $table->foreign('ZoneID')->references('id')->on('zones');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};

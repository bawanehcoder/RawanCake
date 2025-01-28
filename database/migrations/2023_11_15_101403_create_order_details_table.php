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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('OrderID');
            $table->unsignedInteger('ItemID');
            $table->string('OptID',500)->nullable();
            $table->integer('Quantity');
            $table->string('Price',255);
            $table->string('Note',500)->nullable();
            $table->string('blob',150);
            $table->foreign('OrderID')->references('id')->on('orders');
            $table->foreign('ItemID')->references('id')->on('items');
//            $table->foreign('OptID')->references('id')->on('option_detils');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};

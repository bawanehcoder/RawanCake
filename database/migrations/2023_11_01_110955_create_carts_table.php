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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('temp_user_id',255)->nullable();
            $table->unsignedInteger('product_id');
//            $table->unsignedBigInteger('OptID')->nullable();
            $table->string('OptID',500)->nullable();
            $table->unsignedInteger('quantity');
            $table->float('discount',12,2);
            $table->float('shipping_cost',12,2);
            $table->float('tax',12,2);
            $table->float('price',12,2);
            $table->unsignedInteger('address_id');
            $table->string('Note',500)->nullable();
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
        Schema::dropIfExists('carts');
    }
};

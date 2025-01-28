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
        Schema::create('order_edits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('OrderID');
            $table->unsignedInteger('admin_id');
            $table->foreign('OrderID')->references('id')->on('orders');
                   $table->string('blob',150);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_edits');
    }
};

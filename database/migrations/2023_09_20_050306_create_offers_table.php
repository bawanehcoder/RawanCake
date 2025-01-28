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
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->integer('ItemID')->unsigned();
            $table->dateTime('BeginDate');
            $table->dateTime('EndDate');
            $table->decimal('FixedDiscount',12,2);
            $table->double('RelativeDiscount');
            $table->decimal('NewPrice',12,2);
            $table->string('blob',150);
            $table->foreign('ItemID')->references('id')->on('items');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};

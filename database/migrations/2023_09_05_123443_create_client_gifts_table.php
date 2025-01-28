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
        Schema::create('client_gifts', function (Blueprint $table) {
            
            $table->id();
            $table->integer('UserID');
            $table->integer('ProductID');
            $table->decimal('Price',12,2);
            $table->tinyInteger('IsSold');
            $table->timestamps();
            $table->foreign('UserID')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_gifts');
    }
};

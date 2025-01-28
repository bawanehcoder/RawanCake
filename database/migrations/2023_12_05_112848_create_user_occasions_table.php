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
        Schema::create('user_occasions', function (Blueprint $table) {
            $table->id();
            $table->string('title',250);
            $table->date('date');
            $table->unsignedBigInteger('UserID');
            $table->foreign('UserID')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_occasions');
    }
};

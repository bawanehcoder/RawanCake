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
        Schema::create('vtech_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('VtechID');
            $table->unsignedBigInteger('UserID');
            $table->string('blob',20)->default('vtech_users');
            $table->foreign('UserID')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vtech_users');
    }
};

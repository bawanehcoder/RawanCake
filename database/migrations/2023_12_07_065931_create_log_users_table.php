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
        Schema::create('log_users', function (Blueprint $table) {
            $table->id();
            $table->string('source',100);
            $table->string('blob',100)->default('log_users');
            $table->text('data');
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
        Schema::dropIfExists('log_users');
    }
};

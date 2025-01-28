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
        Schema::create('shipping_infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('zone_id');
            $table->string('address',500);
            $table->string('title',255);
            $table->string('name',255);
            $table->string('phone',15);
            $table->enum('default',[0, 1])->default(0);
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('zone_id')->references('id')->on('zones');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipping_infos');
    }
};

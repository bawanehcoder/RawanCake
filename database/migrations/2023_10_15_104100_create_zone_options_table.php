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
        Schema::create('zone_options', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('zone_id');
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->decimal('delivery',12,2);
            $table->foreign('zone_id')->references('id')->on('zones')->onDelete('cascade');;
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('zone_options');
    }
};

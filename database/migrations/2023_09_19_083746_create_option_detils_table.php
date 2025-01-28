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
        Schema::create('option_detils', function (Blueprint $table) {
            $table->id();
            $table->integer('OptID');
            $table->unsignedBigInteger('ItemID');
            $table->decimal('AdditionalValue',12,2);
            $table->string('blob',150);
            $table->foreign('ItemID')->references('id')->on('items')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('option_detils');
    }
};

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
        Schema::create('categories_occasions', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar',255);
            $table->string('name_en',255);
            $table->string('blob',50)->default('categories_occasions');
            $table->integer('sortIndex')->default(0);
            $table->tinyInteger('visible')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories_occasions');
    }
};

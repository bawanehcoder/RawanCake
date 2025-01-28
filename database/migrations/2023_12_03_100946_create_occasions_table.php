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
        Schema::create('occasions', function (Blueprint $table) {
            $table->id();

            $table->string('title_ar',150);
            $table->string('title_en',150);
            $table->string('description_ar',1000)->nullable();
            $table->string('description_en',1000)->nullable();
            $table->date('date');

            $table->string('blob',150);
            $table->boolean('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('occasions');
    }
};

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
        Schema::create('application_gifts', function (Blueprint $table) {
            $table->id();
            $table->string('GiftMessage',500);
            $table->tinyInteger('Enabled')->nullable();
            $table->tinyInteger('GiftType')->nullable();
            $table->integer('ProductID')->nullable();
            $table->decimal('FixedDiscount',12,2)->nullable();
            $table->integer('RelativeDiscount')->nullable();
            $table->string('blob',150);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('application_gifts');
    }
};

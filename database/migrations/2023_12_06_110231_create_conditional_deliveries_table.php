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
        Schema::create('conditional_deliveries', function (Blueprint $table) {
            $table->id();
            $table->string('title_ar',255);
            $table->string('title_en',255);
            $table->string('items',1000)->nullable();
            $table->string('zone_ids',1000)->nullable();
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->decimal('delivery',12,2)->default(0);
            $table->decimal('purchase_value',12,2)->default(0);
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
        Schema::dropIfExists('conditional_deliveries');
    }
};

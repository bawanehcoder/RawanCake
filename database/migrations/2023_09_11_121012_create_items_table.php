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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('CatID');
            $table->date('Date');
            $table->string('blob',50);
            $table->string('Name',150);
            $table->string('NameEN',150);
            $table->string('Description',500);
            $table->string('DescriptionEN',500);
            $table->tinyInteger('Available');
            $table->integer('stock');
            $table->decimal('Price',12,2);
            $table->integer('Views');
            $table->integer('Sales');
            $table->tinyInteger('Special');
            $table->string('operator',255);
            $table->string('Attachment',50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};

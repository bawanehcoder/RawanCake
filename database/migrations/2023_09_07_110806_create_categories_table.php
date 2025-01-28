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
        Schema::create('Categories', function (Blueprint $table) {
            $table->id();
            $table->integer('CatID');
            $table->string('Image',255);
            $table->string('blob',50);
            $table->string('Name',50);
            $table->string('NameEN',50);
            $table->string('ShortcutName',50);
            $table->string('ShortcutNameEN',50);
            $table->integer('SortIndex');
            $table->tinyInteger('Visible');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cateries');
    }
};

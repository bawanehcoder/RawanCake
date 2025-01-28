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
        Schema::create('general_infos', function (Blueprint $table) {
            $table->id();

            $table->string('EMail',150)->nullable();
            $table->string('Facebook',250)->nullable();
            $table->string('Twitter',250)->nullable();
            $table->string('LinkedIn',250)->nullable();
            $table->string('Instagram',250)->nullable();
            $table->string('YouTube',250)->nullable();
            $table->string('Pinterest',250)->nullable();
            $table->string('FourSquare',250)->nullable();
            $table->string('Tumblr',250)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('general_infos');
    }
};

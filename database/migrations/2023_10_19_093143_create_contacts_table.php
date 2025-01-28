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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->dateTime('Date');
            $table->string('Name',150);
            $table->string('EMail',250);
            $table->string('Phone',50);
            $table->string('Message',500);
            $table->string('Replay',1000);
            $table->tinyInteger('IsReaded');
            $table->tinyInteger('IsReplayed');
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
        Schema::dropIfExists('contacts');
    }
};

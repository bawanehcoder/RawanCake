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
        Schema::create('support_tickets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('title',500);
            $table->string('content',3000);
            $table->tinyInteger('priority');
            $table->tinyInteger('status');
            $table->tinyInteger('is_last_reply_from_user')->default(1);
            $table->string('last_reply_from_type',255)->nullable();
            $table->unsignedBigInteger('last_reply_from_id')->nullable();
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('support_tickets');
    }
};

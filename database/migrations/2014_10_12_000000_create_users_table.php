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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->integer('ZoneID');
            $table->string('LoginProvider',50)->nullable();
            $table->string('ProviderID',100)->nullable();
            $table->string('avatar',255)->nullable();
            $table->string('Phone',50)->unique();
            $table->tinyInteger('Gender');
            $table->date('BirthDate');
            $table->tinyInteger('SocialStatus')->nullable();
            $table->dateTime('LastSeenAt')->nullable();
//            $table->string('Code',150)->nullable();
//            $table->dateTime('CodeTime')->nullable();
//            $table->dateTime('SendTime')->nullable();
//            $table->tinyInteger('HasNotifications')->nullable();
            $table->integer('RelativesCount')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('blob',50)->default('users')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

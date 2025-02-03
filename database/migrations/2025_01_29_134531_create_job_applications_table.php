<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('job_applications', function (Blueprint $table) {
        $table->id();
        $table->string('full_name')->nullable();
        $table->string('nationality')->nullable();
        $table->string('birthplace')->nullable();
        $table->date('dob')->nullable();
        $table->string('national_id')->nullable();
        $table->string('gender')->nullable();
        $table->string('smoker')->nullable();
        $table->string('currently_employed')->nullable();
        $table->string('phone')->nullable();
        $table->string('email')->nullable();
        $table->string('address')->nullable();
        $table->string('qualification')->nullable();
        $table->string('major')->nullable();
        $table->string('grade')->nullable();
        $table->string('university')->nullable();
        $table->year('graduation_year')->nullable();
        $table->string('reading_english')->nullable();
        $table->string('writing_english')->nullable();
        $table->string('speaking_english')->nullable();
        $table->string('reading_arabic')->nullable();
        $table->string('writing_arabic')->nullable();
        $table->string('speaking_arabic')->nullable();
        $table->text('experience')->nullable();
        $table->text('courses')->nullable();
        $table->string('agree')->nullable();
        $table->string('job_position')->nullable();
        $table->decimal('min_salary', 10, 2)->nullable();
        $table->string('branch')->nullable();


        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_applications');
    }
};

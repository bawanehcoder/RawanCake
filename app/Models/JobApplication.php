<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{

    use HasFactory;

    protected $fillable = [
        'full_name',
        'nationality',
        'birthplace',
        'dob',
        'national_id',
        'gender',
        'smoker',
        'currently_employed',
        'phone',
        'email',
        'address',
        'qualification',
        'major',
        'grade',
        'university',
        'graduation_year',
        'reading_english',
        'writing_english',
        'speaking_english',
        'reading_arabic',
        'writing_arabic',
        'speaking_arabic',
        'experience',
        'courses',
        'agree',
        'job_position',
        'branch',
        'min_salary',
    ];
}

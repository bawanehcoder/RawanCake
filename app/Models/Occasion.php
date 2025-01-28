<?php

namespace App\Models;

use App\Transformers\OccasionTransformer;
use Flugg\Responder\Contracts\Transformable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpOffice\PhpSpreadsheet\Calculation\Logical\Boolean;

class Occasion extends Model implements Transformable
{
    use HasFactory;
    protected $fillable=[

        "title_ar",
        "title_en",
        "description_ar",
        "description_en",
        "date",
        "active",
        "blob",
    ];
    protected $casts=['active'=>'boolean'];
    public function transformer()
    {
        return  OccasionTransformer::class;
    }
}

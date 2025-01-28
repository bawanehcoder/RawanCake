<?php

namespace App\Models;

use App\Transformers\GenralInfoTransformer;
use App\Transformers\PageTransformer;
use Flugg\Responder\Contracts\Transformable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralInfo extends Model implements Transformable
{
    use HasFactory;
    protected $fillable = [
        'EMail',
        'Facebook',
        'Twitter',
        'LinkedIn',
        'Instagram',
        'YouTube',
        'Pinterest',
        'FourSquare',
        'Tumblr',
    ];
    public function transformer()
    {
        return GenralInfoTransformer::class;
    }
}

<?php

namespace App\Models;

use App\Models\Traits\HasMediaTrait;

use App\Transformers\SliderTransformer;
use Flugg\Responder\Contracts\Transformable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;

class Slide extends Model implements HasMedia,Transformable
{
    use HasFactory;

    use HasMediaTrait;
    protected $CollectionName='slider';

    protected $fillable = [
        'title',
        'url',
        'index',
        'blob',
    ];
    public function transformer()
    {
        return SliderTransformer::class;
    }
}

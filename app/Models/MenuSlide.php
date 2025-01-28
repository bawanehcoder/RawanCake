<?php

namespace App\Models;

use App\Models\Traits\HasMediaTrait;

use App\Transformers\MenuSliderTransformer;
use Flugg\Responder\Contracts\Transformable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;

class MenuSlide extends Model implements HasMedia,Transformable
{
    use HasFactory;

    use HasMediaTrait;
    protected $CollectionName='menu_slider';
    protected $table='menu_slides';
    protected $fillable = [
        'title',
        'url',
        'index',
        'blob',
    ];
    public function transformer()
    {
        return MenuSliderTransformer::class;
    }
}

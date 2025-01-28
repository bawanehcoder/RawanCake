<?php

namespace App\Models;

use App\Models\Traits\HasMediaTrait;
use App\Models\Traits\VisibleTrait;
use App\Transformers\CategoriesOccasionTransformer;
use Flugg\Responder\Contracts\Transformable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;

class CategoriesOccasion extends Model implements HasMedia,Transformable
{
    use HasFactory;
    use HasMediaTrait;
    use VisibleTrait;
    protected $CollectionName='categories_occasion';
    protected $fillable=['name_ar','name_en','sortIndex','visible'];
    public function transformer()
    {
        return CategoriesOccasionTransformer::class;
    }
}

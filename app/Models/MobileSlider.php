<?php

namespace App\Models;

use App\Models\Traits\HasMediaTrait;
use Flugg\Responder\Contracts\Transformable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;

class MobileSlider extends Model implements HasMedia, Transformable
{
    use HasFactory;

    use HasMediaTrait;
    protected $CollectionName='mobile_slider';


    protected $fillable = ['title', 'item_id', 'category_id'];


    public function transformer()
    {
        return \App\Transformers\MobileSlider::class;
    }

    public function item(){
        return $this->belongsTo(Item::class, 'item_id');
    }

    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }
}

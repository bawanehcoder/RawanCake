<?php

namespace App\Models;

use App\Models\Traits\HasMediaTrait;
use App\Transformers\UserOccasionTransformer;
use Flugg\Responder\Contracts\Transformable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;

class UserOccasion extends Model implements  HasMedia,Transformable
{
    use HasFactory;
    use HasMediaTrait;
    protected $fillable=['title','date','UserID','Cat_id'];
    protected $CollectionName='user_occasion';
    public function transformer()
    {
        return UserOccasionTransformer::class;
    }
    public function user(){
        return $this->belongsTo(User::class,'UserID');
    }
    public function categoriesOccasion(){
        return $this->belongsTo(CategoriesOccasion::class,'Cat_id');
    }
}

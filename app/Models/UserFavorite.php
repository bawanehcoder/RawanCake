<?php

namespace App\Models;

use App\Transformers\UserFavoriteTransformer;
use Flugg\Responder\Contracts\Transformable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserFavorite extends Model implements  Transformable
{
    use HasFactory;
    protected $fillable=['UserID','ItemID'];

    public function product(){
        return $this->belongsTo(Item::class,'ItemID');
    }

    public function transformer()
    {
       return UserFavoriteTransformer::class;
    }
    public function user(){
        return $this->belongsTo(User::class,'UserID');
    }
}

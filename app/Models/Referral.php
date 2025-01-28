<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Referral extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable=['referrer_id','registerer_id'];

    public function referrer(){
        return $this->belongsTo(User::class,'referrer_id');
    }
    public function points(){
        return $this->hasMany(Point::class,'details');
    }
    public function registerer(){
        return $this->belongsTo(User::class,'registerer_id');
    }
}

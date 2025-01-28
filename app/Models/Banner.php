<?php

namespace App\Models;

use App\Models\Traits\HasMediaTrait;
use Carbon\Carbon;
use Flugg\Responder\Contracts\Transformable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Banner extends Model implements HasMedia,Transformable
{
    use HasFactory;
    use InteractsWithMedia;

    // use HasMediaTrait;
    protected $CollectionName='banner';
    protected $fillable=['title','url','views','points','start_at','ends_at'];
    protected $casts=['start_at'=>'date','ends_at'=>'date'];

    public function transformer()
    {
        // TODO: Implement transformer() method.
    }
    public function scopeStart($query)
    {
        return $query->where('start_at', '<=', Carbon::now());
    }
    public function scopeEnd($query)
    {
        return $query->where('ends_at', '>=', Carbon::now());
    }
}

<?php

namespace App\Models;

use App\Transformers\ShippingInfoTransformer;
use Flugg\Responder\Contracts\Transformable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShippingInfo extends Model implements Transformable
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'id',
        'user_id',
        'zone_id',
        'address',
        'phone',
        'title',
        'name',
        'default',
        'country_code',
    ];
    public function zone(){
        return $this->belongsTo(Zones::class,'zone_id');
    }

    public function transformer()
    {
        return ShippingInfoTransformer::class;
    }
}

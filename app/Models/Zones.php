<?php

namespace App\Models;

use App\Transformers\ZonesTransformer;
use Flugg\Responder\Contracts\Transformable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zones extends Model implements Transformable
{
    use HasFactory;
    protected $fillable = [
        'AddresAr',
        'AddresEn',
        'RegionID',
        'delivery',
        'blob',
    ];

    public function transformer()
    {
        return ZonesTransformer::class;
    }
    public function zoneOptions(){
        return $this->hasMany(ZoneOption::class,'zone_id');
    }
 public function shippingInfo(){
        return $this->hasMany(Zones::class,'zone_id');
    }
    public function region(){
        return $this->belongsTo(Region::class,'RegionID');
    }
    public function getTitle(){
        return  getLang()=='en'?$this->AddresAr: $this->AddresEn;
    }

}

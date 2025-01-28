<?php

namespace App\Models;

use Flugg\Responder\Contracts\Transformable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ZoneOption extends Model implements Transformable
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'zone_id',
        'start_time',
        'end_time',
        'delivery',
    ];
    public function transformer()
    {
        // TODO: Implement transformer() method.
    }
    public function zones(){
        return $this->belongsTo(Zones::class,'zone_id');
    }
}

<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\SoftDeletes;
class Offer extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'id',
        'ItemID',
        'BeginDate',
        'EndDate',
        'FixedDiscount',
        'RelativeDiscount',
        'NewPrice',
        'blob',
    ];
    protected $dates = [
        'BeginDate',
        'EndDate',
        'deleted_at',
    ];
    public function item(){
        return $this->belongsTo(Item::class,'ItemID');
    }
    public function scopeIsActive($query)
    {
        return $query->where('EndDate', '>', Carbon::now());
    }
    public function status(){
        return $this->isActive->count()>0?true:false;
    }
}

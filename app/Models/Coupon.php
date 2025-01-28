<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupon extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'id',
        'Serial',
        'UsedLimit',
        'UsedCount',
        'FixedDiscount',
        'RelativeDiscount',
        'Expiration',
        'blob',
    ];
    protected $hidden = [

        'blob',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    protected $dates = [
        'Expiration',
    ];

    public function increaseCoupon()
    {
        $this->UsedCount++;
        $this->save();
    }

    public function decreaseCoupon()
    {
        $this->UsedCount--;
        $this->save();
    }

    public function order()
    {
        return $this->hasMany(OrderCoupon::class, 'CouponID');
    }

    public function scopeExpiration($query)
    {
        return $query->where('Expiration', '>', Carbon::now());
    }


}

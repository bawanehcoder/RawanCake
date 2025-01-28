<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderCoupon extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['OrderID', 'CouponID', 'UserID'];

    public function order()
    {
        return $this->belongsTo(Order::class, 'OrderID');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'UserID');
    }
    public function coupon()
    {
        return $this->belongsTo(Coupon::class, 'CouponID');
    }
}

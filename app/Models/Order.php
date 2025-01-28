<?php

namespace App\Models;

use App\Models\Traits\HasMediaTrait;
use App\Models\Traits\SourceTrait;
use App\Transformers\OrderTransformer;
use Flugg\Responder\Contracts\Transformable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;

class Order extends Model implements Transformable
{
    use HasFactory;
    use SoftDeletes;
    use SourceTrait;

    protected $fillable = [
        'id',
        'UserID',
        'ZoneID',
        'OrderDate',
        'Name',
        'address',
        'Phone',
        'Phone2',
        'delivery_type',
        'DeliveryTime',
        'ZonePrice',
        'Total',
        'Discount',
        'AddValue',
        'Points',
        'Status',
        'Note',
        'BranchID',
        'Source',
        'Note',
        'blob',
        'country_code',
        'before_amount',
        'add_value',
        'user_name'

    ];

    public function getSourceAttribute($value)
    {
        switch ($value) {
            case 0:
                return @langucw('Web');
            case 1:
                return @langucw('IOS');
            case 2:
                return @langucw('Android');
            case 4:
                return @langucw('Call Center');

        }
    }

    public function setPaymentMethodAttribute($value)
    {
        switch ($value) {
            case 'cash_on_delivery':
                $this->attributes['PaymentMethod'] = 0;
                break;
            case 'payment_by_credit_card':
                $this->attributes['PaymentMethod'] = 1;
                break;
        }

    }

    public function getPaymentMethodAttribute($value)
    {

        switch ($value) {
            case 0:
                return 'cash on delivery';
            case 1:
                return 'pay by credit card';

        }
    }

    public function getUserNameAttribute($value)
    {

        return $this->attributes['user_name'] != null ? $this->attributes['user_name'] : $this->user->name;

    }

    public function getUserEmailAttribute($value)
    {

        return $this->user->email;

    }

    public function setStatusAttribute($value)
    {
        switch ($value) {
            case 'waiting':
                $this->attributes['Status'] = 0;
                break;
            case 'accepted':
                $this->attributes['Status'] = 1;
                break;
            case 'rejected':
                $this->attributes['Status'] = 2;
                break;
            case 'cancel':
                $this->attributes['Status'] = 3;
                break;

            case 'invoiced':
                $this->attributes['Status'] = 4;
                break;
        }
    }

    public function getStatusAttribute($value)
    {
        switch ($value) {
            case 0:
                return @langucw('waiting');
            case 1:
                return @langucw('accepted');
            case 2:
                return @langucw('rejected');
            case 3:
                return @langucw('cancel');
            case 4:
                return @langucw('invoiced');

        }
    }

    public function scopeNewOrder($query)
    {
        return $query->where('Status', 0);
    }

    public function scopeAcceptedOrder($query)
    {
        return $query->where('Status', 1);
    }
    public function scopeCompleted($query)
    {
        return $query->where('Status', 1);
    }
    public function scopeRejectedOrder($query)
    {
        return $query->where('Status', 2);
    }

    public function scopeCancelOrder($query)
    {
        return $query->where('Status', 3);
    }

    public function scopeCashOnDelivery($query)
    {
        return $query->where('PaymentMethod', 0);
    }

    public function scopeElectronicPayment($query)
    {
        return $query->where('PaymentMethod', 1);
    }

    public function scopePersonalPickup($query)
    {
        return $query->where('delivery_type', 'personal_pickup');
    }

    public function scopeDeliveryAddress($query)
    {
        return $query->where('delivery_type', 'delivery_address');
    }

    public function zone()
    {
        return $this->belongsTo(Zones::class, 'ZoneID');
    }

    public function branch()
    {
        return $this->belongsTo(Branche::class, 'BranchID');
    }

    public function order_details()
    {
        return $this->hasMany(OrderDetail::class, 'OrderID');
    }

    public function orderCoupon()
    {
        return $this->hasOne(OrderCoupon::class, 'OrderID');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'UserID');
    }

    public function transformer()
    {
        return OrderTransformer::class;
    }

    // public function setTotalAttribute()
    // {
    //     // return 10;
    //     // dd((double) $this->order_details()->sum('Price'));
    //     return $this->attributes['Total'] = (int) $this->Total > 0 ? $this->Total : (double) $this->order_details()->sum('Price') + (double) $this?->ZonePrice;
    // }

    public function setAddValueAttribute()
    {
        // return 10;
        if ($this->PaymentMethod == 'pay by credit card') {
            // dd((double) $this->Total - (double) $this->before_amount );
            $this->attributes['Total'] = (int) $this->Total > 0 ? $this->Total : (double) $this->order_details()->sum('Price') + (double) $this?->zone?->delivery;

            return $this->attributes['add_value'] = (double) $this->Total - (double) $this->before_amount;
        }
        return $this->attributes['Total'] = (int) $this->Total > 0 ? $this->Total : (double) $this->order_details()->sum('Price') + (double) $this?->zone?->delivery;
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ConditionalDeliverie extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['items', 'zone_ids', 'start_time', 'end_time', 'delivery', 'purchase_value','title_ar','title_en'];
    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'items' => 'array',
        'zone_ids' => 'array',
    ];

}

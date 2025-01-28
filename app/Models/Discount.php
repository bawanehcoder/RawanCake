<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Discount extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'id',
        'Cats',
        'Type',
        'BeginDate',
        'EndDate',
        'BeginDelivery',
        'EndDelivery',
        'Value',
        'blob',
    ];
    protected $dates = [
        'BeginDate',
        'EndDate',
        'BeginDelivery',
        'EndDelivery',
        'deleted_at',
    ];

}

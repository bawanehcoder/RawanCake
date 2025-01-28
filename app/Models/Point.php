<?php

namespace App\Models;

use App\Models\Traits\PointTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Point extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'id',
        'amount',
        'balance',
        'details',
        'user_id',
        'blob',
    ];
protected $casts=['created_at'=>'date'];
}

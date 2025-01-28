<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Draft extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'id',
        'user_id',
        'entity_type',
        'entity_id',
        'content',
        'action',
    ];
    protected $dates = [
        'created_at',
        'deleted_at',
    ];
}

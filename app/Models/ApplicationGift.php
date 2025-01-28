<?php

namespace App\Models;

use App\Transformers\ApplicationGiftTransformer;

use Flugg\Responder\Contracts\Transformable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ApplicationGift extends Model implements Transformable
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'id',
        'GiftMessage',
        'Enabled',
        'GiftType',
        'ProductID',
        'FixedDiscount',
        'RelativeDiscount',
        'blob',
    ];
    public function transformer(){
        return ApplicationGiftTransformer::class;
    }
}

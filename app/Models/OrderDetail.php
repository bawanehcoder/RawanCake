<?php

namespace App\Models;

use App\Models\Traits\HasMediaTrait;
use App\Transformers\OrderDetailTransformer;
use Flugg\Responder\Contracts\Transformable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;

class OrderDetail extends Model implements Transformable,HasMedia
{
    use HasFactory;
    use SoftDeletes;
    use HasMediaTrait;
    protected $CollectionName='images';
    protected $fillable = ['OrderID','ItemID','Quantity','Price','Note','OptID','blob'];

    public function item(){
       return $this->belongsTo(Item::class,'ItemID') ;
    }
    public function optionDetil(){
        return !empty($this->OptID)?OptionDetil::whereIn('id',json_decode($this->OptID)):null;
        return $this->belongsTo(OptionDetil::class,'OptID');
    }

    public function transformer()
    {
        return OrderDetailTransformer::class;
    }
}

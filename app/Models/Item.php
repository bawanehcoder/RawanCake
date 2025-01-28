<?php

namespace App\Models;

use App\Models\Traits\HasMediaTrait;

use App\Models\Traits\Language;
use App\Models\Traits\StatusTrait;
use App\Transformers\ProductsTransformer;
use Carbon\Carbon;
use Flugg\Responder\Contracts\Transformable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Item extends Model implements HasMedia,Transformable
{
    use HasMediaTrait;
    use HasFactory;
    use StatusTrait;
    use Language;
    protected $CollectionName='products';
    protected $fillable = [
        'id',
        'CatID',
        'Date',
        'blob',
        'Name',
        'NameEN',
        'Description',
        'DescriptionEN',
        'Available',
        'stock',
        'Price',
        'Views',
        'ItemID',
        'R_ItemShortcut',
        'Special',
        'operator',
        'new',
        'upload_image'
    ];


    protected static $fieldStatusMapping = [
        'Available' => 'statusMapping',
    ];
    protected static $statusMapping = [
        0 => [
            'codeName' => 'available',
        ],
        1 => [
            'codeName' => 'unavailable',
        ]
    ];
    public function subCategory(){
        return $this->belongsTo(Category::class, 'CatID');
    }
    public function offerActive(){
        return $this->hasMany(Offer::class, 'ItemID')->isActive();
    }
    public function price(){
        $offer=$this->offerActive->last();
        
        $options  = $this->optionDetil;
        // dd($options);
        if( count($options) ){
            if($offer){
                $price = $this->optionDetil()->first()->AdditionalValue + $this->Price;

                if($offer->RelativeDiscount){
                    $price = $price - ($price * $offer->RelativeDiscount / 100);

                    return $price;
                }

                if($offer->FixedDiscount){
                    $price = $price - $offer->FixedDiscount;

                    return $price;
                }
            }
            return $this->optionDetil()->first()->AdditionalValue + $this->Price;
        }else{
            return $offer?$offer->NewPrice:$this->Price;
        }
    }

    public function price2(){
        $offer=$this->offerActive->last();
        
        $options  = $this->optionDetil;
        // dd($options);
        if( count($options) ){
           
            return $this->optionDetil()->first()->AdditionalValue + $this->Price;
        }else{
            return $this->Price;
        }
    }
    public function checkStock(){
        return  $this->stock>0?true:false;
    }
    public function scopeIsStock($query){
        return  $query->where('stock','>',0);
    }
    public function transformer()
    {
       return ProductsTransformer::class;
    }

    public function getTitle(){
        return  $this->getLang()=='en'?$this->NameEN: $this->Name;
    }
    public function getDescription(){
        return  $this->getLang()=='en'?$this->Description: $this->DescriptionEN;
    }
    public function optionDetil(){
        return $this->hasMany(OptionDetil::class,'ItemID');
    }

    public function subOption(){
        return $this->hasMany(SubOption::class,'OptID');
    }
    public function getOperator(){
       return empty($this->operator)?[]:json_decode($this->operator);
    }
    public function incrementReadCount() {
        $this->Views++;
        return $this->save();
    }
    public function getAvarg(){
        return floor($this->hasMany(Rating::class,'ItemID')->avg('rate'));
    }
    public function getPercentage(){
      return  self::getAvarg() *20;
    }
    public function getRateCount(){
        return floor($this->hasMany(Rating::class,'ItemID')->count());
    }
    public function isFavorite(){
        if(getLogged()){
            return UserFavorite::where('ItemID',$this->id)->where('UserID',getLogged()->id)->exists();
        }
        return false;
    }
}

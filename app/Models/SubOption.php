<?php

namespace App\Models;

use App\Models\Traits\HasMediaTrait;
use App\Models\Traits\StatusTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;

class SubOption extends Model implements HasMedia
{
    use HasFactory;
    use StatusTrait;
    use HasMediaTrait;
    protected $CollectionName='product_sub_options';


    protected $fillable = [
        'id',
        'Name',
        'NameEN',
        'OptID',
        'POptID',
        'Available',
        'blob',
        'ModifierID',
        'R_ItemIDInModifier'
    ];
    protected static $fieldStatusMapping = [
        'Available' => 'availableMapping',
    ];
    protected static $availableMapping = [
        0 => [
            'codeName' => 'available',
        ],
        1 => [
            'codeName' => 'unavailable',
        ]
    ];
    public function getTitle(){
        return  getLang()=='En'?$this->NameEN: $this->Name;
    }
    public function OptionDetil(){
        return $this->hasMany(OptionDetil::class,'OptID');
    }
    public function itemOption(){
        return $this->belongsTo(ItemOption::class,'OptID');
    }


}

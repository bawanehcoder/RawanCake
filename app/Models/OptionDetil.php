<?php

namespace App\Models;

use App\Transformers\OptionDetilTransformer;
use Flugg\Responder\Contracts\Transformable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OptionDetil extends Model implements Transformable
{
    use HasFactory;
    protected $fillable = [
        'id',
        'OptID',
        'ItemID',
        'POptID',
        'AdditionalValue',
        'blob',
        'active'
    ];



    public function subOption(){
        return $this->belongsTo(SubOption::class, 'OptID');
    }
    public function option(){
        return $this->belongsTo(ItemOption::class, 'POptID');
    }
    public function transformer()
    {
        return OptionDetilTransformer::class;
    }


}

<?php

namespace App\Models;

use App\Transformers\BrancheTransformer;
use Flugg\Responder\Contracts\Transformable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branche extends Model implements Transformable
{
    use HasFactory;
    protected $fillable = [
        'id',
        'AddresAr',
        'AddresEn',
        'Phone',
        'Map',
        'blob',
    ];
    public function transformer()
    {
        return BrancheTransformer::class;
    }
    public function getTitle(){
        return  getLang()=='en'?$this->AddresAr: $this->AddresEn;
    }
}

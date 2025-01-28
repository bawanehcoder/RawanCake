<?php

namespace App\Models;


use App\Models\Traits\StatusTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ItemOption extends Model
{

    use HasFactory;
    use StatusTrait;

    protected $fillable = [
        'id',
        'Name',
        'NameEN',
        'Type',
        'blob',
        'DishsetID',
    ];
    protected static $fieldStatusMapping = [
        'Type' => 'typeMapping',

    ];
    protected static $typeMapping = [
        0 => [
            'codeName' => 'basic',
        ],
        1 => [
            'codeName' => 'sub',
        ]
    ];
    public function scopeBasic($query)
    {
        return $query->where('Type', $this->getStatusCodeByName('Type', 'basic'));
    }
    public function scopeSub($query)
    {
        return $query->where('Type', $this->getStatusCodeByName('Type', 'sub'));
    }
    public function scopeAsc($query)
    {
        return $query->orderBy('id', 'asc');
    }
    public function getTitle()
    {

        return getLang() == 'En' ? $this->NameEN : $this->Name;
    }
    public function subOption()
    {
        return $this->hasMany(SubOption::class, 'OptID');
    }
}

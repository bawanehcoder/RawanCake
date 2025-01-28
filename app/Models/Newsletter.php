<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Maatwebsite\Excel\Concerns\ToModel;
class Newsletter extends Model implements ToModel
{
    use HasFactory;
    use SoftDeletes;
    protected $softDeleteField = 'archived';
    protected $fillable = [
        'id',
        'EMail',
        ];
    public function model(array $row)
    {
        return new Newsletter([
            'email' => $row[0],
        ]);
    }

}

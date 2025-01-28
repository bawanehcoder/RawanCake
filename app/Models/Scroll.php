<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scroll extends Model
{
    use HasFactory;

    protected $fillable = ['name_ar','name_en','content_ar','content_en'];

    public function setImageAttribute($value)
    {
        if ($value) {
            $file = $value;
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename = time() . mt_rand(1000, 9999) . '.' . $extension;
            $file->move(public_path('uploads/plans/'), $filename);
            $this->attributes['image'] = 'uploads/plans/' . $filename;
        }
    }
}

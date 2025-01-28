<?php

namespace App\Models;

use App\Transformers\PageTransformer;
use Flugg\Responder\Contracts\Transformable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;
class Page extends Model implements Transformable
{
    use HasFactory;
    use SoftDeletes;
    use HasTranslations;
    protected $fillable = [
        'title',
        'route_name',
        'content',
        'blob',
    ];
    public $translatable = ['content'];
    public function transformer()
    {
        return PageTransformer::class;
    }
}

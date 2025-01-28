<?php

namespace App\Transformers;

use App\Models\Page;
use Flugg\Responder\Transformers\Transformer;

class PageTransformer extends Transformer
{
    protected $relations = [];
    protected $load = [];
    public function transform(Page $page){
        return [
            'title'=>$page->title,
            'route_name'=>$page->route_name,
            'content_ar'=>$page->getTranslation('content', 'ar'),
            'content_en'=>$page->getTranslation('content', 'en'),
        ];
    }
}

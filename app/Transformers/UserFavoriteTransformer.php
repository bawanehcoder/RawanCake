<?php

namespace App\Transformers;

use App\Models\UserFavorite;
use Flugg\Responder\Transformers\Transformer;

class UserFavoriteTransformer extends Transformer
{
    protected $relations = ["product"=>ProductsTransformer::class];
    protected $load = ["product"=>ProductsTransformer::class];
    public function transform(UserFavorite $favorite){
        return [];
    }
}

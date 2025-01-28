<?php

namespace App\Transformers;
use App\Models\Order;
use App\Models\UserOccasion;
use App\Services\UserOccasionService;
use Flugg\Responder\Transformers\Transformer;

class UserOccasionTransformer extends Transformer
{
    protected $relations = [];
    protected $load = [];
    public function transform(UserOccasion $item)
    {
        return [
            'id' => $item->id,
            'title' => $item->title,
            'date' => $item->date,
            'cat_id' => $item->Cat_id,
            'image'=>UserOccasionService::getImage($item),
        ];
    }
}

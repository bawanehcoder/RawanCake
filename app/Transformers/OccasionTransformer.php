<?php

namespace App\Transformers;
use App\Models\Occasion;
use App\Services\UserOccasionService;
use Flugg\Responder\Transformers\Transformer;

class OccasionTransformer extends Transformer
{
    protected $relations = [];
    protected $load = [];
    public function transform(Occasion $item)
    {
        return [
            'id' => $item->id,
            'title_ar' => $item->title_ar,
            'title_en' => $item->title_en,
            'description_ar' => $item->description_ar,
            'description_en' => $item->description_en,
            'date' => $item->date,
            'active' => $item->active,

        ];
    }
}

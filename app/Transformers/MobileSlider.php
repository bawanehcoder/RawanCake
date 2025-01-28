<?php

namespace App\Transformers;

use App\Models\Category;
use App\Models\Item;
use Flugg\Responder\Transformers\Transformer;

class MobileSlider extends Transformer
{
    protected $relations = [];
    protected $load = [];
    public function transform(\App\Models\MobileSlider $slide, $cart = null)
    {
        if ($slide->item) {
            $item = $slide->item;
            return [
                'id' => $item->id,
                'CatID' => $item->CatID,
                'Name' => $item->Name,
                'NameEN' => $item->NameEN,
                'Description' => $item->Description,
                'DescriptionEN' => $item->DescriptionEN,
                'Available' => $item->Available,
                'Price' => $cart == null ? (string) $item->price() : (string) ($cart?->optionDetil() ? $cart?->optionDetil()->sum('AdditionalValue') : $cart->price),
                'NewPrice' => $item->NewPrice,
                'Views' => $item->Views,
                'Rating' => $item->getAvarg(),
                'Stock' => $item->stock,
                'RatingCount' => $item->getRateCount(),
                'optionDetil' => $this->optionDetil($item),
                'isFavorited' => $item->isFavorite(),
                'Special' => $item->Special,
                'main_image' => [
                    'large' => asset($item->getFirstMediaUrl('products', 'large')),
                    'medium' => asset($item->getFirstMediaUrl('products', 'medium')),
                    'small' => asset($item->getFirstMediaUrl('products', 'small')),
                ],
                'other_image' => [
                    'large' => asset($slide->getFirstMediaUrl('mobile_slider', 'full')),
                    'medium' => asset($slide->getFirstMediaUrl('mobile_slider', 'full')),
                    'small' => asset($slide->getFirstMediaUrl('mobile_slider', 'full')),
                ],
            ];
        }
        $category = $slide->category;

        return [
            'id' => (int) $category->id,
            'CatID' => (int) $category->CatID,
            'blob' => $category->blob,
            'Name' => $category->Name,
            'NameEN' => $category->NameEN,
            'ShortcutName' => $category->ShortcutName,
            'ShortcutNameEN' => $category->ShortcutNameEN,
            'images' => [
                'large' => asset($slide->getFirstMediaUrl('mobile_slider', 'full')),
                'medium' => asset($slide->getFirstMediaUrl('mobile_slider', 'full')),
                'small' => asset($slide->getFirstMediaUrl('mobile_slider', 'full')),
            ],
        ];
    }
    public function optionDetil(Item $entity)
    {

        $options = $entity->optionDetil->groupBy('POptID');
        $data = [];
        foreach ($options ?? [] as $optin) {

            $data[$optin[0]->id] =
                [
                    'id' => $optin[0]->id,
                    'title_ar' => $optin[0]->subOption->itemOption->Name,
                    'title_en' => $optin[0]->subOption->itemOption->NameEN
                ];
            foreach ($optin as $i => $item) {
                $data[$optin[0]->id]['optin'][$i] =
                    [
                        'id' => $item->subOption->id,
                        'title_ar' => $item->subOption->Name,
                        'title_en' => $item->subOption->NameEN,
                        'AdditionalValue' => $item->AdditionalValue
                    ];
            }
        }
        return $data;
        return responder()->success(['options' => $data])->respond();
    }
}

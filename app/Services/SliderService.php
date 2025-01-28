<?php

namespace App\Services;

use App\Models\Item;
use App\Models\Slide;

class SliderService
{
    public static function storeFromRequest($request)
    {

        $data = [
            'blob' => $request->blob,
            'title' => $request->title,
            'index' => $request->order,
            'url' => $request->url,
        ];
        $entity = new Slide($data);
        $entity->save();
        MediaService::addMediaFromRequest($entity, 'image', 'slider');
        return $entity;
    }
    public static function updateFromRequest($entity,$request)
    {
        $data = [
            'title' => $request->title,
            'url' => $request->url,
            'index' => $request->order,
        ];
        $entity->update($data);
        $entity->save();

        if(!empty($request['image'])) {
            $entity->clearMediaCollection('slider');
            MediaService::addMediaFromRequest($entity, 'image', 'slider');
        }
        return $entity;
    }
    public static function sliders(){
        return Slide::all();
    }

}

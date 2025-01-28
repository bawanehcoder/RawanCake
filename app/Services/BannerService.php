<?php

namespace App\Services;

use App\Models\Banner;


class BannerService
{
    public static function storeFromRequest($request)
    {
        $data = [
            'title' => $request->title,
            'index' => $request->order,
            'url' => $request->url,
            'point' => $request->point,
            'start_at' => $request->start_at,
            'ends_at' => $request->ends_at,
        ];
        $entity = new Banner($data);
        $entity->save();

        MediaService::addMultipleMediaFromRequest($entity, 'image', 'banner');
        return $entity;
    }
    public static function updateFromRequest($entity,$request)
    {
        $data = [
            'title' => $request->title,
            'url' => $request->url,
            'point' => $request->point,
            'start_at' => $request->start_at,
            'ends_at' => $request->ends_at,
        ];
        $entity->update($data);
        $entity->save();

        if(!empty($request['image'])) {
            $entity->clearMediaCollection('banner');

            MediaService::addMultipleMediaFromRequest($entity, 'image', 'banner');
        }
        return $entity;
    }


}

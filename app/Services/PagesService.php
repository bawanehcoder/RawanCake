<?php

namespace App\Services;


use App\Models\Page;

class PagesService
{
    public static function storeFromRequest($request)
    {

        $entity = new Page;
        $entity->title = $request->title;
        $entity->route_name = $request->route_name;
        $entity->blob = $request->blob;
        if (!empty($request->arabic_content)) {
            $entity->setTranslation('content', 'ar', $request->arabic_content);
        }
        if (!empty($request->english_content)) {
            $entity->setTranslation('content', 'en', $request->english_content);
        }
        $entity->save();

        return true;

    }

    public static function updateFromRequest($entity, $request)
    {
        if (!empty($request->arabic_content)) {
            $entity->setTranslation('content', 'ar', $request->arabic_content);
        }
        if (!empty($request->english_content)) {
            $entity->setTranslation('content', 'en', $request->english_content);
        }
        $entity->save();
        return true;
    }


}

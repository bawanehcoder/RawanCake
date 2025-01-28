<?php

namespace App\Services;

use App\Models\Draft;

class DraftService
{
    public static function saveDraft($entity,$action){
        $entity_draft= new Draft([
            'content' =>json_encode($entity) ,
            'entity_type' =>$entity->getTable(),
            'entity_id' =>$entity->id,
            'user_id' =>getLogged()->id,
            'action' =>$action,
        ]);
        $entity_draft->save();
    }
}

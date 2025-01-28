<?php

namespace App\Classes;

class EntitiesStore
{
    public $store = [];

    public function getEntity($entityType, $entityId, $with = []){



        $key = 'entityType' . '-' . $entityId;

        //if entity saved before, just return it
        if(empty($this->store[$key])){
            //get entity
            $class = "App\\Models\\".$entityType;
            $this->store[$key] = $class::find($entityId);
        }


        return $this->store[$key];
    }
}

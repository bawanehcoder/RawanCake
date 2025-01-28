<?php
/**
 * get class name of gievn aliass if has defined morphed relations
 * @param string $aliass: 'user'
 * @return string|null: App\User
 */
function getClassNameOfAlias($aliass){
    return \Illuminate\Database\Eloquent\Relations\Relation::getMorphedModel($aliass);
}
function getEntity($entityType, $entityId, $params = []){

    return app()->make(\App\Classes\EntitiesStore::class)->getEntity($entityType, $entityId, $params);
}

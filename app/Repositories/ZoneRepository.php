<?php

namespace App\Repositories;

use App\Interfaces\RepositoryInterface;
use App\Models\Zones;

class ZoneRepository implements RepositoryInterface
{
    public function getAll()
    {
        return Zones::all();
    }
    public function findById($id)
    {
        ;
    }
    public function delete($id)
    {
        ;
    }
    public function zoneIds($ids)
    {
        return Zones::whereIn('id', $ids)->get();
    }
}

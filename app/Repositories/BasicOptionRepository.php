<?php

namespace App\Repositories;

use App\Interfaces\RepositoryInterface;
use App\Models\ItemOption;

class BasicOptionRepository implements RepositoryInterface
{

    public function getAll()
    {
       return ItemOption::all();
    }

    public function findById($id)
    {
        return ItemOption::findOrFail($id);
    }

    public function delete($id)
    {
        return ItemOption::findOrFail($id)->delete();
    }
}

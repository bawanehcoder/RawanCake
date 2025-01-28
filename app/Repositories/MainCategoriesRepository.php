<?php
namespace App\Repositories;

use App\Interfaces\RepositoryInterface;
use App\Models\Category;
use Illuminate\Support\Facades\Cache;

class MainCategoriesRepository implements RepositoryInterface
{

    public function getAll()
    {
       return Category::all();
    }

    public function findById($id)
    {
        return Category::findOrFail($id);
    }

    public function delete($id)
    {
        return Category::findOrFail($id)->delete();
    }
    public function get(){
        // return Cache::remember('main_categories', 86400, function () {
            return Category::where('CatID',0)->where('ShortcutName', '<',1000)->orderBy('ShortcutName','ASC')->where('Visible',1)->get();
        // });

    }

    public function getc($count){
        // return Cache::remember('main_categories', 86400, function () {
            return Category::where('CatID',0)->where('ShortcutName', '<',1000)->orderBy('ShortcutName','ASC')->where('Visible',1)->take($count)->get();
        // });

    }
}

<?php
namespace App\Repositories;

use App\Interfaces\RepositoryInterface;
use App\Models\Contact;
use Illuminate\Support\Facades\Auth;


class ContactRepository implements RepositoryInterface
{

    public function getAll()
    {
       return Contact::all();
    }

    public function findById($id)
    {
        return Contact::findOrFail($id);
    }

    public function delete($id)
    {
        return Contact::findOrFail($id)->delete();
    }
    public function getCountOfUnreadMessages()
    {
        if (Auth::guard('admin')->check()) {

            }
//dd(Auth::guard('admin')->check());
       if(Auth::guard('admin')->login(getLogged())){
           return Contact::whereNull('IsReaded')->count();
       }

            return 0;


    }
}

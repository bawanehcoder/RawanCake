<?php

namespace App\Repositories;


use App\Interfaces\RepositoryInterface;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserRepository implements RepositoryInterface
{

    public function getAll()
    {
      return  User::all();
    }

    public function findById($id)
    {
        return User::findOrFail($id);
    }


    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

    public function getCountOfOnlineUsers(){

        return User::online()->count();
    } public function getCountOfUsers(){

        return User::count();
    }

    public function getCountOfOnlineUsersLast24Hours(){
        return User::onlineLast24Hours()->count();
    }
    public function getRegisteredUserCountStatistics($groupBy, $fromDate = null, $toDate = null){
        switch ($groupBy) {
            case 'year':
                $groupBy = '%Y';
                break;
            case 'month':
                $groupBy = '%m';
                break;
            case 'year-month':
                $groupBy = '%Y-%m';
                break;
            case 'year-month-day':
                $groupBy = '%Y-%m-%d';
                break;
            case 'month-day':
                $groupBy = '%m-%d';
                break;
            case 'day':
                $groupBy = '%d';
                break;
            default:
                dd('unknown groupBy param');
                break;
        }

        $query = User::select([
            \DB::raw("DATE_FORMAT(created_at, '$groupBy') as period"),
            \DB::raw("count(DATE_FORMAT(created_at, '$groupBy')) as count")
        ])
            ->groupByRaw("DATE_FORMAT(created_at, '$groupBy')")
            ->orderBy('period', 'asc');

        //fromDate filter
        if($fromDate){
            $query = $query->whereRaw("created_at >= '$fromDate'");
        }

        //toDate filter
        if($toDate){
            $query = $query->whereRaw("created_at <= '$toDate'");
        }

        return $query->get()->toArray();
    }
}

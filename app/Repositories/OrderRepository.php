<?php
namespace App\Repositories;

use App\Interfaces\RepositoryInterface;
use App\Models\Item;
use App\Models\Order;

class OrderRepository implements RepositoryInterface
{

    public function getAll()
    {
       return Order::all();
    }

    public function findById($id)
    {
        return Order::findOrFail($id);
    }

    public function delete($id)
    {
        return Order::findOrFail($id)->delete();
    }

    public function getCountOfSales(){

        return Order::acceptedOrder()->count();
    }

    public function getCompletedSalesCountStatistics($groupBy, $fromDate = null, $toDate = null){
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

        $query = Order::select([
            \DB::raw("DATE_FORMAT(created_at, '$groupBy') as period"),
            \DB::raw("count(DATE_FORMAT(created_at, '$groupBy')) as count")
        ])
            ->completed()
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

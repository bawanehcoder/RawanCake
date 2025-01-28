<?php

namespace App\Http\Controllers\Admin;

use App\Interfaces\RepositoryInterface;
use App\Repositories\OrderRepository;
use App\Repositories\UserRepository;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function __construct(UserRepository $userRepo, OrderRepository $ordrRepo)
    {

        $this->userRepo = $userRepo;
        $this->ordrRepo = $ordrRepo;


    }

    public function index(Request $request)
    {
        $data['usersCount'] = $this->userRepo->getCountOfUsers();
        $data['countOfOnlineUsers'] = $this->userRepo->getCountOfOnlineUsers();
        $data['countOfOnlineUsersLast24Hours'] = $this->userRepo->getCountOfOnlineUsersLast24Hours();
        $data['usersStatistics'] = $this->userRepo->getRegisteredUserCountStatistics(
            'year-month',
            now()->startOfYear()->format('Y-m-d'),
            now()->endOfYear()->format('Y-m-d')
        );
        $data['orderStatistics'] = $this->ordrRepo->getCompletedSalesCountStatistics(
            'year-month',
            now()->startOfYear()->format('Y-m-d'),
            now()->endOfYear()->format('Y-m-d')
        );
        $data['salesCount'] = $this->ordrRepo->getCountOfSales();
        return view('admin.dashboard', $data);
    }
}

<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Item;
use App\Models\Order;
use App\Repositories\GenralSettingRepository;
use App\Repositories\ItemRepository;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function __construct(public GenralSettingRepository $genralSettingRepository)
    {
    }
    public function index()
    {

        return view('site.order.index');

    }
    public function show(Order $entity)
    {

        if ($entity->UserID != getLogged()->id) {
            abort(404);
        }

        if ($entity->PaymentStatus == 'A') {
            $entity->Status = 'waiting';
            $entity->save();
        }
        return view('site.order.show', ['entity' => $entity, 'currency' => $this->genralSettingRepository->getCurrency()]);
    }

}

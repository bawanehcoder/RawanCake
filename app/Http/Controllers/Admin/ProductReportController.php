<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ExportSalesReport;
use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Services\MainCategoriesService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DataTables;
use Maatwebsite\Excel\Facades\Excel;

class ProductReportController extends Controller
{

    public function index(Request $request)
    {

        if (!Admin()->can('sales report view')) {
            abort(401);
        }
        if ($request->ajax()) {

            $data = OrderDetail::query();

            //date range filter

            if (!empty($request->from_date) || !empty($request->to_date)) {
                $data->whereBetween('created_at', [$request->from_date ? Carbon::parse($request->from_date)->hour(0)->minute(0)->second(0) : '0000-00-00', $request->to_date ? Carbon::parse($request->to_date)->hour(23)->minute(59)->second(59) : '9999-12-30']);
            }

            $data->groupBy('itemID');
            $data->selectRaw('sum(Quantity) as Quantity, itemID');


            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('Name', function ($row) {
                    $item = Item::where('id', $row->itemID)->first();
                    if ($item) {
                        return $item->getTitle();
                    }
                    return '';
                })
                ->addColumn('Category', function ($row) {
                    $item = Item::where('id', $row->itemID)->first();
                    if ($item) {
                        $sub_cat=$item->subCategory;
                        if($sub_cat){
                            return $sub_cat->getName();
                        }

                    }
                    return '';
                }) ->addColumn('Price', function ($row) {
                    $item = Item::where('id', $row->itemID)->first();
                    if ($item) {
                        return $item->Price;
                    }
                    return '';
                })
                ->addColumn('Image', function ($row) {
                    $item = Item::where('id', $row->itemID)->first();
                    if ($item) {
                        return '<img src="' . $item->getFirstMediaUrl('products', 'small') . '">';
                    }
                    return '';
                })
                 ->addColumn('Total', function ($row) {
                                    $item = Item::where('id', $row->itemID)->first();
                                    if ($item) {
                                        return $item->Price*$row->Quantity;
                                    }
                                    return '';
                                })

                ->rawColumns(['Image'])
                ->make(true);
        }

        return view('admin.product-report.index', ['to_date' => $request->to_date, 'from_date' => $request->from_date]);
    }


    public function exportSalesReport(Request $request)
    {

        $data = Order::query();
        $data->where('Status', 1);
        #Apply filters:
        if (!empty($request->payment_method)) {
            switch ($request->payment_method) {
                case 'cash_on_delivery':
                    $data->CashOnDelivery();
                    break;
                case 'electronic_payment':
                    $data->ElectronicPayment();
                    break;
            }
        }
        if (!empty($request->receiving_method)) {
            switch ($request->receiving_method) {
                case 'personal_pickup':
                    $data->PersonalPickup();
                    break;
                case 'delivery_address':
                    $data->DeliveryAddress();
                    break;
            }
        }


        //date range filter

        if (!empty($request->from_date) || !empty($request->to_date)) {
            $data->whereBetween('OrderDate', [$request->from_date ? Carbon::parse($request->from_date)->hour(0)->minute(0)->second(0) : '0000-00-00', $request->to_date ? Carbon::parse($request->to_date)->hour(23)->minute(59)->second(59) : '9999-12-30']);
        }
        return Excel::download(new ExportSalesReport($data), now() . '-sales-report.xlsx');

    }


}

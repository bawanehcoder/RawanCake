<?php

namespace App\Http\Controllers\Admin;
use App\Exports\ExportSalesReport;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\MainCategoriesService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DataTables;
use Maatwebsite\Excel\Facades\Excel;
class SalesReportController extends Controller
{

    public function index(Request $request)
    {

        if (!Admin()->can('sales report view')) {
            abort(401);
        }
        if ($request->ajax()) {

            $data = Order::query();
            $data->where('Status',1);

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



            return Datatables::of($data)
                ->addIndexColumn()

                ->addColumn('Source', function ($row) {
                    return $row->Source;
                })
                ->addColumn('PaymentMethod', function ($row) {
                    return $row->PaymentMethod;
                })
                ->addColumn('Total', function ($row) {
                    return $row->Total+$row->AddValue;
                })
                ->addColumn('action', function ($row) {
                    return view('components.table_crud', [
                        'entity' => $row,
                        'showViewButton' => true,
                        'showEditButton' => false,
                        'showDeleteButton' => false,
                    ])->render();
                })

                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.sales-report.index', ['payment_method'=> $request->payment_method,'receiving_method'=> $request->receiving_method,'to_date'=>$request->to_date,'from_date'=>$request->from_date]);
    }


    public function exportSalesReport(Request $request)
    {

        $data = Order::query();
        $data->where('Status',1);
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

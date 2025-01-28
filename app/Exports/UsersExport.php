<?php

namespace App\Exports;

use App\Models\Order;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Order::find(2);
    }

    public function view(): View
    {
        return view('admin.orders.pdf-order', [
            'entity' =>  $this->data
        ]);
    }
}

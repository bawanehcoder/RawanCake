<?php

namespace App\Exports;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Illuminate\Contracts\Queue\ShouldQueue;
class InvoicesExport implements FromView
{
    public function __construct(public $data)
    {
        $this->data=$data;
    }

    public function view(): View
    {
        return view('admin.orders.pdf-order', [
            'entity' =>  $this->data
        ]);
    }
    // }
    // public function registerEvents(): array
    // {
    //     return [

    //         AfterSheet::class    => function(AfterSheet $event) {

    //         },
    //     ];
    // }
}

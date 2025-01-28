<?php

namespace App\Exports;


use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ExportSalesReport implements  FromQuery, WithHeadings, WithMapping, ShouldAutoSize, WithColumnWidths, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */


    private $query;

    public function __construct($query = null)
    {

        if(empty($query)){
            $query = Order::query();
        }

        $this->query = $query;
    }


    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],
            'H'  => ['font' => ['bold' => true]],
        ];
    }

    public function query()
    {
        return $this->query
            ->select([
                'id',
                'Source',
                'PaymentMethod',
                'Name',
                'Phone',
                'address',
                'DeliveryTime',
                'Total',
               ])
            ->orderBy('id', 'desc');

    }

    public function columnWidths(): array
    {
        return [
            'F' => 55,
        ];
    }

    public function headings(): array
    {
        return [
            'id',
            'Source',
            'PaymentMethod',
            'Name',
            'Phone',
            'address',
            'DeliveryTime',
            'Total',

        ];
    }
    public function map($row): array
    {
        return [
            $row->id,
            $row->Source,
            $row->PaymentMethod,
            $row->Name,
            $row->Phone,
            $row->address,
            $row->DeliveryTime,
            $row->Total+$row->AddValue,


        ];
    }


}

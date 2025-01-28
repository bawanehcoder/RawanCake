<?php

namespace App\Exports;

use App\Models\Newsletter;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportNewsletter implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Newsletter::all('EMail');
    }
}

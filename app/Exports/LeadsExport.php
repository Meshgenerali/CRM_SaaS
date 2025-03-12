<?php

namespace App\Exports;

use App\Exports\LeadsExport;
use Maatwebsite\Excel\Facades\Excel;

use App\Models\Lead;
use Maatwebsite\Excel\Concerns\FromCollection;

class LeadsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Lead::all();
    }
}

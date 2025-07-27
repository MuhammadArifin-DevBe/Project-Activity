<?php

namespace App\Exports;

use App\Models\ActivityForm;
use Maatwebsite\Excel\Concerns\FromCollection;

class ActivityFormsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ActivityForm::all();
    }
}

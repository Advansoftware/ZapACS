<?php

namespace App\Exports;

use App\Models\Models\ModelFamilia;
use Maatwebsite\Excel\Concerns\FromCollection;


class FamiliaExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ModelFamilia::all();
    }
}

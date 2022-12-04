<?php

namespace App\Exports;

use App\Models\Arquivo;
use Maatwebsite\Excel\Concerns\FromCollection;

class ArquivosExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Arquivo::all();
    }
}

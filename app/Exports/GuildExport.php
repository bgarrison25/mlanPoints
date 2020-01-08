<?php

namespace App\Exports;

use App\Guild;
use Maatwebsite\Excel\Concerns\FromCollection;

class GuildExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Guild::select('name', 'points')->get();
    }
}

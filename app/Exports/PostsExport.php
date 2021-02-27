<?php
namespace App\Exports;

use App\Lotes;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProductsExport implements FromCollection
{
    use Exportable;

    protected $Lotes;

    public function __construct($Lotes = null)
    {
        $this->Lotes = $Lotes;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->Lotes ?: Lotes::all();
    }
}
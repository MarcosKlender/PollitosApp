<?php

namespace App\Http\Controllers;

use App\Lotes;
use App\Registros;
use App\GavetasVacias;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\Exportable;
use App\Exports\PostExportloteConsolidado;

class ReporteLoteGeneralController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    

    public function generar_excel_consolidado($id)
    {
        return (new PostExportloteConsolidado($id) )->download('lotes_consolidado.xlsx');
    }


}

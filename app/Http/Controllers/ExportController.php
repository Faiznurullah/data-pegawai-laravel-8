<?php

namespace App\Http\Controllers;

use App\Jobs\ExportPdf;
use Illuminate\Support\Facades\DB;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;


class ExportController extends Controller
{
    
   public function downloadpdf(){
       $x = Pegawai::latest()->take(1000)->get();
        view()->share('pegawai', $x);
        $pdf = PDF::loadview('export.data-pdf')->setPaper('a4', 'portrait');
        return $pdf->download('data-pegawai.pdf');
   }

}

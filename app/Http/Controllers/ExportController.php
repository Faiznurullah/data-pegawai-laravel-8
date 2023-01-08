<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;


class ExportController extends Controller
{
    
   public function downloadpdf(){

    $x = DB::table('pegawai')->get();
    view()->share('pegawai', $x);
    $pdf = PDF::loadview('export.data-pdf')->setPaper('a4', 'portrait');;
    return $pdf->download('data-pegawai.pdf');

   }

}

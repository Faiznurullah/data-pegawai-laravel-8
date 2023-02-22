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
      dispatch(new ExportPdf());
   }

}

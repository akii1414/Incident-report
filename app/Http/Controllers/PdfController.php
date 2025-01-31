<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfController extends Controller
{
    public function downloadPDF(Request $request)
    {
        $data = $request->all();
        $pdf = Pdf::loadView('pdf.incident_report', compact('data'));
        return $pdf->download('incident_report.pdf');
    }
}


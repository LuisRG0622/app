<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PDFController extends Controller
{

public function generatePDF()
{
    $data = [
        'title' => 'Styde.net PDF Example',
        'date' => date('m/d/Y')
    ];

    $pdf = Pdf::loadView('pdf_template', $data);
    return $pdf->download('example.pdf');
}

public function download()
{
    $pdf = app('dompdf.wrapper');
    $pdf->loadHTML('<h1>Styde.net</h1>');

    return $pdf->download('mi-archivo.pdf');
}

}

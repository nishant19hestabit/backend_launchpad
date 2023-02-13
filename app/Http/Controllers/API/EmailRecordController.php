<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\EmailRecord;
use Illuminate\Http\Request;
use PDF;

class EmailRecordController extends Controller
{
    public function emailRecords()
    {
        $records = EmailRecord::all();
        $pdf = PDF::loadView('pdf.invoice', compact('records'));
        return $pdf->download('invoice.pdf');
    }
}

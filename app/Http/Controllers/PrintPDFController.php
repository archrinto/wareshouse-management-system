<?php

namespace App\Http\Controllers;

use App\Models\GoodsTransaction;
use Illuminate\Http\Request;
use PDF;

class PrintPDFController extends Controller
{
    public function receivingDetail($id) {
        $companyName = config('name');
        $transaction = GoodsTransaction::where('id', $id)->first();
        $filename = __('receiving') . '-' . gmdate("Ymd", $transaction->transaction_at) . '.pdf';

        $pdf = PDF::loadView('prints.receiving-detail-pdf', [
            'companyName' => $companyName,
            'receivingDate' => gmdate("Y/m/d", $transaction->transaction_at),
            'items' => $transaction->items,
            'createdAt' => $transaction->created_at,
            'printedAt' => now(),
        ]);
        return $pdf->stream();
        return $pdf->download($filename);
    }
}

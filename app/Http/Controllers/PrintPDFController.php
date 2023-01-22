<?php

namespace App\Http\Controllers;

use App\Models\GoodsTransaction;
use App\Services\PrintService;
use Illuminate\Http\Request;
use PDF;

class PrintPDFController extends Controller
{
    public function receivingDetail($id) {
        $transaction = GoodsTransaction::where('id', $id)->first();
        $pdf = PrintService::printDispatchingDetail($transaction);

        return $pdf->stream();
    }

    public function dispatchingDetail($id) {
        $transaction = GoodsTransaction::where('id', $id)->first();
        $pdf = PrintService::printDispatchingDetail($transaction);

        return $pdf->stream();
    }

    public function stockOpnameDetail($id) {
        $transaction = GoodsTransaction::where('id', $id)->first();
        $pdf = PrintService::printStockOpnameDetail($transaction);

        return $pdf->stream();
    }
}

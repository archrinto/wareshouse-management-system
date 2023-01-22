<?php

namespace App\Services;

use App\Models\GoodsTransaction;
use Illuminate\Support\Facades\Auth;
use PDF;

class PrintService {

    public static function printReceivingDetail(GoodsTransaction $transaction) {
        $companyName = config('app.name');

        return PDF::loadView('prints.dispatching-detail-pdf', [
            'companyName' => $companyName,
            'transaction' => $transaction,
            'printedAt' => now(),
            'printedBy' => Auth::user(),
        ]);
    }

    public static function printDispatchingDetail(GoodsTransaction $transaction) {
        $companyName = config('app.name');

        return PDF::loadView('prints.dispatching-detail-pdf', [
            'companyName' => $companyName,
            'transaction' => $transaction,
            'printedAt' => now(),
            'printedBy' => Auth::user(),
        ]);
    }

    public static function printStockOpnameDetail(GoodsTransaction $transaction) {
        $companyName = config('app.name');

        return PDF::loadView('prints.stock-opname-detail-pdf', [
            'companyName' => $companyName,
            'transaction' => $transaction,
            'printedAt' => now(),
            'printedBy' => Auth::user(),
        ]);
    }
}

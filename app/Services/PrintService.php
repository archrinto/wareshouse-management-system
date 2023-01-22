<?php

namespace App\Services;

use App\Models\GoodsTransaction;
use PDF;
class PrintService {

    public static function printReceivingDetail(GoodsTransaction $transaction) {
        $companyName = config('name');

        return PDF::loadView('prints.receiving-detail-pdf', [
            'companyName' => $companyName,
            'receivingDate' => gmdate("Y/m/d", $transaction->transaction_at),
            'items' => $transaction->items,
            'createdAt' => $transaction->created_at,
            'printedAt' => now(),
        ]);
    }
}

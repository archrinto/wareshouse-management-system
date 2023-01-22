<?php

namespace App\Http\Livewire\StockOpname\Pages;

use App\Models\GoodsTransaction;
use App\Services\PrintService;
use Livewire\Component;

class DetailStockOpnamePage extends Component
{
    public $transactionId;
    public $transaction;

    public function mount($id) {
        $this->transactionId = $id;
        $this->loadTransaction();
    }

    public function loadTransaction() {
        $this->transaction = GoodsTransaction::where('id', $this->transactionId)->first();
    }

    public function printPDF() {
        $pdfContent = PrintService::printStockOpnameDetail($this->transaction)->output();
        $filename = __('stock-opname') . '-' . gmdate("Ymd", $this->transaction->transaction_at) . '.pdf';

        return response()->streamDownload(
            fn () => print($pdfContent),
            $filename
        );
    }

    public function render()
    {
        return view('livewire.stock-opname.pages.detail-stock-opname-page');
    }
}

<?php

namespace App\Http\Livewire\Dispatching\Pages;

use App\Models\GoodsTransaction;
use App\Services\PrintService;
use Livewire\Component;

class DetailDispatchingPage extends Component
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
        $pdfContent = PrintService::printDispatchingDetail($this->transaction)->output();
        $filename = __('dispatching') . '-' . gmdate("Ymd", $this->transaction->transaction_at) . '.pdf';

        return response()->streamDownload(
            fn () => print($pdfContent),
            $filename
        );
    }

    public function render()
    {
        return view('livewire.dispatching.pages.detail-dispatching-page');
    }
}

<?php

namespace App\Http\Livewire\Receiving\Pages;

use App\Models\GoodsTransaction;
use App\Services\PrintService;
use Livewire\Component;

class DetailReceivingPage extends Component
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
        $pdfContent = PrintService::printReceivingDetail($this->transaction)->output();
        $filename = __('receiving') . '-' . gmdate("Ymd", $this->transaction->transaction_at) . '.pdf';

        $this->dispatchBrowserEvent('toast',[
            'type' => 'success',
            'message' => __('PDF is ready')
        ]);

        return response()->streamDownload(
            fn () => print($pdfContent),
            $filename
        );
    }

    public function render()
    {
        return view('livewire.receiving.pages.detail-receiving-page');
    }
}

<?php

namespace App\Listeners;

use App\Events\GoodsTransactionCreated;
use App\Models\GoodsTransaction;
use App\Models\GoodsTransactionCategory;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateGoodsStock
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(GoodsTransaction $goodsTransaction)
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\GoodsTransactionCreated  $event
     * @return void
     */
    public function handle(GoodsTransactionCreated $event)
    {
        $goodsTransaction = $event->goodsTransaction;
        $operation = $goodsTransaction->category->operation;
        $items = $goodsTransaction->items;

        foreach($items as $item) {
            $goods = $item->goods;

            if ($operation == GoodsTransactionCategory::$additionOperation) {
                $newStock = $goods->stock + $item->quantity;
            } else if ($operation == GoodsTransactionCategory::$subtractionOperation) {
                $newStock = $goods->stock - $item->quantity;
            } else if ($operation == GoodsTransactionCategory::$changeOperation) {
                $newStock = $item->quantity;
            }

            $item->goods->update([
                'stock' => $newStock,
            ]);
        }
    }


}

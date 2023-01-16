<?php

namespace App\Models;

use App\Traits\UserAudit;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoodsTransactionGoods extends Model
{
    use Uuid;

    protected $table = 'wms_goods_transaction_goods';
    protected $fillable = [
        'transaction_id',
        'goods_id',
        'quantity',
    ];

    public $timestamps = false;

    public function goods()  {
        return $this->belongsTo(Goods::class, 'goods_id', 'id');
    }

    public function transaction() {
        return $this->belongsTo(GoodsTransaction::class, 'transaction_id', 'id');
    }
}

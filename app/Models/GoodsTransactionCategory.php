<?php

namespace App\Models;

use App\Traits\UserAudit;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoodsTransactionCategory extends Model
{
    use Uuid;

    protected $table = 'wms_goods_transaction_category';
    protected $fillable = [
        'name',
        'operation',
        'description',
        'is_receiving',
        'is_dispatching',
        'is_locked'
    ];

    public static $additionOperation = 'addition';
    public static $subtractionOperation = 'subtraction';

    public function scopeReceiving($query) {
        return $query->where('is_receiving', true);
    }

    public function scopeDispatching($query) {
        return $query->where('is_dispatching', true);
    }

    public function scopeStockOpname($query) {
        return $query
            ->where('is_dispatching', false)
            ->where('is_receiving', false);
    }

    public function transactions() {
        return $this->hasMany(GoodsTransaction::class, 'category_id', 'id');
    }
}

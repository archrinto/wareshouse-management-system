<?php

namespace App\Models;

use App\Traits\UserAudit;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoodsTransaction extends Model
{
    use Uuid;

    protected $table = 'wms_goods_transaction';
    protected $fillable = [
        'type',
        'category_id',
        'transaction_at',
        'supplier_id',
        'shipper_id',
        'description',
    ];

    public function supplier() {
        return $this->hasOne(Supplier::class, 'id', 'supplier_id');
    }

    public function shipper() {
        return $this->hasOne(Shipper::class, 'id', 'shipper_id');
    }

    public function items() {
        return $this->hasMany(GoodsTransactionGoods::class, 'transaction_id', 'id');
    }

    public function category() {
        return $this->belongsTo(GoodsTransactionCategory::class, 'category_id', 'id');
    }

    public function getTransactionAtFormattedAttribute() {
        return gmdate("Y-m-d", $this->transaction_at);
    }

    public function scopeDispatching($query) {
        return $query->whereHas('category', function($query) {
            $query->where('is_dispatching', true);
        });
    }

    public function scopeReceiving($query) {
        return $query->whereHas('category', function($query) {
            $query->where('is_receiving', true);
        });
    }

    public function scopeStockOpname($query) {
        return $query->whereHas('category', function($query) {
            $query->where('is_receiving', false)
                ->where('is_dispatching', false);
        });
    }
}

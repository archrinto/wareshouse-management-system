<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    use Uuid;

    protected $table = 'wms_goods';
    protected $fillable = [
        'name',
        'code',
        'description',
        'unit_id',
        'minimum_stock',
        'stock',
        'created_at',
        'updated_at'
    ];

    public function unit() {
        return $this->hasOne(Unit::class, 'id', 'unit_id');
    }

    public function getCodeNameAttribute() {
        return $this->code . ' ' . $this->name;
    }

    public function scopeAvailableStock($query) {
        return $query
            ->whereRaw('stock > 0')
            ->whereRaw('stock >= (minimum_stock * 2)');
    }

    public function scopeLowStock($query) {
        return $query
            ->whereRaw('stock > 0')
            ->whereRaw('stock < (minimum_stock * 2)');
    }

    public function scopeOutOfStock($query) {
        return $query->whereRaw('stock <= minimum_stock');
    }
}

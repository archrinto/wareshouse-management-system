<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

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
        'price',
        'stock',
        'created_at',
        'updated_at'
    ];

    public function unit() : HasOne {
        return $this->hasOne(Unit::class, 'id', 'unit_id');
    }

    public function categories() : BelongsToMany {
        return $this->belongsToMany(
            GoodsCategory::class,
            'wms_goods_categories_goods',
            'goods_id',
            'category_id'
        );
    }

    public function getCategoryNames() : array {
        return $this->categories->pluck('name')->toArray();
    }

    public function getCodeNameAttribute() : string {
        return $this->code . ' ' . $this->name;
    }

    public function scopeAvailableStock($query) {
        return $query
            ->whereRaw('stock > 0 AND stock >= (minimum_stock * 2)');
    }

    public function scopeLowStock($query) {
        return $query
            ->whereRaw('stock > 0 AND stock < (minimum_stock * 2) AND stock > minimum_stock');
    }

    public function scopeOutOfStock($query) {
        return $query->whereRaw('stock <= minimum_stock');
    }
}

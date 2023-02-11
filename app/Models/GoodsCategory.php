<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class GoodsCategory extends Model
{
    use Uuid;

    protected $table = "wms_goods_categories";

    protected $fillable = [
        'name',
        'description',
        'created_by',
        'updated_by'
    ];

    public function goods() : BelongsToMany {
        return $this->belongsToMany(
            Goods::class,
            'wms_goods_categories_goods',
            'category_id',
            'goods_id'
        );
    }
}

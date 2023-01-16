<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoodsCategory extends Model
{
    use Uuid;
    protected $keyType = 'string';
    protected $table = 'wms_goods_category';
    protected $fillable = [
        'name',
        'description',
    ];
}

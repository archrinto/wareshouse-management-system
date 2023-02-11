<?php

namespace App\Http\Controllers;

use App\Models\Goods;
use Illuminate\Http\Request;

class GoodsController extends Controller
{
    public function options(Request $request) {
        $goodsList = Goods::query()
            ->join('wms_unit as u', 'u.id', '=', 'goods.unit_id')
            ->select('code', 'name', 'id', 'u.symbol as unit')
            ->get()
            ->toArray();

        return response()->json(
            $goodsList
        );
    }
}

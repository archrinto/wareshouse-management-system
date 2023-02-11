<?php

namespace Database\Seeders;

use App\Models\GoodsTransactionCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GoodsTransactionCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        GoodsTransactionCategory::create([
            'name' => __('Receiving'),
            'is_locked' => true,
            'is_receiving' => true,
            'operation' => GoodsTransactionCategory::$additionOperation,
        ]);

        GoodsTransactionCategory::create([
            'name' => __('Dispatching'),
            'is_locked' => true,
            'is_dispatching' => true,
            'operation' => GoodsTransactionCategory::$subtractionOperation,
        ]);
    }
}

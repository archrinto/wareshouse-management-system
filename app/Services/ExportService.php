<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Collection;

class ExportService {

    public static function exportGoodsListCSV(Collection $data) {
        $columns = ['code', 'name', 'stock', 'unit', 'value'];

        return function() use($data, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($data as $item) {
                fputcsv($file, array(
                    $item->code,
                    $item->name,
                    $item->stock,
                    $item['unit.symbol'] ?? 'n/a',
                    $item->stock * $item->price
                ));
            }

            fclose($file);
        };
    }
}

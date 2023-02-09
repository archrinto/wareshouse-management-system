<?php

namespace App\Models;

use App\Traits\HasCreatorEditor;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use Uuid;

    protected $keyType = 'string';
    protected $table = 'wms_unit';
    protected $fillable = [
        'name',
        'symbol'
    ];
}

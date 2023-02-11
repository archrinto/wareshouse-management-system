<?php

namespace App\Models;

use App\Traits\HasCreatorEditor;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use Uuid;

    protected $keyType = 'string';
    protected $table = 'wms_supplier';
    protected $fillable = [
        'name',
        'address',
        'cp_name',
        'cp_phone',
    ];
}

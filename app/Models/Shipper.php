<?php

namespace App\Models;

use App\Traits\HasCreatorEditor;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipper extends Model
{
    use Uuid;

    protected $keyType = 'string';
    protected $table = 'wms_shipper';
    protected $fillable = [
        'name',
        'cp_phone',
    ];
}

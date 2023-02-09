<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

trait HasCreatorEditor
{
    public static function bootHasCreatorEditor()
    {
        // updating created_by and updated_by when model is created
        static::creating(function ($model) {
            if (!$model->isDirty('created_by')) {
                $model->created_by = Auth::id();
            }
            if (!$model->isDirty('updated_by')) {
                $model->updated_by = Auth::id();
            }
        });

        // updating updated_by when model is updated
        static::updating(function ($model) {
            if (!$model->isDirty('updated_by')) {
                $model->updated_by = Auth::id();
            }
        });
    }

    public function creator() {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function editor() {
        return $this->belongsTo(User::class, 'updated_by');
    }
}

<?php

namespace App\Models;

use App\Observers\CoverObserver;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;


class Cover extends Model
{

    protected $fillable = [
        'image_path',
        'title',
        'start_at',
        'end_at',
        'is_active',
        'order',
    ];
    protected $casts = [
        'start_at' => 'datetime',
        'end_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    protected function image(): Attribute
    {
        return Attribute::make(
            get: function () {
                return Storage::url($this->image_path);
            }
        );
    }

}

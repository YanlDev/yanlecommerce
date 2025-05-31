<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'sku',
        'name',
        'description',
        'image_path',
        'price',
        'stock',
        'subcategory_id',
    ];

    protected function image(): Attribute
    {
        return Attribute::make(
            get: function () {
                // Verifica que existe el path antes de generar la URL
                return $this->image_path
                    ? Storage::url($this->image_path)
                    : asset('images/no-image.png'); // Imagen por defecto
            }
        );
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function variants(){
        return $this->hasMany(Variant::class);
    }

    public function options(){
        return $this->belongsToMany(Option::class)
            ->using(OptionProduct::class)
            ->withPivot('features')
            ->withTimestamps();
    }

}

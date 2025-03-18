<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    protected $fillable = ['name', 'api_unique_number'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'type_assignments');
    }

    public function categories()
    {
        return $this->belongsToMany(ProductCategory::class, 'type_assignments');
    }
}
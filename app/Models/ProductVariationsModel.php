<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariationsModel extends Model
{
    use HasFactory;
    protected $table = 'product_variations';
    public $primary_key = 'id';

    public function product_properties(){
        return $this->belongsToMany(PropertiesModel::class, 'product_properties', 'product_variation_id', 'properties_id');
    }

    public function product_properties_available(){
        return $this->product_properties()->where('is_active', 1);
    }
}

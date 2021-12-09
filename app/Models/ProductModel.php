<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductImagesModel;
use App\Models\ProductCategoriesModel;

class ProductModel extends Model
{
    use HasFactory;
    protected $table = 'product';
    protected $primary_key = 'id';

    public $timestamps = false;

    public function ref_product_images(){
        return $this->hasMany(ProductImagesModel::class, 'product_id', 'id');
    }

    public function product_categories(){
        return $this->belongsTo(ProductCategoriesModel::class, 'product_categories_id', 'id');
    }

    public function variations(){
        return $this->hasMany(ProductVariationsModel::class, 'product_id', 'id');
    }
}

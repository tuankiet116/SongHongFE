<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategoriesModel extends Model
{
    use HasFactory;

    protected $table = 'product_categories';
    protected $primary_key = 'id';

    public $timestamps = false;

    public function ref_category_lv1()
    {
        return $this->hasMany(CategoryLv1Model::class, 'product_categories_id', 'id');
    }

    public function product()
    {
        return $this->hasMany(ProductModel::class, 'product_categories_id', 'id')->where([
            ['is_active', '=', 1],
            ['view', '=', 1]
        ]);
    }
}

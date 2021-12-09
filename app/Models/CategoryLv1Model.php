<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryLv1Model extends Model
{
    use HasFactory;
    protected $table = 'ref_category_lv1';
    protected $primary_key = 'id';

    public $timestamps = false;

    public function ref_category_lv2(){
        return $this->hasMany(CategoryLv2Model::class, 'ref_category_lv1_id', 'id');
    }

    public function product(){
        return $this->hasMany(ProductModel::class, 'ref_category_lv1_id', 'id');
    }
}

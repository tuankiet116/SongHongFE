<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryLv2Model extends Model
{
    use HasFactory;
    protected $table = 'ref_category_lv2';
    protected $primary_key = 'id';

    public $timestamps = false;

    public function product(){
        return $this->hasMany(ProductModel::class, 'ref_category_lv2_id', 'id');
    }
}

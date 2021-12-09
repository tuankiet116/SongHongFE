<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImagesModel extends Model
{
    use HasFactory;
    protected $table = 'ref_product_images';
    protected $primary_key = 'product_id';

    public $timestamps = false;
}

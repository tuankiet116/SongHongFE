<?php
namespace App\Repositories\Interfaces;
interface ProductCateLv2Interface{
    public function getListingCategoriesWithProduct(int $id);
    public function getProductCateByID(int $id);
}
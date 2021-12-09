<?php
namespace App\Repositories\Interfaces;
interface ProductCateLv1Interface{
    public function getListingCategories(int $shopID);
    public function getListingCategoriesWithProduct(int $shopID);
    public function getProductCateByID(int $id, array $relations = null);
}
<?php
namespace App\Repositories\Interfaces;

interface ProductCateInterface{
    public function getListingCategories(int $shopID);
    public function getListingCategoriesWithProduct(int $shopID);
    public function getProductCateByID(int $id, array $relations = null);
}
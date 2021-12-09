<?php
namespace App\Repositories\Interfaces;
interface ProductsInterface{
    public function getListingProductsWithChildrents(int $shopID, $tables, array $condition, int $paginate = 0);
    public function getProductsByCategories(int $categoriesID, int $shopID, string $level, int $paginate = null);
    public function getProductsInListID(array $id, int $shopID, array $condition = null);
    public function getProductSample(int $shopID, array $condition = null);
}

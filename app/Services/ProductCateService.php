<?php

namespace App\Services;

use App\Repositories\Interfaces\ProductCateInterface;
use App\Repositories\Interfaces\ProductCateLv1Interface;
use App\Repositories\Interfaces\ProductCateLv2Interface;
use App\Repositories\Interfaces\ShopsRepoInterface;
use App\Repositories\Interfaces\WebsiteRepoInterface;

class ProductCateService extends BaseService
{
    private $productCate;
    private $productCateLv1;
    private $productCateLv2;

    public function __construct(
        WebsiteRepoInterface $website,
        ShopsRepoInterface $shop,
        ProductCateInterface $cate,
        ProductCateLv1Interface $catelv1,
        ProductCateLv2Interface $catelv2
    ) {
        parent::__construct($website, $shop);
        $this->productCate = $cate;
        $this->productCateLv1 = $catelv1;
        $this->productCateLv2 = $catelv2;
    }

    public function getListingProductCategories()
    {
        return $this->productCate->getListingCategories($this->shopID);
    }

    public function getListingProductCategoriesWithProductsDetail()
    {
        return $this->productCate->getListingCategoriesWithProduct($this->shopID);
    }

    public function getDetailProductCategories(int $id, int $level = 0, array $relations = null)
    {
        $categories = null;
        switch ($level) {
            case 0:
                $categories = $this->productCate->getProductCateByID($id, $relations);
                break;
            case 1:
                $categories = $this->productCateLv1->getProductCateByID($id, $relations);
                break;
            case 2:
                $categories = $this->productCateLv2->getProductCateByID($id);
                break;
        }
        return $categories;
    }
}

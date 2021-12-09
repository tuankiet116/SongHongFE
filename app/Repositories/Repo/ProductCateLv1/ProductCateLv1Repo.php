<?php

namespace App\Repositories\Repo\ProductCateLv1;

use App\Models\CategoryLv1Model;
use App\Repositories\Interfaces\ProductCateLv1Interface;

class ProductCateLv1Repo implements ProductCateLv1Interface
{
    public function getListingCategories(int $shopID)
    {
    }

    public function getListingCategoriesWithProduct(int $shopID)
    {
    }

    public function getProductCateByID(int $id, array $relations = null)
    {
        if (isset($relations) && sizeof($relations) > 0) {
            return CategoryLv1Model::with($relations)
                ->where([
                    ['id', '=', $id]
                ])->first();
        }
        return CategoryLv1Model::where([
            ['id', '=', $id]
        ])->first();
    }
}

<?php

namespace App\Repositories\Repo\ProductCateLv2;

use App\Models\CategoryLv2Model;
use App\Repositories\Interfaces\ProductCateLv2Interface;

class ProductCateLv2Repo implements ProductCateLv2Interface
{
    public function getListingCategoriesWithProduct(int $id)
    {
    }

    public function getProductCateByID(int $id)
    {
        return CategoryLv2Model::where([
            ['id', '=', $id]
        ])->first();
    }
}

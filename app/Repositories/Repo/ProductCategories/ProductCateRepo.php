<?php

namespace App\Repositories\Repo\ProductCategories;

use App\Models\ProductCategoriesModel;
use App\Repositories\Interfaces\ProductCateInterface;

class ProductCateRepo implements ProductCateInterface
{
    public function getListingCategories(int $shopID)
    {
        return ProductCategoriesModel::where([
                ['shop_id', '=', $shopID],
                ['is_active', '=', 1]
            ])->orderBy('modified_date', 'desc')->get();
    }

    public function getListingCategoriesWithProduct(int $shopID){
        return ProductCategoriesModel::with('ref_category_lv1', 'product.ref_product_images', 'product')
            ->where([
                ['shop_id', '=', $shopID],
                ['is_active', '=', 1]
            ])->orderBy('modified_date', 'desc')->get();
    }

    public function getProductCateByID(int $id, array $relations = null){
        if(isset($relations) && sizeof($relations)>0 ){
            return ProductCategoriesModel::with($relations) 
            ->where([
                ['is_active', '=', 1],
                ['id', '=', $id]
            ])->first();
        }
        return ProductCategoriesModel::where([
            ['is_active', '=', 1],
            ['id', '=', $id]
        ])->first();
    }
}

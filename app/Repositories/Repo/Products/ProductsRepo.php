<?php

namespace App\Repositories\Repo\Products;

use App\Models\ProductModel;
use App\Repositories\Interfaces\ProductsInterface;

class ProductsRepo implements ProductsInterface
{
    public function getListingProductsWithChildrents(int $shopID, $tables, array $condition, int $paginate = 0)
    {
        $result = ProductModel::with($tables)->where([
            ['is_active', '=', 1],
            ['view', '=', 1],
            ['shop_info_id', '=', $shopID],
            $condition
        ]);

        if($paginate > 0 && isset($paginate)){
            return $result->paginate($paginate);
        }
        return $result->get();
    }

    public function getProductsByCategories(int $categoriesID, int $shopID, string $level, int $paginate = null){
        $table = 'product_categories_id';
        switch($level){
            case 'lv0':
                $table = 'product_categories_id';
                break;
            case 'lv1':
                $table = 'ref_category_lv1_id';
                break;
            case 'lv2':
                $table = 'ref_category_lv2_id';
                break;
        }
        $result = ProductModel::where([
            ['is_active'   , '=', 1],
            ['view', '=', 1],
            ['shop_info_id', '=', $shopID],
            [$table        , '=', $categoriesID]
        ]);

        if($paginate > 0 && isset($paginate)){
            return $result->paginate($paginate);
        }
        return $result->get();
    }

    public function getProductsInListID(array $id, int $shopID, array $condition = null){
        if(isset($condition) && sizeof($condition)>0){
            return ProductModel::whereIn('id', $id)->where([
                ['is_active', '=', 1],
                ['view', '=', 1],
                ['shop_info_id', '=', $shopID],
                $condition
            ]);
        }
        else{
            return ProductModel::whereIn('id', $id)->where([
                ['is_active', '=', 1],
                ['view', '=', 1],
                ['shop_info_id', '=', $shopID],
                $condition
            ]);
        }
    }

    public function getProductSample(int $shopID, array $condition = null){
        if(isset($condition) && sizeof($condition)>0){
            return ProductModel::where([
                ['is_active', '=', 1],
                ['view', '=', 1],
                ['shop_info_id', '=', $shopID],
                $condition
            ])->first();
        }
        else{
            return ProductModel::where([
                ['is_active', '=', 1],
                ['view', '=', 1],
                ['shop_info_id', '=', $shopID],
                $condition
            ])->inRandomOrder()->first();
        }
    }
}

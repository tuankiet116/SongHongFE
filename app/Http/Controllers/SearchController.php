<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCategoriesModel;
use App\Models\ConfigurationModel;
use App\Models\ProductModel;
use App\Models\ShopModel;
use App\Services\ConfigurationsService;
use App\Services\PostsService;
use App\Services\ProductCateService;
use App\Services\ProductsService;
use App\Services\ShopsService;

class SearchController extends Controller
{
    private $config;
    private $productCate;
    private $shop;
    private $products;
    private $postPolicy;

    public function __construct(ConfigurationsService $config, ProductCateService $cate, ShopsService $shop, ProductsService $products, PostsService $post)
    {
        $this->config      = $config->getConfig();
        $this->productCate = $cate;
        $this->shop        = $shop->getShopInfor();
        $this->products    = $products;
        $this->postPolicy  = $post->listingPostsByPostType('chinh-sach');
    }

    public function search(Request $request){
        $keyword = $request->keyword;
        $type    = $request->type;

        if(isset($type)){
            $Product = ProductCategoriesModel::where([
                ['shop_id', '=', $this->shop->id],
                ['is_active', '=', 1],
                ['id', '=', $type]
            ])->first()
              ->product()
              ->where([
                  ['title', 'like', '%'.$keyword.'%'],
                  ['is_active', '=', 1],
                  ['view', '=', 1],
              ])->get();

            $cate = [ProductCategoriesModel::where([
                ['shop_id', '=', $this->shop->id],
                ['is_active', '=', 1],
                ['id', '=', $type]
            ])->first()];
        }
        else{
            $Product = ProductModel::where([
                ['title', 'like', '%'.$keyword.'%'],
                ['is_active', '=', 1],
                ['view', '=', 1],
            ])->get();

            $cate = ProductCategoriesModel::where([
                ['shop_id', '=', $this->shop->id],
                ['is_active', '=', 1]
            ])->get();
        }
        return view('search',[
           'productCate' => $this->productCate->getListingProductCategories(),
           'config'      => $this->config,
           'product'     => $Product,
           'cate'        => $cate,
           'shop'        => $this->shop,
           'postPolicy'  => $this->postPolicy
        ]);
    }
}

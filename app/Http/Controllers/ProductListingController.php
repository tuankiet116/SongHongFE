<?php

namespace App\Http\Controllers;

use App\Models\ProductModel;
use App\Services\ConfigurationsService;
use App\Services\PostsService;
use App\Services\ProductCateService;
use App\Services\ProductsService;
use App\Services\PropertiesService;
use App\Services\ShopsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductListingController extends Controller
{
    private $config;
    private $productCate;
    private $listCategories;
    private $shop;
    private $products;
    private $properties;
    private $postPolicy;

    public function __construct(
        ConfigurationsService $config,
        ProductCateService $cate,
        ShopsService $shop,
        ProductsService $products,
        PropertiesService $properties,
        PostsService $posts
    ) {
        $this->config = $config->getConfig();
        $this->shop = $shop->getShopInfor();
        $this->productCate = $cate;
        $this->listCategories = $this->productCate->getListingProductCategories();
        $this->products = $products;
        $this->properties = $properties;
        $this->postPolicy = $posts->listingPostsByPostType('chinh-sach');
    }

    public function show($id, Request $request)
    {
        if (sizeof($request->query()) > 0 && (!$request->has('page') || sizeof($request->query()) > 1)) {
            $products = $this->products->getProductsSearching($request, 'product_categories_id', $id);
        } else {
            $products = $this->products->getProductsByCategories($id, 'lv0', 30);
        }
        $type = "lv0";
        $categoryInfo = $this->getCategoriesLv0Info($id);
        $currentName = $categoryInfo->name;
        $properties_list = $this->properties->getListPropertiesInArray();

        return view('product-categories')->with([
            'productCate'  => $this->productCate->getListingProductCategories(),
            'config'       => $this->config,
            'current_id'   => $id,
            'current_name' => $currentName,
            'categoryInfo' => $categoryInfo,
            'type'         => $type,
            'products'     => $products,
            'properties'   => $properties_list,
            'oldValue'     => $request->query() ?? array(),
            'shop'         => $this->shop,
            'postPolicy'   => $this->postPolicy
        ]);
    }

    public function showlv1($id, Request $request)
    {
        if (sizeof($request->query()) > 0 && (!$request->has('page') || sizeof($request->query()) > 1)) {
            $products = $this->products->getProductsSearching($request, 'ref_category_lv1_id', $id);
        } else {
            $products = $this->products->getProductsByCategories($id, 'lv1', 30);
        }

        $type = "lv1";
        $product_cate_lv1 = $this->productCate->getDetailProductCategories($id, 1);
        $currentName = $product_cate_lv1->name_sub_category;

        $product_cate_id = $product_cate_lv1->product_categories_id;
        $categoryInfo = $this->getCategoriesLv0Info($product_cate_id);

        $properties_list = $this->properties->getListPropertiesInArray();
        return view('product-categories')->with([
            'current_id'   => $id,
            'current_name' => $currentName,
            'categoryInfo' => $categoryInfo,
            'type'         => $type,
            'products'     => $products,
            'properties'   => $properties_list,
            'oldValue'     => $request->query() ?? array(),
            'shop'         => $this->shop,
            'productCate'  => $this->listCategories,
            'config'       => $this->config,
            'postPolicy'   => $this->postPolicy
        ]);
    }

    public function showlv2($id, Request $request)
    {
        if (sizeof($request->query()) > 0 && (!$request->has('page') || sizeof($request->query()) > 1)) {
            $products = $this->products->getProductsSearching($request, 'ref_category_lv2_id', $id);
        } else {
            $products = $this->products->getProductsByCategories($id, 'lv2', 30);
        }
        $type = "lv2";
        $product_cate_lv2 = $this->productCate->getDetailProductCategories($id, 2);
        $product_cate_id = $this->productCate->getDetailProductCategories($product_cate_lv2->ref_category_lv1_id, 1);

        $currentName = $product_cate_lv2->name_sub_category;
        
        $categoryInfo = $this->getCategoriesLv0Info($product_cate_id->product_categories_id);
        $properties_list = $this->properties->getListPropertiesInArray();
        return view('product-categories')->with([
            'current_id'   => $id,
            'current_name' => $currentName,
            'categoryInfo' => $categoryInfo,
            'type'         => $type,
            'products'     => $products,
            'properties'   => $properties_list,
            'oldValue'     => $request->query() ?? array(),
            'shop'         => $this->shop,
            'productCate'  => $this->listCategories,
            'config'       => $this->config,
            'postPolicy'   => $this->postPolicy
        ]);
    }

    public function getProductByCategories($id)
    {
        $arr = [];
        $product = $this->products->getProductsByCategories($id, 'lv0', 10);

        foreach ($product as $item) {
            array_push($arr, [
                'id'              => $item->id,
                'channel'         => $item->channel,
                'is_active'       => $item->is_active,
                'price'           => $item->price,
                'saleprice'       => $item->saleprice,
                'sku'             => $item->sku,
                'title'           => $item->title,
                'category_id'     => $item->category_id,
                'unit_id'         => $item->unit_id,
                'category_lv1_id' => $item->category_lv1_id,
                'category_lv2_id' => $item->category_lv2_id,
                'avatar'          => $item->avatar,
                'avatar2'         => $item->avatar2,
                'name_cate'       => ProductModel::find($item->id)->product_categories->name
            ]);
        }

        return  response($arr, 200);
    }

    private function getCategoriesLv0Info($id){
        return $this->productCate->getDetailProductCategories($id, 0, array('ref_category_lv1', 'ref_category_lv1.ref_category_lv2'));
    }
}

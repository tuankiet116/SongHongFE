<?php

namespace App\Http\Controllers;

use App\Services\ConfigurationsService;
use App\Services\PostsService;
use App\Services\ProductCateService;
use App\Services\ProductsService;
use App\Services\ShopsService;
use Exception;

class ProductDetailController extends Controller
{
    private $config;
    private $productCate;
    private $shop;
    private $products;
    private $postPolicy;

    public function __construct(ConfigurationsService $config, ProductCateService $cate, ShopsService $shop, ProductsService $products, PostsService $post)
    {
        $this->config = $config;
        $this->productCate = $cate;
        $this->shop = $shop;
        $this->products = $products;
        $this->postPolicy = $post->listingPostsByPostType('chinh-sach');
    }

    public function show($id)
    {
        try {
            $product           = $this->products->getProductDetail($id)->first();
            $productCategories = $this->products->getProductsByCategories($product->product_categories_id, 'lv0',10);
            $cateName          = $this->productCate->getDetailProductCategories($product->product_categories_id)->name??null;

            $variations = array();
            $properties = array();
            $list_properties = array();

            foreach ($product->getRelations()['variations'] as $items) {
                $item = array(
                    'id' => $items->id,
                    'image' => $items->image,
                    'price' => number_format($items->price),
                    'saleprice' => number_format($items->saleprice),
                    'weight' => $items->weight
                );
                $variations[$items->id] = $item;
                $propertyItem = array();
                foreach ($items->getRelations()['product_properties'] as $property) {
                    if (!isset($list_properties[$property->keyname]) || !is_array($list_properties[$property->keyname])) {
                        $list_properties[$property->keyname] = array();
                    }
                    $propertyItem[convert_name($property->keyname)] = $property->value;
                    if(!in_array($property->value, $list_properties[$property->keyname])){
                        array_push($list_properties[$property->keyname],$property->value);
                    }
                }
                $properties[$items->id] =  $propertyItem;
            }
            return view('product-detail')->with(
                [
                    'config'            => $this->config->getConfig(),
                    'productInfor'      => $product,
                    'productCate'       => $productCategories,
                    'cateName'          => $cateName->name??"",
                    'productCategories' => $this->productCate->getListingProductCategories(),
                    'properties'        => json_encode($properties),
                    'variations'        => json_encode($variations),
                    'list_properties'   => $list_properties,
                    'shop'              => $this->shop->getShopInfor(),
                    'postPolicy'        => $this->postPolicy
                ]
            );
        } catch (Exception $e) {
            dd($e);
            abort(500);
        }
    }
}

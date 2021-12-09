<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCategoriesModel;
use App\Models\ConfigurationModel;
use App\Models\ShopModel;
use App\Services\ConfigurationsService;
use App\Services\PostsService;
use App\Services\ProductCateService;
use App\Services\ShopsService;

class CartController extends Controller
{
    private $config;
    private $productCate;
    private $shop;
    private $postPolicy;

    public function __construct(ConfigurationsService $config, ProductCateService $cate, ShopsService $shop, PostsService $post)
    {
        $this->config = $config->getConfig();
        $this->productCate = $cate->getListingProductCategories();
        $this->shop = $shop->getShopInfor();
        $this->postPolicy = $post->listingPostsByPostType('chinh-sach');
    }

    private function returnView(string $name){
        return view($name, [
            'productCate' => $this->productCate,
            'config'      => $this->config,
            'shop'        => $this->shop,
            'postPolicy'  => $this->postPolicy
        ]);
    }
    public function list()
    {
        return $this->returnView('cart');
    }

    public function payment()
    {
        return $this->returnView('payment');
    }
}

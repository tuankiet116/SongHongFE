<?php

namespace App\Http\Controllers;

use App\Services\ConfigurationsService;
use App\Services\PostsService;
use App\Services\ProductCateService;
use App\Services\ProductsService;
use App\Services\ShopsService;
use Exception;

class HomeController extends Controller
{
    private $config;
    private $productCate;
    private $shop;
    private $posts;
    private $products;

    public function __construct(
        ConfigurationsService $config,
        ProductCateService $cate,
        ShopsService $shop,
        PostsService $posts,
        ProductsService $products
    ) {
        $this->config = $config->getConfig();
        $this->productCate = $cate->getListingProductCategoriesWithProductsDetail();
        $this->shop = $shop->getShopInfor();
        $this->posts = $posts;
        $this->products = $products;
    }

    public function show()
    {
        try {
            return view('home')->with([
                'productCate'   => $this->productCate,
                'bestSeller'    => $this->products->getBestSellerProducts(),
                'config'        => $this->config,
                'post'          => $this->posts->listingPostsByPostType('truyen-thong-noi-gi-ve-chung-toi', 4),
                'postnew'       => $this->posts->listingPostsByPostType('tin-tuc', 2),
                'postPolicy'    => $this->posts->listingPostsByPostType('chinh-sach'),
                'shop'          => $this->shop,
                'productSample' => $this->products->getProductSampleHome()
            ]);
        } catch (Exception $e) {
            dd($e);
            abort(500);
        }
    }
}

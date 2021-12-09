<?php

namespace App\Http\Controllers;

use App\Services\ConfigurationsService;
use App\Services\PostsService;
use App\Services\ProductCateService;
use App\Services\ShopsService;
use Exception;

class OrderStatusController extends Controller
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

    public function show()
    {
        try {
            return view('order-status', [
                'productCate' => $this->productCate,
                'config'      => $this->config,
                'shop'        => $this->shop,
                'postPolicy'  => $this->postPolicy
            ]);
        } catch (Exception $e) {
            dd($e);
            abort(500);
        }
    }
}

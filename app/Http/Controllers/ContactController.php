<?php

namespace App\Http\Controllers;

use App\Services\ConfigurationsService;
use App\Services\PostsService;
use App\Services\ProductCateService;
use App\Services\ShopsService;

class ContactController extends Controller
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
        return view('contact')->with([
            'productCate' => $this->productCate,
            'config'      => $this->config,
            'shop'        => $this->shop,
            'postPolicy'  => $this->postPolicy
        ]);
    }
}

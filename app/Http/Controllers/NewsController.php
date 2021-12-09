<?php

namespace App\Http\Controllers;

use App\Services\ConfigurationsService;
use App\Services\PostsService;
use App\Services\PostTypesService;
use App\Services\ProductCateService;
use App\Services\ShopsService;
use Exception;

class NewsController extends Controller
{
    private $posts;
    private $postTypes;
    private $shop;
    private $config;
    private $productCate;

    public function __construct(
        PostsService $post, 
        PostTypesService $postTypes,
        ShopsService $shop,
        ConfigurationsService $config,
        ProductCateService $categories)
    {
        $this->posts = $post;
        $this->postTypes = $postTypes->getPostTypesInfor();
        $this->shop = $shop->getShopInfor();
        $this->config = $config->getConfig();
        $this->productCate = $categories->getListingProductCategories();
    }
    public function list()
    {
        try {
            $Post = $this->posts->listingPosts(10);
            $Post1 = $this->posts->getNewestPost();
            $postTop = $this->posts->listingPosts(5);

            $post_type_title = $this->postTypes->post_type_title;
            $post_type_description = $this->postTypes->post_type_description;
            
            return view('news', [
                'listPost'              => $Post,
                'PostsTop'              => $postTop,
                'productCate'           => $this->productCate,
                'config'                => $this->config,
                'post1'                 => $Post1,
                'post_type_title'       => $post_type_title ?? '',
                'post_type_description' => $post_type_description ?? '',
                'postPolicy'            => $this->posts->listingPostsByPostType('chinh-sach'),
                'shop'                  => $this->shop
            ]);
        } catch (Exception $e) {
            dd($e);
            abort(404);
        }
    }

    public function detail()
    {
        try {
            $post_type_title = $this->postTypes->post_type_title;

            $postInfor = $this->posts->getPostInfor();
            $title = $postInfor->post_title;

            $postTop = $this->posts->listingPosts(5);
            $PostRela = $this->posts->listingPosts(3);
            $postDetail = $this->posts->getPostDetail();
            $this->posts->increaseView();

            return view('news-detail', [
                'title'           => $title,
                'post_type_title' => $post_type_title ?? '',
                'postDetail'      => $postDetail,
                'PostsTop'        => $postTop,
                'productCate'     => $this->productCate,
                'config'          => $this->config,
                'PostRela'        => $PostRela,
                'post'            => $postInfor,
                'postPolicy'      => $this->posts->listingPostsByPostType('chinh-sach'),
                'shop'            => $this->shop
            ]);
        } catch (Exception $e) {
            dd($e);
            abort(404);
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCategoriesModel;
use App\Models\ConfigurationModel;
use App\Models\PostTypeModel;
use App\Models\PostModel;
use App\Models\ShopModel;
use App\Services\ConfigurationsService;
use App\Services\PostsService;
use App\Services\PostTypesService;
use App\Services\ProductCateService;
use App\Services\ShopsService;
use Exception;

class PromotionController extends Controller
{
    private $posts;
    private $postTypes;
    private $shop;
    private $config;
    private $productCate;
    private $postPolicy;

    public function __construct(
        PostsService $post,
        PostTypesService $postTypes,
        ShopsService $shop,
        ConfigurationsService $config,
        ProductCateService $categories
    ) {
        $this->posts = $post;
        $this->postPolicy = $post->listingPostsByPostType('chinh-sach');
        $this->postTypes = $postTypes->getPostTypesInfor();
        $this->shop = $shop->getShopInfor();
        $this->config = $config->getConfig();
        $this->productCate = $categories->getListingProductCategories();
    }

    public function list()
    {
        try {
            $promotionPost = $this->posts->listingPostsByPostType('khuyen-mai', 10);
            return view('promotion', [
                'productCate'   => $this->productCate,
                'config'        => $this->config,
                'promotionPost' => $promotionPost,
                'description'   => $this->postTypes->post_type_description,
                'shop'          => $this->shop,
                'postPolicy'    => $this->postPolicy
            ]);
        } catch (Exception $e) {
            dd($e);
            abort(404);
        }
    }

    public function detail()
    {
        try {
            $postInfor = $this->posts->getPostInfor();
            $this->posts->increaseView();
            $postDetail = $this->posts->getPostDetail();
            $title = $postInfor->post_title;
            $description = $postInfor->post_description;
            $image = $postInfor->post_avatar;
            $post_datetime_create = $postInfor->post_datetime_create;
            $post_datetime_update = $postInfor->post_datetime_update;
            $postFeatured = $this->posts->listingPostsByPostType('khuyen-mai', 5);

            return view('promotion-detail', [
                'productCate'          => $this->productCate,
                'config'               => $this->config,
                'postDetail'           => $postDetail,
                'title'                => $title,
                'description'          => $description,
                'image'                => $image,
                'postFeatured'         => $postFeatured,
                'shop'                 => $this->shop,
                'post_datetime_create' => $post_datetime_create,
                'post_datetime_update' => $post_datetime_update,
                'postPolicy'           => $this->postPolicy
            ]);
        } catch (Exception $e) {
            dd($e);
            abort(404);
        }
    }
}

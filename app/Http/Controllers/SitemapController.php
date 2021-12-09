<?php

namespace App\Http\Controllers;

use App\Models\PostTypeModel;
use App\Models\ProductCategoriesModel;
use App\Models\ProductModel;

class SitemapController extends Controller
{
    public function index()
    {
        //Post News
        $post = PostTypeModel::with('Posts')
        ->where('website_user_id', env('WEB_ID'))
        ->where('post_type_title', 'tin-tuc')
        ->orWhere('post_type_title', 'truyen-thong-noi-gi-ve-chung-toi')
        ->orWhere('post_type_title', 'khuyen-mai')
        ->get();

        //Product-detail
        $productDetail = ProductModel::where('shop_info_id', env('SHOP_ID'))->get();
        //Product Categories
        $productCategories = ProductCategoriesModel::with('ref_category_lv1', 'ref_category_lv1.ref_category_lv2')
        ->where('shop_id', env('SHOP_ID'))->get();

        return response()->view('sitemap.sitemap',[
            'posts' => $post,
            'products' => $productDetail,
            'productCate' => $productCategories
        ])
        ->header('Content-Type', 'text/xml');
    }
}

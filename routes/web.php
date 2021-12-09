<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductDetailController;
use App\Http\Controllers\ProductListingController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrderStatusController;
use App\Http\Controllers\PolicyController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/', [HomeController::class, 'show'])->name('home');
Route::get('/chi-tiet-san-pham/{id?}', [ProductDetailController::class,'show'])->name('product-detail');

Route::get('/tin-tuc', [NewsController::class, 'list'])->name('news.tintuc');
Route::get('/tin-tuc/{rw}', [NewsController::class, 'detail'])->name('news.detail');
Route::get('/khuyen-mai', [PromotionController::class, 'list'])->name('Promotion');
Route::get('/khuyen-mai/{rw}', [PromotionController::class, 'detail'])->name('Promotion.detail');

Route::get('/truyen-thong-noi-gi-ve-chung-toi/{rw}', [NewsController::class, 'detail'])->name('news.social');
Route::get('/truyen-thong-noi-gi-ve-chung-toi', [NewsController::class, 'list'])->name('news.social.listing');

Route::get('/chinh-sach/', [PolicyController::class, 'list'])->name('news.policy.listing');
Route::get('/chinh-sach/{rw}', [PolicyController::class, 'detail'])->name('news.policy');

Route::get('/gio-hang', [CartController::class, 'list'])->name('cart');
Route::post('/thanh-toan', [CartController::class, 'payment'])->name('payment');
Route::post('/tim-kiem', [SearchController::class, 'search'])->name('search');
Route::get('/danh-sach-san-pham', [SearchController::class, 'search'])->name('search.get');

Route::get('/danh-sach-san-pham/{id}', [ProductListingController::class, 'show'])->name('product.listing');
Route::get('/danh-sach-san-pham-lv1/{id}', [ProductListingController::class, 'showlv1'])->name('product.lv1');
Route::get('/danh-sach-san-pham-lv2/{id}', [ProductListingController::class, 'showlv2'])->name('product.lv2');

Route::get('/lien-he', [ContactController::class, 'show'])->name('contact');

Route::get('/api/getProdutByCate/{id}', [ProductListingController::class, 'getProductByCategories']);

Route::get('sitemap.xml', [SitemapController::class, 'index']);

Route::get('/thong-tin-ca-nhan', [ProfileController::class, 'show'])->name('profile');

Route::get('/tra-cuu-don-hang', [OrderStatusController::class, 'show'])->name('orderstatus');

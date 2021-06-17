<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', function (Request $request) {
    return $request->user();
});
//Auth
Route::post('/user/register', "App\Http\Controllers\Auth\AuthController@register");
Route::post('/user/login', "App\Http\Controllers\Auth\AuthController@login");

Route::resource('products', 'App\Http\Controllers\ProductController');
Route::get('featured_products', 'App\Http\Controllers\ProductController@getFeaturesProducts');
Route::resource('banner_ads', 'App\Http\Controllers\BannerAdController');
Route::resource('home_ads', 'App\Http\Controllers\HomeAdController' );

Route::resource('categories', 'App\Http\Controllers\CategoryController');
Route::resource('product_categories', 'App\Http\Controllers\ProductCategoryController');

Route::middleware(["auth:api"])->group(function() {
    Route::get("auth/user", function (){
		return \Illuminate\Support\Facades\Auth::user();
	});
    Route::resource('blog', 'App\Http\Controllers\BlogController');
    Route::resource('carts', 'App\Http\Controllers\CartController')->except(['create', 'show', 'update']);
    Route::post('/carts/{cart}', 'App\Http\Controllers\CartController@addCartItems');
    Route::post('/carts/{cart}/checkout', 'App\Http\Controllers\CartController@checkout');
    Route::resource('cart_items', 'App\Http\Controllers\CartItemController')->except(["index", "show", "create"]);

    Route::resource('wishlists', 'App\Http\Controllers\WishlistController')->except(['create', 'show', 'update']);
    Route::post('/wishlists/{wishlist}', 'App\Http\Controllers\WishlistController@addWishlistItems');
    Route::resource('wishlist_items', 'App\Http\Controllers\WishlistItemController')->except(["index", "show", "create"]);
});
Route::group(['prefix' => 'products'], function() {
    Route::resource('{products}/reviews', 'App\Http\Controllers\ReviewController');
});

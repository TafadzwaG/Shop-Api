<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('users', UserController::class);
    $router->resource('products', ProductController::class);
    $router->resource('product-images', ProductImageController::class);
    $router->resource('reviews', ReviewController::class);
    $router->resource('banner-ads', BannerAdController::class);
    $router->resource('home-ads', HomeAdController::class);
    $router->resource('blogs', BlogController::class);
    $router->resource('categories', CategoryController::class);
    $router->resource('blog-images', BlogImageController::class);
    $router->resource('contacts', ContactController::class);
    $router->resource('product-categories', ProductCategoryController::class);
    
});

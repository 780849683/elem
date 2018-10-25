<?php

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

Route::get('/', function () {
    return view('welcome');
});


//Route::domain("admin.ele.com")->namespace("Admin")->group(function () {
//
//    //商户分类
//    Route::get("shopCate/index", "ShopCategoryController@index")->name("admin.shopCate.index");
//
//
//});


Route::domain("shop.elem.test")->namespace("User")->group(function () {
    //endregion
    //region 用户列表
    Route::get("user/index", "UserController@index")->name("shop.user.index");
    Route::any("user/add", "UserController@add")->name("user.add");
    Route::any("user/login", "UserController@login")->name("shop.user.login");
    //endregion


});


//Route::get("shop.index","ShopController@index")->name("shop.index");
Route::domain("shop.elem.test")->namespace("Shop" )->group(function () {


    //region 店铺首页
    Route::get("shop/index", "ShopController@index")->name("shop.index");
    //endregion
    //region 用户列表
    Route::get("user/index", "UserController@index")->name("shop.user.index");
    Route::any("user/login", "UserController@login")->name("shop.user.login");
    //endregion


});
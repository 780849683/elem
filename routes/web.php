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

// 商户  user
Route::domain("shop.elem.test")->namespace("User")->group(function () {

    //用户登录
    Route::any("user/login", "UserController@login")->name("user.login");
    //用户注册
    Route::any("user/add", "UserController@add")->name("user.add");
   // 退出登录
    Route::any("user/logout", "UserController@logout")->name("user.logout");

});


// 店铺  shop
Route::domain("shop.elem.test")->namespace("Shop" )->group(function () {

    //region 店铺首页
    Route::get("shop/index", "ShopController@index")->name("shop.index");
    //添加店铺
    Route::any("shop/add", "ShopController@add")->name("shop.add");
    //修改店铺
    Route::any("shop/edit/{id}", "ShopController@edit")->name("shop.edit");
});


#管理员 后台 admin
Route::domain("admin.elem.test")->namespace("Admin")->group(function (){

    #管理员注册
    Route::any("admin/reg","AdminController@reg")->name("admin.admin.reg");
    #后台登录
    Route::any("admin/login","AdminController@login")->name("admin.admin.login");
    #添加管理员
//    Route::any("admin/add","AdminController@add")->name("admin.admin.add");
    # 管理员列表
    Route::any("admin/index","AdminController@index")->name("admin.admin.index");
    # 编辑管理员
    Route::any("admin/edit","AdminController@edit")->name("admin.admin.edit");

    #商铺管理  商铺首页
    Route::any("shop/index","ShopController@index")->name("admin.shop.index");

});
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

// 店铺  Shop
Route::domain("shop.elem.test")->namespace("Shop" )->group(function () {
    #----  商  户  ----#
        #商户注册
        Route::any("user/reg","UserController@reg")->name("shop.user.reg");
        #商户登录
        Route::any("user/login","UserController@login")->name("shop.user.login");

    #----  店铺  ----#
        #添加店铺
        Route::any("shop/add", "ShopController@add")->name("shop.shop.add");
        #显示店铺
        Route::any("shop/index", "ShopController@index")->name("shop.shop.index");
        #修改店铺
        Route::any("shop/edit/{id}", "ShopController@edit")->name("shop.edit");

    #----  菜品分类  ----#
        # 分类首页
       Route::any("menucate/index", "MenuCateController@index")->name("shop.menucate.index");

    #----   菜品   ----#
        # 菜品首页
        Route::any("menu/index", "MenuController@index")->name("shop.menu.index");
});


#管理员 后台 Admin
Route::domain("admin.elem.test")->namespace("Admin")->group(function (){
    #----  后台管理员  ----#
        #管理员注册
        Route::any("admin/reg","AdminController@reg")->name("admin.admin.reg");
        #后台登录
        Route::any("admin/login","AdminController@login")->name("admin.admin.login");
        #退出登录
        Route::any("admin/logout","AdminController@logout")->name("admin.admin.logout");
        #添加管理员
         //Route::any("admin/add","AdminController@add")->name("admin.admin.add");
        # 管理员列表
        Route::any("admin/index","AdminController@index")->name("admin.admin.index");
        # 编辑管理员
        Route::any("admin/edit","AdminController@edit")->name("admin.admin.edit");

    #----  店铺管理  ----#
        # 商铺首页
        Route::any("shop/index","ShopController@index")->name("admin.shop.index");
        # 商铺审核
        Route::any("shop/shenh/{id}","ShopController@shenh")->name("admin.shop.shenh");
        # 删除商铺
        Route::any("shop/del/{id}","ShopController@del")->name("admin.shop.del");

    #----  商户管理  ----#
        #  商户首页
        Route::any("user/index","UserController@index")->name("admin.user.index");
        #  删除商户 ----#
        Route::get("user/del/{id}","UserController@del")->name("admin.user.del");

    #----  店铺分类 ----#
        #  分类首页e
        Route::any("shopcate/index","ShopCateController@index")->name("admin.shopcate.index");
        #  添加分类
        Route::any("shopcate/add","ShopCateController@add")->name("admin.shopcate.add");
        #  分类编辑
        Route::any("shopcate/edit/{id}","ShopCateController@edit")->name("admin.shopcate.edit");
        #  分类删除
        Route::any("shopcate/del/{id}","ShopCateController@del")->name("admin.shopcate.del");
        #   分类状态
        Route::any("shopcate/shangxian/{id}","ShopCateController@shangxian")->name("admin.shopcate.shangxian");
        Route::any("shopcate/xiaxian/{id}","ShopCateController@xiaxian")->name("admin.shopcate.xiaxian");

});
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
    return view('index');
});

// 店铺  Shop
Route::domain("shop.elem.test")->namespace("Shop" )->group(function () {
    #---- region 商  户  ----#
        #商户注册
        Route::any("user/reg","UserController@reg")->name("shop.user.reg");
        #商户登录
        Route::any("user/login","UserController@login")->name("shop.user.login");
        Route::any("user/login0","UserController@login0")->name("shop.user.login0");
    # endregion

    #---- region 店铺  ----#
        #添加店铺
        Route::any("shop/add", "ShopController@add")->name("shop.shop.add");
        #显示店铺
        Route::any("shop/index", "ShopController@index")->name("shop.shop.index");
        #修改店铺
        Route::any("shop/edit/{id}", "ShopController@edit")->name("shop.edit");
        #店铺图片
        Route::any("shop/upload","ShopController@upload")->name("shop.shop.upload");
    # endregion

    #---- region  菜品分类  ----#
        # 分类首页
       Route::any("menucate/index", "MenuCateController@index")->name("shop.menucate.index");
       #  添加品种
        Route::any("menucate/add", "MenuCateController@add")->name("shop.menucate.add");
        #  编辑种类
        Route::any("menucate/edit/{id}", "MenuCateController@edit")->name("shop.menucate.edit");
        #   删除种类
        Route::any("menucate/del/{id}", "MenuCateController@del")->name("shop.menucate.del");
    # endregion

    #---- region   菜品   ----#
        # 菜品首页
        Route::any("menu/index", "MenuController@index")->name("shop.menu.index");
        #  添加菜
        Route::any("menu/add", "MenuController@add")->name("shop.menu.add");
        #  修改菜
        Route::any("menu/edit/{id}", "MenuController@edit")->name("shop.menu.edit");
        #   删除菜
        Route::any("menu/del/{id}", "MenuController@del")->name("shop.menu.del");
        #   菜品图片
        Route::any("menu/upload","MenuController@upload")->name("shop.menu.upload");
    # endregion

     #----region   活动activ    ----#
        #  活动首页
        Route::any("activ/index", "ActivController@index")->name("shop.activ.index");
        #   添加活动
        Route::any("activ/add", "ActivController@add")->name("shop.activ.add");
        #   编辑活动
        Route::any("activ/edit/{id}", "ActivController@edit")->name("shop.activ.edit");
        #   删除活动
        Route::any("activ/del{id}", "ActivController@del")->name("shop.activ.del");
    # endregion
});


#管理员 后台 Admin
Route::domain("admin.elem.test")->namespace("Admin")->group(function (){
    #----region  后台管理员  ----#
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
     #endregion

    #----region  店铺管理  ----#
        # 商铺首页
        Route::any("shop/index","ShopController@index")->name("admin.shop.index");
        # 商铺审核
        Route::any("shop/shenh/{id}","ShopController@shenh")->name("admin.shop.shenh");
        # 删除商铺
        Route::any("shop/del/{id}","ShopController@del")->name("admin.shop.del");
        Route::any("shop/xiaxian/{id}","ShopController@xiaxian")->name("admin.shop.xiaxian");
    #endregion

    #----region  商户管理  ----#
        #  商户首页
        Route::any("user/index","UserController@index")->name("admin.user.index");
        #  删除商户 ----#
        Route::get("user/del/{id}","UserController@del")->name("admin.user.del");
    #endregion

    #----region  店铺分类 ----#
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
    #endregion
});
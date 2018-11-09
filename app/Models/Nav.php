<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Nav extends Model
{
    protected $fillable=["name","url","pid","sort"];


    public static function navs1(){
        $admin=\Illuminate\Support\Facades\Auth::guard("admin")->user();
        //dd($admin);
        $navs = self::where("pid", 0)->get();
        //var_dump($navs);
        //判断是否超级管理员
        if ($admin->id==8){
            return $navs;
        }
        //dump($navs->toArray());
        foreach ($navs as $k1 => $v1) {
            //找出第一个儿子
            $child = self::where("pid", $v1->id)->first();
            //dd($child);
            //如果没有儿子，把它父亲干掉
            if ($child == null) {
                unset($navs[$k1]);
            }
            //判断当前所有儿子都没有权限 也应该干掉
            $childs=self::where("pid",$v1->id)->get();

           //dump($childs->toArray());
            //声明一个变量
            $num=0;
            foreach ($childs as $k2=>$v2){
                //判断当前儿子有没有权限
                if ($admin && !$admin->can($v2->url)){
                    $num++;
                }
            }
            if ($num==count($childs)){
                unset($navs[$k1]);
            }
        }
      //  dd($navs);
        return $navs;
    }

}

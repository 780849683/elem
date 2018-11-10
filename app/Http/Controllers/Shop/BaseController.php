<?php

namespace App\Http\Controllers\Shop;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    public function __construct()
    {

        /* $this->middleware("auth:admin",[
             "except"=>["login","reg"]
         ]);*/
        //1.添加中间件 auth:admin
        $this->middleware("auth")->except(["login"]);


    }


}

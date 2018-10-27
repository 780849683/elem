<<<<<<< HEAD
# 10-26
=======


##### 汉化

~~~
1. composer require caouecs/laravel-lang:~3.0 -vvv
2. 复制vendor\caouecs\laravel-lang\src\zh-CN 目录到 resources\lang\zh-CN
3. 设置config\app.php 81行为 'locale' => 'zh-CN',
~~~

##### 安装Debug

~~~
composer require barryvdh/laravel-debugbar -vvv
~~~



##### 数据迁移与建模

~~~
php artisan make:model Models/user -m

执行指定的文件
php artisan migrate --path=/database/xxx
~~~

##### 建立控制器

~~~
    php artisan make:controller UserController
~~~

~~~
<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
      //  1. 找到所有
        $users = User::all();
        // 2. 显示并传递数据
        return view("user.index",compact('users'));
    }
}
~~~

##### 建立模板视图

###### 创建 resources/views/layouts/main.blade.php

~~~
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>@yield("title","首页")</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim 和 Respond.js 是为了让 IE8 支持 HTML5 元素和媒体查询（media queries）功能 -->
    <!-- 警告：通过 file:// 协议（就是直接将 html 页面拖拽到浏览器中）访问页面时 Respond.js 不起作用 -->
    <!--[if lt IE 9]>
    <script src="https://cdn.jsdelivr.net/npm/html5shiv@3.7.3/dist/html5shiv.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/respond.js@1.4.2/dest/respond.min.js"></script>
    <![endif]-->
</head>
<body>

{{--引入头部--}}@include("layouts._header")

{{--引入错误提示--}}@include("layouts._error")

{{--引入消息提示--}}@include("layouts._msg")

<div class="container-fluid">

{{--占位--}}@yield("content")

{{--引入尾部--}}@include("layouts._footer")


</div>

<!-- jQuery (Bootstrap 的所有 JavaScript 插件都依赖 jQuery，所以必须放在前边) -->
<script src="https://cdn.jsdelivr.net/npm/jquery@1.12.4/dist/jquery.min.js"></script>
<!-- 加载 Bootstrap 的所有 JavaScript 插件。你也可以根据需要只加载单个插件。 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"></script>
</body>
</html>
~~~

###### resources/views/layouts/_header.blade.php

```页头
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{route("admin.index")}}">php0620</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="active"><a href="{{route("admin.guanyu")}}">关于我们 <span class="sr-only">(current)</span></a></li>
                <li><a href="#">帮助</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">One more separated link</a></li>
                    </ul>
                </li>
            </ul>
            <form class="navbar-form navbar-left">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search">
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#"></a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
```

###### _footer.blade.php

~~~页脚
<footer class="footer navbar-fixed-bottom ">
    <div class="container">
        <hr>
        <p class="text-center"> Good Good Study,Day Day Up! </p>
    </div>
</footer>
~~~

###### 错误提示 _error.blade.php

~~~
@if(count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach($errors -> all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif
~~~

###### 消息提示 _msg.blade.php

~~~
@foreach (['danger', 'warning', 'success', 'info'] as $msg)
    @if(session()->has($msg))
        <div class="alert alert-{{ $msg }} alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            {{ session()->get($msg) }}
        </div>

    @endif
@endforeach
~~~

###### # 记得住模板中要引入

~~~
# 控制器中返回之前加入这句
session()->flash("success","添加成功");
~~~





#####控制器页面  controller

分页：User::paginate(每页条数);

~~~
public function index()
    {
        //得到所有数据    
        $articles = User::paginate(3);
        //显示视图并传递数据
        return view("user.index", compact("articles"));
    }
~~~

~~~
在 view 中引入：
 {{$articles->links()}}
~~~





##### 创建列表视图

###### resources/views/admin/index.blade.php

~~~
@extends("layouts.main")

@section("content")
    <a href="/admin/add" class="btn btn-info">添加</a>

    <table class="table">
        <tr>
            <th>Id</th>
            <th>username</th>
            <th>password</th>
            <th>操作</th>
        </tr>
        @foreach($admins as $admin)
            <tr>
                <td>{{$admin->id}}</td>
                <td>{{$admin->username}}</td>
                <td>{{$admin->password}}</td>
                <td>
                    <a href="" class="btn btn-success">编辑</a>
                    <a href="" class="btn btn-danger">删除</a>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
~~~

##### 建立路由

~~~
Route::get("/admin/index","AdminController@index")->name('admin.index');
Route::any("/admin/reg","AdminController@reg")->name('admin.reg');
Route::any("/admin/login","AdminController@login")->name('admin.login');
Route::any("/admin/edit/{id}","AdminController@edit")->name('admin.edit');
Route::get("/admin/del/{id}","AdminController@del")->name('admin.del');
~~~

##### 注册时密码加密

~~~
   1.  $data['password'] = bcrypt($data['password']);
   
   2.  $data['password']= Hash::make($data['password']);
  
~~~

##### 验证码

1. 执行 composer require mews/captcha -vvv

2. 配置 php artisan vendor:publish  选择

   ~~~
   Provider: Mews\Captcha\CaptchaServiceProvider
   ~~~

   

3. 前端显示

~~~
<div class="form-group">
            <label  class="col-sm-2 control-label">验证码</label>
            <div class="col-sm-10">
                <input id="captcha" class="form-control" name="captcha" >
                <img class="thumbnail captcha" src="{{captcha_src('flat')}}" onclick="this.src='/captcha/flat?'+Math.random()" title="点击图片重新获取验证码">
            </div>
        </div>
~~~

4. 后端验证

~~~
  $this->validate($request, [
                "name" => "required|unique:users",
                "captcha"=>"required|captcha"
            ]);
~~~

#### 图片上传

1.修改配置文件 config/filesystems.php

~~~
'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
        ],
        'image' => [
            'driver' => 'local',
            'root' => public_path(),//设置public路径
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
        ],

    ],
~~~

2.前端视图 input类型file 提交方式post enctype为form格式

~~~
< form method="post" enctype="multipart/form-data">
<input type="file"> 
</form>
~~~

3.后端处理

~~~
public function add(Request $request)
    {
        //判断POST提交
        if ($request->isMethod("post")) {

            //1.验证
            $this->validate($request, [
                "name" => "required|unique:users",
                "password" => "required|min:6|confirmed",
                "img" => "required",
                "captcha" => "required|captcha"
            ], [
                "captcha.required" => '验证码不能为空',
                "captcha.captcha" => '验证码有误',
            ]);

            //2. 接收数据
            $data=$request->post();
            var_dump($data);
            //3. 上传图片
          /*  $file = $request->file("img");


            $data['logo']=$file->store("images","image");*/
          $data['logo']=$request->file("img")->store("images","image");
            var_dump($data);
            exit;
            //2. 添加
            User::create($data);

            //3. 跳转
            return redirect()->route("user.login")->with("success", "注册成功");


        }
        return view("user.add");
    }
~~~

#### 登录

###### 配置文件

config/auth.php

~~~
<?php

return [

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => \App\Models\User::class,
        ],

        'admins' => [
            'driver' => 'eloquent',
            'model' => \App\Models\Admin::class,
        ],
        // 'users' => [
        //     'driver' => 'database',
        //     'table' => 'users',
        // ],
    ],


    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_resets',
            'expire' => 60,
        ],
    ],

];

~~~

###### 控制器

~~~
 protected function login(Request $request){
        if($request -> isMethod("post")){
            // 验证
            $data = $this -> validate($request,[
                "name" => "required",
                "password" => "required"
            ]);
            //  dd($data);
            // 2. 验证账号密码是否正确
            if(Auth::guard("admin")->attempt($data,$request->has("remember"))){
                // 登录成功
                return redirect()->intended(route("user.index1"))->with("success","登录成功");
            }else{
                // 登录失败
                return redirect()->back()->withInput()->with("danger","账号或密码错误");
            }
        }
        return view("admin.login");

    }
~~~

##### Models

~~~
<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Admin extends Authenticatable{

    use Notifiable;
    public $timestamps = false;
    protected $fillable=["name","password","logo","email","expenditure"];

    protected $hidden = ['password','remember_token'];
}
~~~

##### 视图

~~~
@extends("layouts.main")

@section("content")

    <form class="form-horizontal" method="post">
        {{csrf_field()}}
        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">用户名</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" placeholder="用户名" name="name" value="{{old("name")}}">
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="inputPassword3" placeholder="Password" name="password">
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="remember"> 记住我
                    </label>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">登录</button>
            </div>
        </div>
    </form>

@endsection

~~~



# 附加：

#### 充值：  自增方法

~~~
DB::table("users")->where("id",$id)->increment("money",$data['money']);
~~~

#### 执行指定文件 建表

~~~
php artisan migrate --path=/database/xxx
~~~


>>>>>>> ab1a55328a1cc86be6be700a0226810fd79f9a94

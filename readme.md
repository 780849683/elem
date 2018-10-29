#  10-29  接口开发
### 实现步骤
              
              
              
              
              
              
              
              
              
              
# 10—28 day04 OSS
### 开通阿里云oss
1.登录阿里云网站

2.开通oss(实名认证之后申请半年免费)

3.进入控制器 OSS操作面板

4.新建 bucket 取名 域名 标准存储 公共读

5.执行 命令 安装 ali-oss插件
~~~
composer require jacobcyl/ali-oss-storage -vvv
~~~
6.修改 app/filesystems.php 添加如何代码
~~~
 'cloud' => env('FILESYSTEM_CLOUD', 's3'),

<?php

return [

    ...此处省略N个代码
    'disks' => [

      
       'oss' => [
            'driver'        => 'oss',
            'access_id'     => 'LTAI5ccKNuSmXG1z',//账号
            'access_key'    => 'K4udFHYu1sSkJ9SZsLCvWIOIy5fwAB',//密钥
            'bucket'        => 'ele666',//空间名称
            'endpoint'      => 'oss-cn-beijing.aliyuncs.com', // OSS 外网节点或自定义外部域名

        ],
   
    ],

];
~~~

7.修改.env配置文件   设置文件上传驱动为oss
~~~
FILESYSTEM_DRIVER=oss
ALIYUN_OSS_URL=https://elem666.oss-cn-beijing.aliyuncs.com/
ALIYUNU_ACCESS_ID=LTAI5ccKNuSmXG1z
ALIYUNU_ACCESS_KEY=K4udFHYu1sSkJ9SZsLCvWIOIy5fwAB
ALIYUNU_OSS_BUCKET=ele666
ALIYUNU_OSS_ENDPOINT=oss-cn-beijing.aliyuncs.com

~~~

8. 在改 
~~~

 'cloud' => env('FILESYSTEM_CLOUD', 's3'),

 'oss' => [
                'driver'        => 'oss',
                'access_id'     => env("ALIYUNU_ACCESS_ID"),//账号
                'access_key'    => env("ALIYUNU_ACCESS_KEY"),//密钥
                'bucket'        => env("ALIYUNU_OSS_BUCKET"),//空间名称
                'endpoint'      =>env("ALIYUNU_OSS_ENDPOINT"), // OSS 外网节点或自定义外部域名
    ],
~~~


9.获取图片 及 缩略图
~~~
 <img src="{{env("ALIYUN_OSS_URL").$shop->img}}?x-oss-process=image/resize,m_fill,w_80,h_80">
 ~~~
 
 
 ### webuploader
 
 1.下载https://github.com/fex-team/webuploader/releases/download/0.1.5/webuploader-0.1.5.zip 解压；
 2.解压到：D:\laragon\webuploader ，
 3.复制 webuploader 到 public
 4.分别引用CSS和JS 修改 layouts里main模板
 ~~~
 <!--引入CSS-->
    <link rel="stylesheet" type="text/css" href="/public/webuploader/webuploader.css">
 <body>
        
    ....省略
    <!--引入JS-->
<script type="text/javascript" src="/public/webuploader/webuploader.js"></script>
@yield("js")
</body>
</html>
 ~~~
 
 5.视图中添加
  >>>Html中
 ~~~
 <div class="form-group">
                    <label>图像</label>

                    <input type="hidden" name="logo" value="" id="logo">
                    <!--dom结构部分-->
                    <div id="uploader-demo">
                        <!--用来存放item-->
                        <div id="fileList" class="uploader-list"></div>
                        <div id="filePicker">选择图片</div>
                    </div>


                </div>
 ~~~
 
 >>>Js部分
 ~~~
 
 ~~~

6.创建 路由 和方法 用来上传图片
~~~
# 创建 webuploader 图片上传方法
    public function upload(Request $request){
        //处理上传
        //dd($request->file("file"));
        $file=$request->file("file");
        if ($file){
            //上传
            $url=$file->store("shop");
            /// var_dump($url);
            //得到真实地址  加 http的址
            $url=Storage::url($url);
            $data['url']=$url;
            return $data;
            ///var_dump($url);
        }
    }
~~~
 
 7.最后添加 CSS样式
 ~~~
 #picker {
    display: inline-block;
    line-height: 1.428571429;
    vertical-align: middle;
    margin: 0 12px 0 0;
}
#picker .webuploader-pick {
    padding: 6px 12px;
    display: block;
}


#uploader-demo .thumbnail {
    width: 110px;
    height: 110px;
}
#uploader-demo .thumbnail img {
    width: 100%;
}
.uploader-list {
    width: 100%;
    overflow: hidden;
}
.file-item {
    float: left;
    position: relative;
    margin: 0 20px 20px 0;
    padding: 4px;
}
.file-item .error {
    position: absolute;
    top: 4px;
    left: 4px;
    right: 4px;
    background: red;
    color: white;
    text-align: center;
    height: 20px;
    font-size: 14px;
    line-height: 23px;
}
.file-item .info {
    position: absolute;
    left: 4px;
    bottom: 4px;
    right: 4px;
    height: 20px;
    line-height: 20px;
    text-indent: 5px;
    background: rgba(0, 0, 0, 0.6);
    color: white;
    overflow: hidden;
    white-space: nowrap;
    text-overflow : ellipsis;
    font-size: 12px;
    z-index: 10;
}
.upload-state-done:after {
    content:"\f00c";
    font-family: FontAwesome;
    font-style: normal;
    font-weight: normal;
    line-height: 1;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    font-size: 32px;
    position: absolute;
    bottom: 0;
    right: 4px;
    color: #4cae4c;
    z-index: 99;
}
.file-item .progress {
    position: absolute;
    right: 4px;
    bottom: 4px;
    height: 3px;
    left: 4px;
    height: 4px;
    overflow: hidden;
    z-index: 15;
    margin:0;
    padding: 0;
    border-radius: 0;
    background: transparent;
}
.file-item .progress span {
    display: block;
    overflow: hidden;
    width: 0;
    height: 100%;
    background: #d14 url(../images/progress.png) repeat-x;
    -webit-transition: width 200ms linear;
    -moz-transition: width 200ms linear;
    -o-transition: width 200ms linear;
    -ms-transition: width 200ms linear;
    transition: width 200ms linear;
    -webkit-animation: progressmove 2s linear infinite;
    -moz-animation: progressmove 2s linear infinite;
    -o-animation: progressmove 2s linear infinite;
    -ms-animation: progressmove 2s linear infinite;
    animation: progressmove 2s linear infinite;
    -webkit-transform: translateZ(0);
}
@-webkit-keyframes progressmove {
    0% {
        background-position: 0 0;
    }
    100% {
        background-position: 17px 0;
    }
}
@-moz-keyframes progressmove {
    0% {
        background-position: 0 0;
    }
    100% {
        background-position: 17px 0;
    }
}
@keyframes progressmove {
    0% {
        background-position: 0 0;
    }
    100% {
        background-position: 17px 0;
    }
}

a.travis {
  position: relative;
  top: -4px;
  right: 15px;
}
 ~~~
#picker {
    display: inline-block;
    line-height: 1.428571429;
    vertical-align: middle;
    margin: 0 12px 0 0;
}
#picker .webuploader-pick {
    padding: 6px 12px;
    display: block;
}


#uploader-demo .thumbnail {
    width: 110px;
    height: 110px;
}
#uploader-demo .thumbnail img {
    width: 100%;
}
.uploader-list {
    width: 100%;
    overflow: hidden;
}
.file-item {
    float: left;
    position: relative;
    margin: 0 20px 20px 0;
    padding: 4px;
}
.file-item .error {
    position: absolute;
    top: 4px;
    left: 4px;
    right: 4px;
    background: red;
    color: white;
    text-align: center;
    height: 20px;
    font-size: 14px;
    line-height: 23px;
}
.file-item .info {
    position: absolute;
    left: 4px;
    bottom: 4px;
    right: 4px;
    height: 20px;
    line-height: 20px;
    text-indent: 5px;
    background: rgba(0, 0, 0, 0.6);
    color: white;
    overflow: hidden;
    white-space: nowrap;
    text-overflow : ellipsis;
    font-size: 12px;
    z-index: 10;
}
.upload-state-done:after {
    content:"\f00c";
    font-family: FontAwesome;
    font-style: normal;
    font-weight: normal;
    line-height: 1;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    font-size: 32px;
    position: absolute;
    bottom: 0;
    right: 4px;
    color: #4cae4c;
    z-index: 99;
}
.file-item .progress {
    position: absolute;
    right: 4px;
    bottom: 4px;
    height: 3px;
    left: 4px;
    height: 4px;
    overflow: hidden;
    z-index: 15;
    margin:0;
    padding: 0;
    border-radius: 0;
    background: transparent;
}
.file-item .progress span {
    display: block;
    overflow: hidden;
    width: 0;
    height: 100%;
    background: #d14 url(../images/progress.png) repeat-x;
    -webit-transition: width 200ms linear;
    -moz-transition: width 200ms linear;
    -o-transition: width 200ms linear;
    -ms-transition: width 200ms linear;
    transition: width 200ms linear;
    -webkit-animation: progressmove 2s linear infinite;
    -moz-animation: progressmove 2s linear infinite;
    -o-animation: progressmove 2s linear infinite;
    -ms-animation: progressmove 2s linear infinite;
    animation: progressmove 2s linear infinite;
    -webkit-transform: translateZ(0);
}
@-webkit-keyframes progressmove {
    0% {
        background-position: 0 0;
    }
    100% {
        background-position: 17px 0;
    }
}
@-moz-keyframes progressmove {
    0% {
        background-position: 0 0;
    }
    100% {
        background-position: 17px 0;
    }
}
@keyframes progressmove {
    0% {
        background-position: 0 0;
    }
    100% {
        background-position: 17px 0;
    }
}

a.travis {
  position: relative;
  top: -4px;
  right: 15px;
}



###  ueditor  编辑器

##### 安装
~~~
composer require "overtrue/laravel-ueditor:~1.0"
~~~
 
 ##### 配置
1. 添加下面一行到 config/app.php 中 providers 部分：
 ~~~
 Overtrue\LaravelUEditor\UEditorServiceProvider::class,
 ~~~
 2.发布配置文件与资源
 ~~~
 执行：  php artisan vendor:publish 
 
 完了选择： Overtrue\LaravelUEditor\UEditorServiceProvider'
 ~~~
3.模板引入编辑器
这行的作用是引入编辑器需要的 css,js 等文件，所以你不需要再手动去引入它们。 
~~~
@include('vendor.ueditor.assets')
~~~

4.编辑器的初始化
~~~
<!-- 实例化编辑器 -->
<script type="text/javascript">
    var ue = UE.getEditor('container');
    ue.ready(function() {
        ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
    });
</script>

<!-- 编辑器容器 -->
<script id="container" name="content" type="text/plain"></script>
~~~
 
 
5.4+ 
1.请不要忘记 php artisan storage:link
 2.如果你使用的是 laravel 5.3 以下版本，请先创建软链接：
 ~~~
# 请在项目根目录执行以下命令
$ ln -s `pwd`/storage/app/public `pwd`/public/storage
~~~
在 config/ueditor.php 配置 disk 为 'public' 情况下，上传路径在：public/uploads/ 下，确认该目录存在并可写。
如果要修改上传路径，请在 config/ueditor.php 里各种类型的上传路径，但是都在 public 下。
请在 .env 中正确配置 APP_URL 为你的当前域名，否则可能上传成功了，但是无法正确显示。
七牛支持
如果你想使用七牛云储存，需要进行下面几个简单的操作：

1.安装和配置 laravel-filesystem-qiniu

2.配置 config/ueditor.php 的 disk 为 qiniu:
~~~
'disk' => 'qiniu'
~~~
3.剩下时间打局 LOL，已经完事了。

七牛的 access_key 和 secret_key 可以在这里找到：https://portal.qiniu.com/user/key ,在创建 bucket （空间）的时候，推荐大家都使用公开的空间。

事件
你肯定有一些朋友肯定会有一些比较特殊的场景，那么你可以使用本插件提供的事件来支持：

请按照 Laravel 事件的文档来使用： https://laravel.com/docs/5.4/events#registering-events-and-listeners

上传中事件
Overtrue\LaravelUEditor\Events\Uploading

在保存文件之前，你可以拿到一些信息：

$event->file 这是请求的已经上传的文件对象，Symfony\Component\HttpFoundation\File\UploadedFile 实例。
$event->filename 这是即将存储时用的新文件名
$event->config 上传配置，数组。
你可以在本事件监听器返回值，返回值将替换 $filename 作为存储文件名。

上传完成事件
Overtrue\LaravelUEditor\Events\Uploaded

它有两个属性：

$event->file 与 Uploading 一样，上传的文件

$event->result 上传结构，数组，包含以下信息：
~~~
'state' => 'SUCCESS',
'url' => 'http://xxxxxx.qiniucdn.com/xxx/xxx.jpg',
'title' => '文件名.jpg',
'original' => '上传时的源文件名.jpg',
'type' => 'jpg',
'size' => 17283,
~~~
你可以监听此事件用于一些后续处理任务，比如记录到数据库。 
 
 
 
 
 
 

#  10-27 项目day03

###  菜品 菜品分类

#### 关于调用  belongsTo  hasMany 方法
###### 从属方 menu
~~~

public function menu_cate()
    {
        return $this->belongsTo(MenuCate::class,"cate_id");
    }
~~~
###### 拥有方  menu_cate
~~~
public function menu(){
        return $this->hasMany(Menu::class,"cate_id");
    }
~~~
###### 从属方 menu 调用
conotroller

~~~~
$menus=Menu::      ；//这里不能用  DB：：方法
~~~

view
~~~
{{$menu->menu_cate->name}}
~~~

=======

# 分割-----------


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

@extends("user.layouts.main")
@section("title","用户添加")
@section("content")
    <form class="form-horizontal" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">用户名</label>
            <div class="col-sm-2">
                <input type="text" class="form-control" id="name" placeholder="用户名" name="name" value="{{old("name")}}">
            </div>
        </div>
        <div class="form-group">
            <label for="password" class="col-sm-2 control-label">密码</label>
            <div class="col-sm-2">
                <input type="text" class="form-control" id="password" placeholder="密码" name="password" value="{{old("password")}}">
            </div>
        </div>

        <div class="form-group">
            <label for="password" class="col-sm-2 control-label">邮箱</label>
            <div class="col-sm-2">
                <input type="email" class="form-control" id="email" placeholder="密码" name="email" value="{{old("email")}}">
            </div>
        </div>

        {{--<div class="form-group">--}}
        {{--<label for="logo" class="col-sm-2 control-label">头像</label>--}}
        {{--<div class="col-sm-2">--}}
        {{--<input type="file" class="form-control" id="logo" name="logo" size="35" >--}}
        {{--<input type="file" name="logo" size="35">--}}

        {{--</div>--}}
        {{--</div>--}}

        {{--<div class="form-group">--}}
        {{--<label  class="col-sm-2 control-label">验证码</label>--}}
        {{--<div class="col-sm-2">--}}
        {{--<input id="captcha" class="form-control" name="captcha" >--}}
        {{--<img class="thumbnail captcha" src="{{captcha_src('flat')}}" onclick="this.src='/captcha/flat?'+Math.random()" title="点击图片重新获取验证码">--}}
        {{--</div>--}}
        {{--</div>--}}

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">登录</button>
            </div>
        </div>
    </form>

@endsection
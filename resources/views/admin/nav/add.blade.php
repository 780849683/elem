@extends("admin.layouts.main_admin")
@section("title","添加导航栏")
@section("content")

    <form class="form-horizontal" action="" method="post">
        {{csrf_field()}}

        <div class="form-group">
            <label class="col-sm-2 control-label">导航栏名</label>
            <div class="col-sm-10">
                <input type="text" name="name" class="form-control">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">上级菜单</label>
            <div class="col-sm-10">
                <select name="pid" class="form-control">
                    <option value="0">顶级</option>
                    @foreach($navs as $nav)
                        <option value="{{$nav->id}}">{{$nav->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">地址</label>
            <div class="col-sm-10">
                <select name="url" class="form-control">
                    <option value=""></option>
                    @foreach($urls as $url)
                        <option value="{{$url}}">{{$url}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">添加</button>
            </div>
        </div>

       {{-- <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <INPUT onclick="history.go(-1)" type="button" value="返回" style="background:red ; color:white; height: 35px;width: 45px;font-size: 15px;border-radius: 20px">
            </div>
        </div>--}}
        {{--<INPUT onclick="history.go(-1)" type="button" value="返回" style="background:red ; color:white; height: 45px;width: 90px;font-size: 20px;border-radius: 20px">--}}
    </form>
@endsection
@extends("admin.layouts.main_login")
@section("title","菜品分类修改")
@section("content")
    <form class="form-horizontal" action="" method="post">
        {{csrf_field()}}
        <div class="form-group">
            <label class="col-sm-2 control-label">类别</label>
            <div class="col-sm-10">
                <input type="text" name="name" class="form-control" value="{{$mcate->name}}">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">描述</label>
            <div class="col-sm-10">
                <input type="text" name="desc" class="form-control" value="{{$mcate->desc}}">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">是否默认分类</label>
            <div class="col-sm-10">
                <input type="text" name="is_select" class="form-control" value="{{$mcate->is_select}}">
            </div>
        </div>

        {{--<div class="form-group">
            <label class="col-sm-2 control-label">类别</label>
            <div class="col-sm-10">
                <input type="text" name="password" class="form-control">
            </div>
        </div>--}}
        {{--<div class="form-group">--}}
        {{--<label class="col-sm-2 control-label">Email</label>--}}
        {{--<div class="col-sm-10">--}}
        {{--<input type="text" name="email" class="form-control">--}}
        {{--</div>--}}
        {{--</div>--}}
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">修改</button>
            </div>
        </div>
    </form>
@endsection
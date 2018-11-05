@extends("admin.layouts.main_admin")
@section("title","编辑权限")
@section("content")

    <form class="form-horizontal" action="" method="post">
        {{csrf_field()}}
        <div class="form-group">
            <label class="col-sm-2 control-label">名称</label>
            <div class="col-sm-10">
                <input type="text" name="name" class="form-control" value="{{$pers -> name}}">
            </div>
        </div>

         <div class="form-group">
             <label class="col-sm-2 control-label">说明</label>
             <div class="col-sm-10">
                     <input type="text" name="intro" class="form-control" value="{{$pers -> intro}}">
             </div>
         </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">编辑</button>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <INPUT onclick="history.go(-1)" type="button" value="返回" style="background:red ; color:white; height: 35px;width: 45px;font-size: 15px;border-radius: 20px">
            </div>
        </div>
        {{--<INPUT onclick="history.go(-1)" type="button" value="返回" style="background:red ; color:white; height: 45px;width: 90px;font-size: 20px;border-radius: 20px">--}}
    </form>
@endsection
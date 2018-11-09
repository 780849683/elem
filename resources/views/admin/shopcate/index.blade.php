@extends("admin.layouts.main_admin")
@section("title","店铺分类首页")
@section("content")

    <a href="/shopcate/add" class="btn btn-primary">添加</a>
    <table class="table table-bordered">
        <tr>
            <th>Id</th>
            <th>名称</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
        @foreach($cates as $cate)
            <tr>
                <td>{{$cate->id}}</td>
                <td>{{$cate->name}}</td>
                <td>
                    @if($cate->status)
                        <i class="glyphicon glyphicon-ok" style="color: green"></i>
                    @else
                        <i class="glyphicon glyphicon-remove" style="color: coral"></i>
                @endif
                <td>
                    <a href="/shopcate/edit/{id}" class="btn btn-info" >编辑</a>
                    {{--<a href="{{route('admin.shopcate.del',$shop->id)}}" class="btn btn-danger" onclick="return confirm('删除会一并删除用户,确认吗？')">删除</a>--}}
                    @if($cate->status===0)
                        <a href="{{route('admin.shopcate.shangxian',$cate->id)}}" class="btn btn-success">上线</a>
                    @endif
                    @if($cate->status===1)
                        <a href="{{route('admin.shopcate.xiaxian',$cate->id)}}" class="btn btn-warning ">下线</a>
                    @endif
                    <a href="{{route('admin.shopcate.del',$cate->id)}}" class="btn btn-danger">删除</a>
                </td>
            </tr>
        @endforeach
    </table>
    {{ $cates->appends($url)->links() }}
@endsection
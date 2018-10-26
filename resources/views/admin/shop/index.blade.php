@extends("admin.layouts.main")

@section("content")
    <a href="" class="btn btn-primary">添加</a>
    <table class="table table-bordered">
        <tr>
            <th>Id</th>
            <th>名称</th>
            <th>分类</th>
            <th>LOGO</th>
            <th>状态</th>
            <th>用户名</th>
            <th>操作</th>
        </tr>
        @foreach($shops as $shop)
            <tr>
                <td>{{$shop->id}}</td>
                <td>{{$shop->name}}</td>
                <td>{{$shop->shopCate->name}}</td>
                <td><img src="/{{$shop->img}}" height="30" width="30"></td>
                <td>{{$shop->status}}</td>
                <td>{{$shop->user->name}}</td>
                <td>
                    <a href="" class="btn btn-info">下线</a>
                    {{--<a href="{{route('admin.shop.del',$shop->id)}}" class="btn btn-danger" onclick="return confirm('删除会一并删除用户,确认吗？')">删除</a>--}}
                    {{--@if($shop->status===0)--}}
                        {{--<a href="{{route('admin.shop.changeStatus',$shop->id)}}" class="btn btn-success">通审</a>--}}
                    {{--@endif--}}
                </td>
            </tr>
        @endforeach
    </table>

@endsection
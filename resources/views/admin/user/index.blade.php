@extends("admin.layouts.main_admin")
@section("title","商户首页")
@section("content")
    <table class="table table-bordered">
        <tr>
            <th>Id</th>
            <th>用户名</th>
            <th>邮箱</th>
            <th>店铺名</th>
            <th>店铺类别</th>
            <th>操作</th>
        </tr>
        @foreach($shops as $shop)
            <tr>
                <td>{{$shop->user->id}}</td>
                <td>{{$shop->user->name}}</td>
                <td>{{$shop->user->email}}</td>
                <td>{{$shop->name}}</td>
                <td>{{$shop->shopCate->name}}</td>
                <td>
                    <a href="{{route('admin.user.del',$shop->user->id)}}" class="btn btn-danger">删除</a>
                    {{--<a href="" class="btn btn-info">下线</a>--}}
                    {{--<a href="{{route('admin.shop.del',$shop->id)}}" class="btn btn-danger" onclick="return confirm('删除会一并删除用户,确认吗？')">删除</a>--}}
                    {{--@if($shop->status===0)--}}
                        {{--<a href="{{route('admin.shop.changeStatus',$shop->id)}}" class="btn btn-success">通审</a>--}}
                    {{--@endif--}}
                </td>
            </tr>
        @endforeach
    </table>
    {{ $shops->appends($url)->links() }}
@endsection
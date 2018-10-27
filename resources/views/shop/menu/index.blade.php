@extends("shop.layouts.main")

@section("title","菜品管理")

@section("content")


{{--

    <div  class="col-md-4">
    <a href="{{route("good.add")}}" class="btn btn-info">添加</a>
    </div>
    <div class="col-md-8">
    <form class="form-inline pull-right" method="get">
    <div class="form-group">
    <select name="class_id" class="form-control" >
    <option value="">请选择分类</option>
    @foreach($classgoods as $classgood)
    <option value="{{$classgood->id}}">{{$classgood->class}}</option>
    @endforeach
    </select>
    </div>
    <div class="form-group">
    <input type="text" class="form-control"  placeholder="最低价" size="5" name="minPrice" value="{{old("minPrice")}}" >
    </div>
    -
    <div class="form-group">
    <input type="text" class="form-control"  placeholder="最高价" size="5" name="maxPrice" value="{{old("maxPrice")}}">
    </div>
    <div class="form-group">
    <input type="text" class="form-control"  placeholder="请输入名称" name="keyword" value="{{request()->get("keyword")}}">
    </div>
    <button type="submit" class="btn btn-primary">搜索</button>
    </form>
    </div>
    </div>
--}}


    <table class="table" >
        <tr >
            <th>Id</th>
            <th>商品图片</th>
            <th>菜名</th>
            <th>状态</th>
            <th>价格</th>
            <th>类别</th>
            <th>月销量</th>
            <th>描述</th>
            <th>提示信息</th>
            <th>评分</th>
            <th>评分数量</th>
            <th>满意度数量</th>
            <th>满意度评分</th>

        </tr>
        @foreach($menus as $menu)
            <tr>
                <td>{{$menu->id}}</td>
                <td>{{$menu->img}}</td>
                <td>{{$menu->name}}</td>
                <td>{{$menu->status}}</td>
                <td>{{$menu->price}}</td>
                <td>
                    {{$menu->menu_cate->name}}
                    {{--{{}}--}}
                </td>
                <td>{{$menu->month_sale}}</td>
                <td>{{$menu->descr}}</td>
                <td>{{$menu->tips}}</td>
                <td>{{$menu->rating}}</td>
                <td>{{$menu->rating_count}}</td>
                <td>{{$menu->staisfy_count}}</td>
                <td>{{$menu->staisfy_rate}}</td>
                <td>
                    <a href="" class="btn btn-success glyphicon glyphicon-pencil"></a>
                    {{--<a href="{{route('good.look',$good->id)}}" class="btn btn-warning glyphicon glyphicon-eye-open"></a>--}}
                    {{--<a href="{{route('good.del',$good->id)}}" class="btn btn-danger glyphicon glyphicon-trash"></a>--}}

                </td>
            </tr>
        @endforeach
    </table>
    {{--分页--}}
    {{--{{$goods->appends(array("class_id"=>$classId,"minPrice"=>$minPrice,"maxPrice"=>$maxPrice,"keyword"=>$keyword))->links()}}--}}
    {{--{{ $goods->appends($url)->links() }}--}}

@endsection
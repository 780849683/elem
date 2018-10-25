@extends("shop.layouts.main")

@section("title","商户首页")

@section("content")



    {{--<div  class="col-md-4">--}}
        {{--<a href="{{route("good.add")}}" class="btn btn-info">添加</a>--}}
    {{--</div>--}}
    {{--<div class="col-md-8">--}}
        {{--<form class="form-inline pull-right" method="get">--}}
            {{--<div class="form-group">--}}
                {{--<select name="class_id" class="form-control" >--}}
                    {{--<option value="">请选择分类</option>--}}
                    {{--@foreach($classgoods as $classgood)--}}
                        {{--<option value="{{$classgood->id}}">{{$classgood->class}}</option>--}}
                    {{--@endforeach--}}
                {{--</select>--}}
            {{--</div>--}}
            {{--<div class="form-group">--}}
                {{--<input type="text" class="form-control"  placeholder="最低价" size="5" name="minPrice" value="{{old("minPrice")}}" >--}}
            {{--</div>--}}
            {{-----}}
            {{--<div class="form-group">--}}
                {{--<input type="text" class="form-control"  placeholder="最高价" size="5" name="maxPrice" value="{{old("maxPrice")}}">--}}
            {{--</div>--}}
            {{--<div class="form-group">--}}
                {{--<input type="text" class="form-control"  placeholder="请输入名称" name="keyword" value="{{request()->get("keyword")}}">--}}
            {{--</div>--}}
            {{--<button type="submit" class="btn btn-primary">搜索</button>--}}
        {{--</form>--}}
    {{--</div>--}}
    {{--</div>--}}


    <table class="table" >
        <tr >
            <th>Id</th>
            <th>店铺名称</th>
            <th>所属用户</th>
            <th>店铺图片</th>
            <th>品牌店铺</th>
            <th>是否准时达</th>
            <th>蜂鸟配送</th>
            <th>保</th>
            <th>票</th>
            <th>起送价</th>
            <th>配送费</th>
            <th>公告</th>
            <th>优惠</th>
            <th>状态</th>
            <th>类别</th>
            <th>评分</th>


            {{--<th>操作</th>--}}
        </tr>
        @foreach($shops as $shop)
            <tr>
                <td>{{$shop->id}}</td>
                <td>{{$shop->name}}</td>
                <td>{{$shop->user->name}}</td>
                <td align="" class="first-cell"><span><img src="/{{$shop->img}}" width="100"  height="50" /></span></td>
                <td>@if($shop->brand)
                        <i class="glyphicon glyphicon-ok" style="color: green"></i>
                    @else
                        <i class="glyphicon glyphicon-remove" style="color: red"></i>
                    @endif</td>
                <td> @if($shop->time)
                        <i class="glyphicon glyphicon-ok" style="color: green"></i>
                    @else
                        <i class="glyphicon glyphicon-remove" style="color: red"></i>
                    @endif</td>
                <td> @if($shop->fengniao)
                        <i class="glyphicon glyphicon-ok" style="color: green"></i>
                    @else
                        <i class="glyphicon glyphicon-remove" style="color: red"></i>
                    @endif</td>
                <td> @if($shop->bao)
                        <i class="glyphicon glyphicon-ok" style="color: green"></i>
                    @else
                        <i class="glyphicon glyphicon-remove" style="color: red"></i>
                    @endif</td>
                <td> @if($shop->piao)
                        <i class="glyphicon glyphicon-ok" style="color: green"></i>
                    @else
                        <i class="glyphicon glyphicon-remove" style="color: red"></i>
                    @endif</td>
                <td>{{$shop->start_send}}</td>
                <td>{{$shop->send_cost}}</td>
                <td>{{$shop->notice}}</td>
                <td>{{$shop->discount}}</td>
                <td>  @if($shop->status)
                        <i class="glyphicon glyphicon-ok" style="color: green"></i>
                    @else
                        <i class="glyphicon glyphicon-remove" style="color: red"></i>
                    @endif

                </td>
                <td>{{$shop->shop_cate->name}}</td>
                <td>{{$shop->rating}}</td>

                <td>
                    {{--<a href="{{route('good.edit',$good->id)}}" class="btn btn-success glyphicon glyphicon-pencil"></a>--}}
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
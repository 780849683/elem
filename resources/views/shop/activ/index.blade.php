@extends("shop.layouts.main")

@section("title","店铺活动")

@section("content")



    <div  class="col-md-4">
        <a href="{{route("shop.activ.add")}}" class="btn btn-info">添加</a>
    </div>
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
            <th>活动名称</th>
            <th>活动详情 </th>
            <th>开始时间</th>
            <th>结束时间</th>
            <th>操作</th>
        </tr>
        @foreach($acts as $act)
            <tr>
                <td>{{$act->id}}</td>
                <td>{{$act->title}}</td>
                <td>{{$act->content}}</td>
                <td>{{$act->start_time}}</td>
                <td>{{$act->end_time}}</td>
                {{--<td align="" class="first-cell"><span><img src="/{{$shop->img}}" width="100"  height="50" /></span></td>
                 <td>@if($shop->brand)
                         <i class="glyphicon glyphicon-ok" style="color: green"></i>
                     @else
                         <i class="glyphicon glyphicon-remove" style="color: red"></i>
                     @endif</td>
             {{--<td> @if($shop->time)
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

                <td>{{$shop->notice}}</td>
                <td>{{$shop->discount}}</td>
                <td>  @if($shop->status)
                        <i class="glyphicon glyphicon-ok" style="color: green"></i>
                    @else
                        <i class="glyphicon glyphicon-remove" style="color: red"></i>
                    @endif

                </td>
                <td>{{$shop->Shopcate->name}}</td>
                <td>{{$shop->rating}}</td>--}}

                <td>
                    <a href="{{route('shop.activ.edit',$act->id)}}" class="btn btn-success glyphicon glyphicon-pencil"></a>
                    {{--<a href="{{route('good.look',$good->id)}}" class="btn btn-warning glyphicon glyphicon-eye-open"></a>--}}
                    <a href="{{route('shop.activ.del',$act->id)}}" class="btn btn-danger glyphicon glyphicon-trash"></a>

                </td>
            </tr>
        @endforeach
    </table>
    {{--分页--}}
    {{--{{$goods->appends(array("class_id"=>$classId,"minPrice"=>$minPrice,"maxPrice"=>$maxPrice,"keyword"=>$keyword))->links()}}--}}
    {{--{{ $goods->appends($url)->links() }}--}}

@endsection
@extends("shop.layouts.main")

@section("title","日订单量")

@section("content")
    <style>
        th{width: 100px;}
        td{width: 100px;}
    </style>
    <table class="table table-bordered">

        <tr>
            <th>日期</th>
            <th>菜名</th>
            <th>销量</th>

        </tr>
        @foreach($orderdetails as $orderdetail)
            <tr>
                <td>{{$orderdetail->date}}</td>
                <td>{{$orderdetail->name}}</td>
                <td>{{$orderdetail->sl}}</td>

            </tr>
        @endforeach
       {{-- <tr>
            <td>总计</td>
            <td>{{$cc[0]->num}}</td>
            <td>{{$mm[0]->m}}</td>
        </tr>--}}
    </table>
    {{--<a href="JavaScript:history.back(-1)">点击返回</a>--}}
    <INPUT onclick="history.go(-1)" type="button" value="返回" style="background:red ; color:white; height: 45px;width: 90px;font-size: 20px;border-radius: 20px">
@endsection
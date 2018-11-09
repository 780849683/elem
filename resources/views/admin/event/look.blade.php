@extends("admin.layouts.main_admin")
@section("title","活动详情")
@section("content")

    <style>
        td {
            width: 200px;
        }
        th {
            width: 15px;
        }

    </style>

    <table class="table table-bordered">
        <tr>
            <th>已报名商户</th>
           <td>
            @foreach($eus as $eu)
               {{str_replace(['[',']','"'],'',json_encode(\App\Models\User::where('id',$eu->user_id)->pluck('name'),JSON_UNESCAPED_UNICODE)) }}
                @endforeach
           </td>
        </tr>

        <tr>
            <th>中奖商户</th>
            <td>
               @foreach($eps as $ep)
                   {{str_replace(['[',']','"'],'',json_encode(\App\Models\User::where('id',$ep->user_id)->pluck('name'),JSON_UNESCAPED_UNICODE))}}
                   @endforeach
            </td>
        </tr>
        <tr>
            <th>奖品</th>
            <td>

            </td>
        </tr>

    </table>


    <a href="{{route("admin.event.index")}}" class="btn btn-warning" style="float: left">返回</a>
@endsection
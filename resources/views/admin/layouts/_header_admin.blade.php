<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" style="color: yellow" href="">全球最大点餐平台</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                {{--<li class="active" ><a href="{{route("admin.nav.index")}}"><b style="color: orangered;">管理导航栏</b><span class="sr-only">(current)</span></a></li>--}}

                @foreach(\App\Models\Nav::navs1() as $k1=>$v1)
                <li class="dropdown">
                    <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{$v1->name}} <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        @foreach(\App\Models\Nav::where("pid",$v1->id)->get() as $k2=>$v2)

                           @if(\Illuminate\Support\Facades\Auth::guard("admin")->user()->can($v2->url)||\Illuminate\Support\Facades\Auth::guard("admin")->user()->id==8)
                            <li><a href="{{route($v2->url)}}">{{$v2->name}}</a></li>
                            @endif
                         @endforeach
                    </ul>
                    @endforeach
                {{--</li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">商户管理 <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="/user/index">商户管理</a></li>
                        <li><a href="/shop/index">商铺管理</a></li>
                        <li><a href="/shopcate/index">商铺分类</a></li>
                    </ul>
                </li>--}}
            </ul>
            {{--<form class="navbar-form navbar-left">
                <div class="form-group">
                    --}}{{--<select name="cate_id" class="form-control" >--}}{{--
                        --}}{{--<option value="">请选择分类</option>--}}{{--
                        --}}{{--@foreach($cates as $cate)--}}{{--
                            --}}{{--<option value="{{$cate->id}}">{{$cate->name}}</option>--}}{{--
                        --}}{{--@endforeach--}}{{--
                    </select>
                    <div class="form-group">
                        <input type="text" class="form-control"  placeholder="请输入名称" name="keyword" value="{{request()->get("keyword")}}">
                    </div>
                </div>
                <button type="submit" class="btn btn-default">搜索</button>
            </form>--}}
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{Auth::guard('admin')->user()->name}}<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route("admin.admin.edit")}}">修改密码</a></li>
                        <li><a href="{{ route("admin.admin.logout")}}">注销...</a></li>
                    </ul>
                </li>
                {{--<li class="active"><a href="#">{{Auth::guard("admin")->user()->name}}<span class="sr-only">(current)</span></a></li>--}}
                {{--<li class="active"><a href="{{route("admin.logout")}}">退出登录 <span class="sr-only">(current)</span></a></li>--}}

            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
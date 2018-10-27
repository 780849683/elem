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
            <a class="navbar-brand" href="">php0620</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="active"><a href="">关于我们 <span class="sr-only">(current)</span></a></li>
                <li><a href="#">帮助</a></li>
                <li class="dropdown">
                    {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">后台管理 <span class="caret"></span></a>--}}
                    {{--<ul class="dropdown-menu">--}}
                        {{--<li><a href="#">商户管理</a></li>--}}
                        {{--<li><a href="/shop/index">商铺管理</a></li>--}}
                    {{--</ul>--}}
                </li>
            </ul>
            <form class="navbar-form navbar-left">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search">
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    {{--<a href="{{route("admin.admin.reg")}}" >注册<span class=""></span></a>--}}
                    {{--<ul class="dropdown-menu">--}}
                        {{--<li><a href="{{route("admin.admin.edit")}}">修改密码</a></li>--}}
                        {{--<li><a href="{{ route("admin.admin.logout")}}">注销...</a></li>--}}
                    {{--</ul>--}}
                </li>
                {{--<li class="active"><a href="#">{{Auth::guard("admin")->user()->name}}<span class="sr-only">(current)</span></a></li>--}}
                {{--<li class="active"><a href="{{route("admin.logout")}}">退出登录 <span class="sr-only">(current)</span></a></li>--}}

            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
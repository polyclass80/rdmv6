<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RD Management System -@yield('title')</title>
    <!-- 引入 Bootstrap -->
    <link href="{{asset('static/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('static/css/app.css')}}" rel="stylesheet">
    <link href="{{asset('static/datepicker/css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet" media="screen">

    <!-- jQuery (Bootstrap 的 JavaScript 插件需要引入 jQuery) -->
    <script src="{{asset('static/jquery/jquery.min.js')}}"></script>
    <!-- 包括所有已编译的插件 -->
    <script src="{{asset('static/bootstrap/js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('static/datepicker/js/bootstrap-datetimepicker.js')}}" charset="UTF-8"></script>
{{--    <script src="{{asset('static/jexcel/js/jquery.jexcel.js')}}"></script>
    <script src="{{asset('static/jexcel/js/jquery.jcalendar.js')}}"></script>
    <link rel="stylesheet" href="{{asset('static/jexcel/css/jquery.jexcel.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('static/jexcel/css/jquery.jcalendar.css')}}" type="text/css" />--}}

    <link href="{{asset('static/handsontable/handsontable.full.css')}}" rel="stylesheet">
    <link href="{{asset('static/handsontable/pikaday/pikaday.css')}}" rel="stylesheet">
    <script src="{{asset('static/handsontable/handsontable.full.js')}}"></script>
    <script src="{{asset('static/handsontable/moment/moment.js')}}"></script>
    <script src="{{asset('static/handsontable/pikaday/pikaday.js')}}"></script>


    <style>
        body{background-color: #edeff0}

        .ht_master tr td {
            border: 1px solid #8AC007;
        }

        /* All headers */
        .handsontable th {
            /*background-color: #8AC007;*/
            border: 0.5px solid #8AC007;

        }

        /* Row headers */
        .ht_clone_left th {
            /*background-color: #8AC007;*/
            border: 0.5px solid #8AC007;

        }

        /* Column headers */
        .ht_clone_top th {
            /*background-color: #8AC007;*/
            vertical-align: middle;
            border: 0.5px solid #8AC007;

        }
        .ht_master tr > td {
            border: 0.5px solid #8AC007;
        }

    </style>

    @section('javascript')

    @show

</head>
<body>

@section('navbar')
<div class="container" style="height: 80px;background-color: #34495e; width: 100%; ">

    <div class="container" >
    <ul class="nav navbar-nav" style="margin-top: 15px;">

        <li class=""><span class="" style="font-size: xx-large;color: #ffffff;">Lab Inventory Management</span></li>

    </ul>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="#"><span class="glyphicon glyphicon-user"></span> Yong Wang</a></li>
            <li><a href="#"><span class="glyphicon glyphicon-log-out"></span> Log out</a></li>
        </ul>
      </div>

</div>
@show


<nav class="navbar navbar-default" style="background-color: " role="navigation">
    <div class="container" >
        <div class="navbar-header" style="margin-right: 50px">
            <img src="{{asset('static/img/polyone.jpg')}}" class="">
        </div>
            <ul class="nav navbar-nav">
                @section('nav')
                    <li class="navhome"><a href="{{url('home/index')}}">Home</a></li>
                    <li class="navschedule"><a href="{{url('schedule/index')}}">R&D Schedule</a></li>
                    <li class="navinventory"><a href="{{url('inventory/index')}}">Inventory Management</a></li>
                    <li class="navblock"><a href="{{url('rmblock/index')}}">Block RM</a></li>
                    <li class="navpr"><a href="{{url('rmpr/index')}}">RM PR</a></li>
                @show

            </ul>

        <ul class="nav navbar-nav navbar-right">
            <!-- Authentication Links -->
            @if (Auth::guest())
                <li><a href="{{ url('home/index')}}">Login</a></li>
                <li><a href="{{ route('register') }}">Register</a></li>
            @else
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <a href="{{ route('login') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>
            @endif
        </ul>
    </div>
</nav>


<div class="container" >
    <div class="row">
        @section('leftmenu')
        <div class="col-md-2" style="background-color: ;padding: 0px;width:12%;margin-right: 20px;margin-left: 15px;">

            <div class="list-group">
                <a href="#" class="list-group-item active">查看排单</a>
                <a href="#" class="list-group-item">更新排单</a>
                <a href="#" class="list-group-item">提交新工单</a>
                <a href="#" class="list-group-item">更新原料锁定</a>
            </div>

                <div class="list-group">
                    <span class="list-group-item ">Favorite function</span>
                    <a href="#" class="list-group-item">更新排单</a>
                    <a href="#" class="list-group-item">提交新工单</a>
                    <a href="#" class="list-group-item">更新原料锁定</a>
                </div>

        </div>
        @show


            @section('content')
            <div class="col-md-10" style="background-color: #ffffff;padding: 0px;">



            </div>

            @show


    </div>
</div>



    <div class="row " style="margin-top:px;background-color: ;height: 40px;padding-top: ;color: ;">
        <p class="text-center" >
          R&D Management System<br>
            PolyOne SEM Asia<br>
            Copyright @ 2017
        </p>
    </div>



</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>laravel - 后台</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('layui/css/layui.css')}}">
    <script src="{{asset('layui/layui.js')}}"></script>
    <script src="{{asset('/js/jquery-3.2.1.min.js')}}"></script>

</head>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<body class="layui-layout-body">

<div class="layui-layout layui-layout-admin">
    @section('header')
        <div class="layui-header">
            <div class="layui-logo">laravel - 后台</div>
            <!-- 头部区域（可配合layui已有的水平导航） -->
            <ul class="layui-nav layui-layout-left">
                <li class="layui-nav-item"><a href="">控制台</a></li>
                <li class="layui-nav-item"><a href="">商品管理</a></li>
                <li class="layui-nav-item"><a href="">用户</a></li>
                <li class="layui-nav-item">
                    <a href=" ">其它系统</a>
                    <dl class="layui-nav-child">
                        <dd><a href="">邮件管理</a></dd>
                        <dd><a href="">消息管理</a></dd>
                        <dd><a href="">授权管理</a></dd>
                    </dl>
                </li>
            </ul>
            <ul class="layui-nav layui-layout-right">
                <li class="layui-nav-item">
                    <a href="javascript:;">
                        <img src="http://t.cn/RCzsdCq" class="layui-nav-img">
                        贤心
                    </a>
                    <dl class="layui-nav-child">
                        <dd><a href="">基本资料</a></dd>
                        <dd><a href="">安全设置</a></dd>
                    </dl>
                </li>
                <li class="layui-nav-item"><a href="">退出</a></li>
            </ul>
        </div>
    @show
    <div class="layui-body">
        @section('left')
            <div class="layui-side layui-bg-black">
                <div class="layui-side-scroll">
                    <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
                    <ul class="layui-nav layui-nav-tree"  lay-filter="test">
                        <li class="layui-nav-item">
                            <a href=" ">测评</a>
                            <dl class="layui-nav-child">
                                <dd><a href=""></a></dd>

                            </dl>
                        </li>
                        <li class="layui-nav-item">
                            <a href="javascript:;">商品管理</a>
                            <dl class="layui-nav-child">
                                <dd><a href="/goods">商品添加</a></dd>
                                <dd><a href="/goodslist">商品展示</a></dd>
                            </dl>
                        </li>
                        <li class="layui-nav-item">
                            <a href="javascript:;">商品属性管理</a>
                            <dl class="layui-nav-child">
                                <dd><a href="/attr/basic/add">基本属性</a></dd>
                                <dd><a href="/attr/sale/add">销售属性</a></dd>
                            </dl>
                        </li>
                        <li class="layui-nav-item"><a href=""></a></li>
                    </ul>
                </div>
            </div>
        @show
    </div>

    @section('right')
        <div class="layui-body" style="margin: 40px 0px 0px 40px;">
            <!-- 内容主体区域 -->
            @yield('content')
        </div>
    @show


    <div class="layui-footer">
        <!-- 底部固定区域 -->
        layui.com - 底部固定区域
    </div>
</div>
@section('footer')

@show
<script>
    //JavaScript代码区域
    layui.use('element', function(){
        var element = layui.element;

    });
</script>
</body>
</html>
{{--
@include("public.header")

@include("public.left")

@section('content')
@show
@include("public.footer")--}}

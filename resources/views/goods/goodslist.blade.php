
@extends('layout')

@section('content')
    <div style="width:1350px">
        <script type="text/html" id="toolbarDemo">
            <a class="layui-btn layui-bg-green layui-btn-xs" lay-event="update">修改</a>
            <a class="layui-btn layui-bg-green layui-btn-xs" lay-event="del">删除</a>
        </script>
        <div class="demoTable" style="margin-left:20px;margin-top:30px;">
            <div class="layui-input-inline">
                <input type="text"  placeholder="请输入商品名" autocomplete="off" class="layui-input" id="goods_name">
            </div>
            <button class="layui-btn"  lay-filter="formDemo" id="search">搜索</button>
        </div>
        <table class="layui-hide" id="demo" lay-filter="user"></table>

    <script>
        layui.use(['table','layer'], function(){
            var table = layui.table;
            var layer=layui.layer;
            //方法级渲染
            table.render({
                elem: '#demo'
                ,url:"/admin/goods_list"
                ,page: true //开启分页
                ,limit: 10
                ,limits:[1,3,5,7]
                ,cols: [
                    [
                            {checkbox: true, fixed: true}
                        ,{field:'goods_id', title: 'ID', width:100, sort: true, fixed: true}
                        ,{field:'goods_name', title: '商品名字', width:150}
                        ,{field:'goods_price', title: '商品价格', width:100}
                        ,{field:'goods_up', title: '是否上架', width:100}
                        ,{field:'goods_new', title: '是否新品', width:100}
                        ,{field:'goods_best', title: '是否精品', width:100}
                        ,{field:'goods_hot', title: '是否热卖', width:100}
                        ,{field:'goods_num', title: '库存', width:100}
                        ,{field:'sale_num', title: '已售数量', width:100}
                        ,{field:'cate_id', title: '分类id', width:100}
                        ,{field:'brand_id', title: '品牌id', width:100}
                        ,{field: 'right', title:'操作',align:'center', toolbar: '#toolbarDemo'}
                    ]
                ]
            });
                //监听工具条
                table.on('tool(user)', function (obj) {//注：tool是工具条事件名，test是table原始容器的属性 lay-filter="对应的值"
                    if(obj.event=='del'){
                        var goods_id=obj.data.goods_id;
                        //通过ajax把要删除的id传给控制器
                        $.post(
                                "/admin/goodsDel",
                                {goods_id:goods_id},
                                function (msg) {
                                    if(msg.status==100){
                                        layer.msg(msg.msg);
                                        table.reload('user');
                                    }else{
                                        layer.msg(msg.msg);
                                    }
                                },
                                "json"
                        );
                    }else if(obj.event=='update'){
                        var goods_id=obj.data.goods_id;
                        location.href='/admin/goodsUpdate?goods_id='+goods_id;
                    }
                });
            $('#search').click(function () {
                var goods_name=$('#goods_name').val();
                table.reload('demo',{
                    where:{goods_name:goods_name}
                })
            })
        });
    </script>
    </div>
@endsection
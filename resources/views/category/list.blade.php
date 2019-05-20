@extends('layouts.layout')

@section('title' ) {{$title}} @endsection

@section('content')
    <table class="layui-hidden" id="listTable" lay-filter="listTable"></table>
    <script type="text/html" id="barDemo">
        <div class="layui-btn-container">
            <a class="layui-btn layui-btn-danger layui-btn-lg" lay-event="delete">删除</a>
            <a class="layui-btn layui-btn-lg" lay-event="update">编辑</a>
        </div>
    </script>

@endsection

@section('footer')
    <link rel="stylesheet" href="{{URL::asset('/tree/design/css/layui.css')}}">
    <script src="{{URL::asset('/tree/design/layui.js')}}"></script>
    <script>
        var editObj=null,ptable=null,dltable=null,tableId='listTable',layer=null;
        layui.config({
            base: "{{URL::asset('/tree/design/extend/')}}"
        }).extend({
            treeGrid:'/treeGrid'
        }).use(['jquery','treeGrid','layer'], function() {
            var $ = layui.jquery;
            treeGrid = layui.treeGrid;//很重要
            layer = layui.layer;
            ptable = treeGrid.render({
                id: tableId
                , elem: '#' + tableId
                , height: 500
                , idField: 'cate_id'
                , url: '/category/list'
                , cellMinWidth: 100
                , treeId: 'cate_id'//树形id字段名称
                , treeUpId: 'pid'//树形父id字段名称
                , treeShowName: 'cate_name'//以树形式显示的字段
                , cols: [[
                    {field: 'cate_id', width: 100, title: 'id',align: 'center'}
                    , {field: 'cate_name', width: 200, title: '分类名称'}
                    , {field: 'cate_show', width: 100, title: '是否展示',align: 'center'}
                    , {field: 'cate_navshow', width: 150, title: '是否导航展示',align: 'center'}
                    , {field: 'cate_time', width: 170, title: '添加时间',align: 'center'}

                    ,{
                        width: 200, title: '操作', align: 'center'/*toolbar: '#barDemo'*/
                        , templet: function (d) {
                            var html = '';
                            var addBtn = '<a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="upd">修改</a>';
                            var delBtn = '<a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>';
                            var detailBtn = '<a class="layui-btn layui-btn-green layui-btn-xs" lay-event="detail">查看属性</a>';
                            return addBtn + delBtn + detailBtn;
                        }
                    }
                ]]
                , page: false
            });

            treeGrid.on('tool('+tableId+')',function (obj) {
                var data = obj.data
                    ,layEvent = obj.event; //获得 lay-event 对应的值
                if(obj.event === 'del'){//删除行
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url:'/college/delete/'+data.id,
                        type:'get',
                        datatype:'json',
                        success:function (data) {
                            layer.confirm(data.msg, {
                                btn: ['确定'] //可以无限个按钮
                            }, function(index, layero) {
                                //按钮【按钮一】的回调
                                //表格重载
                                if(data.status == 1000){
                                    obj.del();
                                }
                                layer.close(index);

                            })
                        }
                    });
                }else if(obj.event==="upd"){//添加行
                    location.href='/college/update/'+data.id;
                }
            });
        })
    </script>
@endsection


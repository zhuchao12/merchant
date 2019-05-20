@extends('layouts.layout')

@section('title' ) {{$title}} @endsection

@section('content')
    <form class="layui-form" action="">
        <div class="layui-form-item" style="width: 400px;">
            <label class="layui-form-label">分类名称</label>
            <div class="layui-input-block">
                <input type="text" name="cate_name" lay-verify="required" autocomplete="off" placeholder="请输入分类名称" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">父类</label>
            <div class="layui-input-inline">
                <select name="pid">
                    <option value="0">--请选择--</option>
                    @foreach($data as $k => $v)
                        <option value="{{$v->cate_id}}">{!! str_repeat('&nbsp;&nbsp;' ,$v->level*4) !!}{{$v->cate_name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">是否展示</label>
            <div class="layui-input-block">
                <input type="radio" name="cate_show" value="1" title="是" checked="">
                <input type="radio" name="cate_show" value="0" title="否">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">导航展示</label>
            <div class="layui-input-block">
                <input type="radio" name="cate_navshow" value="1" title="是" checked="">
                <input type="radio" name="cate_navshow" value="0" title="否">
            </div>
        </div>

        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" lay-submit lay-filter="*">立即提交</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
        </div>
    </form>
@endsection

@section('footer')
<script>
    $(function () {
        layui.use( ['form','layer'] , function () {
            var form = layui.form;
            var layer = layui.layer;

            //监听提交
            form.on('submit(*)',function(data){
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url:'/category/add',
                    data:data.field,
                    type:'post',
                    dataType:'json',
                    success:function (data) {
                        layer.confirm(data.msg, {
                            btn: ['确定'] //可以无限个按钮
                        }, function(index, layero) {
                            //按钮【按钮一】的回调
                            if(data.status == 1000){
                                location.href='/category/list'
                            }
                            layer.close(index);

                        })
                    }
                });
                return false;
            })
        })
    })
</script>
@endsection
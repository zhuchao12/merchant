@extends('layout')

@section('title' ) {{$title}} @endsection

@section('content')
    <fieldset class="layui-elem-field layui-field-title">
        <legend>商品的销售属性</legend>
    </fieldset>
    <form class="layui-form">
        <div class="layui-form-item">
            <label class="layui-form-label">请选择分类</label>
            <div class="layui-input-inline">
                <select name="category_id"  lay-verify="required" >
                    <option value="">请选择</option>
                    @foreach($data as $k => $v)
                        @if($v->level == 2 )
                            <option value="{{$v->cate_id}}">{!! str_repeat('&nbsp;&nbsp;' ,$v->level*4) !!}{{$v->cate_name}}</option>
                        @else
                            <option value="{{$v->cate_id}}" disabled>{!! str_repeat('&nbsp;&nbsp;' ,$v->level*4) !!}{{$v->cate_name}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="layui-btn-group">
                <button class="layui-btn layui-btn-danger attrAdd"  type="button"> <i class="layui-icon"></i></button>
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

                var attr = '<div class="layui-form-item left">'+
                    '<label class="layui-form-label">属性名</label>'+
                    '<div class="layui-input-inline">'+
                    '<input type="text" name="attr[]" len="0" lay-verify="required"'+
                    'placeholder="请输入属性名"   autocomplete="off" class="layui-input">'+
                    '</div><div class="layui-btn-group">' +
                    '<button class="layui-btn layui-btn-warm attrdel" type="button">' +
                    '<i class="layui-icon">&#xe640;</i></button>'+
                    '<button class="layui-btn layui-btn-warm valueadd"  type="button"> ' +
                    '<i class="layui-icon"></i></button>'+
                    '</div></div>';

                var value = '<div class="layui-form-item valueleft">'+
                    '<label class="layui-form-label">属性值</label>'+
                    '<div class="layui-input-inline">'+
                    '<input type="text" name="value[]" lay-verify="required"'+
                    'placeholder="请输入属性值"   autocomplete="off" class="layui-input">'+
                    '</div><div class="layui-btn-group">' +
                    '<button class="layui-btn layui-btn-primary valuedel" type="button">' +
                    '<i class="layui-icon"></i></button>'+
                    '</div></div>';

                $('.attrAdd').click(function () {
                    $(this).parents('.layui-form-item').after(attr);
                    var len = $(this).parents('.layui-form').find('.left').length;
                    $(this).parents('.layui-form').find('.left').first().find('input').first().attr('name' , 'attr['+len+']' );
                    $(this).parents('.layui-form').find('.left').first().find('input').first().attr('len' , len );
                });

                $(document).on(  'click' , '.attrdel' , function(){
                    // 找到对应的属性值value 删除
                    while( $(this).parents('.layui-form-item').next().attr('class') == 'layui-form-item valueleft' ){
                        $(this).parents('.layui-form-item').next().remove();
                    }
                    $(this).parents('.layui-form-item').remove();
                });

                $(document).on(  'click' , '.valuedel' , function(){
                    $(this).parents('.layui-form-item').remove();
                });

                $(document).on(  'click' , '.valueadd' , function(){
                    $(this).parents('.layui-form-item').after(value);
                    var this_len = $(this).parents('.layui-form-item').find('input').attr('len');
                    $(this).parents('.layui-form-item').next().find('input').attr('name' , 'value['+this_len+'][]' );
                });

                //监听提交
                form.on('submit(*)',function(data){
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url:'/attr/sale/add',
                        data:data.field,
                        type:'post',
                        dataType:'json',
                        success:function (data) {
                            layer.confirm(data.msg, {
                                btn: ['确定'] //可以无限个按钮
                            }, function(index, layero) {
                                //按钮【按钮一】的回调
                                if(data.status == 1000){
                                    location.href='/'
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
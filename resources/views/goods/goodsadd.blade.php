@extends('layout')

@section('content')
<form class="layui-form" lay-filter="goods">
    <div class="layui-tab layui-tab-brief" lay-filter="docDemoTabBrief">
        <ul class="layui-tab-title">
            <li class="layui-this">基本信息</li>
            <li>商品基本属性</li>
            <li>商品销售属性</li>
        </ul>
        <div class="layui-tab-content" style="height: 100px;">
            <!--基本信息START-->
            <div class="layui-tab-item layui-show" >
                <div class="layui-form-item">
                    <label class="layui-form-label">商品名称</label>
                    <div class="layui-input-inline">
                        <input type="text" name="goods_name" lay-verify="required" autocomplete="off" placeholder="请输入标题" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">品牌</label>
                    <div class="layui-input-inline">
                        <select name="brand_id" lay-verify="required">
                            <option value="">--请选择--</option>
                            @foreach($brand as $k=>$v)
                            <option value="{{$v['brand_id']}}">{{$v['brand_name']}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">分类</label>
                    <div class="layui-input-inline">
                        <select name="cate_id" lay-filter="category" lay-verify="required">
                            <option value="">--请选择--</option>
                            @foreach($cate as $k=>$v)
                            <option value="{{$v['cate_id']}}">{!! str_repeat('&nbsp;&nbsp;' ,$v['level']*2) !!}{{$v['cate_name']}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-inline">
                        <label class="layui-form-label">商品本店价格</label>
                        <div class="layui-input-inline">
                            <input type="text" name="goods_selfprice" lay-verify="required|number" autocomplete="off" class="layui-input">
                        </div>
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-inline">
                        <label class="layui-form-label">商品市场价格</label>
                        <div class="layui-input-inline">
                            <input type="text" name="goods_marketprice" lay-verify="required|number" autocomplete="off" class="layui-input">
                        </div>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">是否上架</label>
                    <div class="layui-input-block">
                        <input type="radio" name="goods_up" value="1" title="是" checked="">
                        <input type="radio" name="goods_up" value="0" title="否">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">是否新品</label>
                    <div class="layui-input-block">
                        <input type="radio" name="goods_new" value="1" title="是" checked="">
                        <input type="radio" name="goods_new" value="0" title="否">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">是否精品</label>
                    <div class="layui-input-block">
                        <input type="radio" name="goods_best" checked value="1" title="是">
                        <input type="radio" name="goods_best" value="0" title="否">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">是否热卖</label>
                    <div class="layui-input-block">
                        <input type="radio" name="goods_hot" checked value="1" title="是">
                        <input type="radio" name="goods_hot" value="0" title="否">
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-inline">
                        <label class="layui-form-label">商品库存</label>
                        <div class="layui-input-inline">
                            <input type="number" name="goods_stock" lay-verify="required|number" autocomplete="off" class="layui-input">
                        </div>
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-inline">
                        <label class="layui-form-label">商品积分</label>
                        <div class="layui-input-inline">
                            <input type="text" name="goods_score" lay-verify="required" autocomplete="off" class="layui-input">
                        </div>
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-inline">
                        <input type="hidden" id="mylogo" name="goods_goods_img">
                        <label class="layui-form-label">商品图片</label>
                        <button type="button" class="layui-btn" id="myload">
                            <i class="layui-icon">&#xe67c;</i>上传图片
                        </button>
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-inline">
                        <input type="hidden" id="big_img" name="goods_big_imgs">
                        <input type="hidden" id="mid_img" name="goods_mid_imgs">
                        <input type="hidden" id="small_img" name="goods_small_imgs">
                        <label class="layui-form-label">轮播图</label>
                        <button type="button" class="layui-btn" id="myloads">
                            <i class="layui-icon">&#xe67c;</i>上传图片
                        </button>
                    </div>
                </div>
                <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">编辑器</label>
                    <div class="layui-input-block">
                        <textarea id="demo" name="desc" style="display: none;">小米8好用不贵</textarea>
                        <script>
                            var layedit;
                            var index;
                            layui.use('layedit', function(){
                                layedit = layui.layedit;

                                layedit.set({
                                    uploadImage: {
                                        url: '{:url("Goods/goodsUpLoad",[\'type\' => 3])}' //接口url
                                        ,type: 'post' //默认post
                                    }
                                });

                                index = layedit.build('demo',{
                                    height: 180 //设置编辑器高度
//                      ,tool: ['left', 'center', 'right', '|', 'face']
                                }); //建立编辑器
                            });
                        </script>
                    </div>
                </div>


            </div>
            <!--基本信息END-->

            <!-- 基本属性START -->
            <div class="layui-tab-item" id="basic">
                <span style="color: red">请先选择分类</span>
            </div>

            <!-- 基本属性START -->

            <!-- 销售属性START -->
            <div class="layui-tab-item" id="sale">
                <span style="color: red">请先选择分类</span>
            </div>
            <!-- 销售属性END -->

            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="layui-btn" lay-submit lay-filter="*">立即提交</button>
                    <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@section('footer')
<script>
    var form;
    $(function(){
        layui.use(['form', 'layer','upload'], function(){
            form = layui.form;
            var  layer = layui.layer;
            var upload=layui.upload;
            //文件上传
            //商品图上传
            upload.render({
                elem: '#myload' //绑定元素
                ,url: '{:url("Goods/goodsUpLoad")}?type=1' //上传接口
                ,done: function(res){
                    console.log(res);
                    //上传完毕回调
                    layer.msg(res.font,{icon:res.code});
                    if(res.code==1){
                        $('#mylogo').val(res.src);
                    }
                }
                ,accept: 'images'
                ,size: 1000
                ,error: function(){
                    //请求异常回调
                }
            });

            upload.render({
                elem: '#myloads' //绑定元素
                ,url: '{:url("Goods/goodsUpLoad")}?type=2' //上传接口
                ,multiple:true
                ,number:3
                ,done: function(res){
                    //上传完毕回调
                    layer.msg(res.font,{icon:res.code});
                    if(res.code==1){
                        //拼接大图
                        var goods_big=$('#big_img').val();
                        goods_big=goods_big+res.src.goods_big+'|';
                        $('#big_img').val(goods_big);

                        //拼接中图
                        var goods_mid=$('#mid_img').val();
                        goods_mid=goods_mid+res.src.goods_mid+'|';
                        $('#mid_img').val(goods_mid);

                        //拼接小图
                        var goods_small=$('#small_img').val();
                        goods_small=goods_small+res.src.goods_small+'|';
                        $('#small_img').val(goods_small);
                    }
                }
                ,accept: 'images'
                ,size: 1000
                ,error: function(){
                    //请求异常回调
                }
            });
            //监听提交
            form.on('submit(*)', function(data){

//                var content
                data.field.goods_content = layedit.getContent(index);

                $.post(
                        '{:url("Goods/goodsAdd")}',
                        data.field,
                        function(msg){
                            console.log(msg);
                            layer.msg(msg.font,{icon:msg.code});
                        },'json'
                )
                return false;
            });

            //表单初始赋值
            form.val('goods', {
                "goods_name": "小米8" // "name": "value"
                ,"brand_id":4
                ,"goods_selfprice": 2999.99
                ,"goods_marketprice": 3099.99 //复选框选中状态
                ,"goods_stock":10
                ,"goods_score":100


            });

            form.on('select(category)', function(data){
//                console.log(data.elem); //得到select原始DOM对象
                var category_id = data.value; //得到被选中的值
//                console.log(data.othis); //得到美化后的DOM对象
                $.ajax({
                    url:'/attr/basic/show',
                    data:'category_id='+category_id,
                    type:'post',
                    success:function( html_info ){
                        $('#basic').html(html_info);
                        form.render();
                    }
                });
                $.ajax({
                    url:'/attr/sale/show',
                    data:'category_id='+category_id,
                    type:'post',
                    success:function( html_info ){
                        $('#sale').html(html_info);
                        form.render();
                    }
                })
            });
        });
    })




    //    $('[name="cate_id"]').change(function(){
    //        alert(1);
    //    })

    //    function choseCategory(){
    //        alert(1);
    //    }

</script>
@endsection

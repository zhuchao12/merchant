<form class="layui-form">
    <input type="hidden" value="{$good.goods_id}" name="goods_id">
    <div class="layui-form-item">
        <label class="layui-form-label">商品名称</label>
        <div class="layui-input-block">
            <input type="text" name="goods_name" value="{$good.goods_name}" lay-verify="required" autocomplete="off" placeholder="请输入标题" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-inline">
            <label class="layui-form-label">商品本店价格</label>
            <div class="layui-input-inline">
                <input type="text" name="goods_selfprice"  value="{$good.goods_selfprice}" lay-verify="required|number" autocomplete="off" class="layui-input">
            </div>
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-inline">
            <label class="layui-form-label">商品市场价格</label>
            <div class="layui-input-inline">
                <input type="text" name="goods_marketprice" value="{$good.goods_marketprice}" lay-verify="required|number" autocomplete="off" class="layui-input">
            </div>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">是否上架</label>
        <div class="layui-input-block">
            {if condition="$good.goods_up==1"}
            <input type="radio" name="goods_up" value="1" title="是" checked>
            <input type="radio" name="goods_up" value="0" title="否">
           {else/}
            <input type="radio" name="goods_up" value="1" title="是">
            <input type="radio" name="goods_up" value="0" title="否"  checked>
            {/if}
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">是否新品</label>
        <div class="layui-input-block">
            {if condition="$good.goods_new==1"}
            <input type="radio" name="goods_new" value="1" title="是" checked>
            <input type="radio" name="goods_new" value="0" title="否">
            {else/}
            <input type="radio" name="goods_new" value="1" title="是">
            <input type="radio" name="goods_new" value="0" title="否" checked>
            {/if}
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">是否精品</label>
        <div class="layui-input-block">
            {if condition="$good.goods_best==1"}
            <input type="radio" name="goods_best" value="1" title="是" checked>
            <input type="radio" name="goods_best" value="0" title="否">
            {else/}
            <input type="radio" name="goods_best" value="1" title="是">
            <input type="radio" name="goods_best" value="0" title="否" checked>
            {/if}
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">是否热卖</label>
        <div class="layui-input-block">
            {if condition="$good.goods_hot==1"}
            <input type="radio" name="goods_hot" value="1" title="是" checked>
            <input type="radio" name="goods_hot" value="0" title="否">
            {else/}
            <input type="radio" name="goods_hot" value="1" title="是">
            <input type="radio" name="goods_hot" value="0" title="否" checked>
            {/if}
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-inline">
            <label class="layui-form-label">商品库存</label>
            <div class="layui-input-inline">
                <input type="number" name="goods_num" value="{$good.goods_num}" lay-verify="required|number" autocomplete="off" class="layui-input">
            </div>
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-inline">
            <label class="layui-form-label">商品积分</label>
            <div class="layui-input-inline">
                <input type="text" name="goods_score" value="{$good.goods_score}" lay-verify="required" autocomplete="off" class="layui-input">
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
    <div class="layui-form-item">
        <label class="layui-form-label">品牌</label>
        <div class="layui-input-inline">
            <select name="brand_id" lay-verify="required">
                {volist name='brand' id='v'}
                <option value="{$v.brand_id}">{$v.brand_name}</option>
                {/volist}
            </select>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">分类</label>
        <div class="layui-input-inline">
            <select name="cate_id" lay-verify="required">
                {volist name='cate' id='v'}
                <option value="{$v.cate_id}">{:str_repeat('&nbsp;&nbsp;',$v.level*2)}{$v.cate_name}</option>
                {/volist}
            </select>
        </div>
    </div>
    <!--<div class="layui-form-item layui-form-text">
      <label class="layui-form-label">编辑器</label>
      <div class="layui-input-block">
        <textarea class="layui-textarea layui-hide" name="content" lay-verify="content" id="LAY_demo_editor"></textarea>
      </div>
    </div>-->
    <div class="layui-form-item">
        <div class="layui-input-block">
            <button class="layui-btn" lay-submit lay-filter="*">立即提交</button>
            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
        </div>
    </div>
</form>
<!-- 注意：如果你直接复制所有代码到本地，上述js路径需要改成你本地的 -->
<script>
    $(function(){
        layui.use(['form', 'layer','upload'], function(){
            var form = layui.form;
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
                ,size: 100
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
                $.post(
                        '{:url("Goods/goodsUpdateDo")}',
                        data.field,
                        function(msg){
                            console.log(msg);
                            layer.msg(msg.font,{icon:msg.code});
                            if(msg.code==1){

                            }
                        },'json'
                )
                return false;
            });

        });
    })

</script>

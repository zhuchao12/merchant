<div>
    <form class="layui-form">
        品牌:
        <div class="layui-input-inline">
            <select name="brand_name" lay-verify="required">
                <option value="0">--请选择--</option>
                {volist name='brand' id='v'}
                <option value="{$v.brand_name}">{$v.brand_name}</option>
                {/volist}
            </select>
        </div>
        分类:
        <div class="layui-input-inline">
            <select name="cate_name" lay-verify="required">
                <option value="0">--请选择--</option>
                {volist name='data' id='v'}
                <option value="{$v.cate_name}">{:str_repeat('&nbsp;&nbsp;',$v.level*2)}{$v.cate_name}</option>
                {/volist}
            </select>
        </div>
        <div class="layui-input-inline">
            <input type="text" name="goods_name" placeholder="商品名称" class="layui-input">
        </div>
            <button class="layui-btn" lay-submit lay-filter="*">搜索</button>
    </form>
</div>
<table class="layui-hide" id="test"  lay-filter="test"></table>
<script type="text/html" id="barDemo">
    <a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
</script>
<script>
    layui.use(['table','form','layer'],function(){
        var table = layui.table;
        var form = layui.form;
        var layer = layui.layer;
        var tableIns=table.render({
            elem: '#test'
            ,url:'{:url("Goods/goodsInfo")}'
            ,cellMinWidth: 80 //全局定义常规单元格的最小宽度，layui 2.2.1 新增
            ,limit:3
            ,cols: [[
                {field:'goods_id', width:50, title: 'ID', sort: true}
                ,{field:'goods_name', width:80, title: '商品名称'}
                ,{field:'goods_selfprice', width:80, title: '商品本店价格',edit: 'text'}
                ,{field:'goods_marketprice', width:80, title: '商品市场价格'}
                ,{field:'goods_up', title: '是否上架', width: 80, edit: 'text'} //minWidth：局部定义当前单元格的最小宽度，layui 2.2.1 新增
                ,{field:'goods_new', title: '是否为新品',width: 80, edit: 'text'}
                ,{field:'goods_best', title: '是否为精品',width: 80, edit: 'text'}
                ,{field:'goods_hot', title: '是否为热卖品',width:80, edit: 'text'}
                ,{field:'goods_num', title: '商品库存',width:80, edit: 'text'}
                ,{field:'goods_score', title: '商品积分',width:80, edit: 'text'}
                ,{field:'cate_name', title: '分类',width:100}
                ,{field:'brand_name', title: '品牌',width:85}
                ,{fixed: 'right', title:'操作', toolbar: '#barDemo', width:150}
            ]]
            ,page:true
        });

        var where;
        form.on('submit(*)',function(data){
            tableIns.reload({
                where:data.field
            });
            return false;
        });
        //监听单元格编辑
        table.on('edit(test)', function(obj){
            var value = obj.value //得到修改后的值
                    ,data = obj.data //得到所在行所有键值
                    ,field = obj.field; //得到字段
            var res;
            if(value=='×'){
                res=0;
            }else if(value=='√'){
                res=1;
            }else{
                res=value;
            }
            $.post(
                    '{:url("Goods/goodsUpdate")}',
                    {value:res,goods_id:data.goods_id,field:field},
                    function(msg){
                        layer.msg(msg.font,{icon: msg.code});
                    },'json'
            )
        });
        //监听工具条
        table.on('tool(test)', function(obj){ //注：tool是工具条事件名，test是table原始容器的属性 lay-filter="对应的值"
            var data = obj.data; //获得当前行数据
            var layEvent = obj.event; //获得 lay-event 对应的值（也可以是表头的 event 参数对应的值）
            var tr = obj.tr; //获得当前行 tr 的DOM对象

            if(layEvent === 'edit'){ //查看
                location.href="{:url('Goods/goodsUpdateInfo')}?goods_id="+data.goods_id
            } else if(layEvent === 'del') { //删除
                layer.confirm('真的删除行么', function (index) {
                    $.post(
                            '{:url("Goods/goodsDel")}',
                            {goods_id:data.goods_id},
                            function(msg){
                                layer.msg(msg.font,{icon:msg.code});
                                if(msg.code==1){
                                    tableIns.reload({
                                        where:where
                                    });
                                }
                            },'json'
                    )

                });
            }
        });
    });
</script>

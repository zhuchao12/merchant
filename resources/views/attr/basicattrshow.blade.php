
    @foreach($basic as $k=>$v)
        <div class="layui-form-item">
            <label class="layui-form-label">{{$v['attr_name']}}</label>
            <div class="layui-input-inline">
                @if($v['has_son']==1)
                    <select name="basic[{$v.attr_id}]"  lay-verify="required" >
                        <option value="">请选择</option>
                        @foreach($v['son'] as $kk=>$vv)
                            <option value="{{$vv}}">{{$vv}}</option>
                        @endforeach
                    </select>
                @else
                    <input type="text" name="basic[{$v.attr_id}]" lay-verify="required" autocomplete="off"
                           placeholder="请输入标题" class="layui-input">
                @endif
            </div>
        </div>
    @endforeach



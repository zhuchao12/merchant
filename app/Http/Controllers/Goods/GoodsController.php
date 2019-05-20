<?php

namespace App\Http\Controllers\Goods;

use App\Model\BrandModel;
use App\Model\CateModel;
use App\Model\GoodsModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GoodsController extends Controller
{








































































































    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 商品视图层
     * （柴千千）
     */
    public function goodsList(){
        return view('goods.goodsList');
    }

    /**
     * 商品展示
     */
    public function goods_list(Request $request){
        $limit=$request->input("limit");
        $page=$request->input("page");
        $goods_name=$request->input('goods_name');
//        var_dump($goods_name);
        if(empty($goods_name)){
            $data=GoodsModel::where(['status'=>1])->offset(($page-1)*$limit)->limit($limit)->get();
        }else{
            $data=GoodsModel::where(['goods_name'=>$goods_name])->offset(($page-1)*$limit)->limit($limit)->get();
        }
//        var_dump($data);exit;
        foreach($data as $k=>$v){
            //品牌名字
            $arr=BrandModel::where(['brand_id'=>$data[$k]['brand_id']])->first();
            $data[$k]['brand_id']=$arr['brand_name'];
            //分类名字
            $res=CateModel::where(['cate_id'=>$data[$k]['cate_id']])->first();
            $data[$k]['cate_id']=$res['cate_name'];
            //是否上架
            if($v['goods_up']==1){
                $v['goods_up']='是';
            }else{
                $v['goods_up']='否';
            }
            //是否新品
            if($v['goods_new']==1){
                $v['goods_new']='是';
            }else{
                $v['goods_new']='否';
            }
            //是否精品
            if($v['goods_best']==1){
                $v['goods_best']='是';
            }else{
                $v['goods_best']='否';
            }
            //是否热卖
            if($v['goods_hot']==1){
                $v['goods_hot']='是';
            }else{
                $v['goods_hot']='否';
            }
            //转换时间戳
            $data[$k]['create_time']=date('Y-m-d H:i:s',$v['create_time']);
        }
        $data=$data->toArray();
        $count=GoodsModel::where(['status'=>1])->count();
        $info=[
            'code'=>0,
            'msg'=>'',
            'count'=>$count,
            'data'=>$data,
            'status'=>1000
        ];
        return json_encode($info);
    }
}

<?php

namespace App\Http\Controllers\Goods;

use App\Model\BrandModel;
use App\Model\CategoryModel;
use App\Model\GoodsModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GoodsController extends Controller
{
    //
    public function add(){
        $cate = CategoryModel::where('cate_show',1)->get();
        $cateinfo = CategoryModel::getCateInfo($cate);
        $brand = BrandModel::all();
        $data = [
            'cate'=>$cateinfo,
            'brand'=>$brand
        ];
        return view('goods.goodsadd',$data);
    }






































































    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 商品视图层
     * （柴千千）
     */
    public function goodsList(){
        return view('goods.goodslist');
    }

    /**
     * 商品展示
     */
    public function goods_list(Request $request){
        $limit=$request->input("limit");
        $page=$request->input("page");
        $goods_name=$request->input('goods_name');
//        $all = $request->all();
//        var_dump($all);exit;

        if(empty($goods_name)){

            $data=GoodsModel::where(['status'=>1])->offset(($page-1)*$limit)->limit($limit)->get();
//            var_dump($data);exit;
        }else{
            $data=GoodsModel::where(['status'=>1])->where('goods_name','like',$goods_name."%")->offset(($page-1)*$limit)->limit($limit)->get();
//            var_dump($data);exit;
        }
//        var_dump($data);exit;
        foreach($data as $k=>$v){
            //品牌名字
            $arr=BrandModel::where(['brand_id'=>$data[$k]['brand_id']])->first();
            $data[$k]['brand_id']=$arr['brand_name'];
            //分类名字
            $res=CategoryModel::where(['cate_id'=>$data[$k]['cate_id']])->first();
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
        $count=GoodsModel::where(['status'=>1])->where("goods_name","like","$goods_name"."%")->count();
//        var_dump($count);exit;
        $info=[
            'code'=>0,
            'msg'=>'',
            'count'=>$count,
            'data'=>$data,
        ];
        return json_encode($info);
    }

    /**
     * 删除
     */
    public function goodsDel(Request $request){
        $goods_id=$request->input("goods_id");
//        var_dump($goods_id);exit;
        $res=GoodsModel::where(['goods_id'=>$goods_id])->update(['status'=>2]);
//        var_dump($res);
        if($res){
            $response=[
                'msg'=>"删除成功",
                'status'=>100
            ];
        }else{
            $response=[
                'msg'=>'删除失败',
                'status'=>2
            ];
        }
        echo json_encode($response);
    }

    /**
     * 修改
     */
    public function goodsUpdate(){

    }
}
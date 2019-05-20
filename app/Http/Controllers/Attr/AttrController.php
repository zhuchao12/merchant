<?php
/**
 * 货品属性管理
 */
namespace App\Http\Controllers\Attr;

use App\Model\BasicModel;
use App\Model\CategoryModel;
use App\Model\SaleModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AttrController extends Controller
{
    /**
     * 基本属性添加
     */
    public function addBasicAttr( Request $request )
    {
        if( $request -> ajax() ){
            $data = $request -> all();
//            var_dump($data);die;
            DB::beginTransaction();
            $time = time();
            foreach( $data['attr'] as $k => $v){
                $basic_info = [
                    'category_id'   =>  $data['category_id'],
                    'attr_name'     =>  $v,
                    'status'        =>  1,
                    'ctime'         =>  $time

                ];
                $basic_id = DB::table('shop_basic_attr')->insertGetId($basic_info);
//                var_dump($basic_id);die;
                if(!$basic_id){
                    DB::rollback();
                    return ['code'=>3,'msg'=>'添加失败'];

                }
                //属性是否存在
                if( isset($data['value'][$k])){
                    foreach($data['value'][$k] as $key => $value){
                        $value_info = [
                            'category_id'   =>  $data['category_id'],
                            'attr_value'    =>  $value,
                            'basic_id'      =>  $basic_id,
                            'status'        =>  1,
                            'ctime'         =>  $time
                        ];
                        $value_insert[] = $value_info;
                    }

                }
            }
            $res = DB::table('shop_basic_attr_value')->insert( $value_insert);
            if($res){
                DB::commit();
//                return $this -> dataJson( 1000 ,'添加成功');
                return ['code'=>1000,'msg'=>'添加成功'];
            }else{
                DB::rollBack();
                return ['code'=>3,'msg'=>'添加失败'];
            }

        }else{
            //分类下拉
            $where = [
                'status'    => 1,
            ];
            $data = CategoryModel::where( $where ) -> get();
            if( empty( $data[0] ) ){
                $data =  [];
            }else{
                $data = CategoryModel::getCateInfo( $data );
            }

            $info = [
                'title' =>  '基本属性添加',
                'data'  =>  $data
            ];

            return view( 'attr.add_basic' , $info );
        }
    }

    /**
     * 销售属性添加
     */
    public function addSaleAttr( Request $request )
    {
        if( $request -> ajax()){

            $data = $request -> all();
            DB::beginTransaction();
            $time = time();
            foreach( $data['attr'] as $k => $v){
                $basic_info = [
                    'category_id'   =>  $data['category_id'],
                    'attr_name'     =>  $v,
                    'status'        =>  1,
                    'ctime'         =>  $time

                ];
                $sale_id = DB::table('shop_sale_attr')->insertGetId($basic_info);
                if(!$sale_id){
                    DB::rollBack();
                    return ['code'=>3,'msg'=>'添加失败'];
                }
                //属性是否存在
                if( isset($data['value'][$k])){
                    foreach($data['value'][$k] as $key => $value){
                        $value_info = [
                            'category_id'   =>  $data['category_id'],
                            'attr_value'    =>  $value,
                            'sale_id'      =>  $sale_id,
                            'status'        =>  1,
                            'ctime'         =>  $time
                        ];
                        $value_insert[] = $value_info;
                    }

                }
            }
            $res = DB::table('shop_sale_attr_value')->insert( $value_insert);
            if($res){
                DB::commit();
                return ['code'=>1000,'msg'=>'添加成功'];
            }else{
                DB::rollBack();
                return ['code'=>3,'msg'=>'添加失败'];
            }
        }else{
            //分类下拉
            $where = [
                'status'    => 1,
            ];
            $data = CategoryModel::where( $where ) -> get();
            if( empty( $data[0] ) ){
                $data =  [];
            }else{
                $data = CategoryModel::getCateInfo( $data );
            }

            $info = [
                'title' =>  '销售属性添加',
                'data'  =>  $data
            ];

            return view( 'attr.add_sale' , $info );
        }
    }


    /**
     * 基本属性的展示
     */
    public function basicAttrShow(Request $request){

//        $this -> checkRequest();
//        $category_id = 48;
//
        $category_id = $request -> input('category_id');
//        var_dump($category_id);die;
        # 获取分类对应属性信息
//        $baseInfo = BasicModel::where('category_id',$category_id)->get();
        $basic_obj = BasicModel::join('shop_basic_attr_value','shop_basic_attr.basic_id','=','shop_basic_attr_value.basic_id')
            ->where('shop_basic_attr.category_id',$category_id)->where('shop_basic_attr.status',1)->get();
        $basic_arr =  $basic_obj  -> toArray();
//        var_dump($basic_arr);die;
        $new = [];
        foreach( $basic_arr as $key => $value ){
            $new[$value['basic_id']]['attr_id'] = $value['basic_id'];
            $new[$value['basic_id']]['attr_name'] = $value['attr_name'];
            if($value['basic_value_id']){
//                echo 1;
                $new[$value['basic_id']]['has_son'] = 1;
                $new[$value['basic_id']]['son'][$value['basic_value_id']] = $value['attr_value'];
            }else{
//                echo 2;
                $new[$value['basic_id']]['has_son'] = 0;
            }

        }
//        var_dump($new);exit;

        /*$this -> view -> engine -> layout(false);

        $this -> assign( 'basic' , $new );*/
        $data = [
            'basic'=>$new
        ];
        return view('attr.basicattrshow',$data);
    }

    /**
     * 销售属性的展示
     */
    public function saleAttrShow(Request$request){

//        $this -> checkRequest();

//        $category_id = 48;
        $category_id = $request -> input('category_id');

       /* # 获取分类对应属性信息
        $sale_model = model('Sale');

        #查询启用的属性
        $where = [
            's.status' => 1,
            's.category_id'=> $category_id
        ];

        $sale_obj = $sale_model
            -> field('s.*,v.attr_value,v.sale_value_id')
            -> table('shop_sale_attr s')
            -> join('shop_sale_attr_value v' , 's.sale_id=v.sale_id','left')
            -> where( $where )
            -> select();
//        echo $basic_model->getLastSql();*/
        $sale_obj = SaleModel::join('shop_sale_attr_value','shop_sale_attr.sale_id','=','shop_sale_attr_value.sale_id')
            ->where('shop_sale_attr.category_id',$category_id)->where('shop_sale_attr.status',1)->get();
        $sale_arr =  $sale_obj -> toArray();
//        var_dump($sale_arr);die;
        $new = [];
        foreach( $sale_arr as $key => $value ){
            $new[$value['sale_id']]['attr_id'] = $value['sale_id'];
            $new[$value['sale_id']]['attr_name'] = $value['attr_name'];
            if($value['sale_value_id']){
                $new[$value['sale_id']]['has_son'] = 1;
                $new[$value['sale_id']]['son'][$value['sale_value_id']] = $value['attr_value'];
            }else{
                $new[$value['sale_id']]['has_son'] = 0;
            }
        }
        $data = [
            'sale'=>$new
        ];
//        var_dump($data);die;
        return view('attr.saleattrshow',$data);
    }
}

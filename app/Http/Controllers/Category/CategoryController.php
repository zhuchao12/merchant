<?php
/**
 * 商品分类管理
 */
namespace App\Http\Controllers\Category;

use App\Model\CategoryModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * 分类添加
     */
    public function addCategory( Request $request)
    {
        if( $request -> ajax()){
            $data = $request -> all();

            //判断分类名称唯一
            $where = [
                'status'    =>  1,
                'cate_show' =>  1,
                'cate_name' =>  $data['cate_name']
            ];
            $info = CategoryModel::where($where) -> first('cate_id');
            if(isset($info->cate_id)){
                return $this->dataJson(1 , '分类名称已存在');
            }

            //添加入库
            $cate_data = [
                'cate_name' =>  $data['cate_name'],
                'cate_show' =>  $data['cate_show'],
                'cate_navshow' =>  $data['cate_navshow'],
                'pid' =>  $data['pid'],
                'cate_time' =>  time(),
                'status' =>  1,
            ];
            $res = CategoryModel::insert( $cate_data );
            if($res){
                return $this->dataJson( 1000 , '添加成功');
            }else{
                return $this->dataJson( 2 , '添加失败');
            }
        }else{

            //分类下拉
            $where = [
                'cate_show' => 1,
                'status'    => 1,
            ];
            $data = CategoryModel::where( $where ) -> get();
            if( empty( $data[0] ) ){
                $data =  [];
            }else{
                $data = CategoryModel::getCateInfo( $data );
            }

            $info = [
                'title' =>  '分类添加',
                'data'  =>  $data
            ];
            return view( 'category.add' , $info);
        }
    }

    /**
     * 分类展示
     */
    public function listCategory( Request $request )
    {
        if( $request -> ajax() ){
            $where = [
                'cate_show' => 1,
                'status'    => 1,
            ];
            $data = CategoryModel::where( $where ) -> get();
            if( empty( $data[0] ) ){
                return $this -> dataJsonLayui( 1 , '数据为空');
            }
            foreach ($data as $k => $v){
                $data[$k]['cate_time'] = date( 'Y-m-d H:i:s' , $v['cate_time']);
            }
            return $this -> dataJsonLayui( 0 , '分类展示' , $data );
        }else{
            $info = [
                'title' =>  '分类列表'
            ];
            return view( 'category.list' , $info );
        }
    }

    /**
     * 分类下拉
     */
    public function selectCategory()
    {

    }
}

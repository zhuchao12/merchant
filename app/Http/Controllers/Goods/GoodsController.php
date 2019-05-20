<?php

namespace App\Http\Controllers\Goods;

use App\Model\BrandModel;
use App\Model\CategoryModel;
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
}

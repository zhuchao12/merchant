<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


//后台
Route::any('/admin','Admin\IndexController@index');

//商品属性管理
Route::any('/attr/basic/add', 'Attr\AttrController@addBasicAttr');//基本属性添加//aaa
Route::any('/attr/sale/add', 'Attr\AttrController@addSaleAttr');//销售属性添加
Route::any('/attr/basic/show', 'Attr\AttrController@basicAttrShow');//基本属性展示
Route::any('/attr/sale/show', 'Attr\AttrController@saleAttrShow');//销售属性展示
//商品添加
Route::get('/goods','Goods\GoodsController@add');





































//商品列表视图层
Route::any('/admin/goodsList','Goods\GoodsController@goodsList');

//商品展示
Route::any('/admin/goods_list','Goods\GoodsController@goods_list');

//删除
Route::any('/admin/goodsDel','Goods\GoodsController@goodsDel');
//修改
Route::any('/admin/goodsUpdate','Goods\GoodsController@goodsUpdate');

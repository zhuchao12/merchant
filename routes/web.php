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
Route::any('/attr/basic/add', 'Attr\AttrController@addBasicAttr');//基本属性添加
Route::any('/attr/sale/add', 'Attr\AttrController@addSaleAttr');//销售属性添加
Route::any('/attr/basic/show', 'Attr\AttrController@basicAttrShow');//基本属性展示
Route::any('/attr/sale/show', 'Attr\AttrController@saleAttrShow');//销售属性展示
//商品添加
Route::get('/goods','Goods\GoodsController@add');
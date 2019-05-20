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




























































//商品列表视图层
Route::any('/admin/goodsList','Goods\GoodsController@goodsList');

//商品展示
Route::any('/admin/goods_list','Goods\GoodsController@goods_list');





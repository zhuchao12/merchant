<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CategoryModel extends Model
{
    public $table = 'shop_category';
    public $timestamps = false;

    /**
     * 获取分类信息
     */
    public static function getCateInfo( $data , $pid = 0 , $level = 0)
    {
        foreach ( $data as $k => $v){
            static $info = [];
            if( $v['pid'] == $pid){
                $v['level'] = $level;
                $info[] = $v;
                self::getCateInfo($data , $v['cate_id'] , $v['level'] +1 );
            }
        }
        return $info;
    }
}

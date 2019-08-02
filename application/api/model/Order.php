<?php
/**
 * Author: Luoaotian
 * Date: 2019/7/31
 * Time: 11:29
 */

namespace app\api\model;


class Order extends BaseModel
{
    protected $autoWriteTimestamp = true;

    public function getSnapItemsAttr($value)
    {
        if(empty($value)){
            return null;
        }
        return json_decode($value);
    }
    public function getSnapAddressAttr($value)
    {
        if(empty($value)){
            return null;
        }
        return json_decode($value);
    }
    public static function getSummaryByUser($uid,$page=1,$size=15)
    {
        $pagingData = self::where('user_id',$uid)->order('create_time desc')->paginate($size,true,['page'=>$page]);
        return $pagingData;
    }
}
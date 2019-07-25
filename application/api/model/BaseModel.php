<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/7/24
 * Time: 15:15
 */

namespace app\api\model;


use think\Model;

class BaseModel extends Model
{
    //图片路径处理
    protected function prefixImgUrl($value,$data)
    {
        $finalUrl = $value;
        if($data['from'] ==1){
            $finalUrl = config('setting.img_prefix').$value;
        }
        return $finalUrl;

    }
}
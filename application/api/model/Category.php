<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/7/25
 * Time: 14:38
 */

namespace app\api\model;


class Category extends BaseModel
{
    public function img()
    {
        return $this->belongsTo('Image','topic_img_id','id');
    }
}
<?php

namespace app\api\model;

class Image extends BaseModel
{
    protected $hidden = ['update_time','delete_time'];

    public function getUrlAttr($value,$data)
    {
        return $this->prefixImgUrl($value,$data);
    }

}

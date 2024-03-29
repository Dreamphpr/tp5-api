<?php

namespace app\api\model;


class BannerItem extends BaseModel
{
    protected $hidden = ['img_id','delete_time','banner_id','update_time'];
    public function img()
    {
        return $this->belongsTo('Image','img_id','id');
    }

}

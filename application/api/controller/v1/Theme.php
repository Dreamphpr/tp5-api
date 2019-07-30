<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/7/24
 * Time: 16:02
 */

namespace app\api\controller\v1;


use app\api\validate\IDCollection;
use app\api\model\Theme as ThemeModel;
use app\api\validate\IDMustBePositiveInt;
use app\lib\exception\ThemeExcepton;

class Theme
{
    /**
     *
     */
    public function getSimpleList($ids='')
    {
        (new IDCollection())->goCheck();
        $ids = explode(',',$ids);
        $theme = ThemeModel::with(['topicImg','headImg'])->select($ids);
        if (!$theme ) {
            throw new ThemeExcepton();
        }
        return $theme;

    }

    public function getComplexOne($id)
    {
        (new IDMustBePositiveInt())->goCheck();
        $theme = ThemeModel::getThemeWithproduct($id);
        if (!$theme ) {
            throw new ThemeExcepton();
        }
        return $theme;
    }
}
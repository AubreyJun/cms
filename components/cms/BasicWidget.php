<?php
/**
 * Created by PhpStorm.
 * User: zj08
 * Date: 2020/1/18
 * Time: 21:12
 */

namespace app\components\cms;


use Yii;
use yii\base\Widget;

class BasicWidget extends Widget
{

    public function getFragment($id)
    {
        $fragment = Yii::$app->getDb()->createCommand("select * from cms_theme_fragment where id = :id")
            ->bindParam(":id", $id)
            ->queryOne();
        return $fragment;
    }

}
<?php
/**
 * Created by PhpStorm.
 * User: zj08
 * Date: 2020/1/18
 * Time: 21:12
 */

namespace app\components\cms;


use yii\base\Widget;

class PageNavigationWidget extends Widget
{
    public $data;

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        return $this->render('pageNavigation',$this->data);
    }
}
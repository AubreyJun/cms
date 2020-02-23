<?php
/**
 * Created by PhpStorm.
 * User: zj08
 * Date: 2020/1/18
 * Time: 21:12
 */

namespace app\components\cms;


use yii\base\Widget;

class MetaWidget extends Widget
{
    public $id;
    public $context;

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        $this->context->data['meta_title'] = "sfsdfsf";
        return $this->render("meta");
    }
}
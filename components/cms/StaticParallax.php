<?php
namespace app\components\cms;

use yii\base\Widget;

class StaticParallax extends Widget
{

    public $data;

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        return $this->render('staticParallax',$this->data);
    }

}

<?php
namespace app\components\cms;

use yii\base\Widget;

class PagetitleWidget extends Widget
{

    public $data;

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        return $this->render('pagetitle',$this->data);
    }

}

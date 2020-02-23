<?php
namespace app\components\cms;

use yii\base\Widget;

class TeamListWidget extends Widget
{

    public $data;

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        return $this->render('teamList',$this->data);
    }

}

<?php
/**
 * Created by PhpStorm.
 * User: zj08
 * Date: 2020/1/18
 * Time: 21:12
 */

namespace app\components\cms;


use yii\base\Widget;

class PagePieceWidget extends BasicWidget
{
    public $data;
    public $context;

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        $data =  json_decode(json_encode(simplexml_load_string($this->data['properties'],'SimpleXMLElement',LIBXML_NOCDATA)),true);
       return $this->render("pagepiece",$data);
    }
}
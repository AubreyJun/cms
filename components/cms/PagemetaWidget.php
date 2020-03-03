<?php
/**
 * Created by PhpStorm.
 * User: zj08
 * Date: 2020/1/18
 * Time: 21:12
 */

namespace app\components\cms;


use yii\base\Widget;

class PagemetaWidget extends BasicWidget
{
    public $data;
    public $context;

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        $data =  json_decode(json_encode(simplexml_load_string($this->data['properties'])),true);

        $this->context->data['meta_title'] = $data['meta_title'];
        $this->context->data['meta_keywords'] = $data['meta_keywords'];
        $this->context->data['meta_description'] = $data['meta_description'];
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: zj08
 * Date: 2020/1/18
 * Time: 21:12
 */

namespace app\components\cms;


use yii\base\Widget;

class MetaWidget extends BasicWidget
{
    public $id;
    public $context;

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        $fragment = $this->getFragment($this->id);
        $data =  json_decode(json_encode(simplexml_load_string($fragment['properties'])),true);

        $this->context->data['meta_title'] = $data['meta_title'];
        $this->context->data['meta_keywords'] = $data['meta_keywords'];
        $this->context->data['meta_description'] = $data['meta_description'];
    }
}
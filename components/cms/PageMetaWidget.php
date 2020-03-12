<?php
/**
 * Created by PhpStorm.
 * User: zj08
 * Date: 2020/1/18
 * Time: 21:12
 */

namespace app\components\cms;


use yii\base\Widget;

class PageMetaWidget extends BasicWidget
{
    public $fragment;
    public $context;
    private $data = array();

    public static $editorMapping = array(
        'meta_title' => array(
            'title' => '标题',
            'editor' => 'text'
        ),
        'meta_keywords' => array(
            'title' => '关键字',
            'editor' => 'text'
        ), 'meta_description' => array(
            'title' => '描述',
            'editor' => 'text'
        )
    );

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        $properties = json_decode($this->fragment['properties'], true);
        foreach ($properties as $property) {
            $this->data[$property['pname']] = $property;
        }

        $this->context->data['meta_title'] = $this->data['meta_title']['pvalue'];
        $this->context->data['meta_keywords'] = $this->data['meta_keywords']['pvalue'];
        $this->context->data['meta_description'] = $this->data['meta_description']['pvalue'];
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: zj08
 * Date: 2020/1/18
 * Time: 21:12
 */

namespace app\components\cms;


use yii\base\Widget;

class LayoutRowWidget extends BasicWidget
{

    public $fragment;
    public $context;
    private $data = array();

    public static $editorMapping = array(
    );

    public function init()
    {
        parent::init();
    }




}
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
    public $fragment;
    public $context;
    private $data = array();

    public static $editorMapping = array(
        'content' => array(
            'title' => '页面内容',
            'editor' => 'html'
        )
    );

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        $properties = json_decode($this->fragment['properties'],true);
        foreach ($properties as $property){
            $this->data[$property['pname']] = $property;
        }

        return $this->render("pagepiece", $this->data);
    }
}

<?php


namespace app\components\cms;


use app\models\cms\Fragment;

class SliderWidget extends BasicWidget
{
    public $fragment;
    public $context;
    public $id;
    private $data = array();

    public static $editorMapping = array(
        'sliders' => array(
            'title' => '幻灯片',
            'editor' => 'slider'
        )
    );

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        if($this->id!=null){
            $this->fragment = Fragment::findOne($this->id);
        }
        $properties = json_decode($this->fragment['properties'], true);
        $this->data['slider'] = $properties;

        return $this->render("slier", $this->data);

    }
}

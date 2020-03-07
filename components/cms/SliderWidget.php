<?php


namespace app\components\cms;


class SliderWidget extends BasicWidget
{
    public $fragment;
    public $context;
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
        $properties = json_decode($this->fragment['properties'], true);
        foreach ($properties as $property) {
            $this->data[$property['pname']] = $property;
        }

        return $this->render("slier", $this->data);

    }
}

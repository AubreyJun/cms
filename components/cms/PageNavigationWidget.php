<?php


namespace app\components\cms;


class PageNavigationWidget extends BasicWidget
{
    public $fragment;
    public $context;
    private $data = array();

    public static $editorMapping = array(
        'logo' => array(
            'title' => 'LOGO图片',
            'editor' => 'image'
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

        return $this->render("pagepiece", $this->data);

    }
}

<?php

namespace app\components\cms;


use app\models\cms\Fragment;
use yii\base\Widget;

class TestimonialsWidget extends BasicWidget
{
    public $fragment;
    public $context;
    private $data = array();
    public $id;

    public static $editorMapping = array(
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
        $this->data['fragment'] = $this->fragment;

        $this->data['context'] = $this->context;

        return $this->render("testimonials", $this->data);

    }
}

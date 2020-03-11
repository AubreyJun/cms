<?php
/**
 * Created by PhpStorm.
 * User: zj08
 * Date: 2020/1/18
 * Time: 21:12
 */

namespace app\components\cms;


use app\models\cms\Fragment;
use yii\base\Widget;

class ContentWrapWidget extends BasicWidget
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

        return $this->render("contentWrap", $this->data);

    }
}

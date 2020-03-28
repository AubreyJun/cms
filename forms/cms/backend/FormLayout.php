<?php

namespace app\forms\cms\backend;

class FormLayout extends \yii\base\Model
{
    public $id;
    public $layoutName;
    public $themeId;
    public $header;
    public $footer;

    public function rules()
    {
        return [
            [['id'], 'required'],
            [['themeId'], 'required'],
            [['layoutName'], 'required', 'message' => '布局描述不能为空']
        ];
    }

    public function attributeLabels()
    {
        return [
            'layoutName' => '布局描述',
            'header' => '头部组件',
            'footer' => '底部组件',
        ];
    }


}

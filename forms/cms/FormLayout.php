<?php

namespace app\forms\cms;

class FormLayout extends \yii\base\Model
{
    public $id;
    public $layoutName;
    public $layoutText;
    public $themeId;

    public function rules()
    {
        return [
            [['id'], 'required'],
            [['themeId'], 'required'],
            [['layoutName'], 'required', 'message' => '布局描述不能为空'],
            [['layoutText'], 'required', 'message' => '布局内容不能为空']
        ];
    }

    public function attributeLabels()
    {
        return [
            'layoutName' => '布局描述',
            'layoutText' => '布局内容'
        ];
    }


}

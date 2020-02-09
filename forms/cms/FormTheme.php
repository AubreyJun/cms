<?php

namespace app\forms\cms;

class FormTheme extends \yii\base\Model
{
    public $id;
    public $themeName;
    public $themeKey;
    public $isActive;

    public function rules()
    {
        return [
            [['id'], 'required'],
            [['isActive'], 'required'],
            [['themeName'], 'required', 'message' => '主题名称不能为空'],
            [['themeKey'], 'required', 'message' => 'KEY不能为空']
        ];
    }

    public function attributeLabels()
    {
        return [
            'themeName' => '主题名称',
            'themeKey' => 'KEY',
            'isActive' => '状态',
        ];
    }


}

<?php

namespace app\forms\cms\backend;

class FormTheme extends \yii\base\Model
{
    public $id;
    public $themeName;
    public $isActive;

    public function rules()
    {
        return [
            [['id'], 'required'],
            [['isActive'], 'required'],
            [['themeName'], 'required', 'message' => '主题名称不能为空'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'themeName' => '主题名称',
            'isActive' => '状态',
        ];
    }


}

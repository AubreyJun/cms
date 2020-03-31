<?php

namespace app\forms\cms\backend;

class FormParam extends \yii\base\Model
{
    public $id;
    public $cfgkey;
    public $cfgvalue;
    public $description;
    public $themeId;
    public $tips;

    public function rules()
    {
        return [
            [['id'], 'required'],
            [['cfgkey'], 'required','message'=>'配置的KEY不能为空'],
            [['cfgvalue'], 'required', 'message' => '配置内容不能为空'],
            [['description'], 'required', 'message' => '描述不能为空'],
            [['themeId'], 'required', 'message' => '主题不能为空']
        ];
    }

    public function attributeLabels()
    {
        return [
            'cfgkey' => '配置KEY',
            'cfgvalue' => '配置',
            'description' => '描述',
            'configtype' => '配置类型',
            'themeId' => '主题',
        ];
    }


}








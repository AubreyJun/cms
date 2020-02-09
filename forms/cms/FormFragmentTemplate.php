<?php

namespace app\forms\cms;

class FormFragmentTemplate extends \yii\base\Model
{

    public $id=0,$templatename,$content,$deleted = 0,$themeId,$templateType;

    public function rules()
    {
        return [
            [['id','themeId','templateType'], 'required'],
            [['templatename'], 'required', 'message' => '片段模版名称不能为空'],
            [['content'], 'required', 'message' => '片段模版内容不能为空']
        ];
    }

    public function attributeLabels()
    {
        return [
            'templatename' => '片段模版名称',
            'content' => '片段模版内容',
            'templateType'=>'模板类型'
        ];
    }

}
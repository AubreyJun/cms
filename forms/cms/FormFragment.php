<?php

namespace app\forms\cms;

class FormFragment extends \yii\base\Model
{
    public $id;
    public $themeId;
    public $fragmentName;
    public $fragmentContent;
    public $templateId = 0;
    public $pageType;
    public $properties;

    public function rules()
    {
        return [
            [['id','themeId','pageType'], 'required'],
            [['templateId'], 'required', 'message' => '片段模版不能为空'],
            [['fragmentName'], 'required', 'message' => '片段名称不能为空']
        ];
    }

    public function attributeLabels()
    {
        return [
            'fragmentName' => '片段名称',
            'fragmentContent' => '片段内容',
            'templateId' => '片段模版',
            'properties' => '片段属性'
        ];
    }


}

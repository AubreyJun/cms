<?php
namespace app\forms\cms\backend;

class FormFragment extends \yii\base\Model
{

    public $id, $themeId, $fragmentName, $body,$pageId = 0;

    public function rules()
    {
        return [
            [['id','themeId'], 'required'],
            [['fragmentName'], 'required','message'=>'片段名称不能为空'],
            [['pageId'], 'required','message'=>'页面ID'],
            [['body'], 'required','message'=>'内容不能为空']
        ];
    }


    public function attributeLabels()
    {
        return [
            'fragmentName' => '片段名称',
            'body' => '片段内容'
        ];
    }

}

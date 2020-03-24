<?php
namespace app\forms\cms\backend;

class FormFragment extends \yii\base\Model
{

    public $id, $themeId, $fragmentName, $body;

    public function rules()
    {
        return [
            [['id','themeId'], 'required'],
            [['fragmentName'], 'required','message'=>'片段名称不能为空'],
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

<?php
namespace app\forms\cms\backend;

class FormFragmentProp extends \yii\base\Model
{

    public $id, $fragmentId, $ppKey, $ppValue;

    public function rules()
    {
        return [
            [['id','fragmentId'], 'required'],
            [['ppKey'], 'required','message'=>'配置KEY'],
            [['ppValue'], 'required','message'=>'配置VALUE']
        ];
    }

    public function attributeLabels()
    {
        return [
            'ppKey' => '配置KEY',
            'ppValue' => '配置VALUE'
        ];
    }

}

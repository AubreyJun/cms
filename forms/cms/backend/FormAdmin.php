<?php

namespace app\forms\cms\backend;

class FormAdmin extends \yii\base\Model
{
    public $id;
    public $adminpassword,$newpassword,$tips;


    public function rules()
    {
        return [
            [['id'], 'required'],
            [['adminpassword'], 'required','message'=>'密码不能为空'],
            [['newpassword'], 'required','message'=>'新密码不能为空']
        ];
    }

    public function attributeLabels()
    {
        return [
            'adminpassword' => '用户密码',
            'newpassword' => '新密码'
        ];
    }


}

<?php
namespace app\forms;


class FormLogin extends \yii\base\Model
{

    public $username;
    public $password;
    public $tips;

    public function rules()
    {
        return [
            [['username'], 'required', 'message' => '登入名称不能为空'],
            [['password'], 'required', 'message' => '登入密码不能为空'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => '登入名称',
            'password' => '登入密码'
        ];
    }

}
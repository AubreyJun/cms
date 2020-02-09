<?php


namespace app\modules\plugin\forms;


class FormContact extends \yii\base\Model
{
    public $id;
    public $username;
    public $email;
    public $phone;
    public $message;
    public $subject;

    public function rules()
    {
        return [
            [['username'], 'required', 'message' => '联系人不能为空'],
            [['subject'], 'required', 'message' => '主题不能为空'],
            [['email'], 'required', 'message' => '邮箱不能为空'],
            [['message'], 'required', 'message' => '内容不能为空']
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => '联系人',
            'subject' => '主题',
            'email' => '邮箱',
            'phone' => '手机',
            'message' => '内容'
        ];
    }

}
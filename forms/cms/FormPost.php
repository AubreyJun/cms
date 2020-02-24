<?php

namespace app\forms\cms;

class FormPost extends \yii\base\Model
{
    public $id;
    public $title;
    public $content = '';
    public $summary;
    public $keywords;
    public $tags = '';
    public $postType;
    public $catalogId = 0;
    public $status = 'offline';
    public $themeid = 0;


    public function rules()
    {
        return [
            [['id','catalogId'], 'required'],
            [['postType'], 'required','message'=>'内容类型不能为空'],
            [['title'], 'required','message'=>'标题不能为空'],
            [['content'], 'required', 'message' => '内容不能为空'],
            [['summary'], 'required', 'message' => '摘要不能为空'],
            [['keywords'], 'required', 'message' => '关键字不能为空'],
            [['postType'], 'required', 'message' => '类型不能为空'],
            [['status'], 'required', 'message' => '状态不能为空']
        ];
    }

    public function attributeLabels()
    {
        return [
            'title' => '标题',
            'content' => '内容',
            'summary' => '摘要',
            'keywords' => '关键字',
            'tags' => '标签',
            'postType' => '内容类型',
            'status' => '状态',
            'mainimage' => '主图',
        ];
    }


}

<?php

namespace app\forms\cms;

class FormPage extends \yii\base\Model
{
    public $id;
    public $themeId;
    public $pageName;
    public $pageText;
    public $pageType;
    public $isDefault;
    public $layoutId;
    public $pageKey;

    public function rules()
    {
        return [
            [['id'], 'required'],
            [['pageKey'], 'required'],
            [['themeId'], 'required'],
            [['pageName'], 'required', 'message' => '页面名称不能为空'],
            [['pageText'], 'required', 'message' => '页面内容不能为空'],
            [['pageType'], 'required', 'message' => '页面类型不能为空'],
            [['isDefault'], 'required'],
            [['layoutId'], 'required', 'message' => '布局不能为空']
        ];
    }

    public function attributeLabels()
    {
        return [
            'pageName' => '页面名称',
            'pageText' => '页面内容',
            'pageType' => '页面类型',
            'isDefault' => '默认',
            'layoutId' => '布局',
            'pageKey' => '页面KEY'
        ];
    }





}

<?php

namespace app\forms\cms\backend;

class FormPage extends \yii\base\Model
{
    public $id;
    public $themeId;
    public $pageName;
    public $layoutId;
    public $pageKey;
    public $pagePath;

    public function rules()
    {
        return [
            [['id'], 'required'],
            [['pageKey'], 'required'],
            [['themeId'], 'required'],
            [['pageName'], 'required', 'message' => '页面名称不能为空'],
            [['layoutId'], 'required', 'message' => '布局不能为空'],
            [['pagePath'], 'required', 'message' => '网页路径不能为空'],
        ];
    }


    public function mustTwelve($attribute, $params)
    {

        if(!$this->twelveValidate($this->layout)){
            $this->addError($attribute, "正确格式示例：2,10/12/8,4");
        }
    }

    function twelveValidate($str){

        try{
            $cols = explode(",",$str);
            $total = 0;
            foreach($cols as $col){
                $colnumber = number_format($col);
                $total += $colnumber;
            }

            if($total==12){
                return true;
            }else{
                return false;
            }
        }catch (\ErrorException $e){
            return false;
        }

    }

    public function attributeLabels()
    {
        return [
            'pageName' => '页面名称',
            'pageText' => '页面内容',
            'pageType' => '页面类型',
            'layoutId' => '布局',
            'pageKey' => '页面KEY',
            'layout' => '页面组件布局',
            'pagePath' => '网页路径',
        ];
    }





}

<?php

namespace app\forms\cms\backend;

class FormNav extends \yii\base\Model
{

    public $id = 0, $catalogName, $parentId = 0, $sequenceNumber = 0,  $themeId, $catalogType, $deleted = 0,$tips,$navigationType,$navigationRel,$link,$icon;

    public function rules()
    {
        return [
            [['id'], 'required','message' => 'ID不能为空'],
            [['themeId'], 'required','message' => '主题ID不能为空'],
            [['parentId'], 'required','message' => '父类ID不能为空'],
            [['sequenceNumber'], 'required','message' => '排序ID不能为空'],
            [['catalogName'], 'required', 'message' => '导航名称不能为空'],
            [['catalogType'], 'required', 'message' => '类型不能为空'],
            [['deleted'], 'required', 'message' => '删除标识不能为空']
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => '布局描述',
            'catalogName' => '导航名称',
            'parentId'=>'父类ID',
            'sequenceNumber'=>'排序ID',
            'link'=>'链接',
            'status'=>'状态',
            'catalogType'=>'类型',
            'deleted'=>'删除标识',
            'navigationType'=>'导航类型',
            'navigationRel'=>'导航关联目录',
            'link'=>'链接',
            'icon'=>'ICON',

        ];
    }


}

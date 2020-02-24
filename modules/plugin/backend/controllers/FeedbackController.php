<?php

namespace app\modules\plugin\backend\controllers;

use app\models\cms\Plugin;
use app\modules\plugin\backend\models\Feedback;
use app\structure\constants\MsgType;
use app\structure\controllers\BackendPanelController;
use yii\data\Pagination;

class FeedbackController extends BackendPanelController
{

    public $meta = [
        'name'=>'在线反馈',
        'description'=>'用户的在线反馈信息',
        'menu'=>1,
        'pluginId'=>'feedback'
    ];


    public function actionIndex($pageSize=10){


        $query = Feedback::find()->where(['themeid'=>$this->data['editThemeId']]);
        $count = $query->count();
        $pagination = new Pagination(['totalCount' => $count]);
        $pagination->pageSize = $pageSize;
        $list = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
        $this->data['pagination'] = $pagination;
        $this->data['list'] = $list;

        return $this->render('index',$this->data);
    }

    public function actionInstall(){
        $sql_delete_config = "delete from cms_plugin where pluginId = 'feedback'";
        $this->query($sql_delete_config)->execute();

        $sql_drop_table = 'drop table if exists plugin_feedback';
        $this->query($sql_drop_table)->execute();

        $sql_table = 'CREATE TABLE `plugin_feedback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `createtime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatetime` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `themeid` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8';
        $this->query($sql_table)->execute();

        $sql_test = "INSERT INTO `plugin_feedback` ( `username`, `email`, `subject`, `message`, `createtime`, `updatetime`,
 `themeid`)
VALUES
	( '张三', 'zhujun@ranko.cn', 'hello world', 'hello world', '2020-02-24 10:07:54', NULL,:themeid )";
        $this->query($sql_test)
            ->bindParam(":themeid",$this->data['editThemeId'])
            ->execute();

        $plugin = new Plugin();
        $plugin->pluginName = $this->meta['name'];
        $plugin->pluginId = $this->meta['pluginId'];
        $plugin->description = $this->meta['description'];
        $plugin->themeId = $this->data['editThemeId'];
        $plugin->menu = 1;
        $plugin->status = 'active';
        $plugin->save();

        echo json_encode($this->message(MsgType::SUCCESS,'初始化成功'));
    }

}

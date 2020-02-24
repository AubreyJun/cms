<?php

namespace app\modules\plugin\backend\controllers;

use app\models\cms\Plugin;
use app\modules\plugin\backend\models\Message;
use app\structure\constants\MsgType;
use app\structure\controllers\BackendPanelController;
use yii\data\Pagination;

class MessageController extends BackendPanelController
{

    public $meta = [
        'name'=>'在线留言',
        'description'=>'用户留言信息并反馈',
        'menu'=>1,
        'pluginId'=>'message'
    ];


    public function actionIndex($pageSize=10){

        $query = Message::find()->where(['themeid'=>$this->data['editThemeId']]);;
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

        $sql_delete_config = "delete from cms_plugin where pluginId = 'message'";
        $this->query($sql_delete_config)->execute();

        $sql_drop_table = 'drop table if exists plugin_message';
        $this->query($sql_drop_table)->execute();

        $sql_table = 'CREATE TABLE `plugin_message`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `content` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `createtime` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatetime` timestamp(0) NOT NULL DEFAULT \'0000-00-00 00:00:00\' ON UPDATE CURRENT_TIMESTAMP(0),
  `themeid` int(11) NOT NULL DEFAULT 0,
  `status` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 0,
  `reply` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact';
        $this->query($sql_table)->execute();

        $sql_insert = "INSERT INTO `plugin_message`(`subject`, `username`, `content`, `createtime`, `updatetime`, `themeid`) VALUES
 ( '测试主题', '用户名', '内容', '2020-02-24 10:29:22', '0000-00-00 00:00:00', :themeId)";
        $this->query($sql_insert)->bindParam(":themeId",$this->data['editThemeId'])->execute();

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


    public function actionDelete($id){
        $this->query("delete from plugin_message where id = :id")->bindParam(":id",$id)->execute();

        return $this->redirect("index.php?r=plugin-backend/message/index");
    }

    public function actionReply($id){

        $this->data['message'] = Message::findOne($id);

        return $this->render('reply',$this->data);
    }

    public function actionSavereply(){
        $id = $_POST['id'];
        $reply = $_POST['reply'];
        $status = $_POST['status'];

        $this->query("update plugin_message set reply = :reply ,status=:status where id = :id")
            ->bindParam(":id",$id)
            ->bindParam(":reply",$reply)
            ->bindParam(":status",$status)
            ->execute();

        return $this->redirect("index.php?r=plugin-backend/message/index");

    }

}

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


        $query = Message::find()->where(['themeid'=>$this->data['defaultThemeId']]);;
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

        //查看对应的插件是否已经安装
        $exist = $this->query("select * from cms_plugin where pluginId = :pluginId")
            ->bindParam(":pluginId",$this->meta['pluginId'])->queryOne();

        if($exist){
            echo json_encode($this->message(MsgType::ERROR,'插件已经存在'));
        }else{
            $sql_drop_table = 'drop table if exists plugin_message';
            $this->query($sql_drop_table)->execute();

            $sql_table = 'CREATE TABLE `plugin_message`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `content` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `createtime` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatetime` timestamp(0) NOT NULL DEFAULT \'0000-00-00 00:00:00\' ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact';
            $this->query($sql_table)->execute();

            $plugin = new Plugin();
            $plugin->pluginName = $this->meta['name'];
            $plugin->pluginId = $this->meta['pluginId'];
            $plugin->description = $this->meta['description'];
            $plugin->menu = 1;
            $plugin->status = 'active';
            $plugin->save();

            echo json_encode($this->message(MsgType::SUCCESS,'初始化成功'));
        }
    }


    public function actionDelete($id){
        $this->query("delete from plugin_message where id = :id")->bindParam(":id",$id)->execute();

        return $this->redirect("index.php?r=pluginAdmin/message/index");
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

        return $this->redirect("index.php?r=pluginAdmin/message/index");

    }

}

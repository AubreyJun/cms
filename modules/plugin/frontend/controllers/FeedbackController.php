<?php

namespace app\modules\plugin\frontend\controllers;

use app\structure\constants\MsgType;
use app\structure\controllers\BasicController;
use app\structure\controllers\CmsFrontendController;
use app\structure\controllers\PluginController;
use Yii;
use yii\web\Controller;

class FeedbackController extends CmsFrontendController
{

    public function actionSave(){
        $name = $_POST['name'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];
        $email = $_POST['email'];

        $this->query("insert into plugin_feedback (subject,username,email,message,createtime) values (:subject,:username,:email,:message,now())")
            ->bindParam(":subject",$subject)
            ->bindParam(":username",$name)
            ->bindParam(":email",$email)
            ->bindParam(":message",$message)
            ->execute();


        $message = $this->message(MsgType::SUCCESS,"OK");
        echo json_encode($message);
    }

}

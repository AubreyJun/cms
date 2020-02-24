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
        $name = $_POST['username'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];
        $email = $_POST['email'];

        $this->query("insert into plugin_feedback (subject,username,email,message,createtime,themeid) values (:subject,:username,:email,:message,now(),:themeid)")
            ->bindParam(":subject",$subject)
            ->bindParam(":username",$name)
            ->bindParam(":email",$email)
            ->bindParam(":message",$message)
            ->bindParam(":themeid",$this->defaultTheme['id'])
            ->execute();

        $message = $this->message(MsgType::SUCCESS,"OK");
        echo json_encode($message);
    }

}

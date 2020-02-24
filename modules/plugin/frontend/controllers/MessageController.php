<?php

namespace app\modules\plugin\frontend\controllers;

use app\modules\plugin\forms\FormContact;
use app\modules\plugin\models\Contact;
use app\structure\constants\MsgType;
use app\structure\controllers\BasicController;
use app\structure\controllers\CmsFrontendController;
use app\structure\controllers\PluginController;
use Yii;
use yii\web\Controller;

class MessageController extends CmsFrontendController
{

    public function actionSave()
    {
        $name = $_POST['name'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];

        $this->query("insert into plugin_message (subject,username,content,createtime,themeid) values (:subject,:username,:content,now(),:themeid)")
            ->bindParam(":subject", $subject)
            ->bindParam(":username", $name)
            ->bindParam(":content", $message)
            ->bindParam(":themeid", $this->defaultTheme['id'])
            ->execute();


        $message = $this->message(MsgType::SUCCESS, "OK");
        echo json_encode($message);

    }

}

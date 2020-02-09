<?php


namespace app\modules\cms\backend\controllers;


use app\forms\cms\FormAdmin;
use app\forms\cms\FormArticle;
use app\structure\constants\MsgType;
use app\structure\controllers\BackendPanelController;
use Yii;

class AdmininfoController extends BackendPanelController
{

    public function actionProfile()
    {

        $model = new FormAdmin();
        $model->id = $this->userId;
        $this->data['model'] = $model;

        return $this->render('profile', $this->data);
    }


    public function actionUpdatepwd()
    {
        $model = new FormAdmin();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                $adminPwd = $this->query("select adminpassword from cms_admin where id = :id")->bindParam(":id", $model->id)->queryScalar();
                if (md5($model->adminpassword) == $adminPwd) {
                    $newPwd = md5($model->newpassword);
                    $this->query("update cms_admin set adminpassword = :adminpassword where id = :id")
                        ->bindParam(":adminpassword", $newPwd)
                        ->bindParam(":id", $model->id)
                        ->execute();

                    $this->data['message'] = $this->message(MsgType::SUCCESS,"密码修改成功");


                } else {
                    $model->addError('tips', '原密码错误');
                }
            }
        }

        $model->adminpassword = "";
        $model->newpassword = "";

        $this->data['model'] = $model;
        return $this->render('profile', $this->data);
    }

}

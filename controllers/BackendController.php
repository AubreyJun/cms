<?php


namespace app\controllers;


use app\forms\cms\FormFragment;
use app\forms\FormLogin;
use app\models\WebUser;
use app\structure\controllers\BackendBaseController;
use app\structure\controllers\BasicController;
use Yii;

class BackendController extends BackendBaseController
{

    public function actionIndex()
    {


        if (Yii::$app->user->isGuest) {
            $this->layout = "//backend-login";
            $model = new FormLogin();
            $this->data['model'] = $model;
            return $this->render('index', $this->data);
        } else {
            return $this->redirect("index.php?r=cms-backend/default/index");
        }
    }

    public function actionLogin()
    {
        $model = new FormLogin();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {

                $webUser = WebUser::findByUsernameAndPassword($model->username, $model->password);
                if ($webUser) {
                    Yii::$app->user->login($webUser);
                    return $this->redirect("index.php?r=cms-backend/default/index");
                } else {
                    $model->addError('tips', '用户名或者密码错误');
                }

            } else {
                $model->addError('tips', '用户名或者密码不能为空');
            }
        }

        $this->data['model'] = $model;
        $this->layout = "//backend-login";
        return $this->render('index', $this->data);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->actionIndex();
    }


}

<?php


namespace app\controllers;


use app\structure\controllers\BasicController;
use Yii;
use yii\web\Controller;

class SiteController extends Controller
{

    /**
     * @return \yii\web\Response
     *
     * 默认页面跳转
     */
    public function actionIndex(){
        return $this->redirect("index.html");
    }

    /**
     * @return string
     *
     * 全局的前端错误展示页面
     */
    public function actionError()
    {
        $this->layout = "//content";
        return $this->render('//rkcms/error');
    }

}

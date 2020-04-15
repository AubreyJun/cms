<?php

namespace app\modules\cms\frontend\controllers;

use app\models\cms\frontend\Layout;
use app\structure\controllers\CmsFrontendController;
use yii\web\Controller;

class DefaultController extends CmsFrontendController
{
    public function actionIndex($pagePath='home')
    {
        return $this->show($pagePath);
    }

    public function actionVisual($id){

        $page = $this->query("SELECT * FROM `cms_theme_page` where id = :id ")
            ->bindParam(":id", $id)
            ->queryOne();
        $this->data['CMS_PAGE'] = $page;

        $layout = Layout::findOne($page['layoutId']);
        $this->data['CMS_LAYOUT'] = $layout;

        $this->data['EDITABLED'] = 1;
        $this->layout = '@app/views/rkcms/frontend-cms';
        return $this->render('@app/views/rkcms/page', $this->data);
    }
}

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
}

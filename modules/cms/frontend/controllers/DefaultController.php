<?php

namespace app\modules\cms\frontend\controllers;

use app\structure\controllers\CmsFrontendController;
use yii\web\Controller;

class DefaultController extends CmsFrontendController
{
    public function actionIndex($pagePath)
    {
        return $this->show($pagePath);
    }
}

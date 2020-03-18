<?php

namespace app\modules\cms\frontend\controllers;

use app\structure\controllers\CmsFrontendController;
use yii\web\Controller;

class PageController extends CmsFrontendController
{
    public function actionIndex($id)
    {
        return $id;
    }

}
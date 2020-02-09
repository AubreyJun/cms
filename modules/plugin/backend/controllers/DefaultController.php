<?php

namespace app\modules\plugin\backend\controllers;

use yii\web\Controller;

/**
 * Default controller for the `pluginAdmin` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}

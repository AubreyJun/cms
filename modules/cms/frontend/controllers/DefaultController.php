<?php

namespace app\modules\cms\frontend\controllers;

use app\structure\controllers\CmsFrontendController;
use yii\web\Controller;

/**
 * Default controller for the `cms-frontend` module
 */
class DefaultController extends CmsFrontendController
{
    public function actionIndex($pageType=null,$pageId=0,$catalogId=0)
    {

        $this->pageId = $pageId;

        $this->data['catalogId'] = $catalogId;

        return $this->show($pageType);
    }
}

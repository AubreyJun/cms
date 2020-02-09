<?php

namespace app\modules\cms\backend\controllers;

use app\structure\constants\KeyPrefix;
use app\structure\controllers\AdminController;
use app\structure\controllers\BackendPanelController;
use yii\web\Controller;

class DefaultController extends BackendPanelController
{
    public function actionIndex()
    {

        $host = $_SERVER['HTTP_HOST'];
        $this->data['host'] = $host;

        $this->setPostCount();

        return $this->render('index', $this->data);
    }

    public function actionSetsider()
    {
        if (isset($_REQUEST['class'])) {
            $this->cache->set(KeyPrefix::SIDERBAR . $this->userId, $_REQUEST['class']);
        } else {
            $this->cache->delete(KeyPrefix::SIDERBAR . $this->userId);
        }
    }

    public function actionEdittheme($themeId){

        $this->query("update cms_theme set isEdit = 0 where isEdit = 1")->execute();
        $this->query("update cms_theme set isEdit = 1 where id = :id")->bindParam(":id",$themeId)->execute();

        return $this->redirect("index.php?r=cms-backend/default/index");

    }

    private function setPostCount(){
        $this->data['count_article'] = $this->getCount('article');
        $this->data['count_product'] = $this->getCount('product');
        $this->data['count_image'] = $this->getCount('image');
        $this->data['count_download'] = $this->getCount('download');
        $this->data['count_employee'] = $this->getCount('employee');
    }

    private function getCount($postType='article'){
        return $this->query("select count(1) from cms_post where themeId = :themeId and postType = :postType")
            ->bindParam(":themeId",$this->data['defaultThemeId'])
            ->bindParam(":postType",$postType)
            ->queryScalar();

    }

}

<?php

namespace app\modules\cms\backend\controllers;

use app\structure\controllers\AdminController;
use app\structure\controllers\BackendPanelController;

class DownloadController extends BackendPanelController
{
    public function actionIndex()
    {

        $this->getPost('download');
        $this->data['cardTitle'] = '下载';

        return $this->render('../post/index',$this->data);
    }
}

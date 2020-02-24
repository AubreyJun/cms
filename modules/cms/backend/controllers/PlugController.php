<?php


namespace app\modules\cms\backend\controllers;


use app\models\cms\Plugin;
use app\structure\controllers\AdminController;
use app\structure\controllers\BackendPanelController;

class PlugController extends BackendPanelController
{
    public function actionIndex()
    {

        $this->data['plugin'] = $this->query('select * from cms_plugin ')
            ->queryAll();

        return $this->render('index',$this->data);
    }

    public function actionSetstatus(){
        $id = $_GET['id'];

        $plugin = Plugin::findOne($id);
        if($plugin->status=='active'){
            $plugin->status='disabled';
        }else{
            $plugin->status='active';
        }
        $plugin->save();
        return $this->redirect('index.php?r=cms-backend/plug/index');
    }

    public function actionAdd(){

        return $this->render('add',$this->data);
    }


}

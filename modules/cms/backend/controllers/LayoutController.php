<?php


namespace app\modules\cms\backend\controllers;

use app\forms\cms\backend\FormLayout;
use app\models\cms\backend\BKLayout;
use app\structure\controllers\AdminController;
use app\structure\controllers\BackendPanelController;
use Yii;

class LayoutController extends BackendPanelController
{
    public function actionIndex()
    {
        $this->data['list'] = $this->query("select * from cms_theme_layout where themeId = :themeId")
            ->bindParam(":themeId", $this->data['editThemeId'])
            ->queryAll();

        return $this->render('index', $this->data);
    }

    public function actionAdd()
    {

        $model = new FormLayout();
        $model->id = 0;
        $this->data['model'] = $model;

        return $this->render('edit', $this->data);
    }

    public function actionEdit()
    {
        $model = new FormLayout();
        if ($model->load(Yii::$app->request->post())) {
            $model->setAttributes(['themeId'=>$this->data['editThemeId']]);
            if ($model->validate()) {
                if ($model->id == 0) {
                    $layout = new BkLayout();
                    $layout->setAttributes($model->attributes,false);
                    $layout->save();
                    return $this->actionIndex();
                } else {
                    $layout = BkLayout::findOne($model->attributes['id']);
                    $layout->setAttributes($model->attributes,false);
                    $layout->save();
                    return $this->actionIndex();
                }
            }
        }
        return $this->render('edit', [
            'model' => $model
        ]);
    }

    public function actionUpdate($id)
    {
        $layout = BkLayout::findOne($id);

        $model = new FormLayout();
        $model->load($layout->attributes, '');

        return $this->render('edit', [
            'model' => $model
        ]);
    }

    public function actionDelete($id){
        $layout = BkLayout::findOne($id);
        if($layout){
            $layout->delete();
        }
        return $this->actionIndex();
    }

    public function actionWidget($id){

        $layout = BkLayout::findOne($id);
        $this->data['layout'] = $layout;

        return $this->render('widget', $this->data);
    }

    public function actionSavewidget(){
        $id = $_REQUEST['id'];
        $widgetJSON = $_POST['widgetJSON'];

        $layout = BkLayout::findOne($id);
        $layout->widgetjson = $widgetJSON;
        $layout->save();

        return $this->redirect("index.php?r=cms-backend/layout/widget&id=".$id);
    }

}

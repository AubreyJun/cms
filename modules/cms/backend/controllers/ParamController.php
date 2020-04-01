<?php

namespace app\modules\cms\backend\controllers;


use app\forms\cms\backend\FormParam;
use app\models\cms\Page;
use app\models\cms\Param;
use app\structure\controllers\AdminController;
use app\structure\controllers\BackendPanelController;
use Yii;

class ParamController extends BackendPanelController
{
    public function actionIndex($configType = 'basic')
    {
        $this->data['list'] = $this->query("select * from cms_config where themeid = :themeid")
            ->bindParam(":themeid",$this->data['defaultThemeId'])
            ->queryAll();

        return $this->render('index', $this->data);
    }

    public function actionAdd()
    {
        $model = new FormParam();
        $model->id = 0;
        $this->data['model'] = $model;

        return $this->render('edit', $this->data);
    }

    public function actionEdit()
    {
        $model = new FormParam();
        if ($model->load(Yii::$app->request->post())) {
            $model->setAttributes(['themeId' => $this->data['defaultThemeId']]);
            if ($model->validate()) {
                $exist = Param::find()->where(['cfgkey' => $model->attributes['cfgkey']]
                )->andWhere(['!=', 'id', $model->id])->one();
                if($exist){
                    $model->addError('tips','不能使用相同类型的配置KEY');
                }else{
                    if ($model->id == 0) {
                        $param = new Param();
                        $param->setAttributes($model->attributes, false);
                        $param->save();
                        return $this->redirect("index.php?r=cms-backend/param/index");
                    } else {
                        $param = Param::findOne($model->attributes['id']);
                        $param->setAttributes($model->attributes, false);
                        $param->save();
                        return $this->redirect("index.php?r=cms-backend/param/index");
                    }
                }

            }
        }

        $this->data['model'] = $model;

        return $this->render('edit', $this->data);
    }

    public function actionDelete($id)
    {
        $param = Param::findOne($id);
        if ($param) {
            $param->delete();
        }
        return $this->actionIndex($param['configtype']);
    }

    public function actionUpdate($id)
    {

        $param = Param::findOne($id);
        $model = new FormParam();
        $model->setAttributes($param->attributes, true);

        $this->data['model'] = $model;

        return $this->render('edit', $this->data);
    }

}

<?php

namespace app\modules\cms\backend\controllers;


use app\forms\cms\FormPage;
use app\forms\cms\FormParam;
use app\models\cms\Page;
use app\models\cms\Param;
use app\structure\controllers\AdminController;
use app\structure\controllers\BackendPanelController;
use Yii;

class ParamController extends BackendPanelController
{
    public function actionIndex($configType = 'basic')
    {
        $this->data['configType'] = $this->query("SELECT
	* 
FROM
	cms_select_options t 
WHERE
	t.selectId IN ( SELECT t.id FROM cms_select t WHERE t.selectName = 'configType' ) 
ORDER BY
	t.sequencenumber ASC")->queryAll();

        $this->data['list'] = $this->query("select * from cms_config where configtype = :configType and themeid = :themeid")
            ->bindParam(":themeid",$this->data['defaultThemeId'])
            ->bindParam(":configType", $configType)->queryAll();

        $this->data['current'] = $configType;

        return $this->render('index', $this->data);
    }

    public function actionAdd()
    {
        $model = new FormParam();
        $model->id = 0;
        $this->data['model'] = $model;

        $this->setForm();

        return $this->render('edit', $this->data);
    }

    private function setForm()
    {
        $configType = $this->query("SELECT
	* 
FROM
	cms_select_options t 
WHERE
	t.selectId IN ( SELECT t.id FROM cms_select t WHERE t.selectName = 'configType' ) 
ORDER BY
	t.sequencenumber ASC")->queryAll();
        $configType_select = array();
        foreach ($configType as $item) {
            $configType_select[$item['optionValue']] = $item['optionDesc'];
        }
        $this->data['configType_select'] = $configType_select;
    }

    public function actionEdit()
    {
        $model = new FormParam();
        if ($model->load(Yii::$app->request->post())) {
            $model->setAttributes(['themeId' => $this->data['defaultThemeId']]);
            if ($model->validate()) {
                $exist = Param::find()->where(['cfgkey' => $model->attributes['cfgkey'], 'configtype' => $model->attributes['configtype']]
                )->andWhere(['!=', 'id', $model->id])->one();
                if($exist){
                    $model->addError('tips','不能使用相同类型的配置KEY');
                }else{
                    if ($model->id == 0) {
                        $param = new Param();
                        $param->setAttributes($model->attributes, false);
                        $param->save();
                        return $this->actionIndex($model->attributes['configtype']);
                    } else {
                        $param = Param::findOne($model->attributes['id']);
                        $param->setAttributes($model->attributes, false);
                        $param->save();
                        return $this->actionIndex($model->attributes['configtype']);
                    }
                }

            }
        }

        $this->setForm();
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

        $this->setForm();
        return $this->render('edit', $this->data);
    }

}

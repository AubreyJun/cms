<?php
namespace app\modules\cms\backend\controllers;

use app\forms\cms\FormLayout;
use app\forms\cms\FormNav;
use app\models\cms\Catalog;
use app\models\cms\Nav;
use app\models\cms\Param;
use app\structure\controllers\AdminController;
use app\structure\controllers\BackendPanelController;
use Yii;

class CatalogController extends BackendPanelController
{

    public function actionIndex()
    {

        $this->data['navgation'] = $this->getNavgation();

        return $this->render('index', $this->data);
    }



    public function actionUpdate($id){

        $nav = Nav::findOne($id);
        $this->data['nav'] = $nav;

        $model = new FormNav();
        $model->load($nav->attributes, '');
        $this->data['model'] = $model;

        $this->data['navgation'] = $this->getNavgation('cms');

        return $this->render('edit', $this->data);
    }

    public function actionAdd(){

        $model = new FormNav();
        $this->data['model'] = $model;

        $this->data['navgation'] = $this->getNavgation('cms');

        return $this->render('edit', $this->data);
    }

    public function actionDelete($id){

        $nav = Nav::findOne($id);
        $nav->deleted = 1;
        $nav->save();

        return $this->actionIndex();
    }


    public function actionEdit(){

        $model = new FormNav();
        if ($model->load(Yii::$app->request->post())) {
            $model->setAttributes(['themeId' => $this->data['defaultThemeId']]);
            $model->setAttributes(['catalogType'=>'cms']);
            if ($model->validate()) {
                if ($model->id == 0) {
                    $catalog = new Catalog();
                    $catalog->setAttributes($model->attributes,false);
                    $catalog->save();

                    $parentId = $model->attributes['parentId'];
                    $catalogPath = "";
                    if($parentId == 0 ){
                        $catalogPath = $catalog->attributes['id']."::";
                    }else{
                        $parentCatalog = Catalog::findOne($parentId);
                        $catalogPath = $parentCatalog->attributes["catalogPath"].$catalog->attributes['id']."::";
                    }

                    $catalog = Catalog::findOne($catalog->attributes['id']);
                    $catalog ->setAttributes(['catalogPath'=>$catalogPath],false);
                    $catalog->save();

                    return $this->actionIndex();
                }else{

                    if($model->attributes['id'] == $model->attributes['parentId']){
                        $model->addError('tips','上级导航不能选择自己');
                    }else{

                        $catalog = Catalog::findOne($model->attributes['id']);

                        $parentId = $model->attributes['parentId'];
                        $catalogPath = "";
                        if($parentId == 0 ){
                            $catalogPath = $catalog->attributes['id']."::";
                        }else{
                            $parentCatalog = Catalog::findOne($parentId);
                            $catalogPath = $parentCatalog->attributes["catalogPath"].$catalog->attributes['id']."::";
                        }

                        $catalog->setAttributes($model->attributes, false);
                        $catalog ->setAttributes(['catalogPath'=>$catalogPath],false);

                        $catalog->save();


                    }
                    return $this->actionIndex();
                }
            }
        }

        $this->data['navgation'] = $this->getNavgation($this->data['defaultThemeId']);
        $this->data['model'] = $model;

        return $this->render('edit', $this->data);

    }
}

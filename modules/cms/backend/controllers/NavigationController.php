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

class NavigationController extends BackendPanelController
{

    public function actionIndex()
    {

        $this->data['navgation'] = $this->getNavgation('navigation');

        return $this->render('index', $this->data);
    }



    public function actionUpdate($id){

        $this->setForm();

        $nav = Nav::findOne($id);
        $this->data['nav'] = $nav;

        $model = new FormNav();
        $model->setAttributes($nav->attributes, false);
        $this->data['model'] = $model;

        $this->data['navgation'] = $this->getNavgation('navigation');

        return $this->render('edit', $this->data);
    }

    private function setForm(){
        $navigationType = $this->query("SELECT
	* 
FROM
	cms_select_options t 
WHERE
	t.selectId IN ( SELECT t.id FROM cms_select t WHERE t.selectName = 'navigationType' ) 
ORDER BY
	t.sequencenumber ASC")->queryAll();
        $navigationType_select = array();
        foreach ($navigationType as $item){
            $navigationType_select[$item['optionValue']] = $item['optionDesc'];
        }
        $this->data['navigationType_select'] = $navigationType_select;

        $this->data['catalog_cms'] = $this->getNavgation('cms');
    }

    public function actionAdd(){

        $model = new FormNav();
        $this->data['model'] = $model;

        $this->data['navgation'] = $this->getNavgation('navigation');

        $this->setForm();

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

            $link = $_REQUEST['FormNav']['link'];
            $navigationType = $_REQUEST['FormNav']['navigationType'];
            $navigationRel = $_REQUEST['FormNav']['navigationRel'];

            $model->setAttributes(['catalogType'=>'navigation','link'=>$link,'navigationType'=>$navigationType,'navigationRel'=>$navigationRel],false);

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

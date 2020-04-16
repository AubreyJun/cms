<?php

namespace app\modules\cms\frontend\controllers;

use app\models\cms\frontend\Layout;
use app\structure\controllers\CmsFrontendController;
use yii\web\Controller;

class DefaultController extends CmsFrontendController
{
    public function actionIndex($pagePath='home')
    {
        return $this->show($pagePath);
    }

    public function actionVisual($id){

        $page = $this->query("SELECT * FROM `cms_theme_page` where id = :id ")
            ->bindParam(":id", $id)
            ->queryOne();
        $this->data['CMS_PAGE'] = $page;

        $layout = Layout::findOne($page['layoutId']);
        $this->data['CMS_LAYOUT'] = $layout;

        $this->data['EDITABLED'] = 1;
        $this->layout = '@app/views/rkcms/frontend-cms';

        $this->setForm();

        return $this->render('@app/views/rkcms/page', $this->data);
    }


    private function setForm(){
        $propOptions = array();
        $selectName = 'fragment_type';
        $propProperties = $this->query("SELECT
	* 
FROM
	cms_select_options t 
WHERE
	t.selectId IN ( SELECT t.id FROM cms_select t WHERE t.selectName = :selectName and t.themeId =0  ) 
ORDER BY
	t.sequencenumber ASC")
            ->bindParam(':selectName',$selectName)
            ->queryAll();
        foreach ($propProperties as $item){
            $itemObject = array();
            $itemObject['object'] = $item;
            $itemList = $this->query("select * from cms_fragment where fragmentType = :fragmentType order by sequencenumber asc")
                ->bindParam(":fragmentType",$item['optionValue'])->queryAll();
            $itemObject['list'] = $itemList;

            $propOptions[$item['optionValue']] = $itemObject;
        }
        $this->data['fragmentTypes'] = $propOptions;
    }
}

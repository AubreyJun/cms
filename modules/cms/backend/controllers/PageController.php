<?php


namespace app\modules\cms\backend\controllers;


use app\forms\cms\FormFragment;
use app\forms\cms\FormPage;
use app\models\cms\Fragment;
use app\models\cms\Layout;
use app\models\cms\Page;
use app\structure\controllers\AdminController;
use app\structure\controllers\BackendPanelController;
use Yii;

class PageController extends BackendPanelController
{
    public function actionIndex($pagetype='home')
    {
        $this->data['pageType'] = $this->query("SELECT
	* 
FROM
	cms_select_options t 
WHERE
	t.selectId IN ( SELECT t.id FROM cms_select t WHERE t.selectName = 'pageType' ) 
ORDER BY
	t.sequencenumber ASC")->queryAll();

        $this->data['list'] = $this->query("select * from cms_theme_page where pageType = :pagetype and themeId = :themeId")
            ->bindParam(":themeId", $this->data['editThemeId'])
            ->bindParam(":pagetype",$pagetype)->queryAll();

        $this->data['current'] = $pagetype;

        return $this->render('index', $this->data);
    }


    public function actionAdd(){
        $model = new FormPage();
        $model->id = 0;
        $this->data['model'] = $model;

        $this->setForm();

        return $this->render('edit', $this->data);
    }

    private function setForm(){
        $pageType = $this->query("SELECT
	* 
FROM
	cms_select_options t 
WHERE
	t.selectId IN ( SELECT t.id FROM cms_select t WHERE t.selectName = 'pageType' ) 
ORDER BY
	t.sequencenumber ASC")->queryAll();
        $pageType_select = array();
        foreach ($pageType as $item){
            $pageType_select[$item['optionValue']] = $item['optionDesc'];
        }
        $this->data['pageType_select'] = $pageType_select;


        $layouts = Layout::find()->where(['themeId'=>$this->data['defaultThemeId']])->all();
        $layout_select = array();
        foreach ($layouts as $layout){
            $layout_select[$layout['id']] = $layout['layoutName'];
        }
        $this->data['layout_select'] = $layout_select;

    }

    public function actionEdit(){
        $model = new FormPage();
        if ($model->load(Yii::$app->request->post())) {
            if (!isset($_POST['FormPage']['isDefault'])) {
                $model->setAttributes(['isDefault' => 0]);
            }
            $model->setAttributes(['themeId'=>$this->data['defaultThemeId']]);
            if ($model->validate()) {
                if ($model->id == 0) {
                    $page = new Page();
                    $page->setAttributes($model->attributes,false);
                    $page->save();
                    if($page['isDefault']==1){
                        $this->savePage($page['id']);
                        $page->setUnActive($page['id'],$page['pageType'],$this->data['editThemeId']);
                    }
                    return $this->actionIndex($model->attributes['pageType']);
                }else{
                    $page = Page::findOne($model->attributes['id']);

                    if($page->layout != $model->layout){
                        $page->widgetjson = null;
                    }

                    $page->setAttributes($model->attributes,false);
                    $page->save();
                    if($page['isDefault']==1){
                        $this->savePage($page['id']);
                        $page->setUnActive($page['id'],$page['pageType'],$this->data['editThemeId']);
                    }
                    return $this->actionIndex($model->attributes['pageType']);
                }
            }
        }

        $this->setForm();
        $this->data['model'] = $model;

        return $this->render('edit',$this->data);
    }

    public function actionSavewidget(){
        $id = $_REQUEST['id'];
        $widgetJSON = $_POST['widgetJSON'];

        $page = Page::findOne($id);
        $page->widgetjson = $widgetJSON;
        $page->save();

        return $this->redirect("index.php?r=cms-backend/page/widget&id=".$id);
    }

    public function actionWidget($id){

        $page = Page::findOne($id);
        $this->data['page'] = $page;

        $this->data['fragmentType'] = $this->query("SELECT
	* 
FROM
	cms_select_options t 
WHERE
	t.selectId IN ( SELECT t.id FROM cms_select t WHERE t.selectName = 'fragmentType' ) 
ORDER BY
	t.sequencenumber ASC")
            ->queryAll();

        $fragmentList = array();

        $fragmentKV = array();
        foreach ($this->data['fragmentType'] as $item) {
            $child = array();
            $fragmentKV[$item['optionValue']] = $item['optionDesc'];
            $child['type'] = $item;
            $child['list'] =  $this->query("select * from cms_theme_fragment where fragmentType = :fragmentType and themeId = :themeId")
                ->bindParam(":themeId", $this->data['editThemeId'])
                ->bindParam(":fragmentType", $item['optionValue'])->queryAll();
            $fragmentList[] = $child;
        }

        $this->data['fragmentKV'] = $fragmentKV;
        $this->data['fragmentList'] = $fragmentList;

        $layouts = $this->query("SELECT
	* 
FROM
	cms_select_options t 
WHERE
	t.selectId IN ( SELECT t.id FROM cms_select t WHERE t.selectName = 'layout' ) 
ORDER BY
	t.sequencenumber ASC")
            ->queryAll();

        $this->data['layouts'] = $layouts;

        $widgets = $this->query("SELECT
	* 
FROM
	cms_select_options t 
WHERE
	t.selectId IN ( SELECT t.id FROM cms_select t WHERE t.selectName = 'widget' ) 
ORDER BY
	t.sequencenumber ASC")
            ->queryAll();

        $this->data['widgets'] = $widgets;

        return $this->render('widget',$this->data);
    }

    private function savePage($pageId){
        $page = Page::findOne($pageId);
        $folderPath = Yii::$app->viewPath.'/themes/'. $this->data['defaultThemeName'];
        if(!file_exists($folderPath)){
            mkdir($folderPath);
        }
        $pageText = $page['pageText'];
        file_put_contents(Yii::$app->viewPath.'/themes/'. $this->data['defaultThemeName'].'/'.$page['pageType'].'_'.$page['id'].'.php',$pageText);
    }

    public function actionDelete($id){
        $page = Page::findOne($id);
        if($page){
            $page->delete();
        }
        return $this->actionIndex($page['pageType']);
    }

    public function actionUpdate($id){

        $page = Page::findOne($id);
        $model = new FormPage();
        $model->setAttributes($page->attributes,true);

        $this->data['model'] = $model;

        $this->setForm();
        return $this->render('edit', $this->data);
    }


    public function actionConfig($id){
        $page = Page::findOne($id);
        $this->data['page'] = $page;

        $model = new FormPage();
        $model->setAttributes($page->attributes,true);
        $this->data['model'] = $model;

        return $this->render('config', $this->data);
    }

    public function actionSaveconfig(){
        $model = new FormPage();
        if ($model->load(Yii::$app->request->post())) {
            $page = Page::findOne($model->id);
            $page->pageKey = $_POST['FormPage']['pageKey'];
            $page->save();
            return $this->actionIndex($page['pageType']);
        }
        return $this->actionIndex();
    }

    public function actionGetwidget(){
        $widgetType = $_REQUEST['widgetType'];

        $widgetList = $this->query("select * from cms_theme_fragment where fragmentType = :fragmentType and themeId = :themeId")
            ->bindParam(":fragmentType",$widgetType)
            ->bindParam(":themeId",$this->data['editThemeId'])
            ->queryAll();

        return json_encode($widgetList);
    }

}

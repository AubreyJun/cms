<?php


namespace app\modules\cms\backend\controllers;


use app\forms\cms\backend\FormFragment;
use app\forms\cms\backend\FormPage;
use app\models\cms\backend\BKLayout;
use app\models\cms\backend\BKPage;
use app\models\cms\Layout;
use app\models\cms\Page;
use app\structure\controllers\AdminController;
use app\structure\controllers\BackendPanelController;
use Yii;

class PageController extends BackendPanelController
{
    public function actionIndex($pagetype='home')
    {

        $this->data['list'] = $this->query("select * from cms_theme_page where themeId = :themeId")
            ->bindParam(":themeId", $this->data['editThemeId'])
            ->queryAll();

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
        $layouts = BkLayout::find()->where(['themeId'=>$this->data['editThemeId']])->all();
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
            $model->setAttributes(['themeId'=>$this->data['editThemeId']]);
            if ($model->validate()) {

                $pagePath = $model->pagePath;
                if($this->checkPath($pagePath,$model->id)){
                    if ($model->id == 0) {
                        $page = new BKPage();
                        $page->setAttributes($model->attributes,false);
                        $page->save();
                        return $this->actionIndex($model->attributes['pageType']);
                    }else{
                        $page = BKPage::findOne($model->attributes['id']);

                        $page->setAttributes($model->attributes,false);
                        $page->save();
                        return $this->actionIndex($model->attributes['pageType']);
                    }
                }else{
                    $model->addError('pagePath','网页路径不能重复');
                }
            }
        }

        $this->setForm();
        $this->data['model'] = $model;

        return $this->render('edit',$this->data);
    }

    public function checkPath($path,$id){
        $exist = BKPage::find()->where(['pagePath'=>$path,'themeId'=>$this->data['editThemeId']])->andWhere(['!=','id',$id])->one();
        if($exist){
            return false;
        }else{
            return true;
        }
    }

    public function actionSavewidget(){
        $id = $_REQUEST['id'];
        $widgetJSON = $_POST['widgetJSON'];

        $page = BKPage::findOne($id);
        $page->widgetjson = $widgetJSON;
        $page->save();

        return $this->redirect("index.php?r=cms-backend/page/widget&id=".$id);
    }

    public function actionWidget($id){

        $page = BKPage::findOne($id);
        $this->data['page'] = $page;

        $this->data['pagelist'] = $this->query("select * from cms_theme_page where themeId = :themeId")
            ->bindParam(":themeId", $this->data['editThemeId'])
            ->queryAll();

        return $this->render('widget',$this->data);
    }

    public function actionDelete($id){
        $page = BKPage::findOne($id);
        if($page){
            $page->delete();
        }
        return $this->redirect("index.php?r=cms-backend/page/index");
    }

    public function actionUpdate($id){

        $page = BKPage::findOne($id);
        $model = new FormPage();
        $model->setAttributes($page->attributes,true);

        $this->data['model'] = $model;

        $this->setForm();
        return $this->render('edit', $this->data);
    }


    public function actionConfig($id){
        $page = BKPage::findOne($id);
        $this->data['page'] = $page;

        $model = new FormPage();
        $model->setAttributes($page->attributes,true);
        $this->data['model'] = $model;

        return $this->render('config', $this->data);
    }

    public function actionSaveconfig(){
        $model = new FormPage();
        if ($model->load(Yii::$app->request->post())) {
            $page = BKPage::findOne($model->id);
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


    public function actionPreview(){

        $pageId = $_REQUEST['id'];
        $page = BKPage::findOne($pageId);

        $widgetJSON = $_POST['widgetJSON'];
        $page->widgetjson = $widgetJSON;

        $layout = BKLayout::findOne($page['layoutId']);
        $this->data['CMS_LAYOUT'] = $layout;
        $this->data['CMS_PAGE'] = $page;

        $this->layout = '@app/views/rkcms/frontend-cms';
        return $this->render('@app/views/rkcms/page', $this->data);
    }

    public function getImg($location,$max){
        return 'http://image.ranko.cn/'.$location.'/'.rand(1,$max).'.jpg';
    }

}

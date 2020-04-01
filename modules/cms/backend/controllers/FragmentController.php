<?php


namespace app\modules\cms\backend\controllers;


use app\forms\cms\backend\FormFragment;
use app\forms\cms\backend\FormArticle;
use app\forms\cms\backend\FormFileImage;
use app\models\cms\backend\BKFragment;
use app\models\cms\backend\BKLayout;
use app\structure\controllers\BackendPanelController;
use Yii;
use yii\helpers\FileHelper;

class FragmentController extends BackendPanelController
{

    public function actionIndex()
    {
        $fragmentList = $this->query("select * from cms_theme_fragment where  themeId = :themeId")
            ->bindParam(":themeId", $this->data['editThemeId'])->queryAll();
        $this->data['fragmentList'] = $fragmentList;

        return $this->render('index', $this->data);
    }

    public function actionAdd()
    {

        $model = new FormFragment();
        $model->id = 0;

        $this->data['model'] = $model;

        $filelist = FileHelper::findFiles(Yii::$app->viewPath."/template");
        $this->data['filelist'] = $filelist;

        return $this->render('edit', $this->data);
    }

    public function actionUpdate($id)
    {

        $fragment = BKFragment::findOne($id);
        $model = new FormFragment();
        $model->setAttributes($fragment->attributes, true);
        $this->data['model'] = $model;

        $filelist = FileHelper::findFiles(Yii::$app->viewPath."/template");
        $this->data['filelist'] = $filelist;

        $this->data['fragment'] = $fragment;

        return $this->render('edit', $this->data);
    }

    public function actionEdit()
    {

        $model = new FormFragment();
        if ($model->load(Yii::$app->request->post())) {
            $model->themeId = $this->data['editThemeId'];
            if ($model->validate()) {

                if ($model->id == 0) {
                    $fragment = new BKFragment();
                    $fragment->setAttributes($model->attributes, false);
                    $fragment->save();
                    $this->saveFragment($fragment['id']);
                    return $this->redirect("index.php?r=cms-backend/fragment/index");
                } else {
                    $fragment = BKFragment::findOne($model->attributes['id']);
                    $fragment->setAttributes($model->attributes, false);
                    $fragment->save();
                    $this->saveFragment($fragment['id']);
                    return $this->redirect("index.php?r=cms-backend/fragment/index");
                }
            }
        }

        $this->data['model'] = $model;
        return $this->render('edit', $this->data);

    }

    public function actionCopy($id){
        $fragment = BKFragment::findOne($id);
        $newFragment = new Fragment();
        $newFragment->setAttributes($fragment->attributes, false);
        $newFragment->fragmentName = "复制 - ".$newFragment->fragmentName;
        $newFragment->id = null;
        $newFragment->save();
        $this->saveFragment($newFragment['id']);
        return $this->redirect("index.php?r=cms-backend/fragment/index");
    }

    private function saveFragment($fragmentId){
        $fragment = BKFragment::findOne($fragmentId);
        $folderPath = Yii::$app->viewPath.'/fragment/';
        if(!file_exists($folderPath)){
            mkdir($folderPath);
        }
        $folderPath = $folderPath. $this->data['editThemeId'];
        if(!file_exists($folderPath)){
            mkdir($folderPath);
        }
        file_put_contents($folderPath.DIRECTORY_SEPARATOR.''.$fragment['id'].'.php',$fragment['body']);
    }

    private function saveFragmentTemp($editorValue){
        $folderPath = Yii::$app->viewPath.'/fragment/';
        if(!file_exists($folderPath)){
            mkdir($folderPath);
        }
        file_put_contents($folderPath.DIRECTORY_SEPARATOR.'temp.php',$editorValue);
    }

    public function actionGettemplate(){
        $path = $_POST['path'];
        if(file_exists($path)){
            echo file_get_contents($path);
        }else{
            echo "";
        }
    }

    public function actionPreview(){
        $layout = BkLayout::find()->where(['themeId'=> $this->data['editThemeId'],'review'=>1])->one();
        $this->data['CMS_LAYOUT'] = $layout;
        $this->data['REVIEW'] = 1;
        $this->layout = '@app/views/rkcms/frontend-cms';
        return $this->render("preview",$this->data);
    }

    public function actionDelete($id)
    {

        $fragment = $this->query("select * from cms_theme_fragment where id = :id")
            ->bindParam(":id", $id)
            ->queryOne();

        $this->query("delete from cms_theme_fragment where id = :id")
            ->bindParam(":id", $id)
            ->execute();

        return $this->actionIndex($fragment['fragmentType']);
    }

    public function actionGethtml(){
        $editorValue = $_REQUEST['editorValue'];
        $this->saveFragmentTemp($editorValue);
        return $this->renderFile("@app/views/fragment/temp.php");
    }

}

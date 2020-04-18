<?php


namespace app\modules\cms\backend\controllers;


use app\forms\cms\backend\FormFragment;
use app\forms\cms\backend\FormArticle;
use app\forms\cms\backend\FormFileImage;
use app\models\cms\backend\BKFragment;
use app\models\cms\backend\BKLayout;
use app\models\cms\backend\BKPage;
use app\structure\controllers\BackendPanelController;
use PythonicPHPFormatter;
use Yii;
use yii\helpers\FileHelper;

class FragmentController extends BackendPanelController
{

    public function actionIndex($pageId = 0)
    {

        $this->data['pagelist'] = $this->query("select * from cms_theme_page where themeId = :themeId")
            ->bindParam(":themeId", $this->data['editThemeId'])
            ->queryAll();
        $this->data['pageId'] = $pageId;

        $fragmentList = $this->query("select * from cms_theme_fragment where  themeId = :themeId and pageId = :pageId")
            ->bindParam(":themeId", $this->data['editThemeId'])
            ->bindParam(":pageId", $pageId)
            ->queryAll();
        $this->data['fragmentList'] = $fragmentList;

        return $this->render('index', $this->data);
    }

    public function actionAdd()
    {

        $model = new FormFragment();
        $model->id = 0;

        $this->data['model'] = $model;

        $this->setForm();

        return $this->render('edit', $this->data);
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

        $this->data['pagelist'] = $this->query("select * from cms_theme_page where themeId = :themeId")
            ->bindParam(":themeId", $this->data['editThemeId'])
            ->queryAll();
    }

    public function actionUpdate($id)
    {

        $fragment = BKFragment::findOne($id);
        $model = new FormFragment();
        $model->setAttributes($fragment->attributes, true);

        $body = $this->getFragment($id);
        $model->body = $body;

        $this->data['model'] = $model;
        $this->data['fragment'] = $fragment;

        $this->setForm();

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
                    $this->saveFragment($fragment['id'],$model->body);
                    return $this->redirect("index.php?r=cms-backend/fragment/index");
                } else {
                    $fragment = BKFragment::findOne($model->attributes['id']);
                    $fragment->setAttributes($model->attributes, false);
                    $fragment->save();
                    $this->saveFragment($fragment['id'],$model->body);
                    return $this->redirect("index.php?r=cms-backend/fragment/index");
                }
            }
        }

        $filelist = FileHelper::findFiles(Yii::$app->viewPath."/template");
        $this->data['filelist'] = $filelist;

        $this->data['model'] = $model;
        return $this->render('edit', $this->data);

    }

    public function actionCopy($id){
        $fragment = BKFragment::findOne($id);
        $newFragment = new BKFragment();
        $newFragment->setAttributes($fragment->attributes, false);
        $newFragment->fragmentName = $newFragment->fragmentName;
        $newFragment->id = null;
        $newFragment->save();

        $body = $this->getFragment($id);
        $this->saveFragment($newFragment['id'],$body);
        return $this->redirect("index.php?r=cms-backend/fragment/update&id=".$newFragment->id);
    }

    public function actionGetfragment(){
        $id = $_POST['id'];
        return $this->getFragment($id);
    }

    private function saveFragment($fragmentId,$body){

        $folderPath = Yii::$app->viewPath.'/fragment/';
        if(!file_exists($folderPath)){
            mkdir($folderPath);
        }
        $folderPath = $folderPath. $this->data['editThemeId'];
        if(!file_exists($folderPath)){
            mkdir($folderPath);
        }
        file_put_contents($folderPath.DIRECTORY_SEPARATOR.''.$fragmentId.'.php',$body);
    }

    private function getFragment($fragmentId){
        $fragment = BKFragment::findOne($fragmentId);
        $folderPath = Yii::$app->viewPath.'/fragment/';
        if(!file_exists($folderPath)){
            mkdir($folderPath);
        }
        $folderPath = $folderPath. $this->data['editThemeId'];
        if(!file_exists($folderPath)){
            mkdir($folderPath);
        }
        return file_get_contents($folderPath.DIRECTORY_SEPARATOR.''.$fragment['id'].'.php');
    }



    private function saveFragmentTemp($editorValue){
        $folderPath = Yii::$app->viewPath.'/fragment/';
        if(!file_exists($folderPath)){
            mkdir($folderPath);
        }
        file_put_contents($folderPath.DIRECTORY_SEPARATOR.'temp.php',$editorValue);
    }

    public function actionGettemplate(){
        $fragmentKey = $_POST['fragmentKey'];
        $path = Yii::$app->getViewPath().'/template/'.$fragmentKey.'.php';
        if(file_exists($path)){
            echo file_get_contents($path);
        }else{
            echo "";
        }
        exit();
    }

    public function actionGettemplatepiece(){
        $fragmentKey = $_POST['fragmentKey'];
        $path = Yii::$app->getViewPath().'/template/'.$fragmentKey.'.php';
        $body =  file_get_contents($path);

        $fragmentid = $_POST['fragmentid'];
        $pageId = $_POST['pageId'];
        $page = BKPage::findOne($pageId);

        $fragment = new BKFragment();
        $fragment->themeId = $page['themeId'];
        $fragment->fragmentName = 'sdfd';
        $fragment->pageId = $pageId;
        $fragment->save();
        $this->saveFragment($fragment['id'],$body);

        $widgetJson = $page['widgetjson'];
        $widgetList = json_decode($widgetJson,true);

        $newJson = array();
        foreach ($widgetList as $item){
            $newJson[] = $item;
            if($item==$fragmentid){
                $newJson[] = $fragment['id'];
            }
        }

        $page->widgetjson = json_encode($newJson);
        $page->save();

        $this->data['body'] = $body;
        $this->data['widget'] = $fragment['id'];
        $html = $this->renderPartial("gettemplatepiece",$this->data,true);

        $pieceObject = array(
            'html'=>$html,
            'id'=>$fragment['id']
        );

        echo json_encode($pieceObject);
    }

    public function actionPreview(){
        $layout = BkLayout::find()->where(['themeId'=> $this->data['editThemeId'],'review'=>1])->one();

        $this->data['CMS_LAYOUT'] = $layout;
        $this->data['REVIEW'] = 1;
        $this->layout = '@app/views/rkcms/frontend-cms-preview';

        $editValue = $_REQUEST['editValue'];
        $this->saveFragmentTemp($editValue);
        return $this->render("@app/views/fragment/temp.php",$this->data);
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

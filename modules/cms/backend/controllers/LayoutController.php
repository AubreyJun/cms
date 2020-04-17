<?php


namespace app\modules\cms\backend\controllers;

use app\forms\cms\backend\FormLayout;
use app\models\cms\backend\BKCmsFragment;
use app\models\cms\backend\BKFragment;
use app\models\cms\backend\BKLayout;
use app\models\cms\backend\BKPage;
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

    public function actionGettemplatepiece(){
        $fragmentKey = $_POST['fragmentKey'];
        $path = Yii::$app->getViewPath().'/template/'.$fragmentKey.'.php';
        $body =  file_get_contents($path);

        $fragmentid = $_POST['fragmentid'];
        $layoutId = $_POST['layoutId'];
        $layout = BkLayout::findOne($layoutId);

        $cmsfragment = BKCmsFragment::findBySql("select * from cms_fragment where fragmentKey = :fragmentKey",[':fragmentKey'=>$fragmentKey])->one();

        $fragment = new BKFragment();
        $fragment->themeId = $layout['themeId'];
        $fragment->fragmentName = $layout['layoutName'].'_'.$cmsfragment['fragmentName'];
        $fragment->pageId = 0;
        $fragment->save();
        $this->saveFragment($fragment['id'],$body);

        $widgetJson = $layout['widgetjson'];
        $widgetList = json_decode($widgetJson,true);

        $newJson = array();
        foreach ($widgetList as $item){
            $newJson[] = $item;
            if($item==$fragmentid){
                $newJson[] = $fragment['id'];
            }
        }

        $layout->widgetjson = json_encode($newJson);
        $layout->save();

        $this->data['body'] = $body;
        $this->data['widget'] = $fragment['id'];
        $html = $this->renderPartial("gettemplatepiece",$this->data,true);

        $pieceObject = array(
            'html'=>$html,
            'id'=>$fragment['id']
        );

        echo json_encode($pieceObject);
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

}

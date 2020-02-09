<?php


namespace app\modules\cms\backend\controllers;


use app\forms\cms\FormTheme;
use app\models\cms\Fragment;
use app\models\cms\Layout;
use app\models\cms\Page;
use app\models\cms\Theme;
use app\structure\constants\CmsErrorType;
use app\structure\constants\MsgType;
use app\structure\controllers\AdminController;
use app\structure\controllers\BackendPanelController;
use Yii;

class ThemeController extends BackendPanelController
{

    public function actionIndex($errortype = null)
    {

        if (!is_null($errortype)) {
            $this->data['error_message'] = $this->message($errortype, ErrorType::getMessage($errortype));
        }

        $this->data['list'] = $this->query("select * from cms_theme order by isActive desc")->queryAll();

        return $this->render('index', $this->data);
    }

    public function actionEdit($id = null)
    {
        $model = new FormTheme;

        $this->data['id'] = $id;

        if ($model->load(Yii::$app->request->post())) {
            if (!isset($_POST['FormTheme']['isActive'])) {
                $model->setAttributes(['isActive' => 0]);
            }
            if ($model->validate()) {
                if ($model->id == 0) {
                    $exist = Theme::find()
                        ->where(['themeKey' => $model->themeKey])
                        ->one();
                    if ($exist) {
                        $model->addError('themeKey', "KEY已经存在");
                        return $this->render('edit', [
                            'model' => $model, 'id' => $id
                        ]);
                    } else {
                        $theme = new Theme();
                        $theme->id = $model->id;
                        $theme->themeName = $model->themeName;
                        $theme->themeKey = $model->themeKey;
                        $theme->isActive = $model->isActive == null ? 0 : $model->isActive;
                        $theme->save();
                        $theme->setThemeUnActive($theme->id);
                        return $this->actionIndex();
                    }
                } else {
                    //update
                    $exist = Theme::find()
                        ->where(['themeKey' => $model->themeKey])->andWhere(['!=', 'id', $model->id])
                        ->one();
                    if ($exist) {
                        $model->addError('themeKey', "KEY已经存在");
                        return $this->render('edit', [
                            'model' => $model, 'id' => $id
                        ]);
                    } else {
                        if ($model->isActive == 0) {
                            $countOfActive = $this->query("select count(*) from cms_theme where id !=:id and isActive = 1")
                                ->bindParam(":id", $model->id)
                                ->queryScalar();
                            if ($countOfActive == 0) {
                                return $this->redirect("index.php?r=cms/theme/index&errortype=" . CmsErrorType::ACTIVE_DEFAULTTHEME);
                            }
                        }
                        $theme = Theme::findOne($model->id);
                        $theme->id = $model->id;
                        $theme->themeName = $model->themeName;
                        $theme->themeKey = $model->themeKey;
                        $theme->isActive = $model->isActive == null ? 0 : $model->isActive;
                        $theme->save();
                        $theme->setThemeUnActive($theme->id);
                        return $this->actionIndex();
                    }
                }
            }
        }

        return $this->render('edit', [
            'model' => $model, 'id' => $id
        ]);
    }

    public function actionUpdate($id)
    {
        $model = new FormTheme;

        $theme = Theme::findOne($id);
        $model->setAttributes($theme->attributes);

        return $this->render('edit', [
            'model' => $model, 'id' => $id
        ]);
    }

    public function actionDelete($id)
    {
        $countOfActive = $this->query("select count(*) from cms_theme where id !=:id ")
            ->bindParam(":id", $id)
            ->queryScalar();
        if ($countOfActive == 0) {
            return $this->redirect("index.php?r=cms/theme/index&errortype=" . CmsErrorType::EMPTY_THEME);
        }
        $theme = Theme::findOne($id);
        if ($theme) {
            $this->query("delete from cms_theme_layout where themeId = :themeId")->bindParam(":themeId",$id)->execute();
            $this->query("delete from cms_theme_page where themeId = :themeId")->bindParam(":themeId",$id)->execute();
            $theme->delete();
        }

        return $this->actionIndex();
    }

    public function actionRefresh($id){
        $theme = Theme::findOne($id);

        $layouts = Layout::find()->where(['themeId'=>$theme['id']])->All();
        if(sizeof($layouts)>0){
            foreach ($layouts as $layout){
                $this->saveLayout($layout,$theme);
            }
        }

        $pages = Page::find()->where(['themeId'=>$theme['id']])->All();
        if(sizeof($pages)>0){
            foreach ($pages as $page){
                $this->savePage($page,$theme);
            }
        }

        echo json_encode($this->message(MsgType::SUCCESS,'模板缓存刷新完成'));

    }

    function actionReset($id){
        $theme = Theme::findOne($id);

        $layouts = Layout::find()->where(['themeId'=>$theme['id']])->All();
        if(sizeof($layouts)>0){
            foreach ($layouts as $layout){
                $this->resetLayout($layout,$theme);
            }
        }

        $pages = Page::find()->where(['themeId'=>$theme['id']])->All();
        if(sizeof($pages)>0){
            foreach ($pages as $page){
                $this->resetPage($page,$theme);
            }
        }

        echo json_encode($this->message(MsgType::SUCCESS,'模板逆向同步完成'));

    }


    private function saveLayout($layout,$theme){
        $themeName = $theme['themeKey'].'_'.$theme['id'];
        $folderPath = Yii::$app->viewPath.'/themes/'.$themeName;
        if(!file_exists($folderPath)){
            mkdir($folderPath);
        }
        $layoutPath = $folderPath.'/layouts';
        if(!file_exists($layoutPath)){
            mkdir($layoutPath);
        }
        file_put_contents(Yii::$app->viewPath.'/themes/'.$themeName.'/layouts'.'/layout_'.$layout['id'].'.php',$layout['layoutText']);
    }

    private function resetLayout($layout,$theme){

        $themeName = $theme['themeKey'].'_'.$theme['id'];
        $folderPath = Yii::$app->viewPath.'/themes/'.$themeName;
        if(!file_exists($folderPath)){
            mkdir($folderPath);
        }
        $layoutPath = $folderPath.'/layouts';
        if(!file_exists($layoutPath)){
            mkdir($layoutPath);
        }
        $layoutPath = Yii::$app->viewPath.'/themes/'.$themeName.'/layouts'.'/layout_'.$layout['id'].'.php';

        $content = file_get_contents($layoutPath);
        $id = $layout['id'];

        $this->query("update cms_theme_layout set layoutText = :content where id = :id")
            ->bindParam(":content",$content)
            ->bindParam(":id",$id)
            ->execute();
    }

    private function resetPage($page,$theme){
        $content = file_get_contents(Yii::$app->viewPath.'/themes/'. $this->data['defaultThemeName'].'/'.$page['pageType'].'_'.$page['id'].'.php');

        $id = $page['id'];
        $this->query("update cms_theme_page set pageText = :content where id = :id")
            ->bindParam(":content",$content)
            ->bindParam(":id",$id)
            ->execute();
    }

    private function savePage($page,$theme){
        $themeName = $theme['themeKey'].'_'.$theme['id'];
        $folderPath = Yii::$app->viewPath.'/themes/'.$theme['themeKey'];
        if(!file_exists($folderPath)){
            mkdir($folderPath);
        }
        $pageText = $page['pageText'];
        $pageText .= '<input type=\'hidden\' id="_csrf" value="<?php echo Yii::$app->request->csrfToken; ?>"/>';
        file_put_contents(Yii::$app->viewPath.'/themes/'.$themeName.'/page_'.$page['id'].'.php',$pageText);
    }



}

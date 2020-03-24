<?php


namespace app\modules\cms\backend\controllers;


use app\forms\cms\backend\FormFragment;
use app\forms\cms\FormArticle;
use app\forms\cms\FormFileImage;
use app\models\cms\Article;
use app\models\cms\Fragment;
use app\models\cms\PostTag;
use app\structure\controllers\BackendPanelController;
use Yii;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

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

        return $this->render('edit', $this->data);
    }

    public function actionUpdate($id)
    {

        $fragment = Fragment::findOne($id);
        $model = new FormFragment();
        $model->setAttributes($fragment->attributes, true);
        $this->data['model'] = $model;

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
                    $fragment = new Fragment();
                    $fragment->setAttributes($model->attributes, false);
                    $fragment->save();
                    return $this->redirect("index.php?r=cms-backend/fragment/index");
                } else {
                    $fragment = Fragment::findOne($model->attributes['id']);
                    $fragment->setAttributes($model->attributes, false);
                    $fragment->save();
                    return $this->redirect("index.php?r=cms-backend/fragment/index");
                }
            }
        }

        $this->data['model'] = $model;
        return $this->render('edit', $this->data);

    }

    public function actionCopy($id){
        $fragment = Fragment::findOne($id);
        $newFragment = new Fragment();
        $newFragment->setAttributes($fragment->attributes, false);
        $newFragment->fragmentName = "复制 - ".$newFragment->fragmentName;
        $newFragment->id = null;
        $newFragment->save();
        return $this->redirect("index.php?r=cms-backend/fragment/index");
    }

    public function actionConfig($id)
    {

        $this->data['id'] = $id;

        $fragmentProps = $this->query("select * from cms_theme_fragment_prop where fragmentId = :fragmentId")
            ->bindParam(":fragmentId", $id)
            ->queryAll();
        $this->data['fragmentProps'] = $fragmentProps;

        return $this->render('config', $this->data);
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

}

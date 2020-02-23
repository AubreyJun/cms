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
use yii\web\UploadedFile;

class FragmentController extends BackendPanelController
{

    public function actionIndex()
    {

        $fragmentList = array();

        $this->data['fragmentType'] = $this->query("SELECT
	* 
FROM
	cms_select_options t 
WHERE
	t.selectId IN ( SELECT t.id FROM cms_select t WHERE t.selectName = 'fragmentType' ) 
ORDER BY
	t.sequencenumber ASC")
            ->queryAll();

        $fragmentKV = array();
        foreach ($this->data['fragmentType'] as $item) {
            $fragmentKV[$item['optionValue']] = $item['optionDesc'];

            $fragmentItem = array();
            $fragmentItem['type'] = $item;
            $fragmentItem['list'] = $this->query("select * from cms_theme_fragment where fragmentType = :fragmentType and themeId = :themeId")
                ->bindParam(":themeId", $this->data['editThemeId'])
                ->bindParam(":fragmentType", $item['optionValue'])->queryAll();
            $fragmentList[] = $fragmentItem;
        }
        $this->data['fragmentKV'] = $fragmentKV;
        $this->data['fragmentList'] = $fragmentList;

        return $this->render('index', $this->data);
    }

    private function setForm(){

        $this->data['fragmentType'] = $this->query("SELECT
	* 
FROM
	cms_select_options t 
WHERE
	t.selectId IN ( SELECT t.id FROM cms_select t WHERE t.selectName = 'fragmentType' ) 
ORDER BY
	t.sequencenumber ASC")
            ->queryAll();

        $fragmentKV = array();
        foreach ($this->data['fragmentType'] as $item) {
            $fragmentKV[$item['optionValue']] = $item['optionDesc'];
        }
        $this->data['fragmentKV'] = $fragmentKV;
    }

    public function actionAdd($fragmentType)
    {

        $this->setForm();
        $model = new FormFragment();
        $model->fragmentType = $fragmentType;
        $model->id = 0;
        $this->data['model'] = $model;

        $this->data['fragmentType'] = $fragmentType;

        return $this->render("edit", $this->data);
    }

    public function actionCopyconfig($fragmentId, $id)
    {
        $this->query("insert into cms_theme_fragment_prop (fragmentId,ppKey,ppValue) select fragmentId,ppKey,ppValue 
from cms_theme_fragment_prop where fragmentId = :fragmentId and id =:id")
            ->bindParam(":fragmentId", $fragmentId)
            ->bindParam(":id", $id)
            ->execute();

        return $this->redirect("index.php?r=cms-backend/fragment/config&id=".$fragmentId);
    }

    public function actionUpdate($id)
    {

        $this->setForm();
        $fragment = Fragment::findOne($id);
        $model = new FormFragment();
        $model->setAttributes($fragment->attributes, true);
        $this->data['model'] = $model;

        return $this->render('edit', $this->data);
    }

    public function actionEdit()
    {

        $this->setForm();
        $model = new FormFragment();
        if ($model->load(Yii::$app->request->post())) {
            $model->themeId = $this->data['editThemeId'];
            if ($model->validate()) {

                if ($model->id == 0) {
                    $fragment = new Fragment();
                    $fragment->setAttributes($model->attributes, false);
                    $fragment->save();
                    return $this->actionIndex($model->attributes['fragmentType']);
                } else {
                    $fragment = Fragment::findOne($model->attributes['id']);
                    $fragment->setAttributes($model->attributes, false);
                    $fragment->save();
                    return $this->actionIndex($model->attributes['fragmentType']);
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

    public function actionSaveconfig()
    {
        $id = $_REQUEST['id'];
        $fragmentId = $_REQUEST['fragmentId'];
        $ppKey = $_REQUEST['ppKey'];
        $ppValue = $_REQUEST['ppValue'];

        if ($id == 0) {
            $this->query("insert into cms_theme_fragment_prop (fragmentId,ppKey,ppValue,createtime) values (:fragmentId,:ppKey,:ppValue,now())")
                ->bindParam(":fragmentId", $fragmentId)
                ->bindParam(":ppKey", $ppKey)
                ->bindParam(":ppValue", $ppValue)
                ->execute();
        } else {
            $this->query("update cms_theme_fragment_prop set ppKey = :ppKey, ppValue = :ppValue where id = :id")
                ->bindParam(":id", $id)
                ->bindParam(":ppKey", $ppKey)
                ->bindParam(":ppValue", $ppValue)
                ->execute();
        }

        return $this->redirect("index.php?r=cms-backend/fragment/config&id=" . $fragmentId);

    }

    public function actionDeleteconfig($id, $fragmentId)
    {

        $this->query("delete from cms_theme_fragment_prop where id = :id")
            ->bindParam(":id", $id)
            ->execute();

        return $this->redirect("index.php?r=cms-backend/fragment/config&id=" . $fragmentId);
    }

    public function actionUpdateconfig($id, $fragmentId)
    {

        $props = $this->query("select * from cms_theme_fragment_prop where id = :id")
            ->bindParam(":id", $id)
            ->queryOne();
        $this->data['props'] = $props;

        return $this->actionConfig($fragmentId);

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

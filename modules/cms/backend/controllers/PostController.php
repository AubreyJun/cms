<?php

namespace app\modules\cms\backend\controllers;

use app\forms\cms\FormArticle;
use app\forms\cms\FormPage;
use app\forms\cms\FormParam;
use app\models\cms\Article;
use app\models\cms\Layout;
use app\models\cms\Page;
use app\models\cms\Param;
use app\models\cms\Post;
use app\models\cms\PostProp;
use app\models\cms\PostTag;
use app\structure\controllers\AdminController;
use app\structure\controllers\BackendPanelController;
use Yii;

class PostController extends BackendPanelController
{
    public function actionIndex($queryPostType = 'article')
    {
        $this->data['queryPostType'] = $queryPostType;
        $this->getPost($queryPostType);

        $this->data['contentType'] = $this->query("SELECT
	* 
FROM
	cms_select_options t 
WHERE
	t.selectId IN ( SELECT t.id FROM cms_select t WHERE t.selectName = 'contentType' ) 
ORDER BY
	t.sequencenumber ASC")->queryAll();

        return $this->render('index',$this->data);
    }

    private function setForm(){
        $contentType = $this->query("SELECT
	* 
FROM
	cms_select_options t 
WHERE
	t.selectId IN ( SELECT t.id FROM cms_select t WHERE t.selectName = 'contentType' ) 
ORDER BY
	t.sequencenumber ASC")->queryAll();
        $contentType_select = array();
        foreach ($contentType as $item){
            $contentType_select[$item['optionValue']] = $item['optionDesc'];
        }
        $this->data['contentType_select'] = $contentType_select;

        $this->data['navgation'] = $this->getNavgation('cms');
    }


    public function actionAdd(){

        $model = new FormArticle();
        $model->id = 0;
        $this->data['model'] = $model;

        $this->setForm();

        return $this->render('edit', $this->data);
    }

    public function actionEdit(){
        $model = new FormArticle();
        if ($model->load(Yii::$app->request->post())) {

            $model->themeid = $this->data['editThemeId'];

            if ($model->validate()) {
                $model->tags = $_POST['FormArticle']['tags'];

                if ($model->id == 0) {
                    $article = new Article();
                    $article->setAttributes($model->attributes, false);
                    $article->save();
                    $this->savePostTags($article->id,$model->tags);
                    return $this->actionIndex($model->attributes['postType']);
                } else {
                    PostTag::deleteAll(['postId'=>$model->id]);

                    $article = Article::findOne($model->attributes['id']);
                    $article->setAttributes($model->attributes, false);
                    $article->save();

                    $this->savePostTags($model->id,$model->tags);

                    return $this->actionIndex($model->attributes['postType']);
                }
            }
        }

        $this->setForm();

        $this->data['model'] = $model;
        return $this->render('edit', $this->data);
    }

    private function savePostTags($postId,$tags){
        if($tags!=''){
            $tagsList = explode(",",$tags);
            foreach ($tagsList as $item){
                $tag = new PostTag();
                $tag->postId = $postId;
                $tag->tag = $item;
                $tag->save();
            }
        }
    }

    public function actionDelete($id){
        $article = Article::findOne($id);
        if($article){
            $article->delete();
        }
        return $this->actionIndex();
    }

    public function actionUpdate($id){

        $article = Article::findOne($id);
        $model = new FormArticle();
        $model->setAttributes($article->attributes,true);
        $model->tags = $article['tags'];
        $this->data['model'] = $model;

        $this->setForm();

        return $this->render('edit', $this->data);
    }

    public function actionCopy($id){
        $article = Article::findOne($id);

        $this->query("INSERT INTO cms_post ( `title`, `content`, `summary`, `keywords`, `tags`, `createtime`, `updatetime`, `postType`, `status`, `catalogId`,themeid ) SELECT
`title`,
`content`,
`summary`,
`keywords`,
`tags`,
`createtime`,
`updatetime`,
`postType`,
`status`,
`catalogId` ,
`themeid` 
FROM
	cms_post where id = :id")
            ->bindParam(":id",$id)->execute();

        $lastId = Yii::$app->db->getLastInsertID();

        $this->query("INSERT INTO cms_post_prop ( `postId`, `ppKey`, `ppValue` ) SELECT
:lastId, `ppKey`, `ppValue`
FROM
	cms_post_prop where postId = :postId")->bindParam(":postId",$id)
            ->bindParam(":lastId",$lastId)
            ->execute();


        $this->query("INSERT INTO cms_post_tag ( `tag`, `postId` ) SELECT
`tag`, :lastId
FROM
	cms_post_tag where postId = :postId")->bindParam(":postId",$id)->bindParam(":lastId",$lastId)->execute();


        return $this->actionIndex($article['postType']);
    }

    public function actionConfig($id){
        $post = Post::findOne($id);
        $this->data['post'] = $post;

        $props = PostProp::findAll(['postId'=>$id]);
        $propKV = array();
        foreach ($props as $prop){
            $propKV[$prop['ppKey']] = $prop['ppValue'];
        }
        $this->data['propKV'] = $propKV;

        $propOptions = array();
        $selectName = $post['postType'].'_properties';
        $propProperties = $this->query("SELECT
	* 
FROM
	cms_select_options t 
WHERE
	t.selectId IN ( SELECT t.id FROM cms_select t WHERE t.selectName = :selectName and t.themeId = :themeId ) 
ORDER BY
	t.sequencenumber ASC")
            ->bindParam(':themeId',$this->data['editThemeId'])
            ->bindParam(':selectName',$selectName)
            ->queryAll();
        foreach ($propProperties as $item){
            $propOptions[$item['optionValue']] = $item;
        }
        $this->data['propOptions'] = $propOptions;

        return $this->render('config', $this->data);
    }

    public function actionSaveconfig(){
        $id = $_POST['id'];
        $post = Post::findOne($id);
        $this->data['post'] = $post;

        PostProp::deleteAll(['postId'=>$id]);
        $selectName = $post['postType'].'_properties';
        $propProperties = $this->query("SELECT
	* 
FROM
	cms_select_options t 
WHERE
	t.selectId IN ( SELECT t.id FROM cms_select t WHERE t.selectName = :selectName ) 
ORDER BY
	t.sequencenumber ASC")
            ->bindParam(':selectName',$selectName)
            ->queryAll();
        foreach ($propProperties as $item){
            $postProp = new PostProp();
            $postProp->postId = $id;
            $postProp->ppKey = $item['optionValue'];
            $postProp->ppValue = $_POST[$item['optionValue']];
            $postProp->save();
        }

        return $this->actionIndex($post['postType']);

    }

}

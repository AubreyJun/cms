<?php


namespace app\structure\controllers;

use app\models\cms\Post;
use app\structure\constants\BackendKeyPrefix;
use Yii;
use yii\data\Pagination;

class BackendBaseController extends AppController
{

    public $cache = null;
    public $userId = null;



    public function init()
    {
        parent::init();
        $this->startUp();
    }

    public function startUp()
    {
        $this->layout = '//admin-login';
        $this->setDb();
        $this->setCache();
        $this->setParam();
    }

    public function setDb()
    {
        $this->db = Yii::$app->db;
    }

    public function setCache(){
        $this->cache = Yii::$app->cache;
    }

    public function setParam()
    {
        $this->data['error_message'] = null;

        $defaultTheme = $this->query("select id,themeKey from cms_theme where isActive = 1 ")->queryOne();
        $this->data['defaultThemeId'] = $defaultTheme['id'];
        $this->data['defaultThemeName'] = $defaultTheme['themeKey'].'_'.$defaultTheme['id'];

        $user = Yii::$app->user;
        $this->userId = $user->id;

        if($this->cache->exists(BackendKeyPrefix::SIDERBAR.$user->id)){
            $this->data['siderBarClass'] = 'sidebar-icon-only';
        }else{
            $this->data['siderBarClass'] = '';
        }

        $this->data['pluginList'] = $this->query("select * from cms_plugin where menu = 1 and status ='active'")->queryAll();
    }


    public function getPost($postType,$pageSize=10){
        $query = Post::find()->where(['postType' => $postType]);
        $count = $query->count();
        $post_pagination = new Pagination(['totalCount' => $count]);
        $post_pagination->pageSize = $pageSize;
        $post_list = $query->offset($post_pagination->offset)
            ->limit($post_pagination->limit)
            ->all();
        $this->data['post_pagination'] = $post_pagination;
        $this->data['post_list'] = $post_list;
    }

    public function getNavgation($themeId){

        $navgation = array();

        $topNavgation = $this->query("SELECT
	cc.*,
	( SELECT count( * ) FROM cms_catalog WHERE parentId = cc.id ) cld 
FROM
	cms_catalog cc 
WHERE
	parentid = 0 
	AND themeId = :themeId
	AND deleted = 0 
ORDER BY
	sequencenumber ASC")
            ->bindParam(":themeId",$themeId)
            ->queryAll();
        $level = 1;
        foreach ($topNavgation as $item){
            if($item['cld']>0){
                $children = $this->getNavgationChildren($item['id'],$themeId,$level);
                $navgation[] = array(
                    'object'=>$item,
                    'children'=>$children,
                    'level'=>$level
                );
            }else{
                $navgation[] = array(
                    'object'=>$item,
                    'level'=>$level
                );
            }
        }

        return $navgation;
    }

    private function getNavgationChildren($itemId,$themeId,$level){
        $level ++;

        $childrenArray = array();

        $children = $this->query("SELECT
	cc.*,
	( SELECT count( * ) FROM cms_catalog WHERE parentId = cc.id ) cld 
FROM
	cms_catalog cc 
WHERE
	parentid = :parentId 
	AND themeId = :themeId
	AND deleted = 0 
ORDER BY
	sequencenumber ASC")
            ->bindParam(":themeId",$themeId)
            ->bindParam(":parentId",$itemId)
            ->queryAll();

        foreach ($children as $child){
            if($child['cld']>0){
                $childrenSub = $this->getNavgationChildren($child['id'],$themeId,$level);
                $childrenArray[] = array(
                    'object'=>$child,
                    'children'=>$childrenSub,
                    'level'=>$level
                );
            }else{
                $childrenArray[] = array(
                    'object'=>$child,
                    'level'=>$level
                );
            }
        }

        return $childrenArray;

    }

}
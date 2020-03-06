<?php


namespace app\structure\controllers;


use app\structure\constants\BackendKeyPrefix;
use app\models\cms\Post;
use Yii;
use yii\data\Pagination;

class BackendPanelController extends AppController
{

    public $cache = null;
    public $userId = null;

    public function behaviors()
    {
        return [
            [
                'class' => 'app\structure\filter\BackendSessionFilter'
            ]
        ];
    }


    public function init()
    {
        parent::init();
        $this->startUp();
    }

    public function startUp()
    {
        $this->layout = '//backend-panel';
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

        $defaultTheme = $this->query("select id,themeKey,themeName from cms_theme where isActive = 1 ")->queryOne();

        $editTheme = $this->query("select id,themeKey,themeName from cms_theme where isEdit = 1 ")->queryOne();
        if($editTheme==null){
            $this->data['editThemeId'] = $defaultTheme['id'];

            $this->data['defaultTheme'] = $defaultTheme;
            $this->data['defaultThemeId'] = $defaultTheme['id'];
            $this->data['defaultThemeName'] = $defaultTheme['themeKey'].'_'.$defaultTheme['id'];
        }else{
            $this->data['editThemeId'] = $editTheme['id'];

            $this->data['defaultTheme'] = $editTheme;
            $this->data['defaultThemeId'] = $editTheme['id'];
            $this->data['defaultThemeName'] = $editTheme['themeKey'].'_'.$editTheme['id'];
        }





        $user = Yii::$app->user;
        $this->userId = $user->id;

        if($this->cache->exists(BackendKeyPrefix::SIDERBAR.$user->id)){
            $this->data['siderBarClass'] = 'sidebar-icon-only';
        }else{
            $this->data['siderBarClass'] = '';
        }

        $this->data['pluginList'] = $this->query("select * from cms_plugin where menu = 1 and status ='active' ")
            ->queryAll();

        $_SESSION['LOGIN'] = 1;

        $this->data['themeList'] = $this->query("select * from cms_theme")->queryAll();
    }


    public function getPost($postType,$pageSize=10){
        $query = Post::find()->where(['postType' => $postType,'themeid'=>$this->data['defaultThemeId']]);
        $count = $query->count();
        $post_pagination = new Pagination(['totalCount' => $count]);
        $post_pagination->pageSize = $pageSize;
        $post_list = $query->offset($post_pagination->offset)
            ->limit($post_pagination->limit)
            ->all();
        $this->data['post_pagination'] = $post_pagination;
        $this->data['post_list'] = $post_list;
    }

    public function getNavgation($catalogType){

        $navgation = array();

        $topNavgation = $this->query("SELECT
	cc.*,
	( SELECT count( * ) FROM cms_catalog WHERE parentId = cc.id ) cld 
FROM
	cms_catalog cc 
WHERE
	parentid = 0 
	AND deleted = 0 
	and themeId = :themeId and catalogType = :catalogType
ORDER BY
	sequencenumber ASC")
            ->bindParam(":themeId",$this->data['defaultThemeId'])
            ->bindParam(":catalogType",$catalogType)
            ->queryAll();
        $level = 1;
        foreach ($topNavgation as $item){
            if($item['cld']>0){
                $children = $this->getNavgationChildren($item['id'],$level,$catalogType);
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

    private function getNavgationChildren($itemId,$level,$catalogType){
        $level ++;

        $childrenArray = array();

        $children = $this->query("SELECT
	cc.*,
	( SELECT count( * ) FROM cms_catalog WHERE parentId = cc.id ) cld 
FROM
	cms_catalog cc 
WHERE
	parentid = :parentId  and catalogType = :catalogType
	AND deleted = 0 
ORDER BY
	sequencenumber ASC")
            ->bindParam(":parentId",$itemId)
            ->bindParam(":catalogType",$catalogType)
            ->queryAll();

        foreach ($children as $child){
            if($child['cld']>0){
                $childrenSub = $this->getNavgationChildren($child['id'],$level,$catalogType);
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

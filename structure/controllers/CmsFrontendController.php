<?php


namespace app\structure\controllers;


use app\components\cms\PageMetaWidget;
use app\models\cms\Fragment;
use app\models\cms\Layout;
use app\structure\constants\MsgType;
use Yii;
use yii\data\Pagination;

class CmsFrontendController extends AppController
{

    public $defaultTheme = null;
    public $pageId = 0;
    public $pageType = null;
    private $app_config = array();
    private $demo = false;

    public function init()
    {
        parent::init();
        $this->startUp();
    }

    public function startUp()
    {
        $this->setDb();
        $this->setParam();

    }

    public function setDb()
    {
        $this->db = Yii::$app->db;
    }

    public function setParam()
    {
        if(isset(Yii::$app->params['demo'])){
            $demo = Yii::$app->params['demo'];
        }

        if($demo){
            $host = $_SERVER['HTTP_HOST'];
            $themeKey = Yii::$app->params['themeids'][$host];
            $this->defaultTheme = $this->query("select * from cms_theme t where t.themeKey = :themeKey")
                ->bindParam(":themeKey", $themeKey)
                ->queryOne();
        }else{
            //主题设置
            $this->defaultTheme = $this->query("select * from cms_theme t where t.isActive = 1")->queryOne();
        }


        //系统参数设置
        $configs = $this->query("select * from cms_config t where t.themeId = :themeId")
            ->bindParam(":themeId", $this->defaultTheme['id'])
            ->queryAll();
        foreach ($configs as $config) {
            $this->app_config[$config['themeId'] . '-' . $config['configtype'] . '-' . $config['cfgkey']] = $config['cfgvalue'];
        }
    }

    public function getConfig($configtype, $configKey)
    {
        if (isset($this->app_config[$this->defaultTheme['id'] . '-' . $configtype . '-' . $configKey])) {
            return $this->app_config[$this->defaultTheme['id'] . '-' . $configtype . '-' . $configKey];
        } else {
            return "";
        }
    }

    public function show($pageType)
    {
        if ($pageType == null) {
            $pageType = 'home';
        }

        $this->pageType = $pageType;

        $page = $this->getPage($pageType);
        if ($page == false) {
            $message = $this->message(MsgType::ERROR, '页面没有配置！页面类型：' . $pageType);
            return $this->errorPage($message);
        } else {

            $layout = Layout::findOne($page['id']);

            $this->data['CMS_PAGE'] = $page;
            $this->data['CMS_LAYOUT'] = $layout;

            $this->layout = '@app/views/layouts/frontend-cms';
            return $this->render('@app/views/rkcms/page', $this->data);
        }
    }

    public function errorPage($message)
    {
        $this->layout = "//content";
        $this->data['message'] = $message;
        return $this->render('@app/views/site/error', $this->data);
    }

    public function getPage($pageType)
    {
        if ($this->pageId == 0) {
            return $this->query("SELECT * FROM `cms_theme_page` where pageType = :pageType and isDefault = 1 and themeId = :themeId")
                ->bindParam(":themeId", $this->defaultTheme['id'])
                ->bindParam(":pageType", $pageType)
                ->queryOne();
        } else {
            return $this->query("SELECT * FROM `cms_theme_page` where pageType = :pageType and id = :pageId and themeId = :themeId")
                ->bindParam(":themeId", $this->defaultTheme['id'])
                ->bindParam(":pageType", $pageType)
                ->bindParam(":pageId", $this->pageId)
                ->queryOne();
        }


    }

    public function getPost($postType, $catalogId, $pageSize = 10)
    {
        $postArray = array();

        $catalogPath = '%' . $catalogId . '::%';
        $count = $this->query("SELECT
count(*) 
FROM
	cms_post c_p
	LEFT JOIN cms_catalog c_c ON c_p.catalogId = c_c.id 
WHERE
	c_c.catalogPath LIKE :catalogPath and c_p.postType = :postType")
            ->bindParam(":catalogPath", $catalogPath)
            ->bindParam(":postType", $postType)->queryScalar();
        $post_pagination = new Pagination(['totalCount' => $count]);
        $post_pagination->pageSize = $pageSize;
        $offset = $post_pagination->getOffset();
        $limit = $post_pagination->getLimit();

        $post_list = $this->query("SELECT
	c_p.*,
	c_c.catalogPath 
FROM
	cms_post c_p
	LEFT JOIN cms_catalog c_c ON c_p.catalogId = c_c.id 
WHERE
	c_c.catalogPath LIKE :catalogPath and c_p.postType = :postType limit :offset,:limit")
            ->bindParam(":catalogPath", $catalogPath)
            ->bindParam(":postType", $postType)
            ->bindParam(":offset", $offset)
            ->bindParam(":limit", $limit)
            ->queryAll();

        $postArray['post_list'] = $post_list;
        $postArray['post_pagination'] = $post_pagination;

        return $postArray;
    }

    public function getPostInfo($postId)
    {
        $postobj = array();

        $obj = $this->query("select * from cms_post t where t.id = :id")
            ->bindParam(":id", $postId)
            ->queryOne();
        $postobj['obj'] = $obj;

        $prop = array();
        $prop_list = $this->query("select * from cms_post_prop t where t.postId = :id")->bindParam(":id", $postId)->queryAll();
        foreach ($prop_list as $item) {
            $prop[$item['ppKey']] = $item['ppValue'];
        }
        $postobj['prop'] = $prop;


        $tags = $this->query("select * from cms_post_tag t where t.postId = :id")->bindParam(":id", $postId)->queryAll();
        $postobj['tags'] = $tags;

        return $postobj;
    }

    public function getPostInfoByCatalogId($catalogId)
    {
        return $this->query("select * from cms_post t where catalogId = :catalogId")->bindParam(":catalogId", $catalogId)
            ->queryAll();
    }


    public function includePhp($filename)
    {
        $themeKey = $this->defaultTheme['themeKey'];
        return $this->renderPartial('@app/views/themes/' . $themeKey . '_' . $this->defaultTheme['id'] . "/" . $filename, $this->data);
    }

    private function getNavgationChildren($itemId, $themeId, $level)
    {
        $level++;

        $childrenArray = array();

        $children = $this->query("SELECT
	cc.*,
	( SELECT count( * ) FROM cms_catalog WHERE parentId = cc.id and deleted = 0 and status = 'online' ) cld 
FROM
	cms_catalog cc 
WHERE
	parentid = :parentId 
	AND themeId = :themeId
	AND deleted = 0 and status = 'online'
ORDER BY
	sequencenumber ASC")
            ->bindParam(":themeId", $themeId)
            ->bindParam(":parentId", $itemId)
            ->queryAll();

        foreach ($children as $child) {
            if ($child['cld'] > 0) {
                $childrenSub = $this->getNavgationChildren($child['id'], $themeId, $level);
                $childrenArray[] = array(
                    'object' => $child,
                    'children' => $childrenSub,
                    'level' => $level
                );
            } else {
                $childrenArray[] = array(
                    'object' => $child,
                    'level' => $level
                );
            }
        }

        return $childrenArray;

    }

    public function setDefMeta($page){
        if($page['pageType']=='home'){
            $this->data['meta_title'] = "首页";
        }else if($page['pageType']=='companyinfo'){
            $this->data['meta_title'] = "公司简介";
        }else if($page['pageType']=='articleList'){
            $this->data['meta_title'] = "文章列表";
        }else if($page['pageType']=="feedback"){
            $this->data['meta_title'] = "在线反馈";
        }
    }

    public function setMeta($title, $keywords, $description)
    {
        $this->data['meta_title'] = $title;
        $this->data['meta_keywords'] = $keywords;
        $this->data['meta_description'] = $description;
    }


    public function getRecentPost($postType, $catalogId,$size)
    {
        $list = array();

        $articles = $this->query("select * from cms_post where postType = :postType and `status` = 'online' and catalogId = :catalogId order by id desc  limit 0,:size")
            ->bindParam(":postType", $postType)
            ->bindParam(":catalogId", $catalogId)
            ->bindParam(":size", $size)
            ->queryAll();
        foreach ($articles as $article) {
            $item = array();
            $item['object'] = $article;

            $prop = array();
            $properties = $this->query("select * from cms_post_prop t where postId = :postId")
                ->bindParam(":postId", $article['id'])
                ->queryAll();
            foreach ($properties as $property) {
                $prop[$property['ppKey']] = $property['ppValue'];
            }
            $item['prop'] = $prop;
            $list[] = $item;
        }
        return $list;
    }

    public function query($sql)
    {
        return $this->db->createCommand($sql);
    }

    public function widget($widgetId){

        $fragment = Fragment::findOne($widgetId);

        $evalStr .= 'use \app\components\cms\\'.ucfirst($fragment['fragmentType']).'Widget; $html =  \app\components\cms\\'.ucfirst($fragment['fragmentType']).'Widget::widget([\'fragment\'=>$fragment,\'context\'=>$this]);';
        
        eval($evalStr);

        return $html;
    }

}

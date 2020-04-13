<?php


namespace app\structure\controllers;


use app\components\cms\PageMetaWidget;
use app\models\cms\frontend\Layout;
use app\structure\constants\MsgType;
use Yii;
use yii\data\Pagination;

class CmsFrontendController extends AppController
{

    public $theme = null;
    private $config = array();
    private $demo = false;
    public $pagedata = array();

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

    private function setParam()
    {
        $demo = isset(Yii::$app->params['demo'])?Yii::$app->params['demo']:false;
        if ($demo==true) {
            $this->demo = Yii::$app->params['demo'];
            $phpself = $_SERVER['PHP_SELF'];

            $demomapping = Yii::$app->params['demomapping'];
            $position = strpos($phpself,'/',1);
            $folder = substr($phpself,0,$position);
            $id =$demomapping[$folder];

            $this->theme = $this->query("select * from cms_theme t where t.id = :id")
                ->bindParam(":id", $id)
                ->queryOne();
        }else{
            //主题设置
            $this->theme = $this->query("select * from cms_theme t where t.isActive = 1")->queryOne();
        }

        if($this->theme==null){
            $this->theme = $this->query("select * from cms_theme t limit 0,1")->queryOne();
        }


        //系统参数设置
        $configs = $this->query("select * from cms_config t where t.themeId = :themeId")
            ->bindParam(":themeId", $this->theme['id'])
            ->queryAll();
        foreach ($configs as $config) {
            $this->config[$config['themeId'] . '-' .$config['cfgkey']] = $config['cfgvalue'];
        }
    }

    public function getConfig($configKey)
    {
        if (isset($this->config[$this->theme['id'] . '-' . $configKey])) {
            return $this->config[$this->theme['id'] . '-' . $configKey];
        } else {
            return "";
        }
    }

    public function getTheme(){
        return $this->theme;
    }

    public function show($pagePath)
    {
        if ($pagePath == null) {
            $pagePath = 'home';
        }

        $page = $this->query("SELECT * FROM `cms_theme_page` where pagePath = :pagePath and themeId = :themeId")
            ->bindParam(":themeId", $this->theme['id'])
            ->bindParam(":pagePath", $pagePath)
            ->queryOne();

        if ($page == false) {
            throw new \yii\web\NotFoundHttpException($pagePath."路由未配置页面");
        } else {

            $layout = Layout::findOne($page['layoutId']);

            $this->data['CMS_PAGE'] = $page;
            $this->data['CMS_LAYOUT'] = $layout;

            $this->layout = '@app/views/rkcms/frontend-cms';
            return $this->render('@app/views/rkcms/page', $this->data);
        }
    }

    public function errorPage($message)
    {
        $this->layout = "//content";
        $this->data['message'] = $message;
        return $this->render('@app/views/rkcms/error', $this->data);
    }

    public function setMeta($title, $keywords, $description)
    {
        $this->data['meta_title'] = $title;
        $this->data['meta_keywords'] = $keywords;
        $this->data['meta_description'] = $description;
    }

    public function setData($dtKey,$dtValule){
        $this->data[$dtKey] = $dtValule;
    }

    public function renderFragment($id,$data=array()){
        return $this->renderPartial("@app/views/fragment/".$this->theme['id']."/".$id,$data);
    }

    public function query($sql)
    {
        return $this->db->createCommand($sql);
    }

    public function getImg($location,$max=15){
        if($location=='800x800'|| $location=='1920x1280' || $location =='450x550'){
            return 'http://image.ranko.cn/'.$location.'/'.rand(1,$max).'.jpg';
        }else{
            return $location;
        }
    }

}

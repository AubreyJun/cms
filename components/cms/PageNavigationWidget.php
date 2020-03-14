<?php


namespace app\components\cms;


use app\models\cms\Fragment;

class PageNavigationWidget extends BasicWidget
{
    public $fragment;
    public $id;
    public $context;
    private $data = array();

    public static $editorMapping = array(
        'logo1' => array(
            'title' => 'LOGO(1)图片',
            'editor' => 'image'
        ),
        'logo2' => array(
            'title' => 'LOGO(2)图片',
            'editor' => 'image'
        ),
        'title' => array(
            'title' => '标题',
            'editor' => 'text'
        ),
        'style' => array(
            'title' => '样式',
            'editor' => 'select',
            'selectData'=>array(
                'common'=>'通用'
            )
        )
    );

    public function init()
    {
        parent::init();
    }

    public function run()
    {

        if($this->id!=null){
            $this->fragment = Fragment::findOne($this->id);
        }else if($this->id == 0){
            //获取默认的widget
            $this->fragment = Fragment::find()->where(['isDefault'=>1,'fragmentType'=>'pageNavigation'])->one();
        }

        $properties = json_decode($this->fragment['properties'],true);
        foreach ($properties as $property){
            $this->data[$property['pname']] = $property;
        }

        $this->data['navigation'] = $this->getNavgation('navigation',$this->context->defaultTheme['id']);

        return $this->render("pageNavigation", $this->data);

    }

    public function getNavgation($catalogType,$themeId){

        $navgation = array();

        $topNavgation = $this->context->query("SELECT
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
            ->bindParam(":themeId",$themeId)
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

        $children = $this->context->query("SELECT
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

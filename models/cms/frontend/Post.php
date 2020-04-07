<?php

namespace app\models\cms\frontend;

use app\models\cms\backend\BKCatalog;
use yii\behaviors\TimestampBehavior;
use yii\data\Pagination;
use yii\db\ActiveRecord;
use yii\db\Expression;

class Post extends ActiveRecord
{
    public static function tableName()
    {
        return '{{cms_post}}';
    }

    /**
     *
     * 分页获取分类数据
     *
     */
    public static function getPagination($postType, $catalogId, $pageSize)
    {

        $postArray = array();
        $parent = BKCatalog::findOne($catalogId);
        $path = $parent['catalogPath'] . "%";

        $count = self::getDb()->createCommand("SELECT
count(*) 
FROM
	cms_post c_p
	LEFT JOIN cms_catalog c_c ON c_p.catalogId = c_c.id 
WHERE
	c_c.catalogPath LIKE :catalogPath and c_p.postType = :postType")
            ->bindParam(":catalogPath", $path)
            ->bindParam(":postType", $postType)->queryScalar();
        $post_pagination = new Pagination(['totalCount' => $count]);
        $post_pagination->pageSize = $pageSize;
        $offset = $post_pagination->getOffset();
        $limit = $post_pagination->getLimit();

        $post_list = self::getDb()->createCommand("SELECT
	c_p.*,
	c_c.catalogPath 
FROM
	cms_post c_p
	LEFT JOIN cms_catalog c_c ON c_p.catalogId = c_c.id 
WHERE
	c_c.catalogPath LIKE :catalogPath and c_p.postType = :postType limit :offset,:limit")
            ->bindParam(":catalogPath", $path)
            ->bindParam(":postType", $postType)
            ->bindParam(":offset", $offset)
            ->bindParam(":limit", $limit)
            ->queryAll();

        $postArray['post_list'] = $post_list;
        $postArray['post_pagination'] = $post_pagination;

        return $postArray;

    }

    public function getCatalog()
    {
        return $this->hasOne(Catalog::className(), ['id' => 'catalogId']);
    }

    public static function getItem($postId)
    {
        $post = Post::find()->where(['id' => $postId])->one();

        $object = array();
        $object['object'] = $post;

        $pps = self::getDb()->createCommand("select * from cms_post_prop where postId = :postId")
            ->bindParam(":postId", $post['id'])
            ->queryAll();
        $prop_array = array();
        foreach ($pps as $pp) {
            $prop_array[$pp['ppKey']] = $pp['ppValue'];
        }
        $object['prop'] = $prop_array;

        return $object;
    }

    public static function getRecent($postType, $catalogId, $size)
    {
        $posts_array = array();
        $posts = Post::find()->where(['postType' => $postType, 'catalogId' => $catalogId])->orderBy("createtime desc")->limit($size)->all();
        foreach ($posts as $post) {
            $object = array();
            $object['object'] = $post;

            $pps = self::getDb()->createCommand("select * from cms_post_prop where postId = :postId")
                ->bindParam(":postId", $post['id'])
                ->queryAll();
            $prop_array = array();
            foreach ($pps as $pp) {
                $prop_array[$pp['ppKey']] = $pp['ppValue'];
            }
            $object['prop'] = $prop_array;

            $posts_array[] = $object;
        }
        return $posts_array;
    }

    public static function getParentAll($postType, $catalogId)
    {
        $parent = BKCatalog::findOne($catalogId);
        $path = $parent['catalogPath'] . "%";
        $posts = self::getDb()->createCommand("select c_p.*,c_c.catalogPath from cms_post c_p 
left join cms_catalog c_c on c_p.catalogId = c_c.id
where c_p.postType = :postType and c_c.catalogPath like :path and c_p.status = 'online'")
            ->bindParam(":path", $path)
            ->bindParam(":postType", $postType);
        $posts = $posts->queryAll();
        foreach ($posts as $post) {
            $object = array();
            $object['object'] = $post;

            $pps = self::getDb()->createCommand("select * from cms_post_prop where postId = :postId")
                ->bindParam(":postId", $post['id'])
                ->queryAll();
            $prop_array = array();
            foreach ($pps as $pp) {
                $prop_array[$pp['ppKey']] = $pp['ppValue'];
            }
            $object['prop'] = $prop_array;

            $posts_array[] = $object;
        }
        return $posts_array;
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'createtime',
                'updatedAtAttribute' => 'updatetime',
                'value' => new Expression('NOW()'),
            ],
        ];
    }


}

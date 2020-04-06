<?php

namespace app\models\cms\frontend;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

class Post extends ActiveRecord
{
    public static function tableName()
    {
        return '{{cms_post}}';
    }

    public function getCatalog()
    {
        return $this->hasOne(Catalog::className(), ['id' => 'catalogId']);
    }

    public static function getItem($postId){
        $post = Post::find()->where(['id'=>$postId])->one();

        $object = array();
        $object['object'] = $post;

        $pps = self::getDb()->createCommand("select * from cms_post_prop where postId = :postId")
            ->bindParam(":postId",$post['id'])
            ->queryAll();
        $prop_array = array();
        foreach ($pps as $pp){
            $prop_array[$pp['ppKey']] = $pp['ppValue'];
        }
        $object['prop'] = $prop_array;

        return $object;
    }

    public static function getRecent($postType,$catalogId,$size){
        $posts_array = array();
        $posts = Post::find()->where(['postType'=>$postType,'catalogId'=>$catalogId])->orderBy("createtime desc")->limit($size)->all();
        foreach($posts as $post){
            $object = array();
            $object['object'] = $post;

            $pps = self::getDb()->createCommand("select * from cms_post_prop where postId = :postId")
                ->bindParam(":postId",$post['id'])
                ->queryAll();
            $prop_array = array();
            foreach ($pps as $pp){
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

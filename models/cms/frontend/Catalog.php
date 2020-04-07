<?php

namespace app\models\cms\frontend;

use app\models\cms\backend\BKCatalog;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

class Catalog extends ActiveRecord
{
    public static function tableName()
    {
        return '{{cms_catalog}}';
    }

    public static function getChildren($catalogId){
        $parent = BKCatalog::findOne($catalogId);
        $path = $parent['catalogPath']."%";
        return self::getDb()->createCommand("select * from cms_catalog where catalogPath like :path and id != :catalogId")
            ->bindParam(":path",$path)
            ->bindParam(":catalogId",$catalogId)
            ->queryAll();
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

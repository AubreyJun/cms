<?php

namespace app\models\cms\backend;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

class BKPost extends ActiveRecord
{
    public static function tableName()
    {
        return '{{cms_post}}';
    }

    public function getCatalog()
    {
        return $this->hasOne(Catalog::className(), ['id' => 'catalogId']);
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

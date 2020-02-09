<?php

namespace app\modules\plugin\backend\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

class Feedback extends ActiveRecord
{
    public static function tableName()
    {
        return '{{plugin_feedback}}';
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

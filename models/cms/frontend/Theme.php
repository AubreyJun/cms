<?php

namespace app\models\cms\frontend;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

class Theme extends ActiveRecord
{
    public static function tableName()
    {
        return '{{cms_theme}}';
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

    public function setThemeUnActive($themeId)
    {
        $db = self::getDb();
        $db->createCommand("update cms_theme set isActive = 0 where id != :id")
            ->bindParam(":id", $themeId)
            ->execute();
    }

}

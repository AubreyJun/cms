<?php

namespace app\models\cms\backend;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

class BKTheme extends ActiveRecord
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

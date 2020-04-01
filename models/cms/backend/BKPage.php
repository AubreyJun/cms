<?php

namespace app\models\cms\backend;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

class BKPage extends ActiveRecord
{
    public static function tableName()
    {
        return '{{cms_theme_page}}';
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

    public function setUnActive($id,$pageType,$themeId)
    {
        $db = self::getDb();
        if($pageType=='page'){

            $page = BKPage::findOne($id);
            $pageKey = $page['pageKey'];

            $db->createCommand("update cms_theme_page set isDefault = 0 where id != :id and pageType = :pageType and pageKey = :pageKey and themeId = :themeId")
                ->bindParam(":id", $id)
                ->bindParam(":pageType", $pageType)
                ->bindParam(":pageKey",$pageKey)
                ->bindParam(":themeId",$themeId)
                ->execute();
        }else{
            $db->createCommand("update cms_theme_page set isDefault = 0 where id != :id and pageType = :pageType and themeId = :themeId")
                ->bindParam(":id", $id)
                ->bindParam(":pageType", $pageType)
                ->bindParam(":themeId",$themeId)
                ->execute();
        }
    }



}

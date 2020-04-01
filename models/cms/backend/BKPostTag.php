<?php

namespace app\models\cms\backend;

use yii\db\ActiveRecord;

class BKPostTag extends ActiveRecord
{
    public static function tableName()
    {
        return '{{cms_post_tag}}';
    }




}

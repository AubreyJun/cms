<?php

namespace app\models\cms;

use yii\db\ActiveRecord;

class PostTag extends ActiveRecord
{
    public static function tableName()
    {
        return '{{cms_post_tag}}';
    }




}

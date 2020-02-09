<?php

namespace app\forms\cms;

class FormFileImage extends \yii\base\Model
{

    public $imageFile;
    public $imageUrl;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png,jpg,gif'],
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $folder = date("Ymd");
            $folderPath = \Yii::$app->basePath.'/web/uploads/files/'.$folder;
            if(!file_exists($folderPath)){
                mkdir($folderPath);
            }
            $filename = date('His').'.' . $this->imageFile->extension;
            $this->imageUrl = 'uploads/files/'.$folder.'/'.$filename;
            $this->imageFile->saveAs($folderPath. '/' . $filename);
            return true;
        } else {
            return false;
        }
    }


}

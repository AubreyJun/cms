<?php

namespace app\forms\cms\backend;

class FormFile extends \yii\base\Model
{

    public $folder, $filename,$uploadfile;
    public $rootPath;

    public function rules()
    {
        return [
            [['rootPath'], 'required', 'message' => '根目录不能为空'],
            [['folder'], 'required', 'message' => '文件夹不能为空'],
            [['filename'], 'required', 'message' => '文件名称不能为空'],
            [['uploadfile'], 'file',
                'maxSize'=>1024*1024*2,'tooBig'=>'文件上传过大！',
                'skipOnEmpty'=>false,'uploadRequired'=>'请上传文件！',
                'message'=>'上传失败！']
          /*  [['uploadfile'], 'file','extensions'=>['jpg','png','gif'],'wrongExtension'=>'只能上传{extensions}类型文件！',
                'maxSize'=>1024*1024*2,'tooBig'=>'文件上传过大！',
                'skipOnEmpty'=>false,'uploadRequired'=>'请上传文件！',
                'message'=>'上传失败！']*/
        ];
    }

    public function attributeLabels()
    {
        return [
            'folder' => '文件夹',
            'filename' => '文件名称',
            'uploadfile' => '文件'
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $savePath = $this->rootPath;
            if($this->folder!='/'){
                if(DIRECTORY_SEPARATOR=='\\'){
                    $savePath .=  substr(str_replace('\\','/',$this->folder),1);
                }else{
                    $savePath .= $this->folder;
                }
            }

            $savePath = $savePath .'/'. $this->filename . '.' . $this->uploadfile->extension;

            if(file_exists($savePath)){
                return false;
            }else{
                $this->uploadfile->saveAs($savePath);
                return true;
            }
        } else {
            return false;
        }
    }


}
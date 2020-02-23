<?php
namespace app\forms\cms\backend;

class FormFragment extends \yii\base\Model
{

    public $id, $themeId, $fragmentName, $fragmentType,$properties;

    public function rules()
    {
        return [
            [['id','themeId'], 'required'],
            [['fragmentName'], 'required','message'=>'片段名称不能为空'],
            [['fragmentType'], 'required','message'=>'片段类型不能为空'],
            [['properties'], 'required','message'=>'属性配置不能为空'],
            [['properties'], 'mustXml','message'=>'XML格式不正确'],
        ];
    }

    public function mustXml($attribute, $params)
    {
        if(!$this->xml_parser($this->properties)){
            $this->addError($attribute, "XML格式不正确");
        }
    }

    function xml_parser($str){
        $xml_parser = xml_parser_create();
        if(!xml_parse($xml_parser,$str,true)){
            xml_parser_free($xml_parser);
            return false;
        }else {
            return (json_decode(json_encode(simplexml_load_string($str)),true));
        }
    }

    public function attributeLabels()
    {
        return [
            'fragmentName' => '片段名称',
            'fragmentType' => '片段类型',
            'properties' => '属性配置'
        ];
    }

}

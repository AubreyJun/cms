<?php


namespace app\structure\controllers;


use yii\web\Controller;

abstract class AppController extends Controller implements BaseController
{
    public $db;
    public $layout = "//main";
    public $data = array();

    public function query($sql){
        return $this->db->createCommand($sql);
    }

    public function view($view){
        return $this->render($view,$this->data);
    }

    public function message($code, $message)
    {
        return ['code' => $code, 'message' => $message];
    }


}
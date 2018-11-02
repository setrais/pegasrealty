<?php

class FrontendController extends MyController {

    public function init() {
        parent::init();

        $app = Yii::app();
        //$app->language = 'ru';
        $app->clientScript->registerCoreScript('jquery');
        //$app->clientScript->registerScriptFile('http://maps.google.com/maps/api/js?sensor=false&language=ru');

        //date_default_timezone_set('Europe/Moscow');
        //setlocale(LC_ALL, 'ru_RU');
    }

    public function filters() {
        return array(
            array('application.components.frontend.filters.PageTitle'),
            'accessControl'
        );
    }

    public function performAjaxValidation($models) {
        if (Yii::app()->request->isAjaxRequest && isset($_POST['ajax'])) {
            echo CActiveForm::validate($models);
            Yii::app()->end();
        }
    }

    public function renderAjax($view,$data=null,$return=false){
        $this->layout = 'ajax';
        $this->render($view, $data, $return);
    }

    /*public function createUrl($route, $params=array ( ), $ampersand='&'){   
        if (!isset($params['type'])){
            if (isset($_GET['type']))
                $params['type']=$_GET['type'];
        }
        if (!isset($params['pickup'])){
            if (isset($_GET['pickup']))
                $params['pickup']=$_GET['pickup'];
        }

        return parent::createUrl($route, $params, $ampersand);
    }*/    
}

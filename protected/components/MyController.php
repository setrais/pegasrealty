<?php

class MyController extends CController
{

    public $layout = '//layouts/content';

    public $pageTitle = 'Аренда офиса в Москве | Пегас недвижимость за минуту к успеху Вашего бизнеса (в центре,западе,юге,востоке москвы, по воюао, юаo, зао,юзао,цао,свао,сзао,юго,сао, по стоимости арендодателя)';
    public $pageDescription = 'pegasrealty.ru - Portal Real Estate Agency "Pegas Realty", a professional commercial real estate and rental offices in Moscow.';
    public $pageKeywords = array('аренда',
                                 'офис', 
                                 'москва',
                                 'москве',
                                 'аренда офиса',        
                                 'аренда офиса москва',
                                 'аренда офиса в москве',
                                 /*'аренда офисов в москве',*/
                                 'аренда офиса москвы',
                                 /*'аренда офисов москвы',*/
                                 'коммерческая недвижимость', 
                                 'офисная недвижимость аренда', 
                                 //'офис склад москва',                                 
                                 //invid// 'офисы в аренду москва', 
                                 'аренда под офис',
                                 //'аренда помещений под офис', /*dest*/
                                 'аренда офис москва',
                                 'собственник аренда москва',
                                 //'аренда помещения под офис москва', /*dest*/                                 
                                 'аренда офисных помещений москва', /* todonew */
                                 //'продажа офисов в москве',
                                 //'помещение под офис москва',  /*dest*/
                                 //'продажа офисов',
                                 'аренда офиса в центре москвы',
                                 //'аренда помещений москва',
                                 'аренда офиса без комиссии',
                                 'аренда офиса без посредников',
                                 //'купить офис',
                                 'москвы',        

                                 'аренда офиса в москве цены',
                                 //'аренда офисов москвы без комиссии',
                                 //'аренда офисов москвы недорого',
                                 'аренда офиса в москве дешево',
                                 'cнять в аренду офис в москве',
                                 'cнять офис в москве',
                                 'аренда в москве под офис', 
                                 //'аренда офиса без посредников москва',
                                 //'аренда офиса без комиссии москва',  
                                 'аренда офиса москвы без комиссии',
                                 /*'аренда офиса москва от собственника',*/
                                 'аренда офиса москвы от собственника',
                                 'аренда офиса в москве без комиссии',
        
                                 /*'аренда особняка',*/
                                 /*'аренда особняков',*/
                                 /*'аренда особняка в центре москвы',*/
                                 /*'аренда офиса в бизнес центре',*/ 
                                 /*'аренда офисов в бизнес центрах',*/
                                 );
    public $pageSearch = '';
    public $menu = array();
    public $breadcrumbs = array();
    public $order_status = '';

    public function setFlash($key, $value)
    {
        Yii::app()->user->setFlash($key, $value);
    }

    public function getFlash($key)
    {
        return Yii::app()->user->getFlash($key);
    }

    public function hasFlash($key)
    {
        return Yii::app()->user->hasFlash($key);
    }

    /*public function GetType()
    {
        if (isset($_GET['type']))
            return $_GET['type'];
        else
            return 'restaurants';
    }*/

    public function performUploads($model)
    {
        if (!empty($_FILES)) {
            foreach ($_FILES[$this->_class]['name'] as $_attribute => $_file) {
                if (!empty($_file)) {
                    $model->$_attribute = CUploadedFile::getInstance($model, $_attribute);
                }
            }
        }
    }

    public function performUploadsSaveToDisk($model)
    {
        if (!empty($_FILES)) {
            foreach ($_FILES[$this->_class]['name'] as $_attribute => $_file) {
                if (!empty($_file)) {
                    $model->$_attribute->saveAs(MyFilesystem::makeDirs($model->uploadTo($_attribute)));
                }
            }
        }
    }
}

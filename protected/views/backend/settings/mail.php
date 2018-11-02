<?php $this->pageTitle=Yii::app()->name; ?>
<?php
$this->breadcrumbs=array(
	Yii::t('all','Почта'),
);

$this->menu=array(
	/*array('label'=>Yii::t('form','Create Realestates'), 'url'=>array('create'),
              'visible'=>   Yii::app()->user->checkAccess('superadmin') ),
	array('label'=>Yii::t('menu-adm','Manage Realestates'), 'url'=>array('admin'),
              'visible'=>   Yii::app()->user->checkAccess('superadmin')),*/
);
?>

<h1><?php echo Yii::t('menu-adm','Почта');?></h1>

<p>
    Содержимое страницы настройки почты сайта... 
        
        // почта для контакта
        // email
        <?php //'adminEmail'=>'setrais@gmail.com,info@pegasrealty.ru,support@pegasrealty.ru',//'2229520@mail.ru,2229520@pegasrealty.ru', ?>
        // smtp server
        <?php //'smtp_host'=>"smtp.gmail.com", ?>
        // порт
        <?php //'smtp_port'=>465, ?>
        // мост
        <?php //'smtp_username'=>'realtypegas@gmail.com',   ?>             
        // пароль
        <?php //'smtp_password'=>'as27061973', ?>
        // email моста
        <?php //'email'=>'realtypegas@gmail.com', ?>
        // имя отправителя
        <?php //'email_from_name'=>'Pegas Realty', ?>
    ?>
</p>

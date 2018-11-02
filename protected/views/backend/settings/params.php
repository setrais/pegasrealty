<?php $this->pageTitle=Yii::app()->name; ?>
<?php
$this->breadcrumbs=array(
	Yii::t('all','Основные параметры'),
);

$this->menu=array(
	/*array('label'=>Yii::t('form','Create Realestates'), 'url'=>array('create'),
              'visible'=>   Yii::app()->user->checkAccess('superadmin') ),
	array('label'=>Yii::t('menu-adm','Manage Realestates'), 'url'=>array('admin'),
              'visible'=>   Yii::app()->user->checkAccess('superadmin')),*/
);
?>

<h1><?php echo Yii::t('menu-adm','Основные параметры');?></h1>

<p>    
    Содержимое страницы - основные параметры сайта управления недвижимостью... 
    /* Язык административной части */
    <?php //'sourceLanguage' => 'en_US', ?>
    /* Язык публичной части */
    <?php //'language' => $i18n[$lang], /*'ru_RU',*/  ?>
    /* Название приложения */
    <?php //'name'=>'Pegasus Property | Offices for rent in Moscow',    ?>
    /* языки */
    <?php //'languages' => $i18n, ?>
    /* текущий язык */
    <?php //'language'  => $lang, ?>
</p>

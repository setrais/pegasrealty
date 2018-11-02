<?php $this->pageTitle=Yii::app()->name; ?>
<?php
$this->breadcrumbs=array(
	Yii::t('all','Курсы валют'),
);

$this->menu=array(
	/*array('label'=>Yii::t('form','Create Realestates'), 'url'=>array('create'),
              'visible'=>   Yii::app()->user->checkAccess('superadmin') ),
	array('label'=>Yii::t('menu-adm','Manage Realestates'), 'url'=>array('admin'),
              'visible'=>   Yii::app()->user->checkAccess('superadmin')),*/
);
?>

<h1><?php echo Yii::t('menu-adm','Курсы валют');?></h1>

<p>
    Содержимое страницы настройки курсов валют сайта... 
    
    <?php         array ( 'to'=>'RUB',
                          'from'  => array(                      
                                        array(
                                               'name'   => 'USD',
                                               'amount' => 1,
                                               'curs'   =>array( 'EUR'=>1/0.7328, 'RUB'=>1/35.2448 ), 
                                        ),
                                        array(
                                               'name'   => 'EUR',
                                               'amount' => 1,
                                               'curs'   => array( 'USD'=>1/1.3640, 'RUB'=>1/48.0951 ),
                                        ),
                                        array(
                                               'name'   => 'RUB',
                                               'amount' => 1,
                                               'curs'   =>array( 'USD'=>1/0.0283, 'EUR'=>1/0.0207 ),
                                        ),  
                            )

                          ); 
    ?>
</p>

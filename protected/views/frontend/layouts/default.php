<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="description" content="<?=CHtml::encode(Yii::t("all","pegasrealty.ru - Portal Real Estate Agency \"Pegas Realty\", a professional commercial real estate and rental offices in Moscow."));?>" />
        <meta name="keywords" content="недвижимость аренда офиса в москве офис москва особняк комерческая недвижимость аренда офис склад москва офисы в аренду москва аренда под офис аренда помещений под офис аренда офис москва собственник аренда москва аренда помещения под офис москва аренда офиса москва от собственника аренда офисных помещений москва мебель для офиса москва аренда офиса без посредников москва продажа офисов в москве помещение под офис москва продажа офисов аренда офиса в центре москвы аренда помещений москва купить офис москва коммерческая недвижимость г москва мебель в офис москва аренда офиса без посредников аренда офиса без комиссии купить офис прямая аренда офиса" />        
        <meta name="language" content="ru" />
        <meta name='wmail-verification' content='8b3067952b10a40f' />
        <meta name='yandex-verification' content='6670a13164fc357b' />
        <meta name="google-site-verification" content="CTCVcztMj5mOHzJWHuE8cv20BNFp9a8M5-po2aVKTDM" />        
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>        

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />	        
        <link rel="icon" href="<?php echo Yii::app()->request->baseUrl; ?>/favicon.ico" type="image/x-icon" />
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo Yii::app()->request->baseUrl; ?>/favicon.ico" />
</head>
<body>
  <div id="wrap">
    <div class="container" id="page">
        <!--<div class="header">
                <a href="/" class="logo"></a>
                <ul class="top_menu">
                    <li class="li1"><span></span></li>
                    <li class="act"><a href="/">Аренда</a></li>
                    <li class="li1"><span></span></li>
                    <li><a href="/sell/">Продажа</a></li>
                    <li class="li1"><span></span></li>
                </ul>
                <a href="/request/" class="zapros_but">Запрос<br />брокеру</a>
                <div class="clear"></div>
            </div>
        header end -->
	<div id="header" >		
	</div><!-- header -->

	<!-- <div id="mainmenu" style="text-align: right;">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
                                array('label' => Yii::t('menu','Home'), 'url' => '/'),  
                                array('label' => Yii::t('menu','About company'), 'url'=>array('/site/page', 'view'=>'about')),                                                                
                                array('label' => Yii::t('all','News'), 'url'=>array('/site/news')),
                                array('label' => Yii::t('all','Owners'), 'url'=>array('/site/owners')),
                                array('label' => Yii::t('menu','Contact'), 'url'=>array('/site/contact')),
				/*array('label'=>'Home', 'url'=>array('/site/index')),
				array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),                                                                
				array('label'=>'Contact', 'url'=>array('/site/contact')),
				array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)*/
			),
		)); ?>
	</div> -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
                        'homeLink'=>CHtml::link(Yii::t('menu','Home'),Yii::app()->homeUrl)
		)); ?><!-- breadcrumbs -->
	<?php endif?> 

	<?php echo $content; ?>
                
        <div class="pre_footer"></div>    
	<div id="footer">
                
		<?/*=Yii::t('all','Copyright &copy;');?>  <?php echo date('Y'); ?> <?=Yii::t('all','by Web Studio Rtvs.');?><br/>*/?>
		<?=Yii::t('all','All Rights Reserved.');?><br/>
		<?php// echo Yii::powered(); ?>
	</div><!-- footer -->
    </div><!-- page -->
  </div><!-- wrap -->
</body>
</html>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />      
    <meta name="description" content="<?=CHtml::encode(Yii::t("all","pegasrealty.ru - Portal Real Estate Agency \"Pegas Realty\", a professional commercial real estate and rental offices in Moscow."));?>" />
    <meta name="keywords" content="недвижимость аренда офиса в москве офис москва особняк комерческая недвижимость аренда офис склад москва офисы в аренду москва аренда под офис аренда помещений под офис аренда офис москва собственник аренда москва аренда помещения под офис москва аренда офиса москва от собственника аренда офисных помещений москва мебель для офиса москва аренда офиса без посредников москва продажа офисов в москве помещение под офис москва продажа офисов аренда офиса в центре москвы аренда помещений москва купить офис москва коммерческая недвижимость г москва мебель в офис москва аренда офиса без посредников аренда офиса без комиссии купить офис прямая аренда офиса" />        
    <meta name="language" content="ru" />    
    <title><?php echo CHtml::encode($this->pageTitle); ?> - Админчасть | Недвижимость | Аренда | Офиса | Москва </title>        
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo Yii::app()->request->baseUrl; ?>/favicon.ico" />     
    <!-- blueprint CSS framework -->
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/backend/reset.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/backend/screen.css" media="screen, projection" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/backend/print.css" media="print" />
    <!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/backend/ie.css" media="screen, projection" />
    <![endif]-->
  
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/backend/form.css" />    
    <!--<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/backend/button.css" />-->
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/backend/mains.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/backend/main.css" />            
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
<?

//Yii::app()->clientScript->registerScriptFile('http://code.jquery.com/jquery-latest.js');            
//Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/jquery.js');      
//Yii::app()->clientScript->registerCoreScript('jquery.ui');         
//Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/backend/widgets/jui/themes/cupertino/jquery-ui.css');  

Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/fancybox/jquery.fancybox-1.3.4.pack.js');
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/fancybox/jquery.easing-1.3.pack.js');
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/easytabs/jquery.easytabs.min.js');
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/easytabs/jquery.hashchange.min.js');

Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/fancybox/jquery.fancybox-1.3.4.css');
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/backend/jquery.pnotify/jquery.pnotify.min.js');
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/js/backend/jquery.pnotify/jquery.pnotify.default.css');
//Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/backend/widgets/jui/themes/south-street/jquery-ui.css');
//Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/backend/widgets/jui/themes/base/jquery-ui.css');
//Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/backend/widgets/jui/themes/ui-lightness/jquery-ui.css');
//Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/backend/widgets/jui/themes/eggplant/jquery-ui.css');
//Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/backend/widgets/jui/themes/smoothness/jquery-ui.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/backend/widgets/jui/themes/cupertino/jquery-ui.css');      
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/frontend/cengine.js'); 
//Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/backend/engine.js'); 
?>   
<body>    
    <div class="container" id="page">  
        <?/*<div id="left" <?php echo ( Yii::app()->user->checkAccess('superadmin') ? 'class="t76"' : 'class="all-hmenu t76"');?> >
          <table width="100%" class="wrapper">
            <tr>
              <td class="menu">                                    
              <?php 
                   
               $lang = Yii::app()->params->language;
               $this->widget(
                    'application.zii.widgets.MyMenu',
                    array(
                         'items' => array(
                             array('label' => Yii::t('all','Home'), 'url' => '/'),                             
                             array('label' => str_repeat( '-', 39), 'visible' => Yii::app()->user->checkAccess('superadmin')),
                             array('items' => array(
                                 array('label' => Yii::t('all','Countries'), 'url' => array('/countries'), 'visible' => Yii::app()->user->checkAccess('superadmin') ),
                                 array('label' => Yii::t('all','Regions'), 'url' => array('/regions'), 'visible' => Yii::app()->user->checkAccess('superadmin') && $access ),
                                 array('label' => Yii::t('all','Cities'), 'url' => array('/cities'), 'visible' => Yii::app()->user->checkAccess('superadmin')),
                                 array('label' => Yii::t('all','Areas'), 'url' => array('/districts'), 'visible' => Yii::app()->user->checkAccess('superadmin')),
                                 array('label' => Yii::t('all','Метро'), 'url' => array('/metros'), 'visible' => Yii::app()->user->checkAccess('superadmin')),
                                 array('label' => str_repeat( '-', 36),'visible' => Yii::app()->user->checkAccess('superadmin') ),
                                 array('label' => Yii::t('all','Types of clients'), 'url' => array('/clientTypes'), 'visible' => Yii::app()->user->checkAccess('superadmin') ),
                                 array('label' => Yii::t('all','View commissions had worked'), 'url' => array('/commissions'), 'visible' => Yii::app()->user->checkAccess('superadmin')),
                                 array('label' => Yii::t('all','Types of contracts'), 'url' => array('/contractTypes'), 'visible' => Yii::app()->user->checkAccess('superadmin')),                                 
                                 array('label' => Yii::t('all','Parking'), 'url' => array('/parkings'), 'visible' => Yii::app()->user->checkAccess('superadmin')),   
                                 array('label' => Yii::t('all','Planning'), 'url' => array('/plannings'), 'visible' => Yii::app()->user->checkAccess('superadmin')),   
                                 array('label' => Yii::t('all','Properties'), 'url' => array('/properties'), 'visible' => Yii::app()->user->checkAccess('superadmin')),                                    
                                 array('label' => str_repeat( '-', 36), 'visible' => Yii::app()->user->checkAccess('superadmin')),
                                 array('label' => Yii::t('all','Types of options'), 'url' => array('/realestateFotoTypes'), 'visible' => Yii::app()->user->checkAccess('superadmin')),
                                 array('label' => str_repeat( '-', 36), 'visible' => Yii::app()->user->checkAccess('superadmin')),
                                 array('label' => Yii::t('all','Files'), 'url' => array('/files'), 'visible' => Yii::app()->user->checkAccess('superadmin')),
                                 array('items' => array(
                                    array('label' => Yii::t('all','Photo realestates'), 'url' => array('/files/realestates'), 'visible' => Yii::app()->user->checkAccess('superadmin')),
                                    array('label' => Yii::t('all','Photos of variants'), 'url' => array('/realestate_fotos'), 'visible' => Yii::app()->user->checkAccess('superadmin')),
                                    array('label' => Yii::t('all','Files of presentations'), 'url' => array('/realestate_presentations'), 'visible' => Yii::app()->user->checkAccess('superadmin')),                                     
                                    )),
                                 array('label' => str_repeat( '-', 36), 'visible' => Yii::app()->user->checkAccess('superadmin')),
                                 array('label' => Yii::t('all','Types of realestates'), 'url' => array('/realestateTypes'), 'visible' => Yii::app()->user->checkAccess('superadmin')),                                 
                                 array('label' => Yii::t('all','Views of realestates'), 'url' => array('/realestateVids'), 'visible' => Yii::app()->user->checkAccess('superadmin')),                                 
                                 array('label' => Yii::t('all','Properties of realestates'), 'url' => array('/realestateProperties'), 'visible' => Yii::app()->user->checkAccess('superadmin')),
                                 array('label' => Yii::t('all','Comparison of realestates'), 'url' => array('/realestateSimilarities'), 'visible' => Yii::app()->user->checkAccess('superadmin')),                                                                                                                                    
                                 array('label' => Yii::t('all','Class of realestates'), 'url' => array('/realestateClasses'), 'visible' => Yii::app()->user->checkAccess('superadmin')),                                    
                                 array('label' => str_repeat( '-', 36), 'visible' => Yii::app()->user->checkAccess('superadmin')),
                                 array('label' => Yii::t('all','Messages'), 'url' => array('/messages'), 'visible' => Yii::app()->user->checkAccess('superadmin')),                                                                  
                                 array('label' => Yii::t('all','Translations'), 'url' => array('/sourceMessages'), 'visible' => Yii::app()->user->checkAccess('superadmin')),                                                                  
                                 array('label' => str_repeat( '-', 36), 'visible' => Yii::app()->user->checkAccess('superadmin')),
                                 //array('label' => Yii::t('all','Realestates'), 'url' => array('/realestates'), 'visible' => Yii::app()->user->checkAccess('superadmin')), 
				     array('label' => Yii::t('all','Realestates'), 'url' => array('/realestates/admin'), 'visible' => Yii::app()->user->checkAccess('superadmin')), 
                                 array('label' => Yii::t('all','Representatives'), 'url' => array('/representatives'), 'visible' => Yii::app()->user->checkAccess('superadmin')),                                  
                                 array('label' => str_repeat( '-', 36), 'visible' => Yii::app()->user->checkAccess('superadmin')),
                                 array('label' => Yii::t('all','Taxs'), 'url' => array('/taxs'), 'visible' => Yii::app()->user->checkAccess('superadmin')),
                                 array('label' => str_repeat( '-', 36), 'visible' => Yii::app()->user->checkAccess('superadmin')),
                                 array('label' => Yii::t('all','Types of information block'), 'url' => array('/typesIblocks'), 'visible' => Yii::app()->user->checkAccess('superadmin')),
                                 array('label' => Yii::t('all','Infomation blocks'), 'url' => array('/iblocks'), 'visible' => Yii::app()->user->checkAccess('superadmin')),
                                 array('label' => str_repeat( '-', 36), 'visible' => Yii::app()->user->checkAccess('superadmin')),
                                 array('label' => Yii::t('all','Units of measure'), 'url' => array('/units'), 'visible' => Yii::app()->user->checkAccess('superadmin')),
                                 array('label' => str_repeat( '-', 36), 'visible' => Yii::app()->user->checkAccess('superadmin')),
                                 array('label' => Yii::t('all','Users'), 'url' => array('/users'), 'visible' => Yii::app()->user->checkAccess('superadmin')),
                                 array('label' => Yii::t('all','Roles'), 'url' => array('/authItem'), 'visible' => Yii::app()->user->checkAccess('superadmin')),
                                 array('label' => Yii::t('all','Appointment of users'), 'url' => array('/authAssignment'), 'visible' => Yii::app()->user->checkAccess('superadmin')),
                                 array('label' => str_repeat( '-', 36), 'visible' => Yii::app()->user->checkAccess('superadmin')),
                             ), 'visible' => Yii::app()->user->checkAccess('superadmin')),                             
                             array('items' => array(
                                 array('label' => Yii::t('all','Offices'), 'url' => array('/realestates/office'), 'visible' => Yii::app()->user->checkAccess('superadmin')),                                 
                                 array('label' => Yii::t('all','Warehouses'), 'url' => array('/realestates/warehouse'), 'visible' => Yii::app()->user->checkAccess('superadmin')),
                                 array('label' => Yii::t('all','Cottages'), 'url' => array('/realestates/cottage'), 'visible' => Yii::app()->user->checkAccess('superadmin')),                                 
                                 array('label' => Yii::t('all','Auctions'), 'url' => array('/realestates/auction'), 'visible' => Yii::app()->user->checkAccess('superadmin')),
                                 array('label' => str_repeat( '-', 36), 'visible' => Yii::app()->user->checkAccess('superadmin')),
                             ), 'visible' => Yii::app()->user->checkAccess('superadmin')),
                             array('items' => array(                                 
                                 array('label' => Yii::t('all','Clients'), 'url' => array('/clients'), 'visible' => Yii::app()->user->checkAccess('superadmin')),
                                 array('items' => array(                                
                                     array('label' => Yii::t('all','Tenants'), 'url' => array('/clients/tenants'), 'visible' => Yii::app()->user->checkAccess('superadmin')),
                                     array('label' => Yii::t('all','Buyers'), 'url' => array('/clients/buyers'), 'visible' => Yii::app()->user->checkAccess('superadmin')),                                                                     
                                     array('label' => Yii::t('all','Owner'), 'url' => array('/partners/owners'), 'visible' => Yii::app()->user->checkAccess('superadmin')),
                                    )
                                 ),
                                 array('label' => Yii::t('all','Partners'), 'url' => array('/partners'), 'visible' => Yii::app()->user->checkAccess('superadmin')),                                                                                                   
                                 array('label' => str_repeat( '-', 36), 'visible' => Yii::app()->user->checkAccess('superadmin')),
                             ), 'visible' => Yii::app()->user->checkAccess('superadmin')),                             
                             array('label' => Yii::t('all','Logout'), 'url' => array('/site/logout')),
                             array('label' => str_repeat( '-', 39), 'visible' => Yii::app()->user->checkAccess('superadmin')),
                         ),
                    )
                );
                ?>
              </td>
            </tr>
          </table>            
        </div>*/?>
	<div id="header">        
                <div id="header-panel" >
                    <?php// if ( Yii::app()->user->checkAccess('superadmin') )  { ?>
                    <div id="vids" >
                        <div id="vid-1" class="vid" >
                            <a href="<?=Yii::app()->createUrl('realestates/office');?>" ><?php echo Yii::t('all','Offices');?></a>
                        </div>
                        <div id="vid-2" class="vid" >
                            <a href="<?=Yii::app()->createUrl('realestates/warehouse');?>" ><?php echo Yii::t('all','Warehouses');?></a>
                        </div>
                        <div id="vid-3" class="vid" >
                            <a href="<?=Yii::app()->createUrl('realestates/cottage');?>" ><?php echo Yii::t('all','Cottages');?></a>
                        </div>
                        <div id="vid-4" class="vid" >
                            <a href="<?=Yii::app()->createUrl('realestates/auction');?>" ><?php echo Yii::t('all','Auctions');?></a>
                        </div>
                        <div id="vid-5" class="vid" >
                            <a href="<?=Yii::app()->createUrl('realestates/other');?>" ><?php echo Yii::t('all','Другое');?></a>
                        </div>                        
                    </div>
                    <?// } ?>
                </div>
                <div style="margin-top: -11px;position: absolute;right: 3px;top: 50%;" >
                <?php 
                      //$lpath = '/site/index.html';  
                      $npath = '/bax.php'; 
                      $lpath = '/'; 
                      if ( trim($this->getId())<>'' ) $lpath.=$this->getId().'/';              
                      if ( trim($this->getAction()->getId())<>'' ) $lpath.=$this->getAction()->getId().'.html';              
                      $parms = $this->getActionParams();
                      if ( is_array($parms) ) {
                          $begfor = true;
                          foreach ( $parms as $key=>$val ) {
                              if ( $begfor ) {
                                $lpath.='?'.$key.'='.$val;
                                $begfor=false;
                              }else{
                                $lpath.='&'.$key.'='.$val;  
                              }
                          }
                      }
                ?> 
                <select name="lang" id="lang" onchange="location.href='<?=$npath;?>'+'/'+$('#lang').val()+'<?=$lpath;?>'; " >
                   <?php 
                        $langs = Yii::app()->params->languages;
                        foreach( $langs as $key=>$val ) { 
                   ?>
                          <option value="<?php echo $key ?>" <?php echo ( Yii::app()->language==$val ? 'selected="selected"' : ''); ?> ><?php echo strtoupper($key);?></option>
                   <?php } ?>
                </select>
                </div>    
		<div id="logo" style="text-transform: uppercase;color: #3C578C;" ><?php echo CHtml::encode(Yii::t('all','Realestates')/*Yii::app()->name*/); ?></div>                
	</div><!-- header -->
	
	<?php/* if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif*/?>
        
        <div id="conter" style="" >  
            <div width="100%">
                <div id="sidebarmenu">
                  <table width="100%" class="wrapper">
                <tr>
                  <td class="menu-new">                                    
                  <?php 
                   $lang = Yii::app()->params->language;
                   $user = Yii::app()->user->getName();
                    /*'name' => 'Google corp',
        'link' => 'http://google.com',
        'icon' => 'google',
        'active' => 'dashboard',
        'sub' => array(
            array(
                'name' => 'Gmail',
                'link' => 'http://gmail.com',
            ),
            array(
                'name' => 'Gmap',
                'link' => 'http://maps.google.com/',
            )
        )*/
        /* 
         
*/                 
                   $islink = ''; 
                   $items = array(                       
                                 array('name' => Yii::t('all','Home'), 'link' => '/', 'icon'=>'home',),                                                              
                                 array('name' => Yii::t('all','Настройки сайта'), 'link' => array($islink.'/settings'),'action'=>'settings','icon'=>'settings',
                                       'sub' => array(
                                            array('name' => Yii::t('all','Основные параметры'), 'link' => array($islink.'/settings/params'), 'visible' => Yii::app()->user->checkAccess('superadmin'), 
                                                  'active'=>'settings/params', 'icon'=>'params',
                                                  'visible'=>Yii::app()->user->getName()=='superadmin'),             
                                            array('name' => Yii::t('all','Курсы валют'), 'link' => array($islink.'/settings/conversion'), 'visible' => Yii::app()->user->checkAccess('superadmin'), 
                                                  'active'=>'settings/conversion', 'icon'=>'conversion',                                                
                                                  'visible'=>Yii::app()->user->getName()=='superadmin'),                                                        
                                            array('name' => Yii::t('all','Почта'), 'link' => array($islink.'/settings/mail'), 'visible' => Yii::app()->user->checkAccess('superadmin'), 
                                                  'active'=>'settings/send', 'icon'=>'mail', 'visible'=>Yii::app()->user->getName()=='superadmin'),                                                  
                                            array('name' => Yii::t('all','Социальные сети'), 'link' => array($islink.'/settings/social'), 
                                                  'icon'=>'social', 'visible' => Yii::app()->user->checkAccess('superadmin'), 'active'=>'settings/social', 'visible'=>Yii::app()->user->getName()=='superadmin'),                                                  
                                       ),
                                       'visible'=>Yii::app()->user->getName()=='superadmin',
                                      ), 
                                 array('name' => Yii::t('all','Управление инфоблоками'), 'link' => array($islink.'/iblocks/admin'), 'active'=>'iblocks/admin', 'icon'=>'iblock',
                                       'sub' => array(
                                            /*array('name' => Yii::t('all','Cтраницы'), 'link' => array('#/iblocks/pages'), 'visible' => Yii::app()->user->checkAccess('superadmin')),
                                            array('name' => Yii::t('all','Новости'), 'link' => array('#/iblocks/news'), 'visible' => Yii::app()->user->checkAccess('superadmin')),
                                            array('name' => Yii::t('all','Статьи'), 'link' => array('#/iblocks/articles'), 'visible' => Yii::app()->user->checkAccess('superadmin')),
                                            array('name' => Yii::t('all','Блоки'), 'link' => array('#/iblocks/blocks'), 'visible' => Yii::app()->user->checkAccess('superadmin')),*/
                                            array('name' => Yii::t('all','Types of information block'), 'link' => array($islink.'/typesIblocks/admin'), 'visible' => Yii::app()->user->checkAccess('superadmin'), 'active'=>'typesIblocks/admin'),            
                                            array('name' => Yii::t('all','Множества инфоблоков'), 'link' => array($islink.'/iblocksMany/admin'), 'visible' => Yii::app()->user->checkAccess('superadmin'), 'active'=>'iblocksMany/admin'),                                                                                                
                                       ),
                                       'visible' => Yii::app()->user->checkAccess('superadmin')
                                ), 
                                array('name' => Yii::t('all','Files'), 'link' => array($islink.'/files/admin'), 
                                      'active'=>'files/admin', 'icon'=>'files',
                                      'sub'=> array(
                                            array('name' => Yii::t('all','Types of options'), 'link' => array('/realestateFotoTypes/admin'), 'visible' => Yii::app()->user->checkAccess('superadmin'), 'active'=>'realestateFotoTypes/admin'), 
                                            array('name' => Yii::t('all','Photos of variants'), 'link' => array($islink.'/realestateFotos/admin'), 'visible' => Yii::app()->user->checkAccess('superadmin'),'active'=>'realestateFotos/admin'), 
                                            array('name' => Yii::t('all','Files of presentations'), 'link' => array($islink.'/realestatePresentations/admin'), 'visible' => Yii::app()->user->checkAccess('superadmin'),'active'=>'realestatePresentations/admin'),                                     
                                      ),
                                      'visible' => Yii::app()->user->checkAccess('superadmin')
                                ),
                                array('name' => Yii::t('all','Пользователи'), 'link' => array('/users/admin'), 
                                      'active'=>'users/admin', 'icon'=>'users',
                                      'sub' => array(
                                         array('name' => Yii::t('all','Roles'), 'link' => array('/authItem/admin'), 'visible' => Yii::app()->user->checkAccess('superadmin'),'active'=>'authItem/admin'),
                                         array('name' => Yii::t('all','Appointment of users'), 'link' => array($islink.'/authAssignment/admin'), 'visible' => Yii::app()->user->checkAccess('superadmin'),'active'=>'authAssignment/admin'),                                          
                                         array('name' => Yii::t('all','Подчинения ролей'), 'link' => array($islink.'/authItemChild/admin'), 'visible' => Yii::app()->user->checkAccess('superadmin'),'active'=>'authItemChild/admin'),                                          
                                          
                                      ),
                                      'visible' => Yii::app()->user->checkAccess('superadmin')
                                ),   
                                array('name' => Yii::t('all','Рассылка'), 'link' => array('/subscribe/admin'), 
                                      'active'=>'subscribe', 'icon'=>'mail-delivery',
                                      'sub'  => array(
                                          array('name' => Yii::t('all','Управление рассылкой'), 'link' => array('/subscribe/admin'), 'visible' => Yii::app()->user->checkAccess('superadmin'), 'active'=>'subscribe/admin'),
                                          array('name' => Yii::t('all','Шаблоны рассылки'), 'link' => array('/typeSubscribe/admin'), 'visible' => Yii::app()->user->checkAccess('superadmin'), 'active'=>'typeSubscribe/admin')
                                      ),
                                      'visible' => Yii::app()->user->checkAccess('superadmin')
                                ),                                                                                                                     
                                //array('name' => Yii::t('all','Realestates'), 'link' => array('/realestates'), 'visible' => Yii::app()->user->checkAccess('superadmin')),                                 
                                array('name' => Yii::t('all','Clients'), 'link' => array($islink.'/clients/admin'), 
                                      'action'=>array('clients'), 'icon'=>'clients',
                                      'sub' => array(
                                               array('name' => Yii::t('all','Tenants'), 'link' => array($islink.'/clients/tenants'), 'visible' => Yii::app()->user->getName()=='superadmin', 'active'=>'clients/tenants'),
                                               array('name' => Yii::t('all','Buyers'), 'link' => array($islink.'/clients/buyers'), 'visible' => Yii::app()->user->getName()=='superadmin' , 'active'=>'clients/buyers'),                                                                                                                    
                                       ),
                                       'visible' => Yii::app()->user->checkAccess('superadmin')
                                ),   
                                array('name' => Yii::t('all','Владельцы'), 'link' => array('/representatives/admin'), 
                                      'visible' => Yii::app()->user->checkAccess('superadmin'), 'active'=>'representatives/admin', 
                                      'icon'=>'owners'),                                  
                                //array('name' => Yii::t('all','Owner'), 'link' => array($islink.'/partners/owners'), 'visible' => Yii::app()->user->checkAccess('superadmin'), 'active'=>'partners/owners'),
                                array('name' => Yii::t('all','Partners'), 'link' => array($islink.'/partners'), 
                                      'visible' => Yii::app()->user->checkAccess('superadmin'), 'active'=>'partners',
                                      'icon'=>'partners'),                       
                                array('name' => Yii::t('all','Realestates'), 'link' => array('/realestates/admin'), 'active'=>'realestates', 'icon'=>'realestate',
                                      'sub' => array(
                                            array('name' => Yii::t('all','Offices'), 'link' => array('/realestates/office'), 'visible' => Yii::app()->user->checkAccess('superadmin'),'active'=>'realestates/office'),                                 
                                            array('name' => Yii::t('all','Warehouses'), 'link' => array('/realestates/warehouse'), 'visible' => Yii::app()->user->checkAccess('superadmin'),'active'=>'realestates/warehouse'),
                                            array('name' => Yii::t('all','Cottages'), 'link' => array('/realestates/cottage'), 'visible' => Yii::app()->user->checkAccess('superadmin'),'active'=>'realestates/cottage'),                                 
                                            array('name' => Yii::t('all','Auctions'), 'link' => array('/realestates/auction'), 'visible' => Yii::app()->user->checkAccess('superadmin'),'active'=>'realestates/auction'),
                                            array('name' => Yii::t('all','Другое'), 'link' => array('/realestates/other'), 'visible' => Yii::app()->user->checkAccess('superadmin'),'active'=>'realestates/other'),                                          
                                            //array('label' => str_repeat( '-', 36), 'visible' => Yii::app()->user->checkAccess('superadmin')),
                                        ), 
                                        'visible' => true, //Yii::app()->user->checkAccess('superadmin')
                                ),                                       
                                array('name' => Yii::t('all','Локализация'), 'link'=>array($islink.'/messages/admin'), 
                                      'active'=>'messages', 'icon'=>'translate',
                                      'sub' => array( 
                                           array('name' => Yii::t('all','Messages'), 'link' => array($islink.'/messages/admin'), 'visible' => Yii::app()->user->checkAccess('superadmin'), 'active'=>'messages/admin'),                                                                  
                                           array('name' => Yii::t('all','Translations'), 'link' => array($islink.'/sourceMessages/admin'), 'visible' => Yii::app()->user->checkAccess('superadmin'), 'active'=>'sourceMessages/admin'),                              
                                      ),  
                                     'visible' => Yii::app()->user->checkAccess('superadmin')
                                ),    
                                array('name' => Yii::t('all','Cправочники'), /*'link' => '#',*/ 'icon'=>'directory',
                                      'sub' => array(                                                                                
                                            array('name' => Yii::t('all','Countries'), 'link' => array($islink.'/countries/admin'), 'visible' => Yii::app()->user->checkAccess('superadmin'), 'active' => 'countries/admin' ),
                                            array('name' => Yii::t('all','Regions'), 'link' => array($islink.'/regions/admin'), 'visible' => Yii::app()->user->checkAccess('superadmin'), 'active' => 'regions/admin' ),
                                            array('name' => Yii::t('all','Cities'), 'link' => array($islink.'/cities/admin'), 'visible' => Yii::app()->user->checkAccess('superadmin'), 'active' => 'cities/admin'),
                                            array('name' => Yii::t('all','Districts'), 'link' => array($islink.'/districts/admin'), 'visible' => Yii::app()->user->checkAccess('superadmin'), 'active' => 'districts/admin'),
                                            array('name' => Yii::t('all','Areas'), 'link' => array($islink.'/areas/admin'), 'visible' => Yii::app()->user->checkAccess('superadmin'), 'active' => 'areas/admin'),
                                            array('name' => Yii::t('all','Улицы'), 'link' => array($islink.'/streets/admin'), 'visible' => Yii::app()->user->checkAccess('superadmin'), 'active' => 'streets/admin'),
                                            array('name' => Yii::t('all','Метро'), 'link' => array($islink.'/metros/admin'), 'visible' => Yii::app()->user->checkAccess('superadmin'), 'active' => 'metros/admin'),
                                            array('name' => Yii::t('all','Валюта'), 'link' => array($islink.'/valutes/admin'), 'visible' => Yii::app()->user->checkAccess('superadmin'), 'active'=>'valutes/admin'),                              
                                            array('name' => Yii::t('all','Types of clients'), 'link' => array($islink.'/clientTypes/admin'), 'visible' => Yii::app()->user->checkAccess('superadmin'), 'active' => 'clientTypes/admin'),
                                            array('name' => Yii::t('all','View commissions had worked'), 'link' => array($islink.'/commissions/admin'), 'visible' => Yii::app()->user->checkAccess('superadmin'), 'active'=>'commissions/admin'),
                                            array('name' => Yii::t('all','Types of contracts'), 'link' => array($islink.'/contractTypes/admin'), 'visible' => Yii::app()->user->checkAccess('superadmin'), 'active'=>'contractTypes/admin'),                                 
                                            array('name' => Yii::t('all','Parking'), 'link' => array($islink.'/parkings/admin'), 'visible' => Yii::app()->user->checkAccess('superadmin'), 'active'=>'parkings/admin'),   
                                            array('name' => Yii::t('all','Planning'), 'link' => array($islink.'/plannings/admin'), 'visible' => Yii::app()->user->checkAccess('superadmin'), 'active'=>'plannings/admin'),   
                                            array('name' => Yii::t('all','Properties'), 'link' => array($islink.'/properties/admin'), 'visible' => Yii::app()->user->checkAccess('superadmin'), 'active'=>'properties/admin'),
                                            array('name' => Yii::t('all','Destinations'), 'link' => array($islink.'/destinations/admin'), 'visible' => Yii::app()->user->checkAccess('superadmin'), 'active'=>'destinations/admin'),
                                          
                                            array('name' => Yii::t('all','Types of realestates'), 'link' => array($islink.'/realestateTypes/admin'), 'visible' => Yii::app()->user->checkAccess('superadmin'), 'active'=>'realestateTypes/admin'),                                 
                                            array('name' => Yii::t('all','Views of realestates'), 'link' => array($islink.'/realestateVids/admin'), 'visible' => Yii::app()->user->checkAccess('superadmin'), 'active'=>'realestateVids/admin'),                                 
                                            array('name' => Yii::t('all','Properties of realestates'), 'link' => array($islink.'/realestateProperties/admin'), 'visible' => Yii::app()->user->checkAccess('superadmin'), 'active'=>'realestateProperties/admin'),
                                            array('name' => Yii::t('all','Comparison of realestates'), 'link' => array($islink.'/realestateSimilarities/admin'), 'visible' => Yii::app()->user->checkAccess('superadmin'), 'active'=>'realestateSimilarities/admin'),                                                                                                                                    
                                            array('name' => Yii::t('all','Class of realestates'), 'link' => array($islink.'/realestateClasses/admin'), 'visible' => Yii::app()->user->checkAccess('superadmin'), 'active'=>'realestateClasses/admin'),                                                                                                                          
                                            array('name' => Yii::t('all','Destinations of realestates'), 'link' => array($islink.'/realestateDestinations/admin'), 'visible' => Yii::app()->user->checkAccess('superadmin'), 'active'=>'realestateDestinations/admin'),                                                                                                                          
                                            array('name' => Yii::t('all','Space intervals'), 'link' => array($islink.'/fareaOffers/admin'), 'visible' => Yii::app()->user->checkAccess('superadmin'), 'active'=>'fareaOffers/admin'),                                                                                                                                                                    
                                            array('name' => Yii::t('all','Status of realestates'), 'link' => array($islink.'/realestateStatus/admin'), 'visible' => Yii::app()->user->checkAccess('superadmin'), 'active'=>'realestateStatus/admin'),                                                                                                                          
                                            array('name' => Yii::t('all','Status of client'), 'link' => array($islink.'/clientStatus/admin'), 'visible' => Yii::app()->user->checkAccess('superadmin'), 'active'=>'clientStatus/admin'),                                                                                                                          
                                            array('name' => Yii::t('all','Scopes of client'), 'link' => array($islink.'/clientScopes/admin'), 'visible' => Yii::app()->user->checkAccess('superadmin'), 'active'=>'clientScopes/admin'),                                                                                                                          
                                          
                                          
                                            //array('name' => Yii::t('all','Тип сделки'), 'link' => array('#/type_transactions'), 'visible' => Yii::app()->user->checkAccess('superadmin') ),
                                            //array('name' => Yii::t('all','Тип обьекта'), 'link' => array('#/objects'), 'visible' => Yii::app()->user->checkAccess('superadmin')),
                                            //array('name' => Yii::t('all','Класс обьекта'), 'link' => array('#/class'), 'visible' => Yii::app()->user->checkAccess('superadmin')) , 
                                            //array('name' => Yii::t('all','Категории недвижимости'), 'link' => array('#/categories'), 'visible' => Yii::app()->user->checkAccess('superadmin') ),
                                            //array('name' => Yii::t('all','Операции'), 'link' => array('#/orders'), 'visible' => Yii::app()->user->checkAccess('superadmin') ),
                                            //array('name' => Yii::t('all','Вид аренды'), 'link' => array('#/rents'), 'visible' => Yii::app()->user->checkAccess('superadmin') ),
                                            //array('name' => Yii::t('all','Cроки аренды'), 'link' => array('#/terms'), 'visible' => Yii::app()->user->checkAccess('superadmin') ),
                                     
                                            array('name' => Yii::t('all','Taxs'), 'link' => array($islink.'/taxs/admin'), 'visible' => Yii::app()->user->checkAccess('superadmin'), 'active'=>'taxs/admin'),                              
                                            array('name' => Yii::t('all','Units of measure'), 'link' => array($islink.'/units/admin'), 'visible' => Yii::app()->user->checkAccess('superadmin'), 'active'=>'units/admin'),
                                        ),
                                        'visible' => Yii::app()->user->checkAccess('superadmin')
                                 ),                                   
                                array('name' => Yii::t('all','Logout'), 'link' => array('/site/logout'), 'icon'=>'logout'),                                
                             );

                   $this->widget('ext.menu.EMenu', array('items' => $items));
                    ?>
                  </td>
                </tr>
              </table>            
                </div>   
                <div>
                    <?php echo $content; ?>      
                </div>    
                <div class="clear"></div>
            </div>    
        </div>
        
	<div id="footer">
                
		<?/*=Yii::t('all','Copyright &copy;');?>  <?php echo date('Y'); ?> <?=Yii::t('all','by Web Studio Rtvs.');?><br/>*/?>
		<?=Yii::t('all','All Rights Reserved.');?><br/>
		<?php// echo Yii::powered(); ?>
	</div><!-- footer -->
      </div><!-- page -->      
</body>
</html>
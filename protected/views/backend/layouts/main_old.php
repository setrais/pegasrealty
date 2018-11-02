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
                            <a href="#" ><?php echo Yii::t('all','Offices');?></a>
                        </div>
                        <div id="vid-2" class="vid" >
                            <a href="#" ><?php echo Yii::t('all','Warehouses');?></a>
                        </div>
                        <div id="vid-3" class="vid" >
                            <a href="#" ><?php echo Yii::t('all','Cottages');?></a>
                        </div>
                        <div id="vid-4" class="vid" >
                            <a href="#" ><?php echo Yii::t('all','Auctions');?></a>
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
        <div style="position:relative;" >
            <div id="left" <?php echo ( Yii::app()->user->checkAccess('superadmin') ? 'class="t76"' : 'class="all-hmenu t76"');?> style="left:-250px !important;top:10px !important;position:absolute;" >
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
                                 array('items' => array(
                                      array('label'=>Yii::t('all','Рассылка'), 'url' => array('/subscribe/admin'), /*'active'=>'subscribe/admin',*/  'visible' => Yii::app()->user->checkAccess('superadmin')),
                                      array('items'=>array(
                                          array('label' => Yii::t('all','Управление рассылкой'), 'url' => array('/subscribe/admin'), 'visible' => Yii::app()->user->checkAccess('superadmin') /*'active'=>'subscribe/admin'*/),
                                          array('label' => Yii::t('all','Шаблоны рассылки'), 'url' => array('/typeSubscribe/admin'), 'visible' => Yii::app()->user->checkAccess('superadmin') /*'active'=>'typeSubscribe/admin'*/)    
                                          )
                                      ),                                      
                                 ),'visible' => Yii::app()->user->checkAccess('superadmin')),                                  
                                 array('label' => Yii::t('all','Logout'), 'url' => array('/site/logout')),
                                 array('label' => str_repeat( '-', 39), 'visible' => Yii::app()->user->checkAccess('superadmin')),
                             ),
                        )
                    );
                    ?>
                  </td>
                </tr>
              </table>            
            </div>    
	<?php echo $content; ?>      
        </div>
	<div id="footer">
                
		<?/*=Yii::t('all','Copyright &copy;');?>  <?php echo date('Y'); ?> <?=Yii::t('all','by Web Studio Rtvs.');?><br/>*/?>
		<?=Yii::t('all','All Rights Reserved.');?><br/>
		<?php// echo Yii::powered(); ?>
	</div><!-- footer -->
      </div><!-- page -->      
</body>
</html>
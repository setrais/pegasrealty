<?/*<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">*/?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xml:lang="en" lang="en" >
<head>          
<title><?php echo CHtml::encode($this->pageTitle); ?></title>       
<?  Yii::app()->clientScript->registerMetaTag(null,'text/html; charset=utf-8','Content-Type');
    Yii::app()->clientScript->registerMetaTag(Yii::t('all',$this->pageDescription), 'description'); 
    Yii::app()->clientScript->registerMetaTag(implode(', ',$this->pageKeywords), 'keywords');
    Yii::app()->clientScript->registerMetaTag("ru", 'language'); //!@TODO Lang
    Yii::app()->clientScript->registerMetaTag("6670a13164fc357b", 'yandex-verification');
    Yii::app()->clientScript->registerMetaTag("msvalidate.01", '93AE4F9742B89DE6A922FFFC8ED6BDB9');
    Yii::app()->clientScript->registerMetaTag("wmail-verification", '8b3067952b10a40f');
    Yii::app()->clientScript->registerMetaTag("google-site-verification", 'CTCVcztMj5mOHzJWHuE8cv20BNFp9a8M5-po2aVKTDM');     
    
  /*<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
    <meta name="description" content="<?php echo CHtml::encode(Yii::t('all',$this->pageDescription));?>" />
    <meta name="keywords" content="<?php echo CHtml::encode( implode(', ',$this->pageKeywords) ); ?>" />        
    <meta name="language" content="ru" />
    <meta name='yandex-verification' content='6670a13164fc357b' />
    <meta name="msvalidate.01" content="93AE4F9742B89DE6A922FFFC8ED6BDB9" />
    <meta name='wmail-verification' content='8b3067952b10a40f' />
    <meta name="google-site-verification" content="CTCVcztMj5mOHzJWHuE8cv20BNFp9a8M5-po2aVKTDM" />*/    
  //<meta name="google-site-verification" content="1UbWVy-TCuvDuH70aTtK5WMYrQ3Mz4QMtDV-RRbFHRY" />
  /*<!-- blueprint CSS framework -->         
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
    <!--[if lt IE 8]>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/frontend/form.css" />*/

    Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/screen.css','screen, projection');
    Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/print.css','print');
    Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/ie.css', 'screen, projection:lt IE 8');
    Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/main.css');             
    Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/frontend/form.css'); 
    
    /*<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/frontend/reset.css" />*/
    
    Yii::app()->clientScript->registerCoreScript('jquery');              
    Yii::app()->clientScript->registerCoreScript('jquery.ui');         
    Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/backend/widgets/jui/themes/cupertino/jquery-ui.css');        
    Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/fancybox/jquery.fancybox-1.3.4.pack.js');
    Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/fancybox/jquery.easing-1.3.pack.js');
    Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/fancybox/jquery.fancybox-1.3.4.css');
    Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/backend/jquery.pnotify/jquery.pnotify.min.js');
    Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/js/backend/jquery.pnotify/jquery.pnotify.default.css');           
    Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/backend/tipsy/jquery.tipsy.js');
    Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/js/backend/tipsy/tipsy.css');   
    Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/jquery-blink-master/lib/jquery.blink.js');
    Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/webticker/jquery.webticker.js');
    Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/js/webticker/mywebticker.css');
    

/*<script type="text/javascript" src="/css/jui/js/jquery.js"></script>*/
?>
<script type="text/javascript" src="//yandex.st/share/share.js" charset="utf-8"></script>
<?/*<script type="text/javascript" src="//vk.com/js/api/openapi.js?105"></script>
<script type="text/javascript">
  VK.init({
    apiId: 2847179,
    onlyWidgets: true
  });
</script>*/?>
<?
/*<script src="http://vkontakte.ru/js/api/openapi.js" type="text/javascript" charset="windows-1251"></script>
  <script type="text/javascript">
          VK.init({
            apiId: 2847179,
            onlyWidgets: true
          });
  </script>*/?>
<script type="text/javascript">
      var _gaq = _gaq || [];
          _gaq.push(['_setAccount', 'UA-33312403-1']);
          _gaq.push(['_trackPageview']);

         (function() {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
         })();
</script>
<script type="text/javascript" src="/js/frontend/cengine.js"></script>        
<?/*<link href="/css/frontend/mains.css?v=20110711" rel="stylesheet" type="text/css" />*/?>
<link href="/css/frontend/mains.css" rel="stylesheet" type="text/css" />
<link rel="icon" href="<?php echo Yii::app()->request->baseUrl; ?>/favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" type="image/x-icon" href="<?php echo Yii::app()->request->baseUrl; ?>/favicon.ico" />
</head> 
<body class="fbg-orang">
  <div class="fbg-line-top pos-a"></div>
  <div class="fbg-svet-top pos-a"></div>
  <div id="svet" class="fbg-rsvet">
        <div id="wrap" class="fbg-lsvet"> 
          <div id="puls" class="fbg-line-puls"> 
          <div class="container" id="page">
              <?/*<!--<div class="header">
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
              header end -->*/?>
              <div id="header" style="position:relative;">
                      <div id="icons">
                          <a href="/site/sitemap/" title="Карта сайта" >
                              <img width="16" height="16" border="0" alt="Карта сайта" src="/images/sitemap.png" />
                          </a>        
                      </div>    
                      <div id="logo" onclick="document.location.href='/';" style="cursor: pointer; padding: 10px 0px 0px; height: 74px;">                    
                          <div class="fbg-city" style="height:100%;" > 
                              <div style="line-height: 64px;text-align: right;font-size: 32px;padding-left: 84px;text-align: left;text-shadow: 1px 1px 2px #C9C8C6, 0 0 6px #DDDDDD;text-transform: uppercase;">
                                  <a class="home" href="/" style="z-index:100000;position:relative;" ><?php echo CHtml::encode(Yii::t("all","Pegas Realty")); ?></a>
                              </div>
                          </div>    
                      </div>
                      <div id="phone" style="position:absolute;font-size:20px;font-family: Calibri;right:20px;top:30px;">                    
                          <i style="padding-left:32px;font-size:24px;color: #15428b">+<?php echo Yii::app()->params["contact"]["code_country"];?></i> <span style="vertical-align:top;"> <span style="color: #15428b">(</span><?php echo Yii::app()->params["contact"]["code_oper"];?><span style="color: #15428b">)</span> <?php echo Yii::app()->params["contact"]["code_phone"];?></span>
                          <?php echo CHtml::link(CHtml::image('/images/interner-news-reader.png', 'Свежие RSS новости по Аренде офисов в Москве от Пегас Недвижимость', array('title'=>'Свежие RSS новости по Аренде офисов в Москве от Пегас недвижимость')), '/site/rss/', array('title'=>'Свежие RSS новости по Аренде офисов в Моске от Пегас недвижимость','style'=>'font-size:6px;','target'=>'_blank'));?>
                      </div>
                     <div id="email" style="position:absolute;line-height:27px;font-family:Calibri;right:24px;top:54px;vertical-align: middle;">                    
                        <?php //<i style="padding-left:32px;font-size:14px;color: /*#7f8a7f;*/#9e9f81;/*#4eba46/*#64B922*/"> ?>
                        <?php// echo Yii::app()->params["contact"]["email_main"];?>
                        <?php //</i> ?>
                        <span style="font-size: 1em;color: rgb(51, 51, 51);font-family: Arial;line-height: 24px;margin-right: 7px;vertical-align: top;">
                            <?php echo Yii::app()->params["contact"]["email_main"];?>
                        </span>   
                        <?php echo CHtml::link(CHtml::image('/images/email-rtvs 16x16.png', 'Отправить письмо на корпоративную почту АН "Пегас недвижимость"', array('title'=>'Отправить письмо на корпоративную почту АН "Пегас недвижимость"')), '/site/contact/', array('title'=>'Отправить письмо на корпоративную почту АН "Пегас недвижимость"','style'=>'display:inline-block;vertical-align:middle;'));?>
                     </div>                
              </div><!-- header -->

              <div id="mainmenu" style="text-align: right;">
                      <?php $this->widget('zii.widgets.CMenu',array(
                              'items'=>array(
                                      array('label' => Yii::t('menu','Главная'), 'url' => '/', 'active'=>Yii::app()->request->getRequestUri()=='/'), //Main 
                                      //array('label' => Yii::t('menu','About company'), 'url'=>array('/site/page', 'view'=>'about')),                                                                
                                      array('label' => Yii::t('menu','About company'), 'url'=>array('/site/index', 'id'=>2)),                                                                
                                      array('label' => Yii::t('menu','Каталог недвижимости'), 'url'=>array('/realestates/index')), 
                                      //array('label' => Yii::t('all','News'), 'url'=>array('/site/news')),
                                      array('label' => Yii::t('all','Арендаторам'), 'url'=>array('/site/index', 'id'=>3)),//tenants
                                      //array('label' => Yii::t('all','Owners'), 'url'=>array('/site/owners')),
                                      array('label' => Yii::t('menu','Owners'), 'url'=>array('/site/index', 'id'=>8)),//Owners                                                                  
                                      array('label' => Yii::t('menu','Contact'), 'url'=>array('/site/contact')),
                                      array('label' => Yii::t('menu','Партнеры'), 'url'=>array('/site/partners')),//Партнеры
                                      array('label' => Yii::t('menu','Новости'), 'url'=>array('/site/news'), //News 
                                                //'items'=>array(
                                                //    array('label'=>'New Rent', 'url'=>array('/site/news', 'tag'=>'rent')), // Rent News
                                                //    array('label'=>'New Company', 'url'=>array('/site/news', 'tag'=>'company')), // Company News
                                                //    array('label'=>'New World', 'url'=>array('/site/news', 'tag'=>'world')), // World News                       
                                           ),
                                      array('label' => Yii::t('menu','Статьи'), 'url'=>array('/site/list', 'id'=>14)),//Статьи 
                                      array('label' => Yii::t('menu','FAV'), 'url'=>array('/realestates/favs')),
                                      /*array('label'=>'Home', 'url'=>array('/site/index')),
                                      array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),                                                                
                                      array('label'=>'Contact', 'url'=>array('/site/contact')),
                                      array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
                                      array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)*/
                              ),
                              'htmlOptions'=>array('style'=>'position:relative;z-index:1002') 
                      )); ?>
              </div>
              <?php if(isset($this->breadcrumbs)):?>
                      <?php $this->widget('zii.widgets.CBreadcrumbs', array(
                              'links'=>$this->breadcrumbs,
                              'homeLink'=>CHtml::link(Yii::t('menu','Home'),Yii::app()->homeUrl)
                      )); ?><!-- breadcrumbs -->
              <?php endif?>
              <?/*<div id="content" >*/?>
              <?php echo $content; ?>
              <?/*</div>*/?>    

              <div class="l-t1 pre_footer ses" >
                    <?php $this->renderPartial('/site/info'); ?> 
              </div>
              <div id="footer">                  
                  <div class="left"> 
                      <div class="inline halign-l"><?=Yii::t('all','Copyright &copy;');?> 2012-<?php echo date('Y');?><?php// echo date('Y'); ?> <?=Yii::t('all','All Rights Reserved.');?><br/><?=Yii::t('all','Real Estate Agency - "Pegas Realty"');?>
                      &nbsp;<br/><a href="http://rtvs.net/" style="text-decoration:none;cursor:pointer;" rel="nofollow" ><span style="color: #a32d00"><?=Yii::t('all','Designed by Web Studio Rtvs');?></span></a>		
                      </div>
                      <div class="inline halign-l">
                          <a href="http://rtvs.net/" style="vertical-align:middle;text-decoration:none;cursor:pointer;" rel="nofollow" ><img src="/images/logo_artvs32.png" alt="<?=Yii::t('all','Designed by Web Studio Rtvs');?>" title="<?=Yii::t('all','Designed by Web Studio Rtvs');?>" align="absmiddle" /></a>
                      </div>
                      <div class="clear"></div>
                  </div>
                  <div class="right">
                      <!-- Rating@Mail.ru counter -->
                          <script type="text/javascript">//<![CDATA[
                          var a='',js=10;try{a+=';r='+escape(document.referrer);}catch(e){}try{a+=';j='+navigator.javaEnabled();js=11;}catch(e){}
                          try{s=screen;a+=';s='+s.width+'*'+s.height;a+=';d='+(s.colorDepth?s.colorDepth:s.pixelDepth);js=12;}catch(e){}
                          try{if(typeof((new Array).push('t'))==="number")js=13;}catch(e){}
                          try{document.write('<a href="http://top.mail.ru/jump?from=2228044">'+
                          '<img src="http://df.cf.b1.a2.top.mail.ru/counter?id=2228044;t=56;js='+js+a+';rand='+Math.random()+
                          '" alt="Рейтинг@Mail.ru" style="border:0;" height="31" width="88" \/><\/a>');}catch(e){}//]]></script>
                          <noscript><p><a href="http://top.mail.ru/jump?from=2228044">
                          <img src="http://df.cf.b1.a2.top.mail.ru/counter?js=na;id=2228044;t=56" 
                          style="border:0;" height="31" width="88" alt="Рейтинг@Mail.ru" /></a></p></noscript>
                      <!-- //Rating@Mail.ru counter -->
                      <!--bigmir)net TOP 100-->
                              <script type="text/javascript" language="javascript"><!--
                              function BM_Draw(oBM_STAT){
                              document.write('<table cellpadding="0" cellspacing="0" border="0" style="display:inline-block;margin-right:0px;width:88px;line-height:36px;"><tr><td><div style="margin:0px;padding:0px;font-size:1px;width:88px;display:inline-block;height:47px;"><div style="background:url(\'http://i.bigmir.net/cnt/samples/diagonal/b63_top.gif\') no-repeat bottom;"> </div><div style="font:10px Tahoma;background:url(\'http://i.bigmir.net/cnt/samples/diagonal/b63_center.gif\');"><div style="text-align:center;"><a href="http://www.bigmir.net/" target="_blank" style="color:#0000ab;text-decoration:none;font:10px Tahoma;">bigmir<span style="color:#ff0000;">)</span>net</a></div><div style="margin-top:3px;padding: 0px 6px 0px 6px;color:#12351d;"><div style="float:left;font:10px Tahoma;">'+oBM_STAT.hosts+'</div><div style="float:right;font:10px Tahoma;">'+oBM_STAT.hits+'</div></div><br clear="all"/></div><div style="background:url(\'http://i.bigmir.net/cnt/samples/diagonal/b63_bottom.gif\') no-repeat top;"> </div></div></td></tr></table>');
                              }
                              //-->
                              </script>
                              <script type="text/javascript" language="javascript"><!--
                              bmN=navigator,bmD=document,bmD.cookie='b=b',i=0,bs=[],bm={o:1,v:16910563,s:16910563,t:0,c:bmD.cookie?1:0,n:Math.round((Math.random()* 1000000)),w:0};
                              for(var f=self;f!=f.parent;f=f.parent)bm.w++;
                              try{if(bmN.plugins&&bmN.mimeTypes.length&&(x=bmN.plugins['Shockwave Flash']))bm.m=parseInt(x.description.replace(/([a-zA-Z]|\s)+/,''));
                              else for(var f=3;f<20;f++)if(eval('new ActiveXObject("ShockwaveFlash.ShockwaveFlash.'+f+'")'))bm.m=f}catch(e){;}
                              try{bm.y=bmN.javaEnabled()?1:0}catch(e){;}
                              try{bmS=screen;bm.v^=bm.d=bmS.colorDepth||bmS.pixelDepth;bm.v^=bm.r=bmS.width}catch(e){;}
                              r=bmD.referrer.slice(7);if(r&&r.split('/')[0]!=window.location.host){bm.f=escape(r);bm.v^=r.length}
                              bm.v^=window.location.href.length;for(var x in bm) if(/^[ovstcnwmydrf]$/.test(x)) bs[i++]=x+bm[x];
                              bmD.write('<sc'+'ript type="text/javascript" language="javascript" src="http://c.bigmir.net/?'+bs.join('&')+'"></sc'+'ript>');
                              //-->
                              </script>                        
                      <style>
                         .right table {
                              padding-bottom: 6px !important;
                              vertical-align: middle !important;
                         }
                      </style>
                      <noscript>
                         <a href="http://www.bigmir.net/" target="_blank" ><img src="http://c.bigmir.net/?v16910563&s16910563&t2" width="88" height="31" alt="bigmir)net TOP 100" title="bigmir)net TOP 100" border="0" /></a>
                      </noscript>

                      <!--bigmir)net TOP 100-->                
                      <!-- begin of Top100 code -->
                          <script id="top100Counter" type="text/javascript" src="http://counter.rambler.ru/top100.jcn?2747583"></script>
                          <noscript>
                              <a href="http://top100.rambler.ru/navi/2747583/">
                                  <img src="http://counter.rambler.ru/top100.cnt?2747583" alt="Rambler's Top100" border="0" />
                              </a>
                          </noscript>
                      <!-- end of Top100 code -->                
                      <!-- UAPortnet -->
                      <noscript>
                      <a href="http://uaport.net/news/ua/" target="_blank"><img src="http://uaport.net/banners/news_uaport_2.gif" width="88" height="31" border="0" title="Новости"></a>                
                      </noscript>                
                      <!-- End UAPortnet -->
                      <!-- I.UA counter -->
                          <a href="http://www.i.ua/" target="_blank" onclick="this.href='http://i.ua/r.php?143064';" title="Rated by I.UA" rel="nofollow" >
                          <script type="text/javascript" language="javascript"><!--
                          iS='<img src="http://r.i.ua/s?u143064&p167&n'+Math.random();
                          iD=document;if(!iD.cookie)iD.cookie="b=b; path=/";if(iD.cookie)iS+='&c1';
                          iS+='&d'+(screen.colorDepth?screen.colorDepth:screen.pixelDepth)
                          +"&w"+screen.width+'&h'+screen.height;
                          iT=iD.referrer.slice(7);iH=window.location.href.slice(7);
                          ((iI=iT.indexOf('/'))!=-1)?(iT=iT.substring(0,iI)):(iI=iT.length);
                          if(iT!=iH.substring(0,iI))iS+='&f'+escape(iD.referrer.slice(7));
                          iS+='&r'+escape(iH);
                          iD.write(iS+'" border="0" width="88" height="31" />');
                          //--></script></a>
                      <!-- End of I.UA counter -->
                      <!--LiveInternet counter-->
                          <script type="text/javascript"><!--
                          document.write("<a href='http://www.liveinternet.ru/click' "+
                          "target=_blank><img src='//counter.yadro.ru/hit?t13.6;r"+
                          escape(document.referrer)+((typeof(screen)=="undefined")?"":
                          ";s"+screen.width+"*"+screen.height+"*"+(screen.colorDepth?
                          screen.colorDepth:screen.pixelDepth))+";u"+escape(document.URL)+
                          ";h"+escape(document.title.substring(0,80))+";"+Math.random()+
                          "' alt='' title='LiveInternet: показано число просмотров за 24"+
                          " часа, посетителей за 24 часа и за сегодня' "+
                          "border='0' width='88' height='31'><\/a>")
                          //--></script>
                      <!--/LiveInternet-->
                      <!-- HotLog -->
                      <script type="text/javascript" language="javascript">
                      hotlog_js="1.0"; hotlog_r=""+Math.random()+"&s=2244364&im=307&r="+
                      escape(document.referrer)+"&pg="+escape(window.location.href);
                      </script>
                      <script type="text/javascript" language="javascript1.1">
                      hotlog_js="1.1"; hotlog_r+="&j="+(navigator.javaEnabled()?"Y":"N");
                      </script>
                      <script type="text/javascript" language="javascript1.2">
                      hotlog_js="1.2"; hotlog_r+="&wh="+screen.width+"x"+screen.height+"&px="+
                      (((navigator.appName.substring(0,3)=="Mic"))?screen.colorDepth:screen.pixelDepth);
                      </script>
                      <script type="text/javascript" language="javascript1.3">
                      hotlog_js="1.3";
                      </script>
                      <script type="text/javascript" language="javascript">
                      hotlog_r+="&js="+hotlog_js;
                      document.write('<a href="http://click.hotlog.ru/?2244364" target="_blank"><img '+
                      'src="http://hit41.hotlog.ru/cgi-bin/hotlog/count?'+
                      hotlog_r+'" border="0" width="88" height="31" title="HotLog: показано количество посетителей за сегодня, за вчера и всего" alt="HotLog"><\/a>');
                      </script>
                      <noscript>
                      <a href="http://click.hotlog.ru/?2244364" target="_blank"><img
                      src="http://hit41.hotlog.ru/cgi-bin/hotlog/count?s=2244364&im=307" border="0"
                      width="88" height="31" title="HotLog: показано количество посетителей за сегодня, за вчера и всего" alt="HotLog"></a>
                      </noscript>
                      <!-- /HotLog -->                
                      <!-- Yandex.Metrika informer -->
                      <a href="https://metrika.yandex.ru/stat/?id=15927313&amp;from=informer"
                        target="_blank" rel="nofollow"><img src="//bs.yandex.ru/informer/15927313/3_1_FFFFFFFF_FFF5EEFF_0_pageviews"
                        style="width:88px; height:31px; border:0;" alt="Яндекс.Метрика" title="Яндекс.Метрика: данные за сегодня (просмотры, визиты и уникальные посетители)" onclick="try{Ya.Metrika.informer({i:this,id:15927313,lang:'ru'});return false}catch(e){}"/></a>
                      <!-- /Yandex.Metrika informer -->

                      <!-- Yandex.Metrika counter -->
                        <script type="text/javascript">
                        (function (d, w, c) {
                            (w[c] = w[c] || []).push(function() {
                                try {
                                    w.yaCounter15927313 = new Ya.Metrika({id:15927313,
                                            webvisor:true,
                                            clickmap:true,
                                            trackLinks:true,
                                            accurateTrackBounce:true,
                                            trackHash:true});
                                } catch(e) { }
                            });

                            var n = d.getElementsByTagName("script")[0],
                                s = d.createElement("script"),
                                f = function () { n.parentNode.insertBefore(s, n); };
                            s.type = "text/javascript";
                            s.async = true;
                            s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

                            if (w.opera == "[object Opera]") {
                                d.addEventListener("DOMContentLoaded", f, false);
                            } else { f(); }
                        })(document, window, "yandex_metrika_callbacks");
                        </script>
                        <noscript><div><img src="//mc.yandex.ru/watch/15927313" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
                      <!-- /Yandex.Metrika counter -->
                      <!--Openstat-->
                          <span id="openstat2269938"></span>
                          <script type="text/javascript">
                          var openstat = { counter: 2269938, image: 91, color: "ff9822", next: openstat };
                          (function(d, t, p) {
                          var j = d.createElement(t); j.async = true; j.type = "text/javascript";
                          j.src = ("https:" == p ? "https:" : "http:") + "//openstat.net/cnt.js";
                          var s = d.getElementsByTagName(t)[0]; s.parentNode.insertBefore(j, s);
                          })(document, "script", document.location.protocol);
                          </script>
                      <!--/Openstat-->
                      <?/*<!--Google Analytics-->
                      <script>
                        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
                        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

                        ga('create', 'UA-33312403-1', 'auto');
                        ga('send', 'pageview');

                      </script>
                      <!--Google Analytics-->*/?>
                  </div>
                  <div class="clear"></div>
                  <?php// echo Yii::powered(); ?>
              </div><!-- footer -->
          </div><!-- page -->
          </div> <!-- puls -->
        </div><!-- wrap -->
  </div>
</body>    
</html>
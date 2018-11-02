<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.

// set default
$lang = 'ru';
 
// lang list (path=>Yii I18N name)
$i18n = array(
	'de'=>'de_DE',
	'el'=>'el_EL',
	'en'=>'en_US',
	'es'=>'es_ES',
	'fr'=>'fr_FR',
	'hu'=>'hu_HU',
	'pt'=>'pt_PT',
	'ru'=>'ru_RU',
	'ua'=>'ua_UK',
);

if ($_SERVER['REQUEST_URI']) {
	$uri=explode('/',$_SERVER['REQUEST_URI']);
        if (!strpos($_SERVER['REQUEST_URI'],'index.php')===false) $klang=2;
        else  $klang=1;       
	if (isset($uri[$klang])&&isset($i18n[$uri[$klang]]))
		$lang = $uri[$klang];
}

return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
        'sourceLanguage' => 'en_US',
        'language' => $i18n[$lang], /*'ru_RU',*/
    
	'name'=>'Недвижимость',//'Пегас недвижимость',

	// preloading 'log' component
	'preload'=>array('log'),
    
	// autoloading model and component classes
	'import'=>array(
            'application.models.base.*',
            'application.models.forms.*',
            'application.models.*',
            'application.helpers.*',
            'application.components.*',
            'application.modules.srbac.controllers.SBaseController',
            'application.components.facebook.*',
            'application.components.validators.*',
            'application.components.shoppingCard.*',            
            'application.web.helpers.*',
            'application.web.widgets.*',
            'application.extensions.widgets.*',
            'application.extensions.minify.*',
            /*'ext.eoauth.*',
              'ext.eoauth.lib.*',
              'ext.lightopenid.*',
              'ext.eauth.services.*',*/	
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'as27061973',
		 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
			//'ipFilters'=>array('127.0.0.1','::1'),
                        'ipFilters'=>array('92.113.211.235'),
		),
                'srbac'   => array(
                    // Модель для работы с таблицой пользователей
                    'userclass' => 'Users',
                    // Уникальный идентификатор пользователя
                    'userid'    => 'id',
                    // Название поля содержащего имя пользователя
                    'username'  => 'username',
                    // В режиме отладки все пользователи могут управлять правилами доступа
                    'debug'     => true,
                    // Колличество пунктов выводимых на 1 странице
                    'pageSize'  => 20,
                    // Название роли супер пользователя
                    'superUser' => 'superadmin',//'Authority',
                    // Файл стилей для модуля
                    'css'       => 'srbac.css',
                    // Сообщение для не авторизированных пользователей, 
                    // попытавшихся получить доступ к закрытым для них разделам сайта
                    'notAuthorizedView' => 'application.messages.unauthorized',                    
                    // Операции разрещенные польщователю
                    'userActions'          => array('Show','View','List','Index'),
                    //
                    'listBoxNumberOfLines' => 15,
                    // Путь к картинкам
                    'imagesPath' => 'srbac.images',
                    //
                    'imagesPack'           => 'tango',
                    //
                    'iconText'             => true,
                    'layout'=>'application.views.backend.layouts.column1',
                    'showHeader'=>true, // default: false 
                    'showFooter'=>true, // default: false
                ),
	),
    
        'behaviors' => array(
                'runEnd' => array(
                    'class' => 'application.behaviors.WebApplicationEndBehavior',
                ),
            ),
	// application components
	'components'=>array(
                 'cache' => array(
                       'class' => 'system.caching.CFileCache',
                        //            'class' => 'system.caching.CDummyCache',
                 ),
                 'currency' => array (
                    'class' => 'application.components.CCurrencyComponent',                     
                    'nameCacheComp' => 'cache',
                    'to'    => 'RUB',
                    'from'  => array(                      
                        array(
                            'name'   => 'USD',
                            'amount' => 1,
                            'curs'   =>array( 'EUR'=>1/(52.6900/64.8400) /*0.7732159766032338 /*(А/В)*/, 'RUB'=>1/52.6900 /*(A)*/ ), 
                        ),
                        array(
                            'name'   => 'EUR',
                            'amount' => 1,
                            'curs'   => array( 'USD'=>1/(64.8400/52.6900)/*1.293299712187837 /*(В/А)*/, 'RUB'=>1/64.8400 /*(В)*/ ),
                        ),
                        array(
                            'name'   => 'RUB',
                            'amount' => 1,
                            'curs'   =>array( 'USD'=>1/(1/52.6900)/*0.0258359212314433 /*(1/А)*/, 'EUR'=>1/(1/64.8400) /*0.0199767470664147 /*(1/В)*/ ),
                        ),  
                    ),
                ),
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		// uncomment the following to enable URLs in path-format	
		/*'urlManager'=>array(
			'urlFormat'=>'path',                        
                        'showScriptName'=>false,
                        'urlSuffix'=>'.html',               
			//'rules'=>array(
			//	'/<controller:\w+>/<id:\d+>'=>'<controller>/view',
			//	'/<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
			//	'/<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			//),
			'rules'=>array(
                                'sitemap.xml'=>'site/sitemapxml',
				$lang.'/<module>/<controller:\w+>/<id:\d+>'=>'<module>/<controller>/view',
				$lang.'/<module>/<controller:\w+>/<action:\w+>/<id:\d+>'=>'<module>/<controller>/<action>',
				$lang.'/<module>/<controller:\w+>/<action:\w+>'=>'<module>/<controller>/<action>',
                                $lang.'/<controller:\w+>'=>'<controller>',
				$lang.'/<controller:\w+>/<id:\d+>'=>'<controller>/view', 
				$lang.'/<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
                                $lang.'/<controller:\w+>/<action:\w+>/view/<view:\w+>'=>'<controller>/<action>',
                                //$lang.'/<controller:\w+>/<action:\w+>/rid/<rid:\w+>'=>'<controller>/<action>',
                                $lang.'/<controller:\w+>/<action:\w+>'=>'<controller>/<action>',                              				
			),
		),*/
	        /*'urlManager'=>array(
                    'class'=>'application.extensions.urlManager.LangUrlManager',
                    'languages'=>array('ru','en'),
                    'langParam'=>'language',
                    'urlFormat'=>'path', 
                    'showScriptName'=>false,
                    'urlSuffix'=>'.html',
                ),*/            
		/*'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),*/
		// uncomment the following to use a MySQL database
		'db'=>array(
			/*'connectionString' => 'mysql:host=localhost;dbname=scorp666_pr',
			'emulatePrepare' => true,                    
			'username' => 'scorp666_pr',
			'password' => 'ppvlastdeneg',*/
                        // Локально
                    	'connectionString' => 'mysql:host=localhost;dbname=pegasrealty',
			'emulatePrepare' => true,                    
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
                        'enableProfiling'=>true,
                        'enableParamLogging'=>true,
		),
                'authManager' => array(
                 'class' => 'CDbAuthManager',
                 'connectionID'     => 'db',        
                 'itemTable' => 'auth_item',
                 'itemChildTable' => 'auth_item_child',
                 'assignmentTable' => 'auth_assignment',
                 'defaultRoles'       =>  array('Guest'),
                ),
		'errorHandler'=>array(
		// use 'site/error' action to display errors
                    'errorAction'=>'site/error',
                 ),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
                                // Лигирование запросов на уровне откуда исходя и время когда испольнены
				array(
                                    'class'=>'CWebLogRoute',
                                    //'class'=>'CFileLogRoute',
                                    //'levels'=>'error, warning, trace',
                                    'categories' => 'system.db.CDbCommand',
                                    'showInFireBug'=>false, // будет выводить информацию через FireBug
                                    'enabled'=>false//CHttpRequest::getUserHostAddress()=='37.55.89.200' 
				),
                                // Логирование запросов по времени выполнения 
                                array(
                                    // направляем результаты профайлинга в ProfileLogRoute (отображается
                                    // внизу страницы)
                                    'class'=>'CProfileLogRoute',
                                    'levels'=>'profile', //error, warning, trace, profile, info
                                    'enabled'=> CHttpRequest::getUserHostAddress()=='46.201.96.185' // false 
                                ),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
                'messages' => array(
                    'class' => 'CDbMessageSource',
                    'sourceMessageTable'=> 'source_messages', // по умолчанию 'SourceMessage'
                    'translatedMessageTable'=>'messages',     // по умолчанию 'Message'
                    'cachingDuration'=>10,                    // кэширование 3600
                ),
               'image'=>array(
                    'class'=>'application.extensions.image.CImageComponent',
                    // GD or ImageMagick
                    'driver'=>'GD',
                    // ImageMagick setup path
                    //'params'=>array('directory'=>'D:/Program Files/ImageMagick-6.4.8-Q16'),
                ),
               'ih'=>array('class'=>'CImageHandler'),
                /*'languages'=>array(
                  'class'=>'Languages',
                  'useLanguage'=>true,
                  'autoDetect'=>true,
                  'languages'=>array('ru',),//'en','ro',
                  'languagesTitles'=>array('ru'=>'Russian','en'=>'English','ro'=>'Romanian'),
                ),*/
                'ePdf' => array(
                    'class'         => 'ext.yii-pdf.EYiiPdf',
                    'params'        => array(
                        'mpdf'     => array(
                            'librarySourcePath' => 'application.vendors.mpdf.*',
                            'constants'         => array(
                                '_MPDF_TEMP_PATH' => Yii::getPathOfAlias('application.runtime'),
                            ),
                            'class'=>'mpdf', // the literal class filename to be loaded from the vendors folder
                            'defaultParams'     => array( // More info: http://mpdf1.com/manual/index.php?tid=184
                                'mode'              => '', //  This parameter specifies the mode of the new document.
                                'format'            => 'A4', // format A4, A5, ...
                                'default_font_size' => 0, // Sets the default document font size in points (pt)
                                'default_font'      => '', // Sets the default font-family for the new document.
                                'mgl'               => 15, // margin_left. Sets the page margins for the new document.
                                'mgr'               => 15, // margin_right
                                'mgt'               => 16, // margin_top
                                'mgb'               => 16, // margin_bottom
                                'mgh'               => 9, // margin_header
                                'mgf'               => 9, // margin_footer
                                'orientation'       => 'P', // landscape or portrait orientation
                            )
                        ),
                        'HTML2PDF' => array(
                            'librarySourcePath' => 'application.vendors.html2pdf.*',
                            'classFile'         => 'html2pdf.class.php', // For adding to Yii::$classMap
                            'defaultParams'     => array( // More info: http://wiki.spipu.net/doku.php?id=html2pdf:en:v4:accueil
                                'orientation' => 'P', // landscape or portrait orientation
                                'format'      => 'A4', // format A4, A5, ...
                                'language'    => 'en', // language: fr, en, it ...                                
                                'unicode'     => true, // TRUE means clustering the input text IS unicode (default = true)
                                'encoding'    => 'UTF-8', // charset encoding; Default is UTF-8
                                'marges'      => array(5, 5, 5, 8), // margins by default, in order (left, top, right, bottom)
                            )
                        )
                    ),
                ),
                'mailer' => array(
                  'class' => 'application.extensions.mailer.EMailer',
                  'pathViews' => 'application.views.email',
                  'pathLayouts' => 'application.views.email.layouts'
                ),
                'file' => array(
                        'class' => 'application.extensions.file.CFile'
                ),
                'config'=>array(
                    'class' => 'application.extensions.EConfig',
                )
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'setrais@gmail.com,info@pegasrealty.ru,support@pegasrealty.ru,2229520@pegasrealty.ru',//'2229520@mail.ru,2229520@pegasrealty.ru',
                'infoEmail'=>'info@pegasrealty.ru', 
                'smtp_host'=>"smtp.gmail.com",
                'smtp_port'=>465,
                'contact'=>array('code_country'=>7,
                                 'code_oper'=>'495',
                                 'code_phone'=>'222-95-20',
                                 'email_main'=>'info@pegasrealty.ru'),
                'smtp_username'=>'realtypegas@gmail.com',                
                'smtp_password'=>'as27061973',
                'email'=>'realtypegas@gmail.com',
                'email_from_name'=>'Pegas Realty',
                'languages' => $i18n,
                'language'  => $lang,
                'constants' => array('area'=> array('min'=>50,'max'=>40000),
                                     'stavka'=> array('min'=>0, 'max'=>240000), 
                                     'cost'=> array('min'=>0, 'max'=>100000000),
                                     'remoteness'=> array('min'=>0, 'max'=>20),   
                                     'short'=> array('enable'=>true, 'size'=>8)
                               ),
	),
);
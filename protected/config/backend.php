<?php

return CMap::mergeArray(
        require_once(dirname(__FILE__) . '/main.php'),
        array(
             'defaultController' => 'realestates/index',/*'realestates/admin',/*'site/index',*/
             'components' => array(
                 'user' => array(
                     'class' => 'BackendWebUser',
                     'allowAutoLogin' => true,
                     'loginUrl' => array('site/login'),
                 ),
                 /*'urlManager' => array(
                             'showScriptName' => true,
                 ),*/
		 'urlManager'=>array(
			'urlFormat'=>'path',                        
                        'showScriptName'=>true,//false,
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
		 ),                 
                 'authManager' => array(
                     'class' => 'CDbAuthManager',
                     'connectionID'     => 'db',        
                     'itemTable' => 'auth_item',
                     'itemChildTable' => 'auth_item_child',
                     'assignmentTable' => 'auth_assignment',
                     'defaultRoles'       =>  array('Guest'),
                 ),
                'log' => array(
                     'class' => 'CLogRouter',
                     'routes' => array(
                        //array(
                        //     'class' => 'CFileLogRoute',
                        //     'levels' => 'error, warning',
                        // ),
                        /*array(
                             'class' => 'CWebLogRoute',
                             'showInFireBug' => true,
                         ),*/
                         array(
                             'class' => 'CProfileLogRoute',
                             'levels' => 'profile',
                             'enabled' => false,//true,
                             'showInFireBug' => true,
                         )
                     ),
                 ),
             ),
            'params' => array(
                // количество строк с CGridView
                'pageSizeGrid' => array(
                    'default' => 50,
                    'options' => array(
                        20, 50, 200, 0
                    )
                ),
            ),
        )           
);

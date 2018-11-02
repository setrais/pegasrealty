<?php

return CMap::mergeArray(
    require_once(dirname(__FILE__) . '/main.php'),
    CMap::mergeArray(    
        array(
             'defaultController' => 'realestates/index',/*'realestates/admin',/*'site/index',*/
             'components' => array(
                 'user' => array(
                     'class' => 'BackendWebUser',
                     'allowAutoLogin' => true,
                     'loginUrl' => array('site/login'),
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
                             'enabled' => true,
                             'showInFireBug' => true,
                         )
                     ),
                 ),
                 'urlManager' => array(
                             'showScriptName' => true,
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
        ),
        require_once(dirname(__FILE__) . '/setting.php')
    )    
);

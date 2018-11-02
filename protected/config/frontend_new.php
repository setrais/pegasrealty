<?php
$url = $_SERVER['REQUEST_URI'];
$rep_url = str_replace('/index.php', '', $url);
if($url!==$rep_url)
{
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: /'.ltrim($rep_url, '/'));
    exit();
} 

return CMap::mergeArray( 
    require_once(dirname(__FILE__) . '/main.php'),
    CMap::mergeArray(     
        array(
             'name'=>'Pegasus Property | Offices for rent in Moscow',
             'defaultController' => 'site/index',
             'components' => array(
                 'user' => array(
                     'class' => 'FrontendWebUser',
                     'allowAutoLogin' => true,
                     'loginUrl' => array('site/login'),
                 ),             
                 'log' => array(
                     'class' => 'CLogRouter',
                     'routes' => array(
                         array(
                             'class' => 'CFileLogRoute',
                             'levels' => 'error, warning',
                         ),
    //                      array(
    //                         'class'=>'CWebLogRoute',
    //                         'showInFireBug'=>false,
    //                         'enabled'=>true,
    //                     ),
                     ),
                 ),
                'clientScript' => array(
                    'class' => 'MyClientScript',
                    'combineScriptFiles' => false, //!YII_DEBUG, // By default this is set to true, set this to true if you'd like to combine the script files
                    'combineCssFiles' => false, //!YII_DEBU, // By default this is set to true, set this to true if you'd like to combine the css files
                    'optimizeScriptFiles' => false, //!YII_DEBU,	// @since: 1.1
                    'optimizeCssFiles' => false, //!YII_DEBU, // @since: 1.1
                ),
                //'urlManager' => array(
                //                         'urlFormat' => 'path',
                //                         'showScriptName' => false,
                //                         'rules' => array(
                //                             '' => 'site/index',
                //                             '<controller:\w+>/<id:\d+>' => '<controller>/view',
                //                             '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                //                             '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                //                         ),
                //                     ),
                // uncomment the following to enable URLs in path-format	
                'urlManager'=>array(
                            'urlFormat'=>'path',                        
                            'showScriptName'=>false,
                            'urlSuffix'=>'.html',               
                             //'baseUrl'=> '', - !@TODO Параметр не известен
                             //'caseSensitive' => false, - !@TODO Параметр не известен
                             //'useStrictParsing' => true, - !@TODO Параметр не известен
                            /*'rules'=>array(
                                    '/<controller:\w+>/<id:\d+>'=>'<controller>/view',
                                    '/<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
                                    '/<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
                            ),*/
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
             ),
             /*'params' => array(
                 'vkontakte' => array(
                     'APP_ID' => '2385288',
                     'SECRET' => 'L8c9BiYVT6wNRBOmYcqc',
                 ),
                 'facebook' => array(
                     'APP_ID' => '118514838235738',
                     'SECRET' => 'a70d6deeb91872ff28a607181f3dd075',
                 ),
                 'payment' => array(
                     'robox' => array(
                         // 'URL' => 'https://merchant.roboxchange.com/Index.aspx',
                         'URL' => 'http://test.robokassa.ru/Index.aspx',
                         'LOGIN' => 'oplpronto24',
                         'PASSWORD' => 'x8gipoby',
                         'PASS_1' => 'x8gipoby',
                         'PASS_2' => 'x8gipoby',
                     ),
                     'qiwi' => array(
                         'URL' => 'https://w.qiwi.ru/setInetBill_utf.do',
                         'FROM' => '15460',
                     )
                 )
             ),*/
        ),
        require_once(dirname(__FILE__) . '/setting.php')
    )        
);

<?php
$url = $_SERVER['REQUEST_URI'];
$rep_url = str_replace('/index.php', '', $url);
$rep_url = str_replace('/.html', '.html', $url);
if($url!==$rep_url)
{
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: /'.ltrim($rep_url, '/'));
    exit();
} 

$url = $_SERVER['REQUEST_URI'];
if ($url == '/ru/' || $url == '/ru' ) {
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: /');
    exit();
}

if ($url == '/ru/site/' || $url == '/ru/site' ) {
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: /');
    exit();
}

$abot = array( //'rogerbot',
               'TurnitinBot',
               'Riddler',
               'Exabot',
               'MJ12bot',
               'DotBot',
               'av-host.net',
               '7zap.com',
               'doska-vsem.ru',
               'brutforyou.blogspot.com',
               'csanty-online.ru',
               'jimbo.by',
               //'Twitterbot',
               //'WebIndex',
               'rogerbot',
               'Ruby',
               'ContextAd Bot',
               'OffByOne',
               'Gigabot',
               'AhrefsBot',
               'SISTRIX Crawler',
               'DomainSigmaCrawler',
               'SV1',
               'CometBird',
               'GroupHigh',
               //'AppleWebKit',
               //'Yahoo',
               //'msnbot',
               //'bingbot',
               'proximic',// Возможно нужно включить определение размещения рекламы
               //'Trident', // Возможно нужно включить
               'bithack.ru',
               'WeLikeLinks',
               'FeedBurner',
               'SolomonoBot',    
               'SemrushBot',
               //'BegunAdvertising',
               'Blekkobot', 
               'BLEXBot',
               'WBSearchBot',
               'Linguee Bot',
               'Exabot',
               'SputnikBot',
               'Baiduspider',
               //'Wotbox', // Поисковый бот
               //'BLEXBot', // не нагружает
               //'Firefox/2.0.0.13'
               'Sleuth',
               'ezooms',    
               'Lightspeedsystems',
               'SearchBot',
               'parser3',
               'Wget',
               'SISTRIX',
               'LinkpadBot',
               'Wotbox',
               'AntivirusPro',
               'Insitesbot',
               'estilo.in.ua',
               'flipboard.com',
               'SMTBot',
               //''
               'mbot', 
             );
if( preg_match("#(".implode('|',$abot).")#i", $_SERVER['HTTP_USER_AGENT']) ) {
    //throw new CHttpException(404,'The requested page does not exist.');
    header('HTTP/1.1 403 Forbidden '/*You are not permitted to access the requested URL.*/);   
    exit('Bot Lock');
}

return CMap::mergeArray( 
        require_once(dirname(__FILE__) . '/main.php'),  
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
                                    $lang.'/<controller:\w+>/<action:\w+>/<id:\d+>/<property:\w+>/<pid:\d+>'=>'<controller>/<action>', 
                                    $lang.'/<controller:\w+>/<action:\w+>/<id:\d+>/<property:\w+>'=>'<controller>/<action>',                                                                         
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
        )    
);

<?php

return CMap::mergeArray(
    require_once(dirname(__FILE__) . '/main.php'),
    array(
        'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
        'name' => 'My Console Application',
        'preload' => array('log'),
        'import' => array(
            'application.models.*',
            'application.components.*',
        ),
    )
);

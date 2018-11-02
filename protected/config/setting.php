<?php

return array(
    /* Язык административной части */
    'sourceLanguage' => 'en_US',
    /* Язык публичной части */
    //'language' => $i18n[$lang], /*'ru_RU',*/  
    /* Название приложения */
    'name'=>'Pegasus Property | Offices for rent in Moscow',
    /* Управление Конструктором */
    'modules'=>array( 'gii'=>array( 'password'=>'as27061973', // Пароль
                                    'ipFilters'=>array('37.52.150.47'), // Доступ
                                  ),
     ),       
    'components'=>array( 'currency' => 
                         array ( 'from'  => array(                      
                                    array(
                                           'name'   => 'USD',
                                           'amount' => 1,
                                           'curs'   =>array( 'EUR'=>1/0.7328, 'RUB'=>1/35.2448 ), 
                                    ),
                                    array(
                                           'name'   => 'EUR',
                                           'amount' => 1,
                                           'curs'   => array( 'USD'=>1/1.3640, 'RUB'=>1/48.0951 ),
                                    ),
                                    array(
                                           'name'   => 'RUB',
                                           'amount' => 1,
                                           'curs'   =>array( 'USD'=>1/0.0283, 'EUR'=>1/0.0207 ),
                                    ),  
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
            // почта для контакта
            // email
            'adminEmail'=>'setrais@gmail.com,info@pegasrealty.ru,support@pegasrealty.ru',//'2229520@mail.ru,2229520@pegasrealty.ru',
            // smtp server
            'smtp_host'=>"smtp.gmail.com",
            // порт
            'smtp_port'=>465,
            'smtp_username'=>'realtypegas@gmail.com',                
            'smtp_password'=>'as27061973',
            'email'=>'realtypegas@gmail.com',
            'email_from_name'=>'Pegas Realty',
            // контактные данные         
            'contact'=>array( 'code_country'=>7, // Код страны
                              'code_oper'=>'495', // Код города
                              'code_phone'=>'222-95-20', // Телефон
                              'email_main'=>'info@pegasrealty.ru'), // Инфо email
            // языки
            'languages' => $i18n,
            // текущий язык
            'language'  => $lang,
            'social' => array(
                 'vkontakte' => array(
                        'APP_ID' => '2385288',
                         'SECRET' => 'L8c9BiYVT6wNRBOmYcqc',
                 ),
                 'facebook' => array(
                        'APP_ID' => '118514838235738',
                        'SECRET' => 'a70d6deeb91872ff28a607181f3dd075',
                 ),
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
             ),
            'seo'=>array(
                'title' => 'Аренда офиса в Москве | Пегас недвижимость за минуту к успеху Вашего бизнеса (в центре,западе,юге,востоке москвы, по воюао, юаo, зао,юзао,цао,свао,сзао,юго,сао, по стоимости арендодателя)',
                'description' => 'pegasrealty.ru - Portal Real Estate Agency "Pegas Realty", a professional commercial real estate and rental offices in Moscow.',
                'keywords' => 
                           array('аренда',
                                 'офис', 
                                 'москва',
                                 'москве',
                                 'аренда офиса',        
                                 'аренда офиса москва',
                                 'аренда офиса в москве',
                                 'аренда офисов в москве',
                                 'аренда офиса москвы',
                                 'аренда офисов москвы',                                
                                 'коммерческая недвижимость', 
                                 'офисная недвижимость аренда', 
                                 'офис склад москва',
                                 'офисы в аренду москва', 
                                 'аренда под офис',
                                 'аренда помещений под офис', 
                                 'аренда офис москва',
                                 'собственник аренда москва',
                                 'аренда помещения под офис москва',                                  
                                 'аренда офисных помещений москва',
                                 'продажа офисов в москве',
                                 'помещение под офис москва', 
                                 'продажа офисов',
                                 'аренда офиса в центре москвы',
                                 'аренда помещений москва',
                                 'аренда офиса без комиссии',
                                 'купить офис',
                                 'москвы'
                            )            
            )     
      ),     
    );    
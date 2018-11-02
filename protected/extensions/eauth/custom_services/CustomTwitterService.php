<?php

/**
 * An example of extending the provider class.
 *
 * @author Maxim Zemskov <nodge@yandex.ru>
 * @link http://code.google.com/p/yii-eauth/
 * @license http://www.opensource.org/licenses/bsd-license.php
 */
require_once dirname(dirname(__FILE__)) . '/services/TwitterOAuthService.php';

class CustomTwitterService extends TwitterOAuthService
{

    protected function fetchAttributes()
    {
        $info = $this->makeSignedRequest('https://api.twitter.com/1/account/verify_credentials.json');

        $this->attributes['id'] = $info->id;
        $this->attributes['username'] = $info->name;
        $this->attributes['url'] = 'http://twitter.com/account/redirect_by_id?id=' . $info->id_str;

        $clientLogin = 'twitter' . $info->id;
        if (!$client = Clients::model()->findByAttributes(array('login' => $clientLogin)))
        {
            $client = new Clients();
            $client->login = $clientLogin;
            $client->password = HString::random(6);
        }
        $name = explode(' ', $info->name);
        if (isset($name[1]))
        {
            $client->first_name = $name[1];
            $client->last_name = $name[0];
        }
        else
            $client->first_name = $name[0];

        $client->type = Clients::TYPE_USER;
        $client->save();

        $this->attributes['id'] = $client->id;
    }

}
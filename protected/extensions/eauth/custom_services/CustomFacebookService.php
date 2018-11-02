<?php

/**
 * An example of extending the provider class.
 *
 * @author Maxim Zemskov <nodge@yandex.ru>
 * @link http://code.google.com/p/yii-eauth/
 * @license http://www.opensource.org/licenses/bsd-license.php
 */
require_once dirname(dirname(__FILE__)) . '/services/FacebookOAuthService.php';

class CustomFacebookService extends FacebookOAuthService
{

    // protected $scope = 'friends';

    protected function fetchAttributes()
    {
        $info = (object) $this->makeSignedRequest('https://graph.facebook.com/me');

        $this->attributes['name'] = $info->name;
        $this->attributes['url'] = $info->link;

        $clientLogin = 'fb' . $info->id;
        if (!$client = Clients::model()->findByAttributes(array('login' => $clientLogin)))
        {
            $client = new Clients();
            $client->login = $clientLogin;
            $client->password = HString::random(6);
        }
        $client->first_name = $info->first_name;
        $client->last_name = $info->last_name;

        if (!empty($info->gender))
        {
            $client->gender = $info->gender == 'female' ? Clients::GENDER_FEMALE : Clients::GENDER_MALE;
        }
        $client->type = Clients::TYPE_USER;
        $client->save();

        $this->attributes['id'] = $client->id;
    }

}

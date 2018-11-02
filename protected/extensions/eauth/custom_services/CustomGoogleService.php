<?php

/**
 * An example of extending the provider class.
 *
 * @author Maxim Zemskov <nodge@yandex.ru>
 * @link http://code.google.com/p/yii-eauth/
 * @license http://www.opensource.org/licenses/bsd-license.php
 */
require_once dirname(dirname(__FILE__)) . '/services/GoogleOAuthService.php';

class CustomGoogleService extends GoogleOAuthService
{

    protected $jsArguments = array('popup' => array('width' => 450, 'height' => 450));
    protected $requiredAttributes = array(
        'name' => array('firstname', 'namePerson/first'),
        'lastname' => array('lastname', 'namePerson/last'),
        'email' => array('email', 'contact/email'),
        'language' => array('language', 'pref/language'),
    );

    protected function fetchAttributes()
    {
        $info = (array) $this->makeSignedRequest('https://www.googleapis.com/oauth2/v1/userinfo');

        $this->attributes['name'] = $info['name'];
        if (!empty($info['link']))
            $this->attributes['url'] = $info['link'];

        $clientLogin = 'google' . $info['id'];
        if (!$client = Clients::model()->findByAttributes(array('login' => $clientLogin)))
        {
            $client = new Clients();
            $client->login = $clientLogin;
            $client->password = HString::random(6);
        }
        $client->first_name = $info['given_name'];
        $client->last_name = $info['family_name'];
        if (!empty($info['gender']))
        {
            $client->gender = $info['gender'] == 'female' ? Clients::GENDER_FEMALE : Clients::GENDER_MALE;
        }
        $client->type = Clients::TYPE_USER;
        $client->save();

        $this->attributes['id'] = $client->id;
    }

}
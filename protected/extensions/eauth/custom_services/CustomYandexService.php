<?php

/**
 * An example of extending the provider class.
 *
 * @author Maxim Zemskov <nodge@yandex.ru>
 * @link http://code.google.com/p/yii-eauth/
 * @license http://www.opensource.org/licenses/bsd-license.php
 */
require_once dirname(dirname(__FILE__)) . '/services/YandexOpenIDService.php';

class CustomYandexService extends YandexOpenIDService
{

    protected $jsArguments = array('popup' => array('width' => 900, 'height' => 620));
    protected $requiredAttributes = array(
        'name' => array('fullname', 'namePerson'),
        'email' => array('email', 'contact/email'),
        'gender' => array('gender', 'person/gender'),
    );

    protected function fetchAttributes()
    {
        if (isset($this->attributes['username']) && !empty($this->attributes['username']))
            $this->attributes['url'] = 'http://openid.yandex.ru/' . $this->attributes['username'];

        $clientLogin = $this->attributes['id'];
        if (!$client = Clients::model()->findByAttributes(array('email' => $this->attributes['email'])))
        {
            $client = new Clients();
            $client->login = $clientLogin;
            $client->password = HString::random(6);
            $name = explode(' ', $this->attributes['name']);
            if (isset($name[1]))
            {
                $client->first_name = $name[1];
                $client->last_name = $name[0];
            }
            else
                $client->first_name = $name[0];
            $client->email = $this->attributes['email'];
            if (!empty($this->attributes['gender']))
            {
                $client->gender = $this->attributes['gender'] == 'F' ? Clients::GENDER_FEMALE : Clients::GENDER_MALE;
            }

            $client->type = Clients::TYPE_USER;
            $client->save();
        }

        $this->attributes['id'] = $client->id;
    }

}
<?php

/**
 * An example of extending the provider class.
 *
 * @author Maxim Zemskov <nodge@yandex.ru>
 * @link http://code.google.com/p/yii-eauth/
 * @license http://www.opensource.org/licenses/bsd-license.php
 */
require_once dirname(dirname(__FILE__)) . '/services/VKontakteOAuthService.php';

class CustomVKontakteService extends VKontakteOAuthService
{

    // protected $scope = 'friends';

    protected function fetchAttributes()
    {
        $info = (array) $this->makeSignedRequest('https://api.vkontakte.ru/method/getProfiles', array(
                'query' => array(
                    'uids' => $this->getUid(),
                    //'fields' => '', // uid, first_name and last_name is always available
                    'fields' => 'nickname, sex, bdate, city, country, timezone, photo, photo_medium, photo_big, photo_rec',
                ),
            ));

        $info = $info['response'][0];

        $this->attributes['name'] = $info->first_name . ' ' . $info->last_name;
        $this->attributes['url'] = 'http://vkontakte.ru/id' . $info->uid;

        $clientLogin = 'vk' . $info->uid;
        if (!$client = Clients::model()->findByAttributes(array('login' => $clientLogin)))
        {
            $client = new Clients();
            $client->login = $clientLogin;
            $client->password = HString::random(6);
        }
        $client->first_name = $info->first_name;
        $client->last_name = $info->last_name;
        if (!empty($info->mobile_phone))
        {
            $client->phone = $info->mobile_phone;
        }
        if (!empty($info->sex))
        {
            $client->gender = $info->sex == 1 ? Clients::GENDER_FEMALE : Clients::GENDER_MALE;
        }
        $client->type = Clients::TYPE_USER;
        $client->save();

        $this->attributes['id'] = $client->id;
    }

}

<?php

/**
 * An example of extending the provider class.
 *
 * @author ChooJoy <choojoy.work@gmail.com>
 * @link http://code.google.com/p/yii-eauth/
 * @license http://www.opensource.org/licenses/bsd-license.php
 */
require_once dirname(dirname(__FILE__)) . '/services/MailruOAuthService.php';

class CustomMailruService extends MailruOAuthService
{

    protected function fetchAttributes()
    {
        $info = (array) $this->makeSignedRequest('http://www.appsmail.ru/platform/api', array(
                'query' => array(
                    'uids' => $this->getUid(),
                    'method' => 'users.getInfo',
                    'app_id' => $this->client_id,
                ),
            ));

        $info = $info[0];

        $this->attributes['name'] = $info->first_name . ' ' . $info->last_name;
        if (!empty($info->link))
            $this->attributes['url'] = $info->link;

        $clientLogin = 'mailru' . $info->uid;
        if (!$client = Clients::model()->findByAttributes(array('email' => $info->email)))
        {
            $client = new Clients();
            $client->login = $clientLogin;
            $client->password = HString::random(6);
        }
        $client->email = $info->email;
        $client->first_name = $info->first_name;
        $client->last_name = $info->last_name;
        if (!empty($info->sex))
        {
            $client->gender = $info->sex == 1 ? Clients::GENDER_FEMALE : Clients::GENDER_MALE;
        }
        $client->type = Clients::TYPE_USER;
        $client->save();

        $this->attributes['id'] = $client->id;
    }

}

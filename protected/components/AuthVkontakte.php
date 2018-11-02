<?php

class AuthVkontakte extends AuthSocial {
    public static function registerClient($params) {
        $resp1 = self::getContents('https://api.vk.com/oauth/token?client_id='.Yii::app()->params->vkontakte['APP_ID'].
                                   '&code='.$params['code'].'&client_secret='.Yii::app()->params->vkontakte['SECRET']
        );

        $data1 = json_decode($resp1);
        if ($data1->access_token) {
            $resp2 = file_get_contents('https://api.vkontakte.ru/method/getProfiles?uids='.$data1->user_id.'&access_token='.$data1->access_token.'&fields=uid,first_name,last_name,nickname,domain,sex,bdate,city,country,timezone,photo,photo_medium,photo_big,has_mobile,rate,contacts,education,online');
            $data2 = json_decode($resp2);

            if (isset($data2->response[0]) && !empty($data2->response[0])) {
                $clientLogin = 'vk' . $data2->response[0]->uid;
                if (!$client = Clients::model()->findByAttributes(array('login' => $clientLogin))) {
                    $client = new Clients();
                    $client->login = $clientLogin;
                    $client->password = HString::random(6);
                }
                $client->first_name = $data2->response[0]->first_name;
                $client->last_name = $data2->response[0]->last_name;
                if (!empty($data2->response[0]->mobile_phone)) {
                    $client->phone = $data2->response[0]->mobile_phone;
                }
                if (!empty($data2->response[0]->sex)) {
                    $client->gender = $data2->response[0]->sex == 1 ? Clients::GENDER_FEMALE : Clients::GENDER_MALE;
                }
                $client->save();

                return $client;
            }
        }
    }
}

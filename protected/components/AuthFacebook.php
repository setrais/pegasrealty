<?php

class AuthFacebook extends AuthSocial {
    public static function registerClient($params) {
        $resp1 = self::getContents('https://graph.facebook.com/oauth/access_token?client_id='.
                                   Yii::app()->params->facebook['APP_ID'].'&code='.urlencode($params['code']).
                                   '&client_secret='.Yii::app()->params->facebook['SECRET'].
                                   '&redirect_uri='.urlencode(Yii::app()->createAbsoluteUrl('/'))
        );

        preg_match('/access_token=(.+)&expires=\d+/i', $resp1, $matchToken);
        if (isset($matchToken[1]) && !empty($matchToken[1])) {
            $token = $matchToken[1];

            $facebook = new Facebook(array(
                'appId'  => Yii::app()->params->facebook['APP_ID'],
                'secret' => Yii::app()->params->facebook['SECRET'],
            ));
            $facebook->setAccessToken($token);

            $user = $facebook->getUser();
            if ($user) {
                $userProfile = $facebook->api('/me');

                $clientLogin = 'fb' . $userProfile['id'];
                if (!$client = Clients::model()->findByAttributes(array('login' => $clientLogin))) {
                    $client = new Clients();
                    $client->login = $clientLogin;
                    $client->password = HString::random(6);
                }
                $client->first_name = $userProfile['first_name'];
                $client->last_name = $userProfile['last_name'];
                if (!empty($userProfile['gender'])) {
                    $client->gender = $userProfile['gender'] == 'female' ? Clients::GENDER_FEMALE : Clients::GENDER_MALE;
                }
                $client->save();

                return $client;
            }
        }
    }
}

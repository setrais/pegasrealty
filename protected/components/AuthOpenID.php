<?php

class AuthOpenID extends AuthOpenIDBase {
    public function registerClient() {
        $data = $this->finalAuth();

        if (isset($data['openIdLink'])) {
            $clientLogin = $data['openIdLink'];
            if (!$client = Clients::model()->findByAttributes(array('login' => $clientLogin))) {
                $client = new Clients();
                $client->login = $clientLogin;
                $client->password = HString::random(6);
            }

            if (!empty($data['fullname'])) {
                $client->name = $data['fullname'];
            }

            if (!empty($data['email'])) {
                $client->email = $data['email'];
            }

            $client->save();

            return $client;
        }
    }
}

<?php

class TwitterHelper
{
    public $app_id = 'DasHPTOLyXbYVXsMRsSg';
    public $app_secret = 'AKL4DoiXQeTeURsBWprOJ3p6xr5zh8n6ZY1ZrNKhkqA';
    public $token = NULL;
    public $token_secret = NULL;

    public $request;
    public $request_token;
    public $request_token_secret;
    public $access_token;
    public $access_token_secret;

    public $pin;

    public $loginLink;

    private $_twitter;

    public $status;
    const  READY_TO_POST = 3;

    public function __construct()
    {

        // try to get all imposible data

        $this->request_token = Yii::app()->config->get('tw_requestToken');
        $this->request_token_secret = Yii::app()->config->get('tw_requestTokenSecret');
        $this->access_token = Yii::app()->config->get('tw_accessToken');
        $this->access_token_secret = Yii::app()->config->get('tw_accessTokenSecret');

        $this->pin = Yii::app()->config->get('tw_pin');

        //set tokens
        if (!empty($this->request_token) && !empty($this->request_token_secret))
        {
            // jackpot
            if(!empty($this->access_token) && !empty($this->access_token_secret))
            {
                $this->token = $this->access_token;
                $this->token_secret = $this->access_token_secret;
                $this->status = self::READY_TO_POST;
            }
            elseif(!empty($this->pin))
            {
                $this->token = $this->request_token;
                $this->token_secret = $this->request_token_secret;
                $this->getAccessTokens();
            }
        }
        else
        {
            $this->getRequestTokens();
        }
    }

    public function init()
    {
        $this->_twitter = new TwitterOAuth(
            $this->app_id,
            $this->app_secret,
            $this->token,
            $this->token_secret
        );
        $registerURL = $this->_twitter->getAuthorizeURL(array($this->request_token, $this->request_token_secret));
        $this->loginLink = CHtml::link('Войти в Твиттер', $registerURL);
    }

    public function eraseAll()
    {
        Yii::app()->config->set('tw_requestToken', '');
        Yii::app()->config->set('tw_requestTokenSecret', '');

        Yii::app()->config->set('tw_accessToken', '');
        Yii::app()->config->set('tw_accessTokenSecret', '');

        Yii::app()->config->set('tw_pin', '');

        $this->__construct();
    }

    public function getRequestTokens()
    {
        $this->init();
        $this->request = $this->_twitter->getRequestToken('oob');
        $this->request_token       = $this->request['oauth_token'];
        $this->request_token_secret = $this->request['oauth_token_secret'];
        var_dump($this->request);
        Yii::app()->config->set('tw_requestToken', $this->request_token);
        Yii::app()->config->set('tw_requestTokenSecret', $this->request_token_secret);
        $registerURL = $this->_twitter->getAuthorizeURL($this->request);
        $this->loginLink = CHtml::link('Войти в Твиттер', $registerURL);
    }

    public function getAccessTokens()
    {
        $this->init();
        $this->request = $this->_twitter->getAccessToken($this->pin);
        $this->access_token       = $this->request['oauth_token'];
        $this->access_token_secret = $this->request['oauth_token_secret'];
        var_dump($this->request);
        Yii::app()->config->set('tw_accessToken', $this->access_token);
        Yii::app()->config->set('tw_accessTokenSecret', $this->access_token_secret);
        $this->status = self::READY_TO_POST;
    }

    public function post($url, $message)
    {

        // twitter get only 140 symbols
        $url_length = mb_strlen($url);
        $message = mb_strcut($message, 0, 132-$url_length);
        $message = $message.'... '.$url;

        if ($this->status == self::READY_TO_POST)
        {
            $this->init();
            $this->_twitter->get('account/verify_credentials');
            $post = $this->_twitter->post('statuses/update', array('status' => $message));
            if ($post) return true;
        }
        return $post;
    }

    public function get()
    {
        $this->init();
        $post = $this->_twitter->get('statuses/user_timeline');
        return $post;
    }

    /*
     * @return Twitter login link
     */

    public function getloginLink()
    {
        return $this->loginLink;
    }

}

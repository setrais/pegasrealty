<?php

/*
 *  class helps to post in facebook's page
 *
 * FaceBookHelper uses EConfig extension to store configs in DB
 *
 */
class FaceBookHelper extends CApplicationComponent
{
    private $_facebook;

    public $client_id;
    public $client_secret;
    public $page_access_token;

    public $group_id;

    public function __construct()
    {

        $this->group_id = Yii::app()->config->get('fb_groupid');
        $this->page_access_token = Yii::app()->config->get('fb_page_access_token');

        Yii::import('ext.facebook.*');

        if (isset(Yii::app()->eauth->services))
        {
            $fb_eauth = Yii::app()->eauth->services;

            $this->client_id = $fb_eauth['facebook']['client_id'];
            $this->client_secret = $fb_eauth['facebook']['client_secret'];;
        }
        else // try to get value from db
        {
            $this->client_id = Yii::app()->config->get('fb_appid');
            $this->client_secret = Yii::app()->config->get('fb_secretCode');
        }

        $this->_facebook = new Facebook ( array( 'appId'=> $this->client_id, 'secret'=>$this->client_secret ) );

        if ($user_access_token = Yii::app()->config->get('fb_user_access_token'))
        {
            $this->_facebook->setAccessToken($user_access_token);
        }
        else
        {
             Yii::app()->config->set('fb_user_access_token', $this->_facebook->getAccessToken());
        }

        $this->page_access_token = Yii::app()->config->get('fb_page_access_token') != '' ? Yii::app()->config->get('fb_page_access_token') : $this->getPageAccesToken();

    }

    public function getPageAccesToken()
    {
        $page_info = $this->_facebook->api("/$this->group_id?fields=access_token");
        $access_token = $page_info['access_token'];
        Yii::app()->config->set('fb_page_access_token', $access_token);
        return $access_token;
    }

    public function post($message)
    {
        if ($this->page_access_token != '')
        {
            $args = array(
                'access_token'  => $this->page_access_token,
                'message'       => $message,
            );
            $this->_facebook->api("/$this->group_id/feed","post",$args);
            return true;
        }
        return false;
    }

    public function getLoginUrl()
    {
        if (Yii::app()->config->get('fb_access_token')) {
            return CHtml::link('Удалить авторизацию', $this->_facebook->getLogoutUrl());
        } else {
            return CHtml::link('Привязать админский аккаунт', $this->_facebook->getLoginUrl(array('scope'=>'manage_pages,publish_stream, offline_access')));
        }
    }

    public function deleteAuth()
    {
        Yii::app()->config->set('fb_user_access_token', '');
        Yii::app()->config->set('fb_page_access_token', '');
    }

    public function login()
    {
        return CHtml::link('Привязать админский аккаунт', $this->_facebook->getLoginUrl(array(
            'scope'=>'manage_pages,publish_stream, offline_access',
            'redirect_uri'=>Yii::app()->createAbsoluteUrl('social/index'),
            )
        ));
    }

    public function logout()
    {
        return CHtml::link('Удалить авторизацию', $this->_facebook->getLogoutUrl());
    }
}

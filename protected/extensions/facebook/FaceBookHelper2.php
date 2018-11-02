<?php

/*
 *  class helps to post in facebook's page
 *
 * FaceBookHelper uses EConfig extension to store configs in DB
 *
 */
class FaceBookHelper2
{
    private $_facebook;

    public $app_id;
    public $app_secret;
    public $user_access_token;
    public $page_access_token;
    public $new_access_token;

    public $loginLink = NULL;

    public $group_id;

    public function __construct()
    {
        /* get app_id, app_secret keys from config */
        $this->getAppKeys();

        if (empty($this->user_access_token))
        {
            /* auth scenario */
            $this->loginLink = $this->_getLoginLink();
        }

        // if we get code parameter we reset user access token
        if(!empty($_REQUEST['code']))
        {
            $this->init();
            $this->user_access_token = $this->_facebook->getAccessToken();
            Yii::app()->config->set('fb_user_access_token', $this->user_access_token);
            $this->new_access_token = 1;
        }

        //we have accessToken. Try to get Page Token

        $this->page_access_token = Yii::app()->config->get('fb_page_access_token');
        $this->user_access_token = Yii::app()->config->get('fb_user_access_token');
        $this->group_id = Yii::app()->config->get('fb_group_id');


        if(!empty($this->user_access_token) && (empty($this->page_access_token) || $this->new_access_token))
        {
            $this->getPageAccesToken();
        }
    }

    public function getAppKeys()
    {
        //always use values from db
        $this->app_id = Yii::app()->config->get('fb_app_id');
        $this->app_secret = Yii::app()->config->get('fb_app_secret');
    }

    public function getUserAccessToken()
    {
        $this->user_access_token = Yii::app()->config->get('fb_user_access_token');
    }


    public function init()
    {
        Yii::import('ext.facebook.FaceBook');

        $this->_facebook = new Facebook(array(
            'appId'=>$this->app_id,
            'secret'=>$this->app_secret
        ));

        if(!empty($this->user_access_token)) $this->_facebook->setAccessToken($this->user_access_token);
    }

    /**
     * @return string Return page access token
     */

    public function getPageAccesToken()
    {
        $this->init();
        $page_info = $this->_facebook->api("/$this->group_id?fields=access_token");
        $page_access_token = $page_info['access_token'];
        Yii::app()->config->set('fb_page_access_token', $page_access_token);
        return $page_access_token;
    }

    private function _getLoginLink()
    {
        $this->init();
        return CHtml::link('Привязать админский аккаунт', $this->_facebook->getLoginUrl(array(
                'scope'=>'manage_pages, offline_access, publish_stream',
                'redirect_uri'=>Yii::app()->createAbsoluteUrl('social/index'),
            )
        ));
    }


    public function post($message)
    {
        $this->init();
        $this->page_access_token = Yii::app()->config->get('fb_page_access_token');
        if (!empty($this->page_access_token))
        {
            $args = array(
                'access_token'  => $this->page_access_token,
                'message'       => $message,
            );
            return $this->_facebook->api("/$this->group_id/feed","post",$args);
            //return true;
        }
        return false;
    }

    public function deleteAuth()
    {
        Yii::app()->config->set('fb_user_access_token', '');
        Yii::app()->config->set('fb_page_access_token', '');
    }

    public function logout()
    {
        $this->init();
        return CHtml::link('Удалить авторизацию', $this->_facebook->getLogoutUrl());
    }

    /*
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
    */
}

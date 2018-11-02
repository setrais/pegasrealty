<?php

Yii::import('application.components.openid.*');

require_once dirname(__FILE__) . "/openid/Auth/OpenID/Consumer.php";
require_once dirname(__FILE__) . "/openid/Auth/OpenID/FileStore.php";
require_once dirname(__FILE__) . "/openid/Auth/OpenID/SReg.php";
require_once dirname(__FILE__) . "/openid/Auth/OpenID/PAPE.php";


class AuthOpenIDBase extends CComponent
{
    // ссылка на которую произойдет редирект после авторизации на сайте OpeId - провайдера
    protected $returnTo;

    // ссылка которая будет отображена на сайте OpenId - провайдера
    protected $trustRoot;

    public function __construct($returnTo, $trustRoot)
    {
        global $pape_policy_uris;

        $this->returnTo = $returnTo;
        $this->trustRoot = $trustRoot;

        defined('Auth_OpenID_RAND_SOURCE') or define('Auth_OpenID_RAND_SOURCE', null);

        $pape_policy_uris = array(
            PAPE_AUTH_MULTI_FACTOR_PHYSICAL,
            PAPE_AUTH_MULTI_FACTOR,
            PAPE_AUTH_PHISHING_RESISTANT
        );

    }

    public function getStorage($dir = 'application.runtime.openid')
    {
        $path = $dir;

        $rPath = YiiBase::getPathOfAlias($path);

        if (!is_dir($rPath) || !is_writable($rPath)) {
            throw new Exception('Storage dir is not writible or is does not exisit!');
        }

        return new Auth_OpenID_FileStore($rPath);
    }


    public function getConsumer()
    {
        return new Auth_OpenID_Consumer($this->getStorage());
    }


    function getScheme()
    {
        $scheme = 'http';

        if (isset($_SERVER['HTTPS']) and $_SERVER['HTTPS'] == 'on') {
            $scheme .= 's';
        }

        return $scheme;
    }


    public function getReturnTo()
    {
        return $this->returnTo;
    }

    public function getTrustRoot()
    {
        return $this->trustRoot;
    }

    public function authenticate($openIdUrl)
    {
        if ($openIdUrl) {

            // необходимо инициализировать сессию пользователя
            Yii::app()->user->setState('openIdUrl', $openIdUrl);

            $consumer = $this->getConsumer();

            $authRequest = $consumer->begin($openIdUrl);


            // указан Url не являющийся OpenId
            if (!$authRequest) {
                return false;
            }


            $sregRequest = Auth_OpenID_SRegRequest::build(array('nickname'), array('fullname', 'email'));

            if ($sregRequest) {
                $authRequest->addExtension($sregRequest);
            }

            if ($authRequest->shouldSendRedirect()) {
                $redirectUrl = $authRequest->redirectURL($this->getTrustRoot(), $this->getReturnTo());

                if (Auth_OpenID::isFailure($redirectUrl)) {
                    throw new Exception('Cannot redirect to ' . $redirectUrl->message);
                } else {
                    header("Location: $redirectUrl");
                }
            } else {
                $formId = 'openid_message';

                $formHtml = $authRequest->formMarkup($this->getTrustRoot(), $this->getReturnTo(), false, array('id' => $formId));

                $s = " style=\"display:none\" ";

                $formHtml = str_replace("<form", "<form $s", $formHtml);

                print "<html>
                    <body  onload='document.getElementById(\"" . $formId . "\").submit()'>
                    $formHtml
                    </body>
                    </html>";
                exit;
            }
        } else {
            throw new Exception('OpenIdUrl is empty!');
        }
    }

    public function finalAuth()
    {
        Yii::app()->user->setState('openIdAnswerTime', time());
        $consumer = $this->getConsumer();
        $returnTo = $this->getReturnTo() . '?' . $_SERVER['QUERY_STRING'];
        $response = $consumer->complete($returnTo);

        if ($response->status == Auth_OpenID_CANCEL) {
            // нажали "Отмена" на страничке OpenId-провайдера
            throw new CHttpException('Авторизация отменена!');
        } elseif ($response->status == Auth_OpenID_FAILURE) {
            // логин или пароль указаны не правильно
            throw new CHttpException('OpenId авторизация не удалась!');
        } elseif ($response->status == Auth_OpenID_SUCCESS) {
            // авторизация завершилась успешно...
            $openid = $response->getDisplayIdentifier();
            $sregResp = Auth_OpenID_SRegResponse::fromSuccessResponse($response);
            $sReg = $sregResp->contents();

            $sReg['openIdLink'] = $openid;

            return $sReg;
        }
    }
}

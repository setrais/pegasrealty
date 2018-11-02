<?php
/**
 * vk.wallpost main class code
 *
 * @package vk.wallpost
 * @author Ayrat Belyaev <xbreaker@gmail.com>
 * @copyright (c) 2011 xbreaker
 * @license http://creativecommons.org/licenses/by-sa/3.0/legalcode
 */

class vkWallpost
{
    private $_pass;
    private $_login;
    private $_wallURL;
    private $_wallId;
    private $_cookies   = "aqwdhfyrfd.txt";
    private $_headers   = 1; //1- помогает при дебаге
    private $_userAgent = "Mozilla/5.0 (Windows NT 6.1; rv:8.0.1) Gecko/20100101 Firefox/8.0.1";
    private $_proxyAddr = 'url:port'; //менять не в этом файла, а при инициализации объекта
    private $_proxyAuth = 'login:password';
    private $_proxyType = 'https'; //socks4|socks5
    public $useProxy    = false;

    public $myCystom1;
    public $myCystom2;
    public $myCystom3;
    public $myCystom4; // параметры для вар дампа

    public $ip_h;

    public function __construct($login, $pass, $wallURL, $wallId="")
    {
        //если хотим постить на страницу группы, нужно указать её $wallId со знаком минус
        //например -9999. А если на страницу пользователя, то можно не заполнять поле
        $this->login   = $login;
        $this->pass    = $pass;
        $this->wallURL = $wallURL;
        $this->wallId  = $wallId;
        //$this->_cookies   = $_SERVER['DOCUMENT_ROOT'] . "/../vkontakte_cookie.txt";
        //$this->_cookies   = 'vkontakte_cookie.txt';
        //$this->_cookies   =  'protected/extensions/vkwallpost/vkontakte_cookie.txt';
        $vkp = file_get_contents('http://m.vkontakte.ru/login');
        preg_match_all('/ip_h=(.*?)&/si', $vkp, $out);
        $this->ip_h=$out[1][0];
    }

    /**
     *  Геттеры и сеттеры.
     */
    function __get($var)
    {
        switch ($var)
        {
            case "pass":
            case "login":
            case "wallURL":
            case "wallId":
            case "proxyAddr":
            case "proxyAuth":
            case "proxyType":
            case "userAgent":
            case "headers":
                $var = "_" . $var;
                return $this->$var;
                break;
            default:
                $this->RaiseExeption("Unknow field '$var'");
                break;
        }
    }

    function __set($var, $val)
    {
        switch ($var) {
            case "pass":
            case "login":
            case "wallURL":
            case "proxyAddr":
            case "proxyAuth":
            case "proxyType":
            case "wallId":
            case "userAgent":
            case "headers":
                $var = "_" . $var;
                return $this->$var = $val;
                break;
            default:
                $this->RaiseExeption("Unknow field '$var'");
                break;
        }
    }

    /**
     *   Выбрасывает исключение с указанным тектом
     */
    public static function RaiseExeption($txt,$level=E_USER_NOTICE)
    {
        $trace = debug_backtrace();
        trigger_error(
            $txt.
                ' in ' . $trace[0]['file'] .
                ' on line ' . $trace[0]['line'],
            E_USER_NOTICE);
    }

    /**
     *   Инициализация CURL
     */
    private function getCurl()
    {
        $c = curl_init();
        //настройка прокси
        if($this->useProxy)
        {
            curl_setopt($c, CURLOPT_PROXY, $this->proxyAddr);
            curl_setopt($c, CURLOPT_PROXYUSERPWD, $this->proxyAuth);
            if( $this->proxyType == 'socks4' )
                curl_setopt($c, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS4);
            if( $this->proxyType == 'socks5' )
                curl_setopt($c, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
        }
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        @curl_setopt($c, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($c, CURLOPT_USERAGENT, $this->userAgent);
        if($this->headers)
            curl_setopt($c, CURLOPT_HEADER, 1);
        if($this->_cookies)
        {
            curl_setopt($c, CURLOPT_COOKIEJAR,  $this->_cookies);
            curl_setopt($c, CURLOPT_COOKIEFILE, $this->_cookies);
        }
        return $c;
    }

    /**
     *   Выполнение запроса (вынесено в отдельный метод, для более удобного дебага)
     */
    private function execCurl($ch, $func)
    {
        //$result = curl_exec($ch);
        //$result = $this->curl_exec_follow($ch);
        $result = $this->curl_redir_exec($ch);
        //curl_exec($ch);
        $this->myCystom3 = $result;
        $eo = curl_errno($ch);
        $err = curl_error($ch);
        if($eo > 0) {
            $this->RaiseExeption("CURL error in '$func:$eo' $err");
        }
        curl_close($ch);
        return $result;
    }

    /**
     *   Функция для обхода варнинга CURLOPT_FOLLOWLOCATION cannot be activated
     *   when in safe_mode or an open_basedir is set in
     *   http://www.php.net/manual/en/function.curl-setopt.php#102121
     */

    /*
     * ОСТОРОЖНО  ---  ГОВНОКОД
     */


    /*
    function curl_exec_follow( $ch,  &$maxredirect = null)
    {
        $mr = $maxredirect === null ? 5 : intval($maxredirect);

        if (ini_get('open_basedir') == '' && ini_get('safe_mode') == '7')
        {
            echo 'WE HAVE NATIVE FOLLOWLOCATION';
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, $mr > 0);
            curl_setopt($ch, CURLOPT_MAXREDIRS, $mr);
        }
        else
        {
            echo 'WE HAVENT NATIVE FOLLOW LOCATION';
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
            if ($mr > 0)
            {
                $newurl = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
                $rch = curl_copy_handle($ch);
                curl_setopt($rch, CURLOPT_HEADER, true);
                curl_setopt($rch, CURLOPT_NOBODY, true);
                curl_setopt($rch, CURLOPT_FORBID_REUSE, false);
                curl_setopt($rch, CURLOPT_RETURNTRANSFER, true);
                do
                {
                    curl_setopt($rch, CURLOPT_URL, $newurl);
                    $header = curl_exec($rch);
                    echo $header;
                    if (curl_errno($rch))
                    {
                        $code = 0;
                    }
                    else
                    {
                        $code = curl_getinfo($rch, CURLINFO_HTTP_CODE);
                        if ($code == 301 || $code == 302)
                        {
                            preg_match('/Location:(.*?)\n/', $header, $matches);
                            $newurl = trim(array_pop($matches));
                        }
                        else
                        {
                            $code = 0;
                        }
                    }
                } while ($code && --$mr);
                curl_close($rch);
                if (!$mr)
                {
                    if ($maxredirect === null)
                    {
                        trigger_error('Too many redirects. When following redirects, libcurl hit the maximum amount.', E_USER_WARNING);
                    }
                    else
                    {
                        $maxredirect = 0;
                    }
                    return false;
                }
                curl_setopt($ch, CURLOPT_URL, $newurl);
            }
        }
        return curl_exec($ch);
    }
    */

    function curl_redir_exec($ch)
    {
        static $curl_loops = 0;
        static $curl_max_loops = 20;
        if ($curl_loops++ >= $curl_max_loops)
        {
            $curl_loops = 0;
            return FALSE;
        }
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        list($header, $data) = explode("\n\n", $data, 2);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($http_code == 301 || $http_code == 302)
        {
            $matches = array();
            preg_match('/Location:(.*?)\n/', $header, $matches);
            $url = @parse_url(trim(array_pop($matches)));
            if (!$url)
            {
                //couldn't process the url to redirect to
                $curl_loops = 0;
                return $data;
            }
            $last_url = parse_url(curl_getinfo($ch, CURLINFO_EFFECTIVE_URL));
            if (!$url['scheme'])
                $url['scheme'] = $last_url['scheme'];
            if (!$url['host'])
                $url['host'] = $last_url['host'];
            if (!$url['path'])
                $url['path'] = $last_url['path'];
            $new_url = $url['scheme'] . '://' . $url['host'] . $url['path'] . ($url['query']?'?'.$url['query']:'');
            curl_setopt($ch, CURLOPT_URL, $new_url);
            //debug('Redirecting to', $new_url);
            return $this->curl_redir_exec($ch);
        } else {
            $curl_loops=0;
            return $data;
        }
    }

    public function authCheck()
    {
        return $this->auth();
    }
    /**
     *   Посылаем данные для входа в систему
     */
    private function auth()
    {

        if ($this->login=="")
        {
            $this->RaiseExeption("Empty login");
            return false;
        }
        $login = urlencode($this->login);
        $pass = urlencode($this->pass);
        $c = curl_init();
        $params = array(
            'email'=>$this->login,
            'pass'=>$this->pass
        );
        curl_setopt($c, CURLOPT_URL,'https://login.vk.com/?act=login&to=&from_host=m.vkontakte.ru&ip_h='.$this->ip_h.'&pda=1');
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        //curl_setopt($c, CURLOPT_TIMEOUT, 10);
        //curl_setopt($c, CURLOPT_CONNECTTIMEOUT, 15);
        curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
        @curl_setopt($c, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($c, CURLOPT_VERBOSE, TRUE);
        curl_setopt($c, CURLOPT_COOKIEJAR, $this->_cookies);
        curl_setopt($c, CURLOPT_POST, 1);
        curl_setopt($c, CURLOPT_REFERER, 'http://m.vkontakte.ru/login');
        curl_setopt($c, CURLOPT_USERAGENT, $this->userAgent);
        curl_setopt($c, CURLOPT_POSTFIELDS, http_build_query($params));
        $data = $this->execCurl($c, 'auth');
        //$data = curl_exec($c);
        file_put_contents('/var/www/clients/client2/web7/web/protected/extensions/vkwallpost/vk_output.dat', $data);
       if(strpos($data, 'dosecuritycheck')>0)
       {
           // ну давай, ну давай =)
           preg_match_all('/name=\"hash\" value=\"(.*?)\"/si', $data, $hash);
           //echo $hash;
           //var_dump($hash);
           $ce=$this->getCurl();
           curl_setopt($ce, CURLOPT_URL,'http://m.vkontakte.ru/dosecuritycheck');
            $params = array(
                'hash'=>$hash[1][0],
                'code'=>'5151',
            );
           curl_setopt($ce, CURLOPT_POSTFIELDS, http_build_query($params));
            $data = $this->execCurl($ce, 'auth');
       }

       /*

       // WTFC = WHAT YHE FUCKING CODE
       return true;
        $login = urlencode($this->login);
        $pass = urlencode($this->pass);
        $s = 'act=login&q=1&al_frame=1&expire=&captcha_sid=&captcha_key=&'.
            'from_host=vkontakte.ru&email='.$login.'&pass='.$pass;
        $c = $this->getCurl(true);
        curl_setopt($c, CURLOPT_URL,'http://login.vkontakte.ru/?act=login');
        curl_setopt($c, CURLOPT_POST, 1);
        curl_setopt($c, CURLOPT_POSTFIELDS, $s);
        $this->myCystom2 = $this->execCurl($c, 'auth'); */
    }

    /** Получение параметров, необходимых для постинга (post_hash и my_id) */
    private function getParams()
    {
        $c=$this->getCurl();
        curl_setopt($c, CURLOPT_REFERER, 'http://vkontakte.ru/settings.php');
        curl_setopt($c, CURLOPT_URL, $this->wallURL); //запрос стены для поиска на ней информации
        $r = curl_exec($c);
        $this->myCystom1 = $r;
        preg_match_all('/"post_hash":"(\w+)"/i', $r, $f1);
        preg_match_all('/"user_id":(\d+),/i', $r, $f2);
        preg_match_all('/handlePageParams\(\{"id":(\d+),/i', $r, $f3);
        $f = array(
            'post_hash' => @$f1[1][0],  //необходим для успешного поста
            'user_id'   => @$f2[1][0],
            'my_id'     => @$f3[1][0]); //id залогиненного пользователя
        if ($this->wallId=="")
            $this->wallId=$f["my_id"];
        return $f;
    }

    /**
     *   Добавляет в альбом фотографию.
     *   Возвращает массив:
     *                     'user_id'  => пользователь который загрузил фото
     *                     'photo_id' => порядковый номер фото в системе
     *                     'mixed_id' => уникальный photo_id (состоит из user_id + photo_id), который далее
     *                                   можно передать в makePost и таким образом опубликовать ее на стенке и она появится
     *                                   у нас в альбоме "Фотографии со стены"
     */
    private function uploadPhoto($imgURL, $linkTo)
    {
        $u = urlencode($imgURL);
        $i = urlencode($linkTo);
        $c = $this->getCurl();
        $q = 'act=a_photo&url='.$u.'&image='.$i.'&extra=';
        curl_setopt($c, CURLOPT_POST, 1);
        curl_setopt($c, CURLOPT_REFERER, 'http://vkontakte.ru/share.php');
        curl_setopt($c, CURLOPT_POSTFIELDS, $q);
        curl_setopt($c, CURLOPT_URL, 'http://vkontakte.ru/share.php');
        $r = $this->execCurl($c, 'uploadPhoto');
        if(preg_match('/onUploadDone/i', $r, $o))
        {
            preg_match_all('/{"user_id":(\d+),"photo_id":(\d+)}/i', $r, $out);
            $f = array(
                'user_id'  => $out[1][0],
                'photo_id' => $out[2][0],
                'mixed_id' => $out[1][0].'_'.$out[2][0]);
            return $f;
        }
        else
        {
            return false;
        }
    }

    /**
     *   Пишем на стену
     *   Параметры:
     *             $hash - значение параметра post_hash с исходной страницы
     *             $url - публикуемая ссылка
     *             $message - сообщение, выводимое на стенке
     *             $title - название ссылки, выводимое в всплывающей подсказке
     *             $descr - описание ссылки, выводимое в всплывающей подсказке
     *             $photo - значение уникального photo_id, которое получается с помощью функции photo
     *             $type - тип сообщения, share - ссылка, photo - фото, если пустое значение, то простое сообщение
     */
    private function makePost($hash, $url, $message, $title, $descr, $photo, $type="share")
    {
        //echo '1';
        $u = urlencode($url);
        $m = urlencode($message);
        $t = urlencode($title);
        $d = urlencode($descr);
        $type="share";
        if( $type == 'share')
        {
            //echo 'type share';
            $q = 'act=post&al=1&hash='.$hash.'&message='.$m.'&note_title=&official=&status_export=&to_id='.
                $this->wallId.'&type=all&attach1=undefined_undefined&extra=0&official=1&attach1_type=share&url='.$u.'&title='.$t.'&description='.$d;
            if($photo)
                $q .= '&media='.$photo;
        }
        elseif( $type == 'photo')
        {
            //echo '2';
            $q = 'act=post&al=1&hash='.$hash.'&message='.$m.'&note_title=&official=&status_export=&to_id='.
                $this->wallId.'&type=all&attach1_type=photo&attach1='.$photo;
        }
        elseif( $type == '')
        {
            //echo '3';
            $q = 'act=post&al=1&hash='.$hash.'&message='.$m.'&note_title=&official=&status_export=&'.
                "to_id=".$this->wallId.'&type=all';
        }
        $c = $this->getCurl();
        curl_setopt($c, CURLOPT_HTTPHEADER, array('X-Requested-With: XMLHttpRequest'));
        curl_setopt($c, CURLOPT_POST, 1);
        //curl_setopt($c, CURLOPT_REFERER, 'http://vkontakte.ru/'.$_prefix.$this->wallId);
        curl_setopt($c, CURLOPT_REFERER, $this->wallURL);
        curl_setopt($c, CURLOPT_POSTFIELDS, $q);
        curl_setopt($c, CURLOPT_TIMEOUT, 15);
        curl_setopt($c, CURLOPT_CONNECTTIMEOUT, 15);
        curl_setopt($c, CURLOPT_URL, 'http://vkontakte.ru/al_wall.php');
        $r = $this->execCurl($c, 'makePost');
        //echo '4';
        return $r;
    }

    public function hashValue()
    {
        $h = $this->getHash();
        return $h['my_id'];
    }

    /**
     *   Запрашивает страницу со стеной в поисках хеша.
     *   Если не находит, то пробует логиниться.
     *   Возвращает массов, где помимо хеша также ID залогиненного пользователя. Правда в таком
     *   случае название метода не полностью верно.
     */
    public function getHash()
    {
        $h = $this->getParams();
        //если мы не залогинены, то залогиниться
        if(@$h['my_id'] == 0)
        {
            $this->auth();
            $h = $this->getParams();
        }
        //если мы все еще не залогинены, то ошибка
        /*if($h['my_id'] == 0)
       {
         $this->RaiseExeption("Can't log in");
         return false;
       } */
        return $h;
    }

    /**
     *   Пишем на стену  (логинится, находит хеш и постит на стену)
     */
    public function postMessage($url='', $message='Test', $title='', $descr='', $type='share')
    {
        $h=$this->getHash();
        $r = $this->makePost($h['post_hash'], $url, $message, $title, $descr, false, $h['user_id'], $type);
        $c = preg_match_all('/page_wall_count_all/smi',$r,$f);
        if( $c == 0 )
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    /**
     *   Грузим картинку на стену
     */
    public function postPicture($imgUrl, $linkTo='')
    {
        $h=$this->getHash();
        if (!$h)
            return false;
        $img=$this->uploadPhoto($imgUrl, $linkTo);
        pr($img);
        if (!$img)
        {
            $this->RaiseExeption("Picture is not uploaded");
            return false;
        }
        $r = $this->makePost($h['post_hash'], $linkTo, "", "", "", $img["mixed_id"], $h['user_id'], "photo");
        $c = preg_match_all('/page_wall_count_all/smi',$r,$f);
        if( $c == 0 )
        {
            return false;
        }
        else
        {
            return true;
        }
    }

}
?>
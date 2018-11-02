<?php

class MySmsMailer extends CApplicationComponent
{

// SMSC.RU API (www.smsc.ru) версия 2.5 (22.10.2011)

    public $smsc_login = "<login>";        // логин клиента
    public $smsc_password = "<password>";    // пароль или MD5-хеш пароля в нижнем регистре
    public $smsc_post = 0;                    // использовать метод POST
    public $smsc_https = 0;                // использовать HTTPS протокол
    public $smsc_charset = "windows-1251";    // кодировка сообщения: utf-8, koi8-r или windows-1251 (по умолчанию)
    public $smsc_debug = 0;                // флаг отладки
    public $smsc_from = "api@smsc.ru";     // e-mail адрес отправителя

// Функция отправки SMS
//
// обязательные параметры:
//
// $phones - список телефонов через запятую или точку с запятой
// $message - отправляемое сообщение
//
// необязательные параметры:
//
// $translit - переводить или нет в транслит (1,2 или 0)
// $time - необходимое время доставки в виде строки (DDMMYYhhmm, h1-h2, 0ts, +m)
// $id - идентификатор сообщения. Представляет собой 32-битное число в диапазоне от 1 до 2147483647.
// $format - формат сообщения (0 - обычное sms, 1 - flash-sms, 2 - wap-push, 3 - hlr, 4 - bin, 5 - bin-hex, 6 - ping-sms)
// $sender - имя отправителя (Sender ID). Для отключения Sender ID по умолчанию необходимо в качестве имени
// передать пустую строку или точку.
// $query - строка дополнительных параметров, добавляемая в URL-запрос ("valid=01:00&maxsms=3&tz=2")
//
// возвращает массив (<id>, <количество sms>, <стоимость>, <баланс>) в случае успешной отправки
// либо массив (<id>, -<код ошибки>) в случае ошибки

    public function send_sms($phones, $message, $translit = 0, $time = 0, $id = 0, $format = 0, $sender = false, $query = "")
    {
        static $formats = array(1 => "flash=1", "push=1", "hlr=1", "bin=1", "bin=2", "ping=1");

        $m = _smsc_send_cmd("send", "cost=3&phones=" . urlencode($phones) . "&mes=" . urlencode($message) .
            "&translit=$translit&id=$id" . ($format > 0 ? "&" . $formats[$format] : "") .
            ($sender === false ? "" : "&sender=" . urlencode($sender)) . "&charset=" . $this->smsc_charset .
            ($time ? "&time=" . urlencode($time) : "") . ($query ? "&$query" : ""));

        // (id, cnt, cost, balance) или (id, -error)

        if ($this->smsc_debug)
        {
            if ($m[1] > 0)
                echo "Сообщение отправлено успешно. ID: $m[0], всего SMS: $m[1], стоимость: $m[2] руб., баланс: $m[3] руб.\n";
            else
                echo "Ошибка №", -$m[1], $m[0] ? ", ID: " . $m[0] : "", "\n";
        }

        return $m;
    }

// SMTP версия функции отправки SMS

    public function send_sms_mail($phones, $message, $translit = 0, $time = 0, $id = 0, $format = 0, $sender = "")
    {
        return mail("send@send.smsc.ru", "", $this->smsc_login . ":" . $this->smsc_password . ":$id:$time:$translit,$format,$sender:$phones:$message", "From: " . $this->smsc_from . "\nContent-Type: text/plain; charset=" . $this->smsc_charset . "\n");
    }

// Функция получения стоимости SMS
//
// обязательные параметры:
//
// $phones - список телефонов через запятую или точку с запятой
// $message - отправляемое сообщение
//
// необязательные параметры:
//
// $translit - переводить или нет в транслит (1,2 или 0)
// $format - формат сообщения (0 - обычное sms, 1 - flash-sms, 2 - wap-push, 3 - hlr, 4 - bin, 5 - bin-hex, 6 - ping-sms)
// $sender - имя отправителя (Sender ID)
// $query - строка дополнительных параметров, добавляемая в URL-запрос ("list=79999999999:Ваш пароль: 123\n78888888888:Ваш пароль: 456")
//
// возвращает массив (<стоимость>, <количество sms>) либо массив (0, -<код ошибки>) в случае ошибки

    function get_sms_cost($phones, $message, $translit = 0, $format = 0, $sender = false, $query = "")
    {
        static $formats = array(1 => "flash=1", "push=1", "hlr=1", "bin=1", "bin=2", "ping=1");

        $m = _smsc_send_cmd("send", "cost=1&phones=" . urlencode($phones) . "&mes=" . urlencode($message) .
            ($sender === false ? "" : "&sender=" . urlencode($sender)) . "&charset=" . $this->smsc_charset .
            "&translit=$translit" . ($format > 0 ? "&" . $formats[$format] : "") . ($query ? "&$query" : ""));

        // (cost, cnt) или (0, -error)

        if ($this->smsc_debug)
        {
            if ($m[1] > 0)
                echo "Стоимость рассылки: $m[0] руб. Всего SMS: $m[1]\n";
            else
                echo "Ошибка №", -$m[1], "\n";
        }

        return $m;
    }

// Функция проверки статуса отправленного SMS или HLR-запроса
//
// $id - ID cообщения
// $phone - номер телефона
//
// возвращает массив:
// для отправленного SMS (<статус>, <время изменения>, <код ошибки sms>)
// для HLR-запроса (<статус>, <время изменения>, <код ошибки sms>, <код страны регистрации>, <код оператора абонента>,
// <название страны регистрации>, <название оператора абонента>, <название роуминговой страны>, <название роумингового оператора>,
// <код IMSI SIM-карты>, <номер сервис-центра>)
// либо массив (0, -<код ошибки>) в случае ошибки

    function get_status($id, $phone)
    {
        $m = _smsc_send_cmd("status", "phone=" . urlencode($phone) . "&id=" . $id);

        // (status, time, err) или (0, -error)

        if ($this->smsc_debug)
        {
            if ($m[1] != "" && $m[1] >= 0)
                echo "Статус SMS = $m[0]", $m[1] ? ", время изменения статуса - " . date("d.m.Y H:i:s", $m[1]) : "", "\n";
            else
                echo "Ошибка №", -$m[1], "\n";
        }

        return $m;
    }

// Функция получения баланса
//
// без параметров
//
// возвращает баланс в виде строки или false в случае ошибки

    function get_balance()
    {
        $m = _smsc_send_cmd("balance"); // (balance) или (0, -error)

        if ($this->smsc_debug)
        {
            if (!isset($m[1]))
                echo "Сумма на счете: ", $m[0], " руб.\n";
            else
                echo "Ошибка №", -$m[1], "\n";
        }

        return isset($m[1]) ? false : $m[0];
    }

// ВНУТРЕННИЕ ФУНКЦИИ
// Функция вызова запроса. Формирует URL и делает 3 попытки чтения

    function _smsc_send_cmd($cmd, $arg = "")
    {
        $url = ($this->smsc_https ? "https" : "http") . "://smsc.ru/sys/$cmd.php?login=" . urlencode($this->smsc_login) . "&psw=" . urlencode($this->smsc_password) . "&fmt=1&" . $arg;

        $i = 0;
        do
        {
            if ($i)
                sleep(2);

            $ret = _smsc_read_url($url);
        }
        while ($ret == "" && ++$i < 3);

        if ($ret == "")
        {
            if ($this->smsc_debug)
                echo "Ошибка чтения адреса: $url\n";

            $ret = ","; // фиктивный ответ
        }

        return explode(",", $ret);
    }

// Функция чтения URL. Для работы должно быть доступно:
// curl или fsockopen (только http) или включена опция allow_url_fopen для file_get_contents

    function _smsc_read_url($url)
    {
        $ret = "";
        $post = $this->smsc_post || strlen($url) > 2000;

        if (function_exists("curl_init"))
        {
            $c = curl_init();

            if ($post)
            {
                list($url, $post) = explode('?', $url, 2);
                curl_setopt($c, CURLOPT_POST, true);
                curl_setopt($c, CURLOPT_POSTFIELDS, $post);
            }

            curl_setopt($c, CURLOPT_URL, $url);
            curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($c, CURLOPT_CONNECTTIMEOUT, 10);
            curl_setopt($c, CURLOPT_TIMEOUT, 10);
            curl_setopt($c, CURLOPT_SSL_VERIFYPEER, 0);

            $ret = curl_exec($c);
            curl_close($c);
        } elseif (!$this->smsc_https && function_exists("fsockopen"))
        {
            $m = parse_url($url);

            $fp = fsockopen($m["host"], 80, $errno, $errstr, 10);

            if ($fp)
            {
                fwrite($fp, ($post ? "POST $m[path]" : "GET $m[path]?$m[query]") . " HTTP/1.1\r\nHost: smsc.ru\r\nUser-Agent: PHP" . ($post ? "\r\nContent-Type: application/x-www-form-urlencoded\r\nContent-Length: " . strlen($m['query']) : "") . "\r\nConnection: Close\r\n\r\n" . ($post ? $m['query'] : ""));

                while (!feof($fp))
                    $ret = fgets($fp, 100);

                fclose($fp);
            }
        }
        else
            $ret = file_get_contents($url);

        return $ret;
    }

// Examples:
// list($sms_id, $sms_cnt, $cost, $balance) = send_sms("79999999999", "Ваш пароль: 123", 1);
// list($sms_id, $sms_cnt, $cost, $balance) = send_sms("79999999999", "http://smsc.ru\nSMSC.RU", 0, 0, 0, 0, false, "maxsms=3");
// list($sms_id, $sms_cnt, $cost, $balance) = send_sms("79999999999", "0605040B8423F0DC0601AE02056A0045C60C037761702E736D73632E72752F0001037761702E736D73632E7275000101", 0, 0, 0, 5, false);
// list($sms_id, $sms_cnt, $cost, $balance) = send_sms("79999999999", "", 0, 0, 0, 3, false);
// list($cost, $sms_cnt) = get_sms_cost("79999999999", "Вы успешно зарегистрированы!");
// send_sms_mail("79999999999", "Ваш пароль: 123", 0, "0101121000");
// list($status, $time) = get_status($sms_id, "79999999999");
// $balance = get_balance();
}


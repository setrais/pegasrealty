<?php

class HString
{
    public static function random($length = 8)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $string = '';
        for ($c = 0; $c < $length; $c++) {
            $string .= $characters[rand(0, strlen($characters)-1)];
        }
        return $string;
    }
}

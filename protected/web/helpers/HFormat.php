<?php

class HFormat {
    public static function phone($t, $region_id) {
        $t = preg_replace("/\D/", "", $t);

        if (strlen($t) == 7) {
            switch($region_id) {
                case 77:
                    $t = "495".$t;
                break;

                default:
                    $t = "812".$t;
                break;
            }
        }

        if (strlen($t) == 11) {
            $t = substr($t, 1);
        }

        if (strlen($t) == 10) {
            $t = "+7".$t;
        }

        $pos = 0;
        for($c=strlen($t)-1; $c>=0; $c--) {
            if (in_array($pos, array(2, 4, 7, 10))) {
                $nums[] = " ";
            }
            $nums[] = $t{$c};
            $pos++;
        }

        return strrev(implode("", $nums));
    }
    
    function full_trim($str)                            
    {                                                   
        return trim(preg_replace('/\s{2,}/', ' ', $str));
                                                      
    }
}

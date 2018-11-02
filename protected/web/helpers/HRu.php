<?php

class HRu
{
    public static function translit($str)
    {
        $tr = array(
            "А" => "A", "Б" => "B", "В" => "V", "Г" => "G",
            "Д" => "D", "Е" => "E", "Ж" => "J", "З" => "Z", "И" => "I",
            "Й" => "Y", "К" => "K", "Л" => "L", "М" => "M", "Н" => "N",
            "О" => "O", "П" => "P", "Р" => "R", "С" => "S", "Т" => "T",
            "У" => "U", "Ф" => "F", "Х" => "H", "Ц" => "TS", "Ч" => "CH",
            "Ш" => "SH", "Щ" => "SCH", "Ъ" => "", "Ы" => "YI", "Ь" => "",
            "Э" => "E", "Ю" => "YU", "Я" => "YA", "а" => "a", "б" => "b",
            "в" => "v", "г" => "g", "д" => "d", "е" => "e", "ж" => "j",
            "з" => "z", "и" => "i", "й" => "y", "к" => "k", "л" => "l",
            "м" => "m", "н" => "n", "о" => "o", "п" => "p", "р" => "r",
            "с" => "s", "т" => "t", "у" => "u", "ф" => "f", "х" => "h",
            "ц" => "ts", "ч" => "ch", "ш" => "sh", "щ" => "sch", "ъ" => "y",
            "ы" => "yi", "ь" => "", "э" => "e", "ю" => "yu", "я" => "ya",
            " " => "_", "." => "", "/" => "_"
        );
        return strtr($str, $tr);
    }

    public static function tryTranslit($str, $try) {
        if (empty($try)) {
            return self::translit($str);
        }
        return $try;
    }

    static function Rubl(){
        return ' <span class="rur">p<span>уб.</span>';
    }
    
    function cutstr($string, $maxlen, $isquote=false, $sim='...', $end=' ') {
        $len = (mb_strlen($string) > $maxlen)
            ? mb_strripos(mb_substr($string, 0, $maxlen), $end)
            : $maxlen
        ;

        if ($isquote) $quote='"';
        else $quote='';

        $cutStr = mb_substr($string, 0, $len);
            return (mb_strlen($string) > $maxlen)
                ? $quote . $cutStr . $sim .$quote
                : $quote . $cutStr . $quote;
   }
   
   function cutarray($array,$max) {
       $aresult = array();
       $end = true;
       foreach ($array as $val) {           
           if ($end) $aresult[] = $val;
           if ($val>$max) {
               $end = false;
           }
       }
       if (!empty($aresult)) {
           return $aresult;
       } else {
           return null; //array($array[0]);
       }
   }
   
   function iskeyintxt($keys,$txt) {
       $iskey = array();
       foreach ($keys as $key) {
           if(mb_stripos($txt,$key,0,'UTF-8')!==false) $iskey[]=$key;
       }       
       return $iskey;
   }
    
   function curscob($str) {  
       $pattern = '/^([^\(]*)\s\(([^.]*)\)([^\)]*)$/i';
       $replacement = ', $1, $2';
       $preg = preg_replace($pattern, $replacement, $str);
       return ($str == $preg ? '' : $preg);
   }
   
   function trimarray($arrcur) {
       foreach ($arrcur as $key=>$el) {
           $arrres[]= trim($el);
       }
       return $arrres;
   }
   
   public function mb_ucfirst($str, $enc = 'UTF-8') { 
    	return mb_strtoupper(mb_substr($str, 0, 1, $enc), $enc).mb_strtolower(mb_substr($str, 1, mb_strlen($str, $enc), $enc),$enc); 
   }
    
    /** Generation id
     * 
     */
    public function genid() {
        return self::uuid2();
    }
	
    /** Generator of the unique key
     * 
     */
    public function uuid() 
    {
        // The field names refer to RFC 4122 section 4.1.2
        return sprintf('%04x%04x-%04x-%03x4-%04x-%04x%04x%04x',
        mt_rand(0, 65535), mt_rand(0, 65535), // 32 bits for "time_low"
        mt_rand(0, 65535), // 16 bits for "time_mid"
        mt_rand(0, 4095),  // 12 bits before the 0100 of (version) 4 for "time_hi_and_version"
        bindec(substr_replace(sprintf('%016b', mt_rand(0, 65535)), '01', 6, 2)),
        // 8 bits, the last two of which (positions 6 and 7) are 01, for "clk_seq_hi_res"
        // (hence, the 2nd hex digit after the 3rd hyphen can only be 1, 5, 9 or d)
        // 8 bits for "clk_seq_low"
        mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535) // 48 bits for "node"
        );
    }


    /** Generator of the unique key
     * 
     */
    public function uuid2() 
    {
       // better, difficult to guess
       return  md5(uniqid(rand(), true));
    }
    
    /** Вывод отладочной информации
     * 
     * @param $info   	: string - Информация
     * @param $is_res	: string - Формат (array)
     * @param $is_end	: string - Закрывать тег pre
     * @return 			: string - Строка отладки
     */
    public function d($info, $is_res=false, $is_end=true) 
    {
	
	$beg='<pre>';
	$end='</pre>';
		
	if (is_array($info) || is_object($info)) $res=print_r($info);
	else if (is_string($info)) $res=$info;
	else if ($is_res) 
	{
            foreach ($info->result() as $row)
            {
    		$res=print_r($row);
            }
	} 
	else 
	{
            $res=$info;
	}
				
	if ($is_end) $res=$beg.$res.$end;
	else  $res=$beg.$res;
		
	return $res;
    }
	
    /** Выводит отладочную информацию
     *  @param  $info 	: string - Информация
     *          $is_res : string - Формат (array)
     *          $is_end  : string - Закрывать тег pre
     *          $is_die  : string - Прирывать выполнение    
     */
     function sed($info, $is_res=false, $is_end=true, $is_die=false) 
     {		
	echo self::d($info, $is_res, $is_end);
		
	if ($is_die)
	{
            die();
	}
    }

    function genuid() {
        return $this->genid;
    }
    
    function gennid() {
        return rand(1,99999).strtoupper(HCommon::genRandomString(2,'',array('num'=>false)));
        
    }
    
    function gentid() {
        return time().strtoupper(HCommon::genRandomString(2,'',array('num'=>false)));        
    }
    
    
    ### Функция создает список ключевых слов по тексту, а также краткое описание.
    ### Входящие параметры:
    ###   - $text - Сообственно текст для которого хотим получить ключевые слова
    ###   - $keywords - Дополнительные ключевые слова. Будут добавляться в начало полученных.
    ###   - $description - Дополнительное описание. Будет добавляться в начало полученного.
    ###                    (Учтите, описание не более 200 символов, поэтому полученное будет
    ###                     обрезаться с учетом длинны дополнительного)
    ###
    ### Выходные параметры:
    ###   - $meta['keywords'] - Соответственно ключевые слова
    ###   - $meta['description'] - и описание
    ###
    ### Использование:
    ###   - $meta=create_meta($text);
    ###   - $meta=create_meta($text, $keywords);
    ###   - $meta=create_meta($text, 'дополнительные,ключевые,слова');
    ###   - $meta=create_meta($text, $keywords, $description);
    ###   - $meta=create_meta($text, 'дополнительные,ключевые,слова', 'дополнительное,описание');
    function create_meta($text, $keywords='', $description='') {
        ### Нормализация текста
        $search = array ("'ё'",
                         "'<script[^>]*?>.*?</script>'si",  // Вырезается javascript
                         "'<[\/\!]*?[^<>]*?>'si",           // Вырезаются html-тэги
                         "'([\r\n])[\s]+'",                 // Вырезается пустое пространство
                         "'&(quot|#34);'i",                 // Замещаются html-элементы
                         "'&(laquo|#171);'i",
                         "'&(ndash|#8211);'i",
                         "'&(mdash|#8212);'i",
                         "'&(raquo|#187);'i",
                         "'&(amp|#38);'i",
                         "'&(lt|#60);'i",
                         "'&(gt|#62);'i",
                         "'&(nbsp|#160);'i",
                         "'&(iexcl|#161);'i",
                         "'&(cent|#162);'i",
                         "'&(pound|#163);'i",
                         "'&(copy|#169);'i",
                         "'&#(\d+);'e");
        $replace = array ("е",
                          " ",
                          " ",
                          "\\1 ",
                          "\" ",
                          " ",
                          " ",
                          " ",
                          " ",
                          " ",
                          " ",
                          " ",
                          " ",
                          chr(161),
                          chr(162),
                          chr(163),
                          chr(169),
                          "chr(\\1)");
        $text=preg_replace($search, $replace, $text);
        $text=trim(stripslashes(preg_replace('/[\r\n\t]/i', ' ', strip_tags($text))));

        ### Формируем описание из текста, макс.200 за до первого знака пунктуации
        $idx=$idw=450;
        if(!empty($description)) {
            $description=trim($description).' ';
            $idx-=strlen($description);
        }
        while(!in_array($text[$idw], array('.', '!', '?', ',', '-', ':')) && $idw )$idw--;       
        if ($idw) $meta['description']=strtr( $description.substr($text, 0, $idw+1).".",
                                              array( ',.'=>'...', '-.'=>'...',
                                                     ':.'=>'...','..'=>'.',
                                                     ' ,.'=>'...', ' -.'=>'...', ' :.'=>'...',' ..'=>'.'
                                                    )
                                              );
        else { 
            $idx=strrpos(substr($text, 0, $idx+1)," ");
            $meta['description']=$description.substr($text, 0, $idx).".";
        }    

        ### Загружаем таблицу общих слов и удаляем эти слова из текста
        $name='common-words.txt';
        if(file_exists($name)) {
            if($file=fopen($name, 'r')) {
                $data='';
                while(!feof($file)){
                    $word=trim(fgets($file));
                    if($word[0]=='#')continue;
                    $data.=' '.$word;
                }
                fclose($file);
                $data=str_replace(' ', '|', trim($data));
            }
            $text=preg_replace('/\b'.$data.'\b/i', '', $text);
        }
        ### Удаляем из текста все знаки препинаний и пунктуации и преобразуем в массив слов
        //$text=split(' ', preg_replace('/[^\w]+/i', ' ', $text)); $data='';
        $del_symbols = array(",", ".", ";", ":", "\"", "#", "\$", "%", "^",
                             "!", "@", "`", "~", "*", "-", "=", "+", "\\",
                             "|", "/", ">", "<", "(", ")", "&", "?", "¹", "\t",
                             "\r", "\n", "{","}","[","]", "'", "“", "”", "•",
                             " не "," на "," то "," вы "," по "," бы "," потому ", " из ",
                             " как ", " для ", " что ", " или ", " это ", " этих ",
                             " всех ", " вас ", " они ", " оно ", " еще ", " когда ", " также ", " которые ", " который",
                             " где ", " эта ", " лишь ", " уже ", " вам ", " нет ",
                             " если ", " надо ", " все ", " так ", " его ", " чем ",
                             " при ", " даже ", " мне ", " есть ", " раз ", " два ",
                             "0", "1", "2", "3", "4", "5", "6", "7", "8", "9"
                             );
        $text = mb_strtolower(str_replace($del_symbols, array_fill(0, count($del_symbols)," "), $text),'UTF-8');
        $text = preg_replace("( +)", " ", $text);
        $text = explode(' ', preg_replace('/[\d\.\,\!\-]+/i', ' ', $text)); $data='';        
          
        foreach($text as $key=>$word) if(strlen($word)>3) $data.=' '.strtolower($word);
        $text=explode(' ', trim($data)); $size=count($text);
        $arr1=array(); $arr2=array(); $arr3=array();
        ### Строим массив слов отсортированный по частоте вложений в тексте
        for($i=0; $i<$size; $i++) {
            $word=$text[$i];
            if($arr1[$word])$arr1[$word]++; else $arr1[$word]=1;
        }
        arsort($arr1);
        ### Строим массив фраз состоящих из двух слов отсортированный по частоте вложений в тексте
        for($i=0; $i<$size-1; $i++) {
            $word=$text[$i].' '.$text[$i+1];
            if($arr2[$word])$arr2[$word]++; else $arr2[$word]=1; 
        }
        arsort($arr2);
        ### Строим массив фраз состоящих из трех слов отсортированный по частоте вложений в тексте
        for($i=0; $i<$size-2; $i++) {
            $word=$text[$i].' '.$text[$i+1].' '.$text[$i+2];
            if($arr3[$word])$arr3[$word]++; else $arr3[$word]=1;
        }
        arsort($arr3);

        ### Выбираем 15 первых слов с максимальной частотой вложений
        $data=array(); $i=0;
        foreach($arr1 as $word=>$count) {
            $data[$word]=$count;
            if($i++==16)break;
        }
        ### Выбираем 8 первых фраз состоящих из двух слов с максимальной частотой вложений
        $i=0;
        foreach($arr2 as $word=>$count) {
            $data[$word]=$count;
            if($i++==8)break;
        }
        ### Выбираем 4 первых фраз состоящих из трех слов с максимальной частотой вложений
        $i=0;
        foreach($arr3 as $word=>$count) {
            $data[$word]=$count;
            if($i++==4)break;
        }
        arsort($data); $text='';

        ### Переводим массив фраз в текст, опять таки с учетом частот вложений
        //foreach($data as $word=>$count) $text.=','.$word; $text=substr($text, 1);
        //if(!empty($keywords))$keywords=preg_replace('/,$/i', '', $keywords).',';
        foreach($data as $word=>$count) $text.=', '.$word; $text=substr($text, 2);
        if(!empty($keywords))$keywords=preg_replace('/,$/i', '', $keywords).', ';
        $meta['keywords']=$keywords.$text;
        ### Возвращаем полученный результат
        return $meta;
     }
     
    /**
     * Saves configuration into a file.
     * There's no need to provide full array, just the part that needs to be updated.
     * 
     * Ex.:
     * current configuration:
     * <pre>
     * array(
     *     'key1'=>'value1',
     *     'key2'=>'value2'
     * )
     * </pre>
     * configuration, that needs to be updated:
     * <pre>
     * array(
     *     'key1'=>'newValue'
     * )
     * </pre>
     * @param string configuration file name.
     * @param array configuration to be saved.
     * @param boolean whether to replace matching configuration recrods or not
     * @return boolean true if configuration has been successfully saved.
     */
    public static function saveConfig($file,$config,$replace=true)
    {
	$old = require($file);
	$new = $replace?CMap::mergeArray($old,$config):CMap::mergeArray($config,$old);
	$new = self::unsetNulls($new);
	return app()->file->set($file)->setContents("<?php\n return " . var_export($new,true) . ';');
    }
}

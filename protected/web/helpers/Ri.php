<?php
/**
 * File of Librari CXI, phpDocumentor Quickstart
 * 
 * This file of yavlyaet'sya additional a library 
 * for expansions applications under framework Codeigniter
 * in-code documentation through DocBlocks and tags.
 * @author Aleksandr Rikun <setrais@gmail.com>
 * @version 1.0
 * @package CXI
 */
class Cfg 
{
	
    public $lib_path='/libs/';
	
    /** Возвращает каталог, где находится сайт
     * 
     */
    function root_dir()
    {
    	return $_SERVER["DOCUMENT_ROOT"];
    }


    /** Относительный путь к библиотекам
     * 
     */
    function lib_path( $lib_name='' )
    {
    	$rez=$this->lib_path.$lib_name;
    	
      	if ( trim( $lib_name<>'' ) )
      	{
        	$rez.='/';
      	}
      	return $rez;
    }

    
    /** Абсолютный путь к библиотекам
     * 
     * @param $lib_name
     */
    function lib_abs_path( $lib_name='' )
    {
      	return $this->root_dir().$this->lib_path( $lib_name );
    }
	
}

class Genid {

	
    /** Generation id
     * 
     */
    function genid() {
        return $this->uuid2();
    }
	
    /** Generator of the unique key
     * 
     */
    function uuid() 
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
    function uuid2() 
    {
       // better, difficult to guess
       return  md5(uniqid(rand(), true));
    }
	
} 

class Ri extends Genid {

    public $image;
    public $file;	  
    /** Конструктор класса
     * 
     */
    function __construct() 
    {           
            $this->image=new RiImage();			
            $this->file=new RiImage();			
    }
	
    /** Деструктор класса
     * 
     */
    function __destruct() { }
	
    /** Главная функция класса
     * 
     */
    function Ri() 
    {
        parent::Genid();
        $this->init();
    }
	
    /** Инициализация класса
     * 
     */
    function init() 
    {
	//echo "A class is initialized!";		
    }
	
    /** Вывод отладочной информации
     * 
     * @param $info   	: string - Информация
     * @param $is_res	: string - Формат (array)
     * @param $is_end	: string - Закрывать тег pre
     * @return 			: string - Строка отладки
     */
    function d($info, $is_res=false, $is_end=true) 
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
	echo $this->d($info, $is_res, $is_end);
		
	if ($is_die)
	{
            die();
	}
    }
	
	
   /* Формирует наименование месяца
    * 
    * @params $month string number mounth 
    * 		  $is_short string type name
    * 		  $short int cnt shorting name
    */
   function get_name_month($month='',$is_short=false,$short=3,$lang="ru_vid")
   {
       $this->d( $month, 'echo' );

       if (is_int($month)) $month = str_pad( $month, 2, "0", STR_PAD_LEFT );      
       switch( $month )
       {
    	  case '01': $monstr = array(   "en"    => 'January',
                                        "ru"    => 'Январь',
    					"ru_vid" 	=> 'Января' );
                     break;    			 
    	  case '02': $monstr = array(   "en"	=> "February",
				   	"ru"	=> "Февраль",
				   	"ru_vid" 	=> "Февраля" );
                     break;    			 
    	  case '03': $monstr = array(   "en"		=> "March",
    				   	"ru"		=> "Март",
    					"ru_vid" 	=> "Марта"	 );
    		     break;    			 
    	  case '04': $monstr = array(   "en"		=> "April",
    					"ru"		=> "Апрель",
    					"ru_vid" 	=> "Апреля"  );
    		     break;    			 
    	  case '05': $monstr = array(   "en"		=> "May",
    					"ru"		=> "Май",
    					"ru_vid" 	=> "Мая"	);
                     break;    			 
    	  case '06': $monstr = array(   "en"		=> "June",
    					"ru"		=> "Июнь",
    					"ru_vid" 	=> "Июня"	);
                     break;    			 
          case '07': $monstr = array(   "en"		=> "July",
    					"ru"		=> "Июль",
    					"ru_vid"	=> "Июля"	);
                     break;    			 
    	  case '08': $monstr = array(   "en"		=> "August",
    				  	"ru"		=> "Август",
    					"ru_vid"	=> "Августа" );
                     break; 
    	  case '09': $monstr = array(   "en"		=> "September",
    					"ru"		=> "Сентябрь",
    					"ru_vid"	=> "Сентября" );
                     break; 
    	  case '10': $monstr = array(   "en"		=> "October",
   					"ru"		=> "Октябрь",
    					"ru_vid" 	=> "Октября" );
                     break;
          case '11': $monstr = array(   "en"		=> "November",
    					"ru"		=> "Ноябрь",
    					"ru_vid"	=> "Ноября"	);
                     break;    			 
          case '12': $monstr = array(   "en"		=> "December",
      					"ru"		=> "Декабрь",
      					"ru_vid"	=> "Декабря" );
                     break;
          default:   $monstr = array(   "ru"		=>'',
                                        "en"		=>""		 );
    	}
    	
    	if ( $is_short ) $monstr = substr( $monstr[$lang], 0, $short );
    	else $monstr = $monstr[ $lang ];
    	
    	return $monstr;
    }

    
   /** Формирует массив месяцев года 
    * 
    * @param 		$lang : string - язык вывода месяца
    * @return			  : string - название месяца 
    */  
   function get_data_months( $lang="ru" ) 
   {
       $months=array( "ru" => 
                      array( "01" => "Январь", "02" => "Февраль", "03" => "Март", 
                             "04" => "Апрель", "05" => "Май",     "06" => "Июнь",
 			     "07" => "Июль",   "08" => "Август",  "09" => "Сентябрь",	
                             "10" => "Октябрь","11" => "Ноябрь",  "12" => "Декабрь"
	 		    ));
	 				 
	return $months[$lang];
   }

   /**
    * 
    *
   function dc_simple( $textinp )
   {
       return iconv( 'utf-8', 'cp1251', $textinp );
   }*/
   
   /**
    * 
   function ec_simple( $textinp )
   {
       return iconv( 'cp1251', 'utf-8', $textinp );
   }*/
   
   
   /**
    * 
    * @param unknown_type $date
    */
   function get_str_date( $date=array() ) 
   {		
	return $date["mday"]." ".$this->get_name_month( $date["mon"] )
	       ." ".$date["year"];	
   }
   
   /**
    * 
    * @param $str_date
    * @param $location
    */
   function conv_date_tounix( $str_date='', $location='ru' ) 
   {
     $date_elements = explode( ".", $str_date );
    	
     if ( $location == "ru" ) return $date_elements[2]."-".$date_elements[1]."-".$date_elements[0];
     else return $str_date;
   }
   
   function get_str_period( $date_start=array(), $date_end=array() ) 
   {		
	$action=array();
		
	if ($date_end["year"]==$date_start["year"] && $date_end["mon"]==$date_start["mon"]) 
	{
            $action["period"] = $date_start["mday"].' – '.$date_end["mday"]." "
							   .$this->get_name_month($date_start["mon"])
							   ." ".$date_start["year"]." года";
	} 
	else if ($date_end["year"]==$date_start["year"] && $date_end["mon"]!=$date_start["mon"]) 
	{
            $action["period"] = $date_start["mday"].' '.$this->get_name_month( $date_start["mon"] )
				.' – '.$date_end["mday"].' '.$this->get_name_month( $date_end["mon"] )
				." ".$date_start["year"]." года";
	} 
	else if ( $date_end["year"]!=$date_start["year"] && $date_end["mon"]!=$date_start["mon"] ) 
	{
            $action["period"] = $date_start["mday"].' '.$this->get_name_month($date_start["mon"])
                		.' '.$date_start["year"]." – ".$date_end["mday"]
				.' '.$this->get_name_month($date_end["mon"])." ".$date_end["year"]." года";
	}
		
	return $action["period"];
   } 

   function get_cut_text( $text, $cnt_sim="400", $stud="..." )
   {
   	// указываем кодировку
	mb_internal_encoding("UTF-8");
		 
	// обрезаем строку до 400 символов
	$cut_text = mb_substr($text,0,$cnt_sim);
		
	if ( strlen($text) > strlen( $cut_text ) ) return $cut_text.' '.$stud;	
	else return $cut_text;
   }	

   function cutstr($string, $maxlen, $isquote=false) {
        $len = (mb_strlen($string) > $maxlen)
            ? mb_strripos(mb_substr($string, 0, $maxlen), ' ')
            : $maxlen
        ;

        if ($isquote) $quote='"';
        else $quote='';

        $cutStr = mb_substr($string, 0, $len);
            return (mb_strlen($string) > $maxlen)
                ? $quote . $cutStr . '...'.$quote
                : $quote . $cutStr . $quote;
   }

   // Возвращает абсолютный путь к корню без /
   function ci_absnosl_base_url($base_url)
   {
   	 return substr($base_url, 0, -1);
   }
}

// Параметры картинки
class Param_Image 
{
    public $width=140;
    public $height=140;

    public $max_width=null;   			// Максимальная ширина
    public $max_height=null;  			// Максимальная высота

    public $quality=100;
    public $background=0xFFFFFF;
    public $logo_file=null;
    public $align_img='left';           // Расположение картинки по горизонтали при диспропорции
    public $valign_img='top';           // Расположение картинки по вертикали при диспропорции
    public $isdisp=false;               // Диспропропарция
    public $smootdisp='none';           // Выравнивание диспопорции 'none','fill','cutt'
}


Class RiImage 
  {

    public $scr_photo;             // Маленькая фотография (тип param_image)
    public $small_photo;           // Маленькая фотография (тип param_image)
    public $big_photo;             // Большая фотография (тип param_image)
    public $file;                  // Компонента для загрузки файлов
    public $is_ajax_css=false;     // Подключать файл стилей ajax
    public $folder_name='images';  // Название каталога в хранилище файлов, куда будет сохраняться информация
    public $is_ajax_reg=false;     // Использовать ajax при генерации картинок

    // Для внутреннего использования
    protected $ext;

  	function __construct()
	{	
		$this->init();
		$this->file=new RiFile();
	}

    function init() 
    {
      $this->small_photo=new Param_Image($this);
      $this->big_photo=new Param_Image($this);
      $thia->scr_photo=new Param_Image($this);
    }

    /** Устанавливает необходимый размер фотографии
     * 
     * @param $file_name - название файла
     * @param $param - объект с параметрами изображения. Имеет тип param_image
     */
    function resize( $file_name, $file_rez=null, $param=null )
    {
         // Получаем размер изображения
         $size_src = getimagesize($file_name);
         
         if ($size_src == false) 
         {
            $this->cxi->d("По указаному пути: ".$file_name." нет файл источника </br>");
            return false;
         }

    	$param->quality=(int)$param->quality; // приводим качество к инту, чтобы не было проблем
    	$param->width=(int)$param->width;     // тоже и с размерами
	    $param->height=(int)$param->height;

	    // если качество меньше 1 или больше 99, тогда ставим его 100
	    if($param->quality<1 || $param->quality>99){
		    $param->quality=100;
 	    }

        // Создаем каталог
        $this->file->create_dir($file_rez,0775, true);

    	// Определяем исходный формат по MIME-информации, предоставленной
	    // функцией getimagesize, и выбираем соответствующую формату
	    // imagecreatefrom-функцию.
	$format = strtolower(substr($size_src['mime'], strpos($size_src['mime'], '/')+1));
    	$icfunc = "imagecreatefrom" . $format;

        // Проверяем является ли файл графическим
    	if (!function_exists($icfunc)) {
            echo "Файл источник: ".$src." не являеться графическим </br>";
            return false;
        }


      	$isrc = $icfunc($file_name);

        ///////////////////////////////////////////////////////////////////////
        // Назначение параметров машбирования по умолчанию
        ///////////////////////////////////////////////////////////////////////
        $top_src=0;               // Расположение по вертикали на холсте
        $left_src=0;              // Расположение по горизонтали на холсте
        $src_x=0;                 // Центрирование изображения по х
        $src_y=0;                 // Центрирование изображения по y
        $src_width=$size_src[0];  // Ширина области картинки
        $src_height=$size_src[1]; // Высота области картинки
        ///////////////////////////////////////////////////////////////////////

        // Определяем пропорцию по ширине. Если ширина не задана (null), тогда пропоцию определяем по высоте.
        // Если высота тоже не задане - не делаем масштабирование
        if (($param->width<>null)and($param->width<>0)and($param->height<>null)and($param->height<>0)){

                if($param->isdisp) {

                   $width_img=$param->width;
                   $height_img=$param->height;
                   $width_area=$width_img;   // Ширина области фонирования
                   $height_area=$height_img; // Высота области фонирования

                } else {

                   $koef_width=$param->width/$size_src[0];
                   $koef_height=$param->height/$size_src[1];

                   if (($param->smootdisp=='fill') or ($param->smootdisp=='none')) {

                       // При заливке фоном
                       if ($param->smootdisp=='fill') {

                           $koef = min($koef_width, $koef_height);
                           $onwidth = ($koef_width == $koef);
                           $width_img   = $onwidth  ? $param->width  : floor($size_src[0] * $koef);
                           $height_img  = !$onwidth ? $param->height : floor($size_src[1] * $koef);
                           $src_x    = 0 ;
                           $src_y    = 0 ;
                           $width_area=$param->width;   // Ширина области фонирования
                           $height_area=$param->height; // Высота области фонирования
                           $src_width = $size_src[0];
                           $src_height= $size_src[1];
                           $isfill=true;                    // Заливать фоном
                       // Без заливки фоном
                       } else {

                           $koef = min($koef_width, $koef_height);
                           $onwidth = ($koef_width == $koef);
                           $width_img   = $onwidth  ? $param->width  : floor($size_src[0] * $koef);
                           $height_img  = !$onwidth ? $param->height : floor($size_src[1] * $koef);
                           $src_width = $size_src[0];
                           $src_height= $size_src[1];
                           $width_area=$width_img;   // Ширина области фонирования
                           $height_area=$height_img; // Высота области фонирования
                           $isfill=false;                   // Не заливать фоном
                       }


                   } else if ($param->smootdisp=='cutt') {

                       $koef = max($koef_width, $koef_height);
                       $onwidth = ($koef_width == $koef);
                       $src_x    = $onwidth ? 0 : floor(($size_src[0]-floor($param->width/$koef)) / 2);
                       $src_y    = !$onwidth ? 0 : floor(($size_src[1]-floor($param->height/$koef)) / 2);
                       $src_width = floor($param->width/$koef);  // Ширина обрезанная
                       $src_height= floor($param->height/$koef); // Высота обрезанная
                       $width_img =$param->width;
                       $height_img=$param->height;
                       $width_area=$width_img;   // Ширина области фонирования
                       $height_area=$height_img; // Высота области фонирования
                       $isfill=false;

                   } else if ($param->smootdisp=="apro") {
                       $koef = max($koef_width, $koef_height);
                       $onwidth = ($koef_width == $koef);
                       $width_img   = $onwidth  ? $param->width  : floor($size_src[0] * $koef);
                       $height_img  = !$onwidth ? $param->height : floor($size_src[1] * $koef);
                       $src_x    = 0 ;
                       $src_y    = 0 ;
                       $width_area=  (($width_img<$param->width) ? $param->width : $width_img) ;   // Ширина области фонирования
                       $height_area= (($height_img<$param->height) ? $param->height : $height_img) ; // Высота области фонирования
                       $src_width = $size_src[0];
                       $src_height= $size_src[1];
                       $isfill=true;                    // Заливать фоном
                   }

                   // Погашение диспропорции
                   if ($isfill) {

                       // Выравнивание по горизонтали
                       if (trim($param->align_img)=="left" or trim($param->align_img)==='') {
                           $left_src = 0;
                       } else if (trim($param->align_img)=="center") {
                           $left_src = $onwidth  ? 0 : floor(($width_area - $width_img) / 2);
                       } else if (trim($param->align_img)=="right") {
                           $left_src = $onwidth  ? 0 : ($width_area - $width_img);
                       }
                       // Выравнивание по вертикали
                       if (trim($param->valign_img)=="top" or trim($param->valign_img)==='') {
                           $top_src=0;
                       } else if (trim($param->valign_img)=="middle") {
                           $top_src     = !$onwidth ? 0 : floor(($height_area - $height_img) / 2);
                       } else if (trim($param->valign_img)=="bottom") {
                           $top_src     = !$onwidth ? 0 : ($height_area - $height_img) ;
                       }
                   }

                }

        }else{

                if (($param->width<>null)and($param->width<>0)){
                    $koef=$param->width/$size_src[0];

                }else if (($param->height<>null)and($param->height<>0)){
                    $koef=$param->height/$size_src[1];
                }else{
                    $koef=1;
                }

                $width_img=$size_src[0]*$koef;
                $height_img=$size_src[1]*$koef;

                // Проверяем граничные размеры
                if (($param->max_width<>null)and($param->max_width<$width_img)){                    
                    
                   $koef=$param->max_width/$size_src[0];
                   
                   $width_img=$size_src[0]*$koef;
                   $height_img=$size_src[1]*$koef;
                   
                }

                if (($param->max_height<>null)and($param->max_height<$height_img)){
                    $koef=$param->max_height/$size_src[1];

                    $width_img=$size_src[0]*$koef;
                    $height_img=$size_src[1]*$koef;
                }

                $src_width=$size_src[0];
                $src_height=$size_src[1];
                $width_area=$width_img;   // Ширина области фонирования
                $height_area=$height_img; // Высота области фонирования

        }

   	$idest = imagecreatetruecolor($width_area, $height_area);
       	imagefill($idest, 0, 0, $param->background);        
       	imagecopyresampled($idest, $isrc, $left_src, $top_src, $src_x, $src_y, $width_img, $height_img, $src_width, $src_height);
        //imagecolortransparent ($dest, $param->background);

        if ($file_rez==null){
          $file_rez=$file_name;
        }

        imagejpeg($idest, $file_rez, $param->quality);

      	imagedestroy($isrc);
      	imagedestroy($idest);

    }
    

  /**
   * Функция img_resize(): генерация thumbnails
   *  $src             - имя исходного файла
   *  $logo            - имя логотипа
   *  $dest            - имя генерируемого файла
   *  $width, $height  - ширина и высота генерируемого изображения, в пикселях
   *  Необязательные параметры:
   *  $rgb             - цвет фона, по умолчанию - белый
   *  $quality         - качество генерируемого JPEG, по умолчанию - максимальное (100)
   *  $vid             - 1 - указывает, если картинка получается меньше указанных размеров, тогда заполнить избыток фоном.
   *                     2 - налажывает на рисунок логотип
   */ 
  function img_resize($src, $logo, $dest, $width, $height,  $quality=100, $rgb=0xFFFFFF, $logo_intensite=0, $vid_scr=0, $vid_dest=0 )
  {
      if (!file_exists($src))
      {
          echo "По указаному пути: ".$src." нет файл источника </br>";
          return false;
      }
      
      $size_src = getimagesize($src);
      
      if ($size_src === false)
      {
            echo "По указаному пути: ".$src." нет файл источника </br>";
            return false;
      }
      
      $quality=(int)$quality; // приводим качество к инту, чтобы не было проблем
      $width=(int)$width;     // тоже и с размерами
      $height=(int)$height;

      // если качество меньше 1 или больше 99, тогда ставим его 100
      if($quality<1 || $quality>99)
      {
         $quality=100;
      }

      // если вдруг не пришла высота или ширина, тогда размеры будем оставлять как размеры самой картинки, без уменьшения
      if(!$width || !$height)
      {
        $width=$size_src[0];
        $height=$size_src[1];
      }

      // если реальная ширина и высота рисунка меньше, чем размеры до которых надо уменьшить,
      // тогда уменьшаемые размеры станут равны реальным размерам, чтобы не произошло увеличение
      //if($size_src[0]<$width && $size_src[1]<$height)
      //{
	  //  $width=$size_src[0];
	  //  $height=$size_src[1];
      //}

      // Определяем исходный формат по MIME-информации, предоставленной
      // функцией getimagesize, и выбираем соответствующую формату
      // imagecreatefrom-функцию.
      $format = strtolower(substr($size_src['mime'], strpos($size_src['mime'], '/')+1));
      $icfunc = "imagecreatefrom" . $format;

      if (!function_exists($icfunc))
      {
            echo "Файл источник: ".$src." не являеться графическим </br>";
            return false;
      }

      $x_ratio = $width / $size_src[0];
      $y_ratio = $height / $size_src[1];

      $isrc = $icfunc($src);

      switch ($vid_scr) {
      case 1:
        // чистое изменение размеров картинки
        $ratio       = min($x_ratio, $y_ratio);
        $use_x_ratio = ($x_ratio == $ratio);
       	$new_width_src   = $use_x_ratio  ? $width  : floor($size_src[0] * $ratio);
        $new_height_src  = !$use_x_ratio ? $height : floor($size_src[1] * $ratio);
        $new_left_src    = $use_x_ratio  ? 0 : floor(($width - $new_width_src) / 2);
        $new_top_src     = !$use_x_ratio ? 0 : floor(($height - $new_height_src) / 2);
        // чистое изменение размеров картинки
   	$new_left_src    = 0;
       	$new_top_src     = 0;
        $src_x    = 0 ;
        $src_y    = 0 ;
   	$idest = imagecreatetruecolor($new_width_src, $new_height_src);
        $src_width = $size_src[0];
        $src_height= $size_src[1];
        break;
      case 2:
        // так создается картинка узаканного размера,
        // а все где картинки нет, заполнится фоном.
        // чтобы так создавать картинку, нижнюю строку надо удалить,
        // а с этой снять комментарии
        $ratio       = min($x_ratio, $y_ratio);
        $use_x_ratio = ($x_ratio == $ratio);
       	$new_width_src   = $use_x_ratio  ? $width  : floor($size_src[0] * $ratio);
        $new_height_src  = !$use_x_ratio ? $height : floor($size_src[1] * $ratio);
        $new_left_src    = $use_x_ratio  ? 0 : floor(($width - $new_width_src) / 2);
        $new_top_src     = !$use_x_ratio ? 0 : floor(($height - $new_height_src) / 2);
        $src_x    = 0 ;
        $src_y    = 0 ;
       	$idest = imagecreatetruecolor($width, $height);
        $src_width = $size_src[0];
        $src_height= $size_src[1];
        break;
     default:
        // подрезание фотографии
        $ratio       = max($x_ratio, $y_ratio);
        $use_x_ratio = ($x_ratio == $ratio);
        // чистое изменение размеров картинки
        $new_left_src    = 0;
       	$new_top_src     = 0;
        $src_x    = $use_x_ratio  ? 0 : floor(($size_src[0]-floor($width/$ratio)) / 2);
        $src_y    = !$use_x_ratio ? 0 : floor(($size_src[1]-floor($height/$ratio)) / 2);
        $src_width = floor($width/$ratio);
        $src_height= floor($height/$ratio);
        $new_width_src=$width;
        $new_height_src=$height;
   		$idest = imagecreatetruecolor($width, $height);
        break;
     }

       	imagefill($idest, 0, 0, $rgb);
      	imagecopyresampled($idest, $isrc, $new_left_src, $new_top_src, $src_x, $src_y, $new_width_src, $new_height_src, $src_width, $src_height);

      	imagedestroy($isrc);

        // Наложение логотипа
        if ($logo<>"") {  // Проверка на существование параметра
          $size_logo = getimagesize($logo);
          $format = strtolower(substr($size_logo['mime'], strpos($size_logo['mime'], '/')+1));
          $lcfunc = "imagecreatefrom" . $format;
          if ($size_logo === false)
          {
            echo "Путь к файлу логотипа: ".$logo." указан не коректно </br>";
            return false;
          }
          if (!function_exists($lcfunc)) {
             echo "Тип файл логотипа: ".$logo." не являеться графическим </br>";
             return false;
          }
          
          if ($vid_src==0) { // В зависимости от вида подложки
              $width=$new_width_src;
              $height=$new_height_src;
          }
          
          $x_ratio = $width / $size_logo[0];
  	  $y_ratio = $height / $size_logo[1];

          $ratio       = min($x_ratio, $y_ratio);
          $use_x_ratio = ($x_ratio == $ratio);
          $new_width_logo   = $use_x_ratio  ? $width  : floor($size_logo[0] * $ratio);
          $new_height_logo  = !$use_x_ratio ? $height : floor($size_logo[1] * $ratio);
          $new_left_logo    = $use_x_ratio  ? 0 : floor(($width - $new_width_logo) / 2);
          $new_top_logo     = !$use_x_ratio ? 0 : floor(($height - $new_height_logo) / 2);

          $lsrc = $lcfunc($logo);

          if($size_logo[0]<$width && $size_logo[1]<$height) {
          // налаживаем логотип на картинку $dest
          switch ($vid_dest)
          {
             case 1: // Увелечение до размеров картинки
                  imagecopyresampled($idest, $lsrc, $new_left_logo, $new_top_logo, 0, 0, $new_width_logo, $new_height_logo, $size_logo[0], $size_logo[1]);
                  break;
             case 2: // Расположение вверху-слева top_left
                  if ($logo_intensite<>0) // Если используеться интенсивность перехода
                  {
                    $new_top_logo     = 0;
               		  $new_left_logo    = 0;
                    imagecopymerge($idest, $lsrc, $new_left_logo, $new_top_logo, 0, 0, $size_logo[0], $size_logo[1], $logo_intensite);
                  } else { // Без использования интенсивности перехода
                    $new_top_logo     = 0;
               		  $new_left_logo    = 0;
                    imagecopy($idest, $lsrc, $new_left_logo, $new_top_logo, 0, 0, $size_logo[0], $size_logo[1]);
                  }
                  break;
             case 3: // Расположение вверху-по центру top_center
                  if ($logo_intensite<>0) // Если используеться интенсивность перехода
                  {
                    $new_top_logo     = 0;
               		  $new_left_logo    = floor(($width-$size_logo[0])/2);
                    imagecopymerge($idest, $lsrc, $new_left_logo, $new_top_logo, 0, 0, $size_logo[0], $size_logo[1], $logo_intensite);
                  } else { // Без использования интенсивности перехода
                    $new_top_logo     = 0;
               		  $new_left_logo    = floor(($width-$size_logo[0])/2);
                    imagecopy($idest, $lsrc, $new_left_logo, $new_top_logo, 0, 0, $size_logo[0], $size_logo[1]);
                  }
                  break;
             case 4: // Расположение вверху-справа top-right
                  if ($logo_intensite<>0) // Если используеться интенсивность перехода
                  {
                    $new_top_logo     = 0;
               		  $new_left_logo    = $width-$size_logo[0];
                    imagecopymerge($idest, $lsrc, $new_left_logo, $new_top_logo, 0, 0, $size_logo[0], $size_logo[1], $logo_intensite);
                  } else { // Без использования интенсивности перехода
                    $new_top_logo     = 0;
               		  $new_left_logo    = $width-$size_logo[0];
                    imagecopy($idest, $lsrc, $new_left_logo, $new_top_logo, 0, 0, $size_logo[0], $size_logo[1]);
                  }
                  break;
             case 5: // Расположение по центру-слева middle-left
                  if ($logo_intensite<>0) // Если используеться интенсивность перехода
                  {
                    $new_top_logo     = floor(($height-$size_logo[1])/2);
               		  $new_left_logo    = 0;
                    imagecopymerge($idest, $lsrc, $new_left_logo, $new_top_logo, 0, 0, $size_logo[0], $size_logo[1], $logo_intensite);
                  } else { // Без использования интенсивности перехода
                    $new_top_logo     = floor(($height-$size_logo[1])/2);
               		  $new_left_logo    = 0;
                    imagecopy($idest, $lsrc, $new_left_logo, $new_top_logo, 0, 0, $size_logo[0], $size_logo[1]);
                  }
                  break;
             case 6: // Расположение по центру-по центру middle-center
                  if ($logo_intensite<>0) // Если используеться интенсивность перехода
                  {
                    $new_top_logo     = floor(($height-$size_logo[1])/2);
               		  $new_left_logo    = floor(($width-$size_logo[0])/2);
                    imagecopymerge($idest, $lsrc, $new_left_logo, $new_top_logo, 0, 0, $size_logo[0], $size_logo[1], $logo_intensite);
                  } else { // Без использования интенсивности перехода
                    $new_top_logo     = floor(($height-$size_logo[1])/2);
               		  $new_left_logo    = floor(($width-$size_logo[0])/2);
                    imagecopy($idest, $lsrc, $new_left_logo, $new_top_logo, 0, 0, $size_logo[0], $size_logo[1]);
                  }
                  break;
             case 7: // Расположение по центру-справа middle-right
                  if ($logo_intensite<>0) // Если используеться интенсивность перехода
                  {
                    $new_top_logo     = floor(($height-$size_logo[1])/2);
               		  $new_left_logo    = $width-$size_logo[0];
                    imagecopymerge($idest, $lsrc, $new_left_logo, $new_top_logo, 0, 0, $size_logo[0], $size_logo[1], $logo_intensite);
                  } else { // Без использования интенсивности перехода
                    $new_top_logo     = floor(($height-$size_logo[1])/2);
               		  $new_left_logo    = $width-$size_logo[0];
                    imagecopy($idest, $lsrc, $new_left_logo, $new_top_logo, 0, 0, $size_logo[0], $size_logo[1]);
                  }
                  break;
             case 8: // Расположение c низу-слева bottom-left
                  if ($logo_intensite<>0) // Если используеться интенсивность перехода
                  {
                    $new_top_logo     = $height-$size_logo[1];
               		  $new_left_logo    = 0;
                    imagecopymerge($idest, $lsrc, $new_left_logo, $new_top_logo, 0, 0, $size_logo[0], $size_logo[1], $logo_intensite);
                  } else { // Без использования интенсивности перехода
                    $new_top_logo     = $height-$size_logo[1];
               		  $new_left_logo    = 0;
                    imagecopy($idest, $lsrc, $new_left_logo, $new_top_logo, 0, 0, $size_logo[0], $size_logo[1]);
                  }
                  break;
             case 9: // Расположение c низу-по центру bottom-center
                  if ($logo_intensite<>0) // Если используеться интенсивность перехода
                  {
                    $new_top_logo     = $height-$size_logo[1];
               		  $new_left_logo    = floor(($width-$size_logo[0])/2);
                    imagecopymerge($idest, $lsrc, $new_left_logo, $new_top_logo, 0, 0, $size_logo[0], $size_logo[1], $logo_intensite);
                  } else { // Без использования интенсивности перехода
                    $new_top_logo     = $height-$size_logo[1];
               		  $new_left_logo    = floor(($width-$size_logo[0])/2);
                    imagecopy($idest, $lsrc, $new_left_logo, $new_top_logo, 0, 0, $size_logo[0], $size_logo[1]);
                  }
                  break;
             case 10: // Расположение c низу-справа bottom-right
                  if ($logo_intensite<>0) // Если используеться интенсивность перехода
                  {
                    $new_top_logo     = $height-$size_logo[1];
               		  $new_left_logo    = $width-$size_logo[0];
                    imagecopymerge($idest, $lsrc, $new_left_logo, $new_top_logo, 0, 0, $size_logo[0], $size_logo[1], $logo_intensite);
                  } else { // Без использования интенсивности перехода
                    $new_top_logo     = $height-$size_logo[1];
               		  $new_left_logo    = $width-$size_logo[0];
                    imagecopy($idest, $lsrc, $new_left_logo, $new_top_logo, 0, 0, $size_logo[0], $size_logo[1]);
                  }
                  break;
             case 11: // Размножить
                  $cnt_col=ceil($width/$size_logo[0]);
                  $cnt_row=ceil($height/$size_logo[1]);
                  $width_best=$cnt_col*$size_logo[0];
                  $height_best=$cnt_row*$size_logo[1];
             		  $ibest = imagecreate($width_best,$height_best);
                  $new_top_logo=0;
                  $new_left_logo=0;
                  for ($i=0;$i<$cnt_row;$i++) {
                   for ($j=0;$j<$cnt_col;$j++) {
                    if ($logo_intensite<>0) // Если используеться интенсивность перехода
                    {
                      $new_top_logo     = $i*$size_logo[1];
                 		  $new_left_logo    = $j*$size_logo[0];
                      imagecopymerge($ibest, $lsrc, $new_left_logo, $new_top_logo, 0, 0, $size_logo[0], $size_logo[1], $logo_intensite);
                    } else { // Без использования интенсивности перехода
                      $new_top_logo     = $i*$size_logo[1];
                 		  $new_left_logo    = $j*$size_logo[0];
                      imagecopy($ibest, $lsrc, $new_left_logo, $new_top_logo, 0, 0, $size_logo[0], $size_logo[1]);
                    }
                   }
                  }
                  $new_left_logo=0;
                  $new_top_logo=0;
                  $left_best     = floor(($width_best-$width)/2);
             		  $top_best    = floor(($height_best-$height)/2);
                  imagecopy($idest, $ibest, $new_left_logo, $new_top_logo, $left_best, $top_best, $width, $height);
                  break;
             default:
                  if ($logo_intensite<>0) // Если используеться интенсивность перехода
                  {
                    $new_top_logo     = floor(($height-$size_logo[1])/2);
               		  $new_left_logo    = floor(($width-$size_logo[0])/2);
                    imagecopymerge($idest, $lsrc, $new_left_logo, $new_top_logo, 0, 0, $size_logo[0], $size_logo[1], $logo_intensite);
                  } else { // Без использования интенсивности перехода
                    $new_top_logo     = floor(($height-$size_logo[1])/2);
               		  $new_left_logo    = floor(($width-$size_logo[0])/2);
                    imagecopy($idest, $lsrc, $new_left_logo, $new_top_logo, 0, 0, $size_logo[0], $size_logo[1]);
                  }
                  break;
                }
          } else { // уменьшение логотипа до размеров картинки
                 $new_top_logo     = $height-$new_height_logo;
            		 $new_left_logo    = $width-$new_width_logo;
                 /*$str_width_logo=$new_width_logo;
                 $str_height_logo=$new_height_logo;
                 $new_width_logo=floor($new_width_logo*0.80);
                 $new_height_logo=floor($new_height_logo*0.80);
                 $new_left_logo=$new_left_logo+floor(($str_width_logo-$new_width_logo)/2);
                 $new_top_logo=$new_top_logo+floor(($str_height_logo-$new_height_logo)/2);*/
                 imagecopyresampled($idest, $lsrc, $new_left_logo, $new_top_logo, 0, 0, $new_width_logo, $new_height_logo, $size_logo[0], $size_logo[1]);
          }
          }

     	imagejpeg($idest, $dest, $quality);
        imagedestroy($lsrc);
    	imagedestroy($idest);
	return true;
    }

}

// Класс управления файлами
class RiFile 
{

   	public $fsecs=array("index.php","index.html"); // Список файлов защиты

   	/** Массив типов файлов
   	 * 
   	 */ 
   	public $aext=array("image"=>array("jpg","gif","png"), // Картинки
                           "video"=>array("flv"),             // Видео
                           "music"=>array("mp3"),             // Музыка
                           "files"=>array(""));               // Все остальные типы файлов

   	
   	/** Проверка на существоание директории с поледующим ее соданием
     * 
   	 * @param $dir 			- Полное название директории с абсолютным путем
   	 * @param $prav 		- Права
   	 * @param $create_index - автоматическое создание индексного файла-заглушки
   	 */
   	function is_dir($dir,$prav=0750,$create_index=false)
   	{
   	//  echo 'dir='.$dir.'<br>';

       if (!is_dir($dir)) { //Проверка на существоание каталога
            mkdir($dir,$prav); //Создание каталога

            if ($create_index==true){
                $this->save_fsec($dir."/index.html");
            }
             return false;
        }
        return true;
    }

    
   	/** Запись файла защиты
   	 *
   	 * @param $fname - полное имя файла
   	 * @param $instr - режим открытия файла
   	 * @param $cont  - текст
   	 */
   	function save_fsec( $filename )
   	{
        $file = fopen( $filename, "w+" );
        fwrite( $file, "" );
        fclose( $file ); // Закрываем дескриптор файла
   	}

   	
   	/** Запись текста в файл
   	 * 
   	 * @param	$fname - полное имя файла
   	 * @param 	$instr - режим открытия файла
   	 * @param	$cont  - текст 
   	 */
   	function save_text($filename,/*$instr="r",*/$text)
   	{
   		// Убеждаемся что файл доступен и существует для записи.	
       if ( is_writable( $filename) ) 
       { 
           $savesize=file_put_contents( $filename, $text );
       }
       else 
       {
           echo "<b>Файл $filename недоступен для записи</b>";
       }
   	}
   
   	
	/** Рекурсивное создание папок (при необходимости)
	 * 
	 * @param $path_inp - полный путь к папке
	 * @param $prav_inp - право доступа на папку
	 */
	function create_dir( $path_inp, $prav_inp, $create_index=false )
	{
	    $poz=strlen( $_SERVER["DOCUMENT_ROOT"] );
	    while ( $num = strpos( $path_inp,"/", $poz ) )
	    {
	        $poz  	= $num+1;
	        $fpath	= substr( $path_inp, 0, $num );
	        //echo '<pre>'.$fpath.'</pre>';
	
	        $this->is_dir( $fpath, $prav_inp, $create_index );
	    }
	 }
	
	
	/** Удаление каталогов как пустых так и с файлами
	 * 
	 * ПРИМЕЧАНИЕ: ПОИСКАТЬ ПОДОБНУЮ КОМАНДУ В PHP 
	 */
	function full_del_dir ($directory)
	{
	   $dir = opendir($directory);
	   while( ( $file = readdir($dir) ) )
	   {
	      if ( is_file( $directory."/".$file ) )
	      {
	         unlink ( $directory."/".$file );
	      }
	      else if ( is_dir( $directory."/".$file ) &&
	              ( $file != "." ) && ( $file != ".." ) )
	      {
	         full_del_dir ($directory."/".$file);
	      }
	    }
	
	    closedir ($dir);
	    rmdir ($directory);
	
	}
	
	
	/** Возвращает расширение файла
	 * 
	 * @param $filename
	 */
	function ext( $filename ) 
	{
	    $path_info = pathinfo( $filename );
	    return $path_info['extension'];
	}
	
	/** Возвращает название файла
	 * 
	 */
	function filename( $filename ) 
	{
	    $path_info = pathinfo( $filename );
	
	    $rez	   = $path_info['filename'];
	
	    if ( trim( $path_info['extension'] )<>'' )
	    {
	        $rez.='.'.$path_info['extension'];
	    }
	    
	    return $rez;
	}
	
	
	/** Возвращает название первой части файла (без расширения)
	 * 
	 * @param $filename
	 */
	function base_filename($filename) 
	{
	      $path_info = pathinfo($filename);
	      $rez=$path_info['filename'];
	      
	      return $rez;
	}
	
	  
	/** Возращает по расширению файла - тип файла согласно зарегистрированных типов
	 *  файлов
	 *  
	 * @param $filename - название файла
	 */
	function type_file( $filename ) 
	{
	    $ext=$this->ext( $filename );
	     
	    foreach( $this->aext as $key=>$val ) 
	    {
	       if ( in_array($ext,$val) ) 
	       {
	           return $key;
	       }
	    }
	    
	}
	
	  
	/** Сохраняет файл по указанному пути
	 * 
	 * @param $filename
	 * @param $new_filename
	 */
	function save( $filename, $new_filename )
	{
	    $rez=$new_filename;
	    if (!rename( $filename, $new_filename ) )
	    {
	       $this->cxi->d('Файл '.$filename.' не возможно переместить.<br>','echo');
               return false;
	    }
	    return $rez;
    }

}

class Onpay { //onpay functions
	
	/*= Необходимо прописать свои параметры ==
	 */
	function get_constant($name) 
	{
		$arr = array(
		       // логин в системе onpay
			     'onpay_login' => 'setrais', 
			     // секретный код вашего интернет ресурса. Этот код указывается в вашем кабинете в настройках
			     'private_code' => 'nZwMTV1mzUv', 
			     // URL куда следует вернуться после выполнения первого шага оплаты
			     'url_success' => 'http://skidofon.rtvs.net/index.php/main/buying/4/',
			     // флаг - использовать таблицу балансов пользователей, если установлен false, то метод 
			     // data_update_user_balance переопределять не надо, он не будет вызываться
			     'use_balance_table' => true,
			     // статус для неоплаченной операции в таблице operations
			     'new_operation_status' => 0
			    );
		return $arr[$name];
	}
	
	// Для работы системы необходимо сохранение заявок от пользователей на первом шаге и обработка
	// при уведомлении системой onpay
	
	// функция определения параметров платежной формы
	// к примеру, если необходимо добавить e-mail пользователя, который совершает платеж, то
	// добавляется строка к результату '&user_email=vasia@mail.ru'
	function get_iframe_url_params($operation_id, $sum, $md5check) {
		return "f=1&pay_mode=fix&pay_for=$operation_id&price=$sum&currency=RUR&convert=yes&md5=$md5check&url_success=".$this->get_constant('url_success');
	}
	
	// функция создания операции. Для дальнейшей обработки платежа используется ID созданной операции
	function data_create_operation($sum) 
	{
		
	  if ( isset($_REQUEST["user_id"]) ) {	
	  	  $userid 			= $_REQUEST["user_id"];  		  //Определяем ID пользователя, осуществляющего пополнение 
	  	  $type 			= "Внешняя"; 				  	  //определяем тип операции 
	  	  $comment 			= "Пополнение счета"; 			  //вводим комментарий операции 
	  	  $description 		= "через систему Onpay"; 		  //дополнительный комментарий 
	  
	
	  	  //создаем строку для вставки в базу данных 
	  	  $query = "INSERT INTO `operations` (`sum`,`user_id`, `status`, `type`, `comment`, `description`, `date`) 
							VALUES('$sum', '$userid', ".$this->get_constant('new_operation_status').", '$type', '$comment', '$description', NOW());";
	   
	  	  return mysql_query($query); //сохраняем данные в базу
	  } else {
	  	  return false;
	  } 
	  
	}
	
	// функция выборки неоплаченной операции по ID
	function data_get_created_operation($id) 
	{
		$query = "SELECT * FROM operations WHERE `id`='$id' and `status`=".$this->get_constant('new_operation_status');
	  return mysql_query($query); 
	}
	
	// функция обновления статуса операции на оплаченную
	function data_set_operation_processed($id) 
	{
		$query = "UPDATE operations SET status=1 WHERE id='$id'";
		return mysql_query($query); 
	}
	
	// обновление баланса пользователя
	// если параметр use_balance_table установлен в false, то этот метод не вызывается
	// $operation_id - ID в таблице operations, по нему можно получить ID пользователя
	function data_update_user_balance($operation_id, $sum) {
		
		//Определяем ID пользователя, осуществляющего пополнение 
		$operation = $this->data_get_created_operation($operation_id);
		if (mysql_num_rows($operation) == 1) {
			$operation_row = mysql_fetch_assoc($operation);
			$userid = $operation_row["user_id"];
			
			//Обновляем данные по счету пользователя 
			$query = "UPDATE balances SET sum=sum+$sum, date=NOW() WHERE id='$userid'";
			return mysql_query($query);
		} else {
			return false;
		}
	}
	
	/*================ Конец ===========================*/
	
	//функция проебразует число в число с плавающей точкой 
	function to_float($sum) { 
	  if (strpos($sum, ".")) {
			$sum = round($sum, 2);
		} else {
			$sum = $sum.".0";
		} 
	  return $sum; 
	}
	
	//функция выдает ответ для сервиса onpay в формате XML на чек запрос 
	function answer($type, $code, $pay_for, $order_amount, $order_currency, $text) { 
	  $md5 = strtoupper(md5("$type;$pay_for;$order_amount;$order_currency;$code;".$this->get_constant('private_code'))); 
	  return "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<result>\n<code>$code</code>\n<pay_for>$pay_for</pay_for>\n<comment>$text</comment>\n<md5>$md5</md5>\n</result>";
	} 
	
	//функция выдает ответ для сервиса onpay в формате XML на pay запрос 
	function answerpay($type, $code, $pay_for, $order_amount, $order_currency, $text, $onpay_id) { 
	  $md5 = strtoupper(md5("$type;$pay_for;$onpay_id;$pay_for;$order_amount;$order_currency;$code;".$this->get_constant('private_code'))); 
	  return "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<result>\n<code>$code</code>\n<comment>$text</comment>\n<onpay_id>$onpay_id</onpay_id>\n<pay_for>$pay_for</pay_for>\n<order_id>$pay_for</order_id>\n<md5>$md5</md5>\n</result>"; 
	}
	
	function process_first_step() {
		
		$sum = $_REQUEST['sum'];
		$output = '';
		$err = '';
		
		if (is_numeric($sum)) { //проверяем являются ли введенные данные числом 
			$result = $this->data_create_operation($sum);
		} else {
	    	$err = 'В поле сумма не числовое значение';
		}
		
		//если данные в базу поместились, идем дальше. 
		if ($result) { 
		    $number = mysql_insert_id(); //определяем id записи в бд 
		    $sumformd5 = $this->to_float($sum); //преобразуем число к числу с плавающей точкой 
				//создаем хеш данных для проверки безопасности
		    $md5check = md5("fix;$sumformd5;RUR;$number;yes;".$this->get_constant('private_code')); 
				//создаем строчку для запроса
		    $url = "http://secure.onpay.ru/pay/".$this->get_constant('onpay_login')."?".$this->get_iframe_url_params($number, $sum, $md5check);
				//вывод формы onpay с заданными параметрами
			$output = '<iframe src="'.$url.'" width="900" height="900" frameborder=no scrolling=no></iframe>';
			
		} else {
		  	$err = empty($err) ? mysql_error() : $err;
			$output = "onpay script: Ошибка сохранения данных. (" . $err . ")";
		}
		//return $output;
		
	}
	
	function process_api_request() {
		
		$rezult = ''; 
		$error = ''; 
		//проверяем чек запрос 
		if ($_REQUEST['type'] == 'check') { 
		    //получаем данные, что нам прислал чек запрос 
		    $order_amount 	= $_REQUEST['order_amount']; 
		    $order_currency = $_REQUEST['order_currency']; 
		    $pay_for 		= $_REQUEST['pay_for']; 
		    $md5 			= $_REQUEST['md5']; 
		    //выдаем ответ OK на чек запрос 
		    $rezult = $this->answer($_REQUEST['type'],0, $pay_for, $order_amount, $order_currency, 'OK'); 
		} 
	
		//проверяем запрос на пополнение 
		if ($_REQUEST['type'] == 'pay') { 
		    $onpay_id 			= $_REQUEST['onpay_id']; 
		    $pay_for 			= $_REQUEST['pay_for']; 
		    $order_amount 		= $_REQUEST['order_amount']; 
		    $order_currency		= $_REQUEST['order_currency']; 
		    $balance_amount 	= $_REQUEST['balance_amount']; 
		    $balance_currency 	= $_REQUEST['balance_currency']; 
		    $exchange_rate 		= $_REQUEST['exchange_rate']; 
		    $paymentDateTime 	= $_REQUEST['paymentDateTime']; 
		    $md5 				= $_REQUEST['md5']; 
		
		    //производим проверки входных данных 
		    if (empty($onpay_id)) {$error .="Не указан id<br>";} 
		    else {if (!is_numeric(intval($onpay_id))) {$error .="Параметр не является числом<br>";}} 
		    if (empty($order_amount)) {$error .="Не указана сумма<br>";} 
		    else {if (!is_numeric($order_amount)) {$error .="Параметр не является числом<br>";}} 
		    if (empty($balance_amount)) {$error .="Не указана сумма<br>";} 
		    else {if (!is_numeric(intval($balance_amount))) {$error .="Параметр не является числом<br>";}} 
		    if (empty($balance_currency)) {$error .="Не указана валюта<br>";} 
		    else {if (strlen($balance_currency)>4) {$error .="Параметр слишком длинный<br>";}} 
		    if (empty($order_currency)) {$error .="Не указана валюта<br>";} 
		    else {if (strlen($order_currency)>4) {$error .="Параметр слишком длинный<br>";}} 
		    if (empty($exchange_rate)) {$error .="Не указана сумма<br>";} 
		    else {if (!is_numeric($exchange_rate)) {$error .="Параметр не является числом<br>";}} 
		
		    //если нет ошибок 
				if (!$error) { 
					if (is_numeric($pay_for)) {
						//Если pay_for - число 
						$sum = floatval($order_amount); 
						$rezult = $this->data_get_created_operation($pay_for);
						if (mysql_num_rows($rezult) == 1) { 
							//создаем строку хэша с присланных данных 
							$md5fb = strtoupper(md5($_REQUEST['type'].";".$pay_for.";".$onpay_id.";".$order_amount.";".$order_currency.";".$this->get_constant('private_code'))); 
							//сверяем строчки хеша (присланную и созданную нами) 
							if ($md5fb != $md5) {
								$rezult = $this->answerpay($_REQUEST['type'], 8, $pay_for, $order_amount, $order_currency, 'Md5 signature is wrong. Expected '.$md5fb, $onpay_id);
							} else { 
								$time = time(); 
								$rezult_balance = $this->get_constant('use_balance_table') ? $this->data_update_user_balance($pay_for, $sum) : true;
								$rezult_operation = $this->data_set_operation_processed($pay_for);
								//если оба запроса прошли успешно выдаем ответ об удаче, если нет, то о том что операция не произошла 
								if ($rezult_operation && $rezult_balance) {
									$rezult = $this->answerpay($_REQUEST['type'], 0, $pay_for, $order_amount, $order_currency, 'OK', $onpay_id);
								} else {
									$rezult = $this->answerpay($_REQUEST['type'], 9, $pay_for, $order_amount, $order_currency, 'Error in mechant database queries: operation or balance tables error', $onpay_id);
								} 
							}
						} else {
							$rezult = $this->answerpay($_REQUEST['type'], 10, $pay_for, $order_amount, $order_currency, 'Cannot find any pay rows acording to this parameters: wrong payment', $onpay_id);
						} 
					} else {
						//Если pay_for - не правильный формат 
						$rezult = $this->answerpay($_REQUEST['type'], 11, $pay_for, $order_amount, $order_currency, 'Error in parameters data', $onpay_id); 
					} 
				} else {
					//Если есть ошибки 
					$rezult = $this->answerpay($_REQUEST['type'], 12, $pay_for, $order_amount, $order_currency, 'Error in parameters data: '.$error, $onpay_id); 
				} 
		} 
		return $rezult;
	}
}

class Site {
	
    public $title;       			  // Класс заголовоков окна (строка)
    public $body;        			  // Класс тела сайта (строка)
    public $h1;          			  // Класс контента
    public $currency;    			  // Валюта сайта по умолчанию
    public $end;         			  // Класс интернет-страницы
    public $keywords;    			  // Класс Ключевые слова
    public $description; 			  // Класс описание страницы
    public $pathway;     			  // Класс цепочка навигаци
    public $pages='';    			  // Прокрутка страниц
    public $sectname;   			  // Название сайта для "хлебной крошки"
    public $charset='windows-1251';   // Текущая кодировка (от current char set)
    public $langs;                    // Объект языков сайта
    public $site_name;                // Название сайта
    public $site_url;                 // URL сайта
    public $script='';                // Скрипт сайта
    public $debug=0;                  // Отладка
        
}

class Collect  {
 	
    public $arr;        // Массив элементов коллекции
    public $arr_onkeys; // Именнованный массив элементов коллекции
     
    
  	function __construct()
   	{
          parent::__construct($this->owner);
    	    $this->clear();
   	}

   	
    /** Добавляет новые позиции в массив, перед этим проверяя, есть ли такой элемент
     * 
     * @param $valueinp - значение
     * @param $keyinp   - ключ
     */
    function add($valueinp, $keyinp='')
    {
       //echo $valueinp;
       // Без ключа
       if (trim($keyinp)==='') {
           if ((trim($valueinp)<>'') and (!in_array(trim($valueinp), $this->arr))){
             	array_push($this->arr, $valueinp);
             	// echo 'adding<br>';
           }

       } else {
             $this->arr_onkeys[$keyinp]=$valueinp;
             //  echo 'adding<br>';
       }
     }

     
    /** Добавляет новые позиции в массив, перед этим проверяя, есть ли такой элемент
     * 
     * @param $keyinp   - ключ
	 * @param $valueinp - значение.
	 */
    function add_onkeys($keyinp, $valueinp='')
    {
       $this->add($valueinp, $keyinp);
    }

    
    /** Возвращает список всех элементов коллекции, разделенный заданным символом
     * 
     * @param $razdel
     * @param $onkey
     */
    function get_elems_chr($razdel=', ', $onkey=false)
    {
      	if ( !$onkey ) 
      	{
          	return implode($razdel, $this->arr);
      	} 
      	else 
      	{
        	foreach ($this->arr as $key=>$val) 
        	{
            	return implode($razdel, $val);
         	}
      	}
    }

    
    /** Возвращает список всех элементов коллекции. Каждый элемент, с новой строки
     * 
     */
    function get_elems()
    {
       return $this->get_elems_chr(chr(13));
       //implode(chr(13),$this->arr);
    }

    
    /** Получение списка элементов, разделенных знаком, 
     *  если элементы массива в коллекции - массив
     * 
     * @param $razdel
     * @param $n_elem
     */
    function get_elems_chr_arr( $razdel=', ', $n_elem=0 )
    {
       $rez='';
       for ($i=0; $i<=(count($this->arr)-1); $i++)  
       {
       		if ($rez<>'')
       		{
           		$rez.=$razdel;
	        }

         	$rez.=$this->arr[$i][$n_elem];
       }

       return $rez;
    }

    
    /** Возвращает количество элементов в массиве
     * 
     */
    function count()
    {
    	return count($this->arr);
    }

    
    /**
     * 
     */
    function clear()
    {
    	$this->arr=array();
    }

    
    /** Возвращает элемент с индексом $i
     * 
     * @param $i
     */
    function get_el($i)
    {
    	return $this->arr[$i];
    }
    

    /** Функция очищает все элементы массива и устанавливает 1 текстовый блок
     * 
     * @param unknown_type $new_text
     */
    function set_text($new_text)
    {
       $this->clear();
       $this->add($new_text);
    }

    /** Функция возвращающая индекс елемента по названию и алису
     * 
	 * @param $name_inp - название елемента
     * @param $alias_inp  - alias елемента
     *  в случае удачного поиска результат индекс елемента,
     *  случае неудачного false
     */
    function get_key_el($name_inp,$alias_inp='') 
    {
       $key='';
       for ( $i=0; $i<=(count($this->arr)-1); $i++ )  
       {
       		// Если указано название и алис елемента
         	if ( $name_inp<>'' and $alias_inp<>'' )
         	{
          		 if ( ( strtoupper( $this->arr[$i][1] ) === strtoupper( $name_inp ) )
                		and strtoupper( $this->arr[$i][3] ) === strtoupper( $alias_inp ) )
           		 {
             		return $key=$i;
           		 }
           
		         // Если алиас елемента не указан
        	} 
        	else 
        	{
           		if ( strtoupper( $this->arr[$i][1]) === strtoupper($name_inp) )
           		{
             		return $key=$i;
           		}
         	}
       }
       return false;
    }

    
    /** Функция возвращающая значение елемента по названию и алису
     * @param $name_inp - название елемента
     * @param $alias_inp  - alias елемента
     * в случае удачного поиска результат свойство или массив свойств елемента
     * в случае неудачного false
     */
    function get_values_el( $name_inp, $alias_inp='' ) 
    {
       $values='';
       
       for ($i=0; $i<=( count($this->arr)-1 ); $i++)  
       {
         // Если указано название и алис елемента
         if ($name_inp<>'' and $alias_inp<>'')
         {
             if ( ( strtoupper( $this->arr[$i][1] ) === strtoupper( $name_inp ) )
                and strtoupper( $this->arr[$i][3] ) === strtoupper( $alias_inp ) )
             {
             	return $values=$this->arr($i);
           	 }
         // Если алиас елемента не указан
         } 
         else 
         {
         	if ( strtoupper( $this->arr[$i][1] ) === strtoupper( $name_inp ) )
           	{
            	 return $values=$this->arr($i);
            }
         }
       }
       return false;
    }

    
}

/** Класс параметры социальных сетей
 * 
 * @author setrais@gmail.com
 * @property url					- УРЛ социальной сети
 * @property script					- Скрипт социальной сети 
 * @property api					- АРI социальной сети
 */
class Params_Social extends Collect 
{
	public $url; 			// Url социальной сети
	public $script;			// Script для социальной сети
	public $is;				// Существование
}

// Класс социальных сетей
class Social extends Obj {
	
	public $vkontakte;
        public $mailru;
        public $facebook;
	public $odnoklassniki;
	public $twitter;
	public $livejournal;
	public $google;
	
	
	/** Конструктор класса социальных сетей
	 * 
	 */
	function __construct() 
	{
	   	$this->vkontakte 		= new Params_Social();   	
	   	$this->mailru			= new Params_Social();
	   	$this->facebook			= new Params_Social();
	   	$this->odnoklassniki	= new Params_Social();
	   	$this->twitter			= new Params_Social();
	   	$this->livejournal 		= new Params_Social();
	   	$this->google			= new Params_Social();  
	}

	function get_social() {
	}
	  
	
	/** Назначение скирта обьекту  
	 * @param string	$name_socs	- наименование социальной сети
	 * @param string	$script		- скрипт социальной сети 
	 */
	function set_script( $name_socs, $script="" ) {
		
		//
		if ( is_string( $name_socs ) && trim( $name_socs )<>'' && is_var_class ( $name_socs, $this ) ) 
		{
			eval("\$this->".$name_socs."->script=".$script.";");
		}
		
	}

	
	/** Назначение скирпа социальной сети "В контакте"
	 * 
	 */
	function set_script_vkontakte() {
		$login 	  = 'setraiser@skidofon';
		$password = '';
		$script ='';
	   	$this->set_script('vkontakte',$script);
	}

	
	/** Формирование скрипта социальной сети
	 * 
	 * @param string	$name_socs	- наименование социальной сети 
	 */
	function get_script( $name_socs ) 
	{
		eval("\$soc = \$this->".$name_socs."->script ;");
		
		return $soc;
	}

	/** Вывод скрипта социальной сети
	 * 
	 * @param string	$name_socs	- наименование социальной сети 
	 */
	function show_script( $name_socs ) 
	{
		echo "<script>".chr(13);
		echo "		".$this->get_script( $name_socs).chr(13);
		echo "</script>".chr(13);
	}
	
	
	/** Назначение скирпа социальной сети "mail.ru"
	 * 
	 */
	function set_script_mailru() {
		$script ='';
	   	$this->set_script('mailru',$script);
	}
	
	
	/** Назначение скирпа социальной сети "Facebook"
	 * 
	 */
	function set_script_facebook() {
		$script ='';
	   	$this->set_script('facebook',$script);
	}
	
	
	/** Назначение скирпа социальной сети "Odnoklassniki"
	 * 
	 */
	function set_script_odnoklassniki() {
		$script ='';
	   	$this->set_script('odnoklassniki',$script);
	}
	
	
	/** Назначение скирпа социальной сети "Twitter"
	 * 
	 */
	function set_script_twitter() {
		$script ='';
	   	$this->set_script('twitter',$script);
	}
	 
	
	/** Назначение скирпа социальной сети "Livejournal"
	 * 
	 */
	function set_script_livejournal() {
		$script ='';
	   	$this->set_script('livejournal',$script);
	}
	
	
	/** Назначение скирпа социальной сети "Google"
	 * 
	 */
	function set_script_google() {
		$script ='';
	   	$this->set_script('google',$script);
	}
	
}

/**
 * 
 * @author Администратор
 *
 */
class Obj 
{
	/** Фукнция проверяет существование свойства в классе
	 * 
	 * @param $name_var
	 * @param $class
	 */
	function is_var_class( $name_var, $class = null ) 
	{
		if ( is_string( $name_var ) && trim( $name_var )<>'' )
		{
		
			if ( $class !== null )
			{
				$vars = get_class_vars( get_class( $class ) );
			}
			else 
			{
				$vars = get_class_vars( get_class( $this ) );
			}
			
			return in_array( $name_var, $vars );
		}
	}
}
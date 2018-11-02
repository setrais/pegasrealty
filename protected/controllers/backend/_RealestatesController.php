<?php

class RealestatesController extends BackendController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		/*return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','autocompleteaddress',
                                                 'autocompletetitle','autocompletemetro',
                                                 'ajaxshowcurrenty','getcoord' ),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);*/
                return array(
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','view','autocompleteaddress',
                                                 'autocompletetitle','autocompletemetro',
                                                 'ajaxshowcurrenty','getcoord','create'),
				'users'=>array('@'),
			),
                    	array('allow', // allow member user to perform 'create' actions
				'actions'=>array('create'),
				'users'=>array('member'),
			),                    
			array('allow', // allow manager and admin and superadmin user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('manager','admin','superadmin'),
			),                    
			array('allow', // allow admin and superadmin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin','superadmin','manager'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);            
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Realestates;
                // Генерация ID                        
                $model = $this->genIds($model);
                
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Realestates']))
		{                        
			$model->attributes=$_POST['Realestates']; 
                        // Генерация ID
                        $model = $this->genIds($model);
                        $model->date_rang = date('Y-m-d',strtotime($model->date_rang));
                        $model->date_release = date('Y-m-d',strtotime($model->date_release));
                        
			if($model->save()) {
                            
                            // Запись свойств недвижемести
                            $this->SavePropsRealestates($model);
                            
                            $this->redirect(array('view','id'=>$model->id));
                        }
		}
                
                /* Create map */
                $map = $this->_show_map($model);
                
                // Инициализация валюты                
                $model->valute_id=2; // Default 2
                $this->SetCurrency($model->valute_id); 
                
		$this->render('create',array(
			'model'=>$model,
                        'map'=>$map
		));
	}

        protected function genIds($model) 
        {
            $Ri = new Ri;
            if (trim($model->uid)=='') $model->uid = $Ri->genid();                         
            if (trim($model->sid)=='' && trim($model->title)<>'') $model->sid = HRu::translit($model->title);
            //if (trim($model->nid)=='') $model->nid = strtoupper(HCommon::genRandomString());
            if (trim($model->nid)=='') $model->nid = rand(1,99999).strtoupper(HCommon::genRandomString(2,'',array('num'=>false)));
                
            return $model;
        } 
        
        protected function _show_map_poligon($model) {
                                               
            Yii::import('ext.EGMap.*');
            
            Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/polygon/polygon.core.js');            
            
            $gMap = new EGMap();
            $gMap->setWidth(862);
            $gMap->setHeight(420);            
            /*$gMap->setAPIKey('http://pp.rtvs.net', 'ABQIAAAAuKTQCaAmRIZm8fpzMcomXRSjgd74L9WyZO8Sjj0ClzXDGx3dYxQN2iImmF-UZzmvUG1oogyiwpW3eQ');*/
            $gMap->setAPIKey('pegasrealty.ru', 'AIzaSyDu-9PAa4Wjo64NrGGwjuxdIQhxGV1XTw8'); 
            $gMap->zoom = 14;
            $gMap->mapTypeId = EGMap::TYPE_ROADMAP;
            $gMap->mapTypeControlOptions = array(
                    'position'=> EGMapControlPosition::RIGHT_TOP,
                    'style'=>EGMap::MAPTYPECONTROL_STYLE_DROPDOWN_MENU
            );
            
            $dragevent = new EGMapEvent('dragend', "function (event) {}", false, EGMapEvent::TYPE_EVENT_DEFAULT);
            
            $gMap->setCenter(55.74779594179455,37.626800537109375);
      
            $gMap->addEvent(new EGMapEvent('click',
                             'function (event) {
                                var title ="'.Yii::t("map","Выделенная Вами область").'";
                                var des ="'.Yii::t("map","Кординаты выбранной области записаны</br>Для изменения области выберите отмену.").'";        
                                var nbut ="'.Yii::t('map','Отмена').'";     
                                var creator = new PolygonCreator("polygon",'.$gMap->getJsName().',title,nbut,des);
                                    
                              } 
                            ', false, EGMapEvent::TYPE_EVENT_DEFAULT_ONCE));             

            /*$gMap->addEvent(new EGMapEvent('rightclick',
                             'function (event) {
                                creator.destroy();
                              } 
                            ', false, EGMapEvent::TYPE_EVENT_DEFAULT_ONCE));*/
                        
            // Preparing InfoWindow with information about our marker.
            //$info_window = new EGMapInfoWindow("<div class='gmaps-label' style='color: #000;'>Это твоя область поиска<br/>недвижемости!</div>");

            /*$coords   = array();            
            $coords[] = new EGMapCoord(55.79958279167743, 37.530670166015625);
            $coords[] = new EGMapCoord(55.80267031855561, 37.728424072265625);
            $coords[] = new EGMapCoord(55.70065260176176, 37.711944580078125);
            $coords[] = new EGMapCoord(55.69600909191166, 37.525177001953125);
            $coords[] = new EGMapCoord(55.79958279167743, 37.530670166015625);            
                        
            $polygon = new EGMapPolygon($coords, 
                                        array('title' => Yii::t('realestates', $model->title), 'draggable'=>true),
                                        'polygon', array('dragevent'=>$dragevent));
            
            $polygon->addHtmlInfoWindow($info_window);  
            $gMap->addPolygon($polygon);  */                    
            $gMap->zoom = 9;            
            //$gMap->centerOnPolygons();
            //$gMap->zoomOnPolygons(0.1); 
            $gMap->enableLatLonControl();
            
            // Saving coordinates after polygons.
            $gMap->appendMapTo('#mapsearch');                          
            
            return $gMap;

        }
        
        protected function _show_map($model) {
                Yii::import('ext.EGMap.*');
                
                $gMap = new EGMap();                
                $gMap->setWidth(704);
                $gMap->setHeight(420);
                /*$gMap->setAPIKey('http://pp.rtvs.net', 'ABQIAAAAuKTQCaAmRIZm8fpzMcomXRSjgd74L9WyZO8Sjj0ClzXDGx3dYxQN2iImmF-UZzmvUG1oogyiwpW3eQ');*/
                $gMap->setAPIKey('pegasrealty.ru', 'AIzaSyDu-9PAa4Wjo64NrGGwjuxdIQhxGV1XTw8');
                $gMap->zoom = 10;/*6;*/
                $mapTypeControlOptions = array(
                     'position' => EGMapControlPosition::RIGHT_TOP,
                     'style' => EGMap::MAPTYPECONTROL_STYLE_DEFAULT
                 );

                $gMap->mapTypeId = EGMap::TYPE_ROADMAP;
                $gMap->mapTypeControlOptions = $mapTypeControlOptions;

                // Preparing InfoWindow with information about our marker.
                $info_window_a = new EGMapInfoWindow("<div class='gmaps-label' style='color: #000;'>Это твой маркер<br/>недвижемости!</div>");

                // Setting up an icon for marker.
                //$icon = new EGMapMarkerImage("http://google-maps-icons.googlecode.com/files/car.png");
                $icon = new EGMapMarkerImage("http://google-maps-icons.googlecode.com/files/realestate.png");
                //$icon = new EGMapMarkerImage("http://www.google.com/intl/en_us/mapfiles/ms/micons/blue-dot.png");                                

                $icon->setSize(32, 37);
                $icon->setAnchor(16, 16.5);
                $icon->setOrigin(0, 0);

                
                // Saving coordinates after user dragged our marker.
                $dragevent = new EGMapEvent('dragend', "function (event) { /*$.ajax({
                     'type':'POST',
                     'url':'".$this->createUrl('catalog/savecoords').'/'.$items->id."',
                     'data':({'lat': event.latLng.lat(), 'lng': event.latLng.lng()}),
                     'cache':false,
                });*/
                $('#Realestates_map_latitude').val(event.latLng.lat());    
                $('#Realestates_map_longitude').val(event.latLng.lng());
                }", false, EGMapEvent::TYPE_EVENT_DEFAULT);

                // If we have already created marker - show it                
                if ( !empty($model->map_latitude) && !empty($model->map_longitude) ) {
                    $marker = new EGMapMarker($model->map_latitude, $model->map_longitude, array('title' => Yii::t('realestates', $model->title),
                                    'icon'=>$icon, 'draggable'=>true), 'marker', array('dragevent'=>$dragevent));
                    $marker->addHtmlInfoWindow($info_window_a);
                    $gMap->addMarker($marker);                                    
                    $gMap->setCenter($model->map_latitude, $model->map_longitude);
                    $gMap->zoom = 10;
                    $gMap->enableLatLonControl();

                    // If we don't have marker in database - make sure user can create one
                } else {
                    
                    $gMap->setCenter(55.74779594179455,37.626800537109375);                    

                    // Setting up new event for user click on map, so marker will be created on place and respectful event added.
                    $gMap->addEvent(new EGMapEvent('click',
                                           'function (event) {var marker = new google.maps.Marker({position: event.latLng, map: '.$gMap->getJsName().
                                            ', draggable: true, icon: '.$icon->toJs().'}); '.$gMap->getJsName().
                                            '.setCenter(event.latLng); var dragevent = '.$dragevent->toJs('marker').
                                            '; /*$.ajax({'.
                                            '"type":"POST",'.
                                                    '"url":"'.$this->createUrl('catalog/savecoords')."/".$items->id.'",'.
                                                    '"data":({"lat": event.latLng.lat(), "lng": event.latLng.lng()}),'.
                                                    '"cache":false,'.
                                            '});*/ 
                                            $("#Realestates_map_latitude").val(event.latLng.lat());    
                                            $("#Realestates_map_longitude").val(event.latLng.lng());
                                            }', false, EGMapEvent::TYPE_EVENT_DEFAULT_ONCE));
                }

                ob_start();
                    $gMap->renderMap(array(), Yii::app()->language);
                    $map=ob_get_contents();
                ob_end_clean();
                return $map;
        }
        
        protected function SavePropsRealestates($model) {
            
           // Запись списка свойств недвижемости
           $model_properties = new RealestateProperties();
           $properties = $this->SetProperty($model->id, 'property_id', $model_properties);
                             
           // Запись списка представителей
           $model_representatives = new RealestateRepresentatives();
           $representatives = $this->SetRepresentative($model->id, 'representative_id', $model_representatives);
                                     
           // Запись списка свойств недвижемости
           $model_similarities = new RealestateSimilarities();
           $similarities = $this->SetSimilarities($model->id, 'similaries_id', $model_similarities);
                             
           // Запись списка представителей
           $model_similarities1 = new RealestateSimilarities();
           $similarities1 = $this->SetSimilarities1($model->id, 'similaries_id', $model_similarities1);
                             
           // Запись фото орегинала недвижемости
           $file_picOreginal=$this->SetPicOreginal($model->id, $model);                                                                                      
           if ($file_picOreginal->id) $attributes["pic_oreginal_id"]= $file_picOreginal->id ;                             
                             
           // Запись фото скриншота недвижемости                             
           $file_picScr=$this->SetPicScr($model->id, $model);
           if ($file_picScr->id) $attributes["pic_scr_id"]= $file_picScr->id ;                             
                             
           // Запись фото анонса недвижемости
           $file_picAnons=$this->SetPicAnons($model->id, $model);   
           if ($file_picAnons->id) $attributes["pic_anons_id"]= $file_picAnons->id ;                                 
                             
           // Запись детального фото недвижемости
           $file_picDetile=$this->SetPicDetile($model->id, $model);
           if ($file_picDetile->id) $attributes["pic_detile_id"]= $file_picAnons->id ;                                                        
                             
           // Обновление модели
           $model->attributes = $attributes;
           $model->update();                                                             

           // Запись вариантов недвижемости
           $model_fotos = new RealestateFotos();
           $representatives = $this->SetFotos($model->id, 'file_id', $model_fotos);
                                                          
           // Запись презентаций недвижемости
           $model_presentations = new RealestatePresentations();
           $representatives = $this->SetPresentations($model->id, 'presentation_id', $model_presentations);                             
           
           // Запись 
           $errors = array();
           if (is_array($model->errors))
               $errors = array_merge($errors,$model->errors);
                             
           if (is_array($properties->errors)) 
               $errors = array_merge($errors,$properties->errors);                             
           if (is_array($representatives->errors)) 
               $errors = array_merge($errors,$representatives->errors);
           if (is_array($similarities->errors)) 
               $errors = array_merge($errors,$similarities->errors);                             
           if (is_array($similarities1->errors)) 
               $errors = array_merge($errors,$similarities1->errors);
           if (is_array($file_picOreginal->errors))
               $errors = array_merge($errors,$file_picOreginal->errors);                             
           if (is_array($file_picScr->errors))
               $errors = array_merge($errors,$file_picScr->errors);
           if (is_array($file_picAnons->errors))
               $errors = array_merge($errors,$file_picAnons->errors);
           if (is_array($file_picDetile->errors))
               $errors = array_merge($errors,$file_picDetile->errors);
                                     
           // !@TODO Cобрать все ошибки Переход при удачной записи
           if ( empty($errors)) $this->redirect(array('view','id'=>$model->id));                                                                                                                                                                         

        }

        /**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
                // Генерация ID в случае если нет параметров                       
                $model = $this->genIds($model);
                        
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Realestates']))
		{
                        //echo "<pre>"; print_r($_FILES); echo "</pre>";
                        //echo "<pre>"; print_r($_POST); echo "</pre>";
                        //echo "<pre>"; var_dump($_FILES['Realestates']['name']['realestateFotos']); echo "</pre>";
                        //exit;
			$model->attributes=$_POST['Realestates'];       
                        $model->date_rang = date('Y-m-d',strtotime($model->date_rang));
                        $model->date_release = date('Y-m-d',strtotime($model->date_release));
                        
                        /* Перегенерация sid;
                           !TODO в дальнейшем нужно пересмотреть генерацию с формы*/                        
                        $model->sid = HRu::translit($model->title);
                            
                        // Save Realestate
			if($model->save()) 
                        {   
                            $this->SavePropsRealestates($model);
                        }
		}

                /* Create map */
                $map = $this->_show_map($model);
                
                // Свойства недвижемости
                /*$properties = RealestateProperties::model()->findAll("realestate_id=".$id, 
                                          array("select"=>"property_id"));                
                $selProperties = array();
                foreach ( $properties as $key=>$val) 
                $selProperties[$val->property_id]=array("selected"=>true);*/
                
                // Представители недвижемости
                /*$representatives = RealestateRepresentatives::model()->findAll("realestate_id=".$model->id, 
                                          array("select"=>"representative_id"));
                $selRepresentatives = array();
                foreach ( $representatives as $key=>$val) 
                $selRepresentatives[$val->representative_id]=array("selected"=>true);*/                
                
                // Другая площадь
                /*$similarities1 = RealestateSimilarities::model()->findAll("realestate_id=".$model->id, 
                                          array("select"=>"similaries_id"));
                $selSimilarities1 = array();
                foreach ( $similarities1 as $key=>$val) 
                $selSimilarities1[$val->similarities_id]=array("selected"=>true);                
                
                // Схожие предложения
                $similarities = RealestateSimilarities::model()->findAll("realestate_id=".$model->id, 
                                          array("select"=>"similaries_id"));
                $selSimilarities = array();
                foreach ( $similarities as $key=>$val) 
                $selSimilarities[$val->similarities_id]=array("selected"=>true); */               
                                    
                // Инициализация валюты                
                $this->SetCurrency($model->valute_id); 
                        
		$this->render('update',array( 'model'=> $model,
                                              'map'=> $map,                                              
                                              /*'selproperties'=> $selProperties,
                                              'selRepresentatives'=> $selRepresentatives,
                                              'selSimilarities1'=> $selSimilarities1,
                                              'selSimilarities'=> $selSimilarities*/));
	}
        
        protected function SetCurrency($currency_id) 
        {
            $curr_valute = Valutes::model()->findByPk($currency_id);                
            Yii::app()->currency->to = $curr_valute->title;                
            $ainfo_curs = $this->__isCurs();
                
            Yii::app()->currency->from =$ainfo_curs; 
            Yii::app()->currency->timeCacheComp = 0;
            Yii::app()->currency->init();
        }

        protected function SetFotos( $id, $field_id, $model) {
            return $this->SetManyFieldFiles( $id, $field_id, "Fotos",$model,'Варианты '.Yii::t('all','realestate'));
        }

        protected function SetPresentations( $id, $field_id, $model) {
            return $this->SetManyFieldFiles( $id, $field_id, "Presentations",$model,'Файл '.Yii::t('all','presentation'),false);
        }

        protected function SetProperty( $id, $field_id, $model) {
            return $this->SetManyField( $id, $field_id, "Properties",$model);
        }
        
        protected function SetRepresentative( $id, $field_id, $model) {
            return $this->SetManyField( $id, $field_id, "Representatives",$model);
        }
        
        protected function SetSimilarities( $id, $field_id, $model) {
            return $this->SetManyField( $id, $field_id, "Similarities",$model, 1);
        }
        
        protected function SetSimilarities1( $id, $field_id, $model) {
            return $this->SetManyField( $id, $field_id, "Similarities1",$model, 2);
        }
               
        // Save files
        
        protected function SaveFile($id, $model, $field, $file_title, $save_model=false, $key=null, $is_image=true) {                                        
                                       
           //echo "<pre>"; print_r($_FILES["Realestates"]); "</pre>"; 
           $is_upfile = ( $key!==null ? $_FILES["Realestates"]["name"][$field]<>"" 
                                      : $_FILES["Realestates"]["name"][$field][$key]<>"" );           
           if ( isset($_FILES["Realestates"]["name"][$field]) && $is_upfile ) 
           {                             
               if ( $key!==null ) {
                   //echo "model:[$key]".$field;                        
                   $upfile=CUploadedFile::getInstancesByName("Realestates[".$field."]");                                      
                   $upfile=$upfile[$key];
               }    
               else 
               { 
                   $upfile=CUploadedFile::getInstance($model,$field);   
                   //print_r($upfile);
                   //exit;
               }
                                                
               if (!empty($upfile)) {                            

                   $pathto = Yii::app()->getBasePath()."/../";                                                        
                   $pathto_tmp = "uploads/tmp";                                                        
                   $pathfull_tmp_file = $pathto.$pathto_tmp."/".$upfile->name;                
                                                           
                   $Ri = new Ri(); $uid=$Ri->genid();

                   $pathto_original = "uploads/files";                            
                   $file_name =  $model->tableName()."_".$uid."_original.".$upfile->extensionName;                                        
                   $path_original_file = $pathto_original."/".$file_name;                            
                   $pathfull_original_file = $pathto.$path_original_file; 
      
                   if ( $upfile->saveAs($pathfull_original_file) ) {                                                                                                        
  
                       // Ресайз картинок 
                       if ($is_image) 
                       {          
                           
                          $pathto_src_file  = $pathto.$pathto_original."/".$model->tableName()."_".$uid."_src.".$upfile->extensionName;                    
                          $pathto_big_file  = $pathto.$pathto_original."/".$model->tableName()."_".$uid."_big.".$upfile->extensionName;                    
                          $pathto_small_file= $pathto.$pathto_original."/".$model->tableName()."_".$uid."_small.".$upfile->extensionName;

                          $images = new RiImage();
                          $images->scr_photo->width=null;//60;
                          $images->scr_photo->height=40;
                          $images->small_photo->width=null;//120;
                          $images->small_photo->height=80;
                          $images->big_photo->width=null;//800;
                          $images->big_photo->height=600;

                          // Ресайз картинок в выводом ошибок в буфер                               

                          $resize_src   = $images->resize( $pathfull_original_file, $pathto_src_file, $images->scr_photo);
                          $resize_small = $images->resize( $pathfull_original_file, $pathto_small_file, $images->small_photo);
                          $resize_big   = $images->resize( $pathfull_original_file, $pathto_big_file, $images->big_photo);                          
                          
                          // Получаем размеры в масив
                          $imgwh = getimagesize($pathfull_original_file); 
                          $img_height = $imgwh[1]; 
                          $img_width = $imgwh[0]; 

                       }else{
                           $img_height = null;
                           $img_width = null;
                       } 
                                             
                       // Запись картинки орегинала
                       $file = new Files();                                              

                       $attributes = array( "uid"                => $uid,
                                               "status"          => "created",
                                               "name"            => $file_title." №".$id,  
                                               "order"           => 500,
                                               "height"          => $img_height,
                                               "width"           => $img_width,
                                               "file_size"       => $upfile->size,
                                               "ext"             => $upfile->extensionName,
                                               "subdir"          => $pathto_original,
                                               "file_name"       => $file_name,
                                               "original_name"   => $path_original_file,
                                               "content_type"    => $upfile->type,
                                               "created_user"    => Yii::app()->user->id,
                                               "created"         => date('Y-m-d'),
                                               "controller"      => $this->getId(),
                                               "action"          => $this->getAction()->getId());                                           

                       $file->attributes=$attributes;                    
                       if ( $save_model ) {
                           if ( !($file->save()) ) $errors = $file->errors; /* echo "Файл орегинала записан" */
                       }
                       return $file;
                   }
                   else return false;
               }          
               else return false;
            }             
        }

        protected function setManyFieldFiles ($id, $field_id, $field_imp, $model, $file_title="", $resize=true)  
        {                                         
            $field = 'realestate'.ucfirst($field_imp);       
                        
            $is_files = ( isset($_FILES['Realestates']["name"][$field]) && trim($_FILES['Realestates']["name"][$field])<>'' ? true : false);
            $is_postfiles = ( isset($_POST['Realestates'][$field]) && is_array($_POST['Realestates'][$field]) ? true : false) ;            
            // Save Representatives               
            if ( $is_files || is_postfiles ) {

                // Зачистка файлов                
                $realestate_files=$model->findAll('realestate_id='.$id); $aid = $fid = array();   
                
                // Если файлы существую
                if ( $is_postfiles ) $realestate_postfiles = $_POST['Realestates'][$field];
                else $realestate_postfiles = array();

                // Формируем массив ID файлой для удаления 
                foreach( $realestate_files as $key=>$realestate_file )  {                   
                    if ( trim($realestate_file->file_id)<>'' && !in_array($realestate_file->id,$realestate_postfiles)) {
                        $aid[] = $realestate_file->file_id;
                        $fid[] = $realestate_file->id;
                    }
                }
                                                       
                // Если массив не пустой зачищаем файлы и таблицы файлов и списка файлов свойства недвижемости   
                if (is_array($aid) && !empty($aid) ) {
                    
                    $aList_id = implode(",",$aid);
                    $fList_id = implode(",",$fid);

                    $files=Files::model()->findAll("id in (".$aList_id.")", array('select'=>'id, original_name') );                               
                                        
                    // Удаление записей в таблице файлов                      
                    if ($files) {                                        
                        Files::model()->deleteAll("id in (".$aList_id.")");    
                    }
                    //exit;
                    /*!@TODO Проверить    */
                    foreach( $files as $key=>$file ) {                                    
                        if( is_file(Yii::app()->request->baseUrl."/".$file->original_name))
                            unlink(Yii::app()->request->baseUrl."/".$file->original_name);      
                    }                    
                    
                    // Удаление записей в таблице файлов недвижемости  
                    $model->deleteAll('realestate_id='.$id.' and id in ('.$fList_id.')'); $errors = array();                                      
                }             
                
                
                if ( $is_files ) {
                    foreach ($_FILES['Realestates']['name'][$field] as $key=>$pfile )
                    {                                              
                        $file = $this->SaveFile($id, $model, $field, $file_title, true, $key, $resize );

                        if ( $file && empty($file->errors)) {

                             $attributes = array( "realestate_id" => $id, 'file_id' => $file->id );
                             $model->attributes = $attributes;                 

                             if ( !($model->save()) ) {                            
                                if (is_array($model->errors)) 
                                    $errors=array_merge($errors,$model->errors);
                             }
                             $model = new $model; 
                        } else {
                            if (is_array($file->errors))
                                $errors=array_merge($errors,$file->errors);                                  
                        }

                    }                                                    
                }    
                return $errors;                 
            }            
        }
        
        protected function SetManyField ( $id, $field_id, $field, $model, $linking_id=null ) {
                                   
          $field = 'realestate'.ucfirst($field);
          // Save Representatives                                                 
          if (isset($_POST['Realestates'][$field])) 
          {            
              $errors = array(); 
              if ( $linking_id==null ) $model->deleteAll('realestate_id='.$id);    
              else $model->deleteAll('realestate_id='.$id.' and realestate_linking_id='.$linking_id);    
              
              //print_r($_POST['Realestates'][$field]);
              
              foreach ($_POST['Realestates'][$field] as $key=>$many )
              { 
                if ( $linking_id===null ) {  
                    $attributes = array( "realestate_id" => $id, $field_id => $many,);
                }else{
                    $attributes = array( "realestate_id" => $id, $field_id => $many, "realestate_linking_id"=>$linking_id);
                }
                $model->attributes = $attributes;                 
                
                if ( !($model->save()) ) {
                    if (is_array($model->errors))
                        $errors=array_merge($errors,$model->errors); 
                }
                $model = new $model;
                 
              }                     
              return $errors;
          } else {
              
              if ( $linking_id==null ) $model->deleteAll('realestate_id='.$id);    
              else $model->deleteAll('realestate_id='.$id.' and realestate_linking_id='.$linking_id);   
              
              return false;
          }          
        }
        
        protected function SetPicDetile($id, $model) {
            return $this->SetPic($id, $model, 'pic_detile_id','Картинка детально '. Yii::t('all','realestate'));
        }

        protected function SetPicAnons($id, $model) {
            return $this->SetPic($id, $model, 'pic_anons_id','Анонс картинки '. Yii::t('all','realestate'));
        }

        protected function SetPicOreginal($id, $model ) {
            return $this->SetPic($id, $model, 'pic_oreginal_id','Орегинал '. Yii::t('all','realestate'));
        }

        protected function SetPicScr($id, $model ) {
            return $this->SetPic($id, $model, 'pic_scr_id','Скриншот '. Yii::t('all','realestate'));
        }
        
        protected function SetPic($id, $model, $field_imp,$file_title) {
            
          if ( !(is_array($exts)) ) {
              $exts=array('jpg','jpeg','png');
          } 
          
          $field = str_replace("_", "", $field_imp);
          $field = str_replace("id", "", $field);
          $field = str_replace("pic", "", $field);
          $field = "pic".ucfirst($field);

          //Yii::app()->end();
          //print_r($_FILES); 
          //echo "<br/>".trim($_FILES['Realestates']["name"][$field]);
          //exit;
          
          // Зачистка файлов
          $file_old=$model->findAll('id='.$id);                                                                
                                   
          /*!@TODO Проверить */   
          if( is_file(Yii::app()->request->baseUrl."/".$file_old->original_name)) 
                      unlink(Yii::app()->request->baseUrl."/".$file_old->original_name);                                                                          
          /*
            echo "<pre>"; print_r($realestate_files); echo "</pre>";
            exit;
          */
          
          $file = $this->SaveFile($id, $model, $field, $file_title, false ); 
                              
          if ( is_object($file)) {
               
 
             if (isset($_POST['Realestates'][$field_imp]) && trim($_POST['Realestates'][$field_imp])<>"" ) 
             {                             
               $file_record = Files::model()->find('id=:id', array(':id'=>$_POST['Realestates'][$field_imp]));
               
               //echo $_POST['Realestate'][$field_imp];
               //echo "<pre>"; print_r($file_record); echo "<pre/>";
          
               // Save upload files Many Field             
                   
               if ($file_record) {                   
                 
                   $file_record->attributes=$attributes;
                   $attributes = array( "status"          => "refused",
                                        "height"          => $file->height,
                                        "width"           => $file->width,
                                        "file_size"       => $file->file_size,
                                        "ext"             => $file->ext,
                                        "subdir"          => $file->subdir,
                                        "file_name"       => $file->file_name,
                                        "original_name"   => $file->original_name,
                                        "content_type"    => $file->content_type,                                                          
                                        "updated_user"    => Yii::app()->user->id,
                                        "updated"         => date('Y-m-d'),
                                        "controller"      => $file->controller,
                                        "action"          => $file->action);                                                    
               }else $file_record = $file;
             }else $file_record = $file;                                           

             if ( $file_record->save() ) {
                 return $file_record; /* echo "Файл орегинала записан" */;       
             }                              
          }                                                                              
          return false;          
        }
        
	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Realestates');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()                
	{
            	$this->layout='//layouts/column3';
                
		$model=new Realestates('search');                
		$model->unsetAttributes();  // clear any default values                
                
		if( isset($_GET['Realestates'])) :
                        
			$model->attributes=$_GET['Realestates'];
                        
                        if ( !empty($_GET['remoteness-from']) && !empty($_GET['remoteness-to'])) {
                            $model->getDbCriteria()->addBetweenCondition('remoteness', 
                                $_GET['remoteness-from'], $_GET['remoteness-to']);  
                        }

                        if ( !empty($_GET['date_rang-from']) && !empty($_GET['date_rang-to']) )    
                            $model->getDbCriteria()->addBetweenCondition('date_rang', 
                                date('Y-m-d', strtotime($_GET['date_rang-from'])), date('Y-m-d', strtotime($_GET['date_rang-to'])));                

                        if ( !empty($_GET['date_release-from']) && !empty($_GET['date_release-to']) )    
                            $model->getDbCriteria()->addBetweenCondition('date_release', 
                                date('Y-m-d', strtotime($_GET['date_release-from'])), date('Y-m-d', strtotime($_GET['date_release-to'])));                
                       
                        if ( !empty($_GET['area-from']) && !empty($_GET['area-to'])) 
                             $model->getDbCriteria()->addBetweenCondition('area', 
                                $_GET['area-from'], $_GET['area-to']);                
                                                
                        if ( !empty($_GET['price-from']) && !empty($_GET['price-to'])) 
                        $model->getDbCriteria()->addBetweenCondition('price', 
                                $_GET['price-from'], $_GET['price-to']);               
                        
                        if ( isset($_GET['polygon']) && !empty($_GET['polygon']) ) {
                            
                            $model->getDbCriteria()->addBetweenCondition('map_longitude',
                                    $model->getMinLongCoord($_GET['polygon']),
                                    $model->getMaxLongCoord($_GET['polygon']));              
                            $model->getDbCriteria()->addBetweenCondition('map_latitude',
                                    $model->getMinLatCoord($_GET['polygon']),
                                    $model->getMaxLatCoord($_GET['polygon']));
                        }
                        
                        // Search for Realestate Properties
                        if ( isset($_GET["Realestates"]["realestateProperties"]) && !empty($_GET["Realestates"]["realestateProperties"])) {
                            
                            if ( !intval($_GET["is_many_properties"]) ) {
                                $model->getDbCriteria()->with['realestateProperties'] = array(
                                            'select' => false,
                                            'together' => true,
                                            'condition' => 'realestateProperties.property_id IN ('
                                                            .implode(',', $_GET["Realestates"]["realestateProperties"]).')' ,                
                                );                                
                                
                            }else{
                                $model->getDbCriteria()->with['realestateProperties'] = array(
                                            'select' => false,
                                            'together' => true,
                                            'condition' => 'realestateProperties.property_id IN ('
                                                          .implode(',', $_GET["Realestates"]["realestateProperties"]).')'
                                                          .' AND ('.'(SELECT COUNT(*) FROM realestate_properties sp '
                                                                    .' WHERE realestateProperties.realestate_id=sp.realestate_id AND sp.property_id IN ('
                                                                        .implode(',', $_GET["Realestates"]["realestateProperties"]).') GROUP BY realestate_id)='
                                                                    .count($_GET["Realestates"]["realestateProperties"]).')',                
                                            );
                                
                            }

                        }
                        
                        // Search for Realestate Representatives
                        if ( isset($_GET["Realestates"]["realestateRepresentatives"]) && !empty($_GET["Realestates"]["realestateRepresentatives"])) {
                            
                            if ( !intval($_GET["is_many_representatives"]) ) {
                                $model->getDbCriteria()->with['realestateRepresentatives'] = array(
                                            'select' => false,
                                            'together' => true,
                                            'condition' => 'realestateRepresentatives.representative_id IN ('
                                                            .implode(',', $_GET["Realestates"]["realestateRepresentatives"]).')' ,                
                                );                                
                                
                            }else{
                                $model->getDbCriteria()->with['realestateRepresentatives'] = array(
                                            'select' => false,
                                            'together' => true,
                                            'condition' => 'realestateRepresentatives.representative_id IN ('
                                                          .implode(',', $_GET["Realestates"]["realestateRepresentatives"]).')'
                                                          .' AND ('.'(SELECT COUNT(*) FROM realestate_representatives sr '
                                                                    .' WHERE realestateRepresentatives.realestate_id=sr.realestate_id AND sr.representative_id IN ('
                                                                        .implode(',', $_GET["Realestates"]["realestateRepresentatives"]).') GROUP BY realestate_id)='
                                                                    .count($_GET["Realestates"]["realestateRepresentatives"]).')',                
                                            );
                                
                            }

                        }
                        
                        // Search for Realestate Similarities1 
                        if ( isset($_GET["Realestates"]["realestateSimilarities1"]) && !empty($_GET["Realestates"]["realestateSimilarities1"])) {
                            
                            if ( !intval($_GET["is_many_similarities1"]) ) {
                                $model->getDbCriteria()->with['realestateSimilarities1'] = array(
                                            'select' => false,
                                            'together' => true,
                                            'condition' => 'realestateSimilarities1.similaries_id IN ('
                                                            .implode(',', $_GET["Realestates"]["realestateSimilarities1"]).')' ,                
                                );                                
                                
                            }else{
                                $model->getDbCriteria()->with['realestateSimilarities1'] = array(
                                            'select' => false,
                                            'together' => true,
                                            'condition' => 'realestateSimilarities1.similaries_id IN ('
                                                          .implode(',', $_GET["Realestates"]["realestateSimilarities1"]).')'
                                                          .' AND ('.'(SELECT COUNT(*) FROM realestate_similarities ss '
                                                                    .' WHERE realestateSimilarities1.realestate_id=ss.realestate_id AND ss.similaries_id IN ('
                                                                        .implode(',', $_GET["Realestates"]["realestateSimilarities1"]).') GROUP BY realestate_id)='
                                                                    .count($_GET["Realestates"]["realestateSimilarities1"]).')',                
                                            );
                                
                            }

                        }
                        
                        // Search for Realestate Similarities
                        if ( isset($_GET["Realestates"]["realestateSimilarities"]) && !empty($_GET["Realestates"]["realestateSimilarities"])) {
                            
                            if ( !intval($_GET["is_many_similarities"]) ) {
                                $model->getDbCriteria()->with['realestateSimilarities'] = array(
                                            'select' => false,
                                            'together' => true,
                                            'condition' => 'realestateSimilarities.similaries_id IN ('
                                                            .implode(',', $_GET["Realestates"]["realestateSimilarities"]).')' ,                
                                );                                
                                
                            }else{
                                $model->getDbCriteria()->with['realestateSimilarities'] = array(
                                            'select' => false,
                                            'together' => true,
                                            'condition' => 'realestateSimilarities.similaries_id IN ('
                                                          .implode(',', $_GET["Realestates"]["realestateSimilarities"]).')'
                                                          .' AND ('.'(SELECT COUNT(*) FROM realestate_similarities ss '
                                                                    .' WHERE realestateSimilarities.realestate_id=ss.realestate_id AND ss.similaries_id IN ('
                                                                        .implode(',', $_GET["Realestates"]["realestateSimilarities"]).') GROUP BY realestate_id)='
                                                                    .count($_GET["Realestates"]["realestateSimilarities"]).')',                
                                            );
                                
                            }

                        }
                        
                //Yii::beginProfile('blockId');
                //print_r($model->search()->getData());
                //Yii::endProfile('blockId');
		//Yii::app()->end();
                        
                endif;               

                //$map = $this->_show_map_poligon($model);
                
                $map = $this->_show_map_poligon($model);
                
		$this->render('admin',array(
                              'model'=>$model,
                              'map'=>$map,
		));
	}
        
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Realestates::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='realestates-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
        public function actionAutocompleteAddress() {
            return $this->formAutocomplete('address');
        }

        public function actionAutocompleteTitle() {
            return $this->formAutocomplete('title');
        }
        
        public function actionAutocompleteMetro() {
            return $this->formAutocomplete('metro_id');
        }
        
        protected function formAutocomplete($field) {
            $term  = urldecode(Yii::app()->getRequest()->getParam('term'));
            
            if(Yii::app()->request->isAjaxRequest && $term) {
                $criteria = new CDbCriteria;
                // формируем критерий поиска
                $criteria->addSearchCondition($field, $term);
                $realestates = Realestates::model()->findAll($criteria);
                // обрабатываем результат
                $result = array();
                foreach($realestates as $realestate) {
                    $lable = '№'.$realestate['id'].' '.$realestate[$field];
                    $result[] = array('id'=>$realestate['id'], 'label'=>$lable, 'value'=>$realestate[$field]);
                }
                echo CJSON::encode($result);
                Yii::app()->end();
            }
        }
        
        public function actionAjaxShowCurrenty($vid,$price) 
        {    
            if( Yii::app()->request->isAjaxRequest ) {
                
                $model = new Realestates();
                $model->price = $price;
                $model->valute_id = $vid;
                
                $curr_valute = Valutes::model()->findByPk($vid);
                
                Yii::app()->currency->to = $curr_valute->title;
                
                $ainfo_curs = $this->__isCurs();
                
                Yii::app()->currency->from =$ainfo_curs;  
                Yii::app()->currency->timeCacheComp = 0;
                Yii::app()->{Yii::app()->currency->nameCacheComp}->delete('currency');
                Yii::app()->currency->init();
                
                $form = new CActiveForm();
                $this->renderPartial( '_currency', array('model'=>$model,
                                                         'form' =>$form,
                                                         'is_ajax'=>true,
                                                         'is_curs'=>!empty($ainfo_curs)));
                Yii::app()->end();
            }
        }
        
        public function __isCurs() {
            
            $ainfo_curs = array();                
            switch ( strtoupper(Yii::app()->currency->to) ) 
            {
               case 'USD':
                  $ainfo_curs[] = array("name"=>"EUR","amount"=>1);                                 
                  $ainfo_curs[] = array("name"=>"RUB","amount"=>1);
                  break;
              case 'EUR':
                  $ainfo_curs[] = array("name"=>"USD","amount"=>1);   
                  $ainfo_curs[] = array("name"=>"RUB","amount"=>1);                              
                  break;
              case 'RUB':                         
                  $ainfo_curs[] = array("name"=>"USD","amount"=>1);  
                  $ainfo_curs[] = array("name"=>"EUR","amount"=>1);                                                  
                  break;
            }
            return $ainfo_curs;
        } 
}

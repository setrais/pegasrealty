<?php
class SpacesController extends BackendController
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
				'actions'=>array('index','view','autocompleteaddress','ajaxview','ajaxcopyinclient','ajaxsendinclient',
                                                 'autocompletetitle','autocompletemetro',
                                                 'ajaxshowcurrenty','ajaxshowpromcurrenty','getcoord','create'),
				'users'=>array('@'),
			),
                    	array('allow', // allow member user to perform 'create' actions
				'actions'=>array('create','copy'),
				'users'=>array('member'),
			),                    
			array('allow', // allow manager and admin and superadmin user to perform 'create' and 'update' actions
				'actions'=>array('create','update','copy'),
				'users'=>array('manager','admin','superadmin','adminone'),
			),                    
			array('allow', // allow admin and superadmin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin','superadmin','manager','adminone'),
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
                $model = $this->loadModel($id);
		$this->render('view',array(
			'model'=>$model,
                        'map'=>$this->_view_map($model)
		));
	}

       /**
	* Displays Ajax a particular model.
	* @param integer $id the ID of the model to be displayed
	*/
	public function actionAjaxView($id)
	{
            $cs=Yii::app()->getClientScript();
            if(null!==($scriptMap=Yii::app()->request->getParam('scriptMap')) && is_string($scriptMap)){
                    foreach(explode(',', $scriptMap) as $script)
                        $cs->scriptMap[$script]=false;
            }

            if( Yii::app()->request->isAjaxRequest ) {
		$this->renderPartial('view_ajax',array(
			'model'=>$this->loadModel($id),
                        'map'=>$this->_view_map($model)
		),false,true);
            }    
	}   
  
       /**
	* Send Presentation of the Space In Client Ajax a particular model.
	* @param integer $id the ID of the space model to be copy in client
        * @param integer $cid the ID of the client model 
	*/
        public function actionAjaxSendInClient($id, $cid)
        {
           if( Yii::app()->request->isAjaxRequest ) {               
               
               $space = Spaces::model()->findByPk($id);
               $client = Clients::model()->findByPk($cid);
               
               if ( $space && $client) {
                    $body = "Здравствуйте! \r\n";
                    $body.= "Уважаемый : ".$client->contact_person."\r\n";
                    $body.= "\r\n";
                    $body.= "Прошу Вас рассмотреть коммерческое предложение по ".$space->operation->title." недвижемости №".$space->nid."\r\n";
                    $body.= "согласно вашых пожеланий\r\n";
                    $body.= "\r\n";
                    $body.= "Предлагаемая недвижемость: ".$space->title."\r\n";
                    $body.= "\tКласс - ".CHtml::encode($space->spaceClass->title)."\r\n";
                    $body.= "\tВид - ".CHtml::encode($space->spaceVid->title)."\r\n";
                    $body.= "\tРайон - ".CHtml::encode($space->district->title)."\r\n";
                    $body.= "\tМетро - ".CHtml::encode($space->metro->title)."\r\n";
                    $body.= "\tРасстояние - ".CHtml::encode($space->remoteness)." (".CHtml::encode($space->unit->short_title).")\r\n";
                    //$body.= "\tAдрес - ".CHtml::encode($space->address)."\r\n";
                    $body.= "\tПлощадь - ".CHtml::encode($space->area)." м.кв. \r\n";
                    $body.= "\tСтоимость - ". CHtml::encode(round($space->price))." кв/м в год \r\n";
                    $body.= "\tПланировка - ".CHtml::encode($space->planning->title)."\r\n";
                    $body.= "\tПарковка - ".CHtml::encode($space->parking->title)." ".CHtml::encode($space->cnt_parking_place)." м/м \r\n";                    

                            
                    $props = CHtml::listData(Properties::model()->findAll("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                                array("order"=>"sort")), 'id', 'title');                 
                    
                    $cnt=count($space->spaceProperties);
                    if ($cnt<>0) {
                        foreach ($space->spaceProperties as $key=>$spacePropertie) { 
                           if ($cnt<>($key+1)) echo CHtml::encode($props[$spacePropertie->property_id])."/";
                               else $body.= CHtml::encode($props[$spacePropertie->property_id]).'/';
                        } 	                    
                        $body.= "\tCвойства - ".implode(',',$space->spaceProperties->title)."\r\n";
                    }
                    if ($space->anons) {
                        $body.= "\tКраткое описание: \r\n";
                        $body.= "\t".$space->anons." \r\n";
                    }
                    $body.= "\r\n";
                    $body.= "\r\n";
                    $body.= "\r\n";
                    $body.= " Cообщение отправлено с сайта "./*"<a href='".Yii::app()->request->getServerName()."'>"*/Yii::app()->request->getServerName()/*"</a>"*/."\r\n";
                    $body.= " C уважением администрация "./*"<a href='".Yii::app()->request->getServerName()."'>".*/"<< Pegas Realty >>"./*"</a>".*/"\r\n";
                    
                    
                    
                    $headers="From: ".Yii::app()->params['adminEmail']." \r\nReply-To: ".$client->email;
                    $subject="Коммерческое предложение";
		    mail($client->email,$subject,$body,$headers);
		    //Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
		    //$this->refresh();                                                    
                    $data  = array( "error"=>false, "mess"=>Yii::t('all','Spaces')." №".$id." по клиенту:".$cid, "body"=>null );
                    echo json_encode($data);
                    return;
               } else {
                    $data  = array( "error"=>true, "mess"=>Yii::t('all','Spaces')." №".$id." по клиенту:".$cid, "body"=>null );
                    echo json_encode($data);
                    return;
               }
            }       
        }        
                
                

       /**
	* Copy Space In Client Ajax a particular model.
	* @param integer $id the ID of the space model to be copy in client
        * @param integer $cid the ID of the client model 
	*/
	public function actionAjaxCopyInClient($id, $cid)
	{
            /*$cs=Yii::app()->getClientScript();
            if(null!==($scriptMap=Yii::app()->request->getParam('scriptMap')) && is_string($scriptMap)){
                    foreach(explode(',', $scriptMap) as $script)
                        $cs->scriptMap[$script]=false;
            }*/
            
            if( Yii::app()->request->isAjaxRequest ) {               
               if ( ClientSpaces::model()->findAll("client_id=".$cid." and space_id=".$id) ) {
                   $data  = array( "error"=>false, "mess"=>"Уже! ".Yii::t('all','Spaces')." №".$id." по клиенту:".$cid, "body"=>null );
                   echo json_encode($data);
                   return;
               } else {
                   $model_client_spaces = new ClientSpaces();
                   $model_client_spaces->client_id = $cid;
                   $model_client_spaces->space_id  = $id;
               
                   if ($model_client_spaces->save()) {
                      $data  = array( "error"=>false, "mess"=>Yii::t('all','Spaces')." №".$id." по клиенту:".$cid, "body"=>null );
                      echo json_encode($data);
                      return;
                   }
               }
            }    
	}        

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Spaces;
                // Генерация ID                        
                $model = $this->genIds($model);
                
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Spaces']))
		{                        
			$model->attributes=$_POST['Spaces']; 
                        // Генерация ID
                        $model = $this->genIds($model);
                        $model->create_date=date('Y-m-d H:s:i');
                        $model->create_user=Yii::app()->user->id;
                        
                        if (trim($model->date_rang)<>'') $model->date_rang = date('Y-m-d',strtotime($model->date_rang));
                        else $model->date_rang=null;
                        if (trim($model->date_release)<>'') $model->date_release = date('Y-m-d',strtotime($model->date_release));
                        else $model->date_release=null;
                        
			if($model->save()) {
                            
                            // Запись свойств недвижемести
                            $this->SavePropsSpaces($model);
                            
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

        /**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionCopy($id)
	{
                $copid = $id;
		$model = $this->loadModel($id);
                // Генерация ID в случае если нет параметров                       
                $model = $this->genIds($model, true);                
                
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Spaces']))
		{
                        //echo "<pre>"; print_r($_FILES); echo "</pre>";
                        //echo "<pre>"; print_r($_POST); echo "</pre>";
                        //echo "<pre>"; var_dump($_FILES['Spaces']['name']['spaceFotos']); echo "</pre>";
                        //exit;
			$model->attributes=$_POST['Spaces'];       
                        
                        /* Перегенерация sid;
                           !TODO в дальнейшем нужно пересмотреть генерацию с формы*/                        
                        $model->sid = HRu::translit($model->title);
                                                
                        $model_copy = $model;

                        $model=new Spaces; $id = $model->id;
                        $model->attributes=$model_copy->attributes;
                        $model->id = $id;
                        $model->create_date=date('Y-m-d H:s:i');
                        $model->create_user=Yii::app()->user->id;
                        
                        if (trim($model->date_rang)<>'') $model->date_rang = date('Y-m-d',strtotime($model->date_rang));
                        else $model->date_rang=null;
                        if (trim($model->date_release)<>'') $model->date_release = date('Y-m-d',strtotime($model->date_release));
                        else $model->date_release=null;
                        
                        // Save Space
			if($model->save()) 
                        {   
                            $this->SavePropsSpaces($model,$copid);
                        }
		}else{
                    /*$model->picOreginal=null;
                    $model->picScr=null;
                    $model->picAnons=null;
                    $model->picDetile=null;
                    $model->spaceFotos=array();
                    $model->spacePresentations=array();
                    $model->pic_detile_id=null;
                    $model->pic_anons_id=null;
                    $model->pic_oreginal_id=null;
                    $model->pic_scr_id=null;*/  
                }

                /* Create map */
                $map = $this->_show_map($model);
                                                               
                // Инициализация валюты                
                $this->SetCurrency($model->valute_id); 
                        
		$this->render('copy',array( 'model'=> $model,
                                              'map'=> $map,                                              
                                              /*'selproperties'=> $selProperties,
                                              'selRepresentatives'=> $selRepresentatives,
                                              'selSimilarities1'=> $selSimilarities1,
                                              'selSimilarities'=> $selSimilarities*/));
	}

        protected function genIds($model, $is_gen=false) 
        {
            $Ri = new Ri;
            if (trim($model->uid)=='' || $is_gen ) $model->uid = $Ri->genid();                         
            if ( ( trim($model->sid)=='' || $is_gen ) && trim($model->title)<>'' ) $model->sid = HRu::translit($model->title);
            //if (trim($model->nid)=='') $model->nid = strtoupper(HCommon::genRandomString());
            if (trim($model->nid)=='' || $is_gen ) $model->nid = rand(1,99999).strtoupper(HCommon::genRandomString(2,'',array('num'=>false)));
                
            return $model;
        } 
        
        protected function _show_map_poligon($model) {
                                               
            Yii::import('ext.EGMap.*');
            
            Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/polygon/polygon.core.js');            
            
            $gMap = new EGMap();
            $gMap->setWidth(862);
            $gMap->setHeight(420);            
            $gMap->setAPIKey('http://pp.rtvs.net', 'ABQIAAAAuKTQCaAmRIZm8fpzMcomXRSjgd74L9WyZO8Sjj0ClzXDGx3dYxQN2iImmF-UZzmvUG1oogyiwpW3eQ');
            $gMap->zoom = 14;
            $gMap->minZoom = 14;
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
                                        array('title' => Yii::t('spaces', $model->title), 'draggable'=>true),
                                        'polygon', array('dragevent'=>$dragevent));
            
            $polygon->addHtmlInfoWindow($info_window);  
            $gMap->addPolygon($polygon);  */                    
            $gMap->zoom = 9;    
            $gMap->minZoom = 9;
            //$gMap->centerOnPolygons();
            //$gMap->zoomOnPolygons(0.1); 
            $gMap->enableLatLonControl();
            
            // Saving coordinates after polygons.
            $gMap->appendMapTo('#mapsearch');                          
            
            return $gMap;

        }
        
        protected function _view_map($model) {
                Yii::import('ext.EGMap.*');
                
                $gMap = new EGMap();                
                $gMap->setWidth(682);
                $gMap->setHeight(420);
                $gMap->setAPIKey('http://pp.rtvs.net', 'ABQIAAAAuKTQCaAmRIZm8fpzMcomXRSjgd74L9WyZO8Sjj0ClzXDGx3dYxQN2iImmF-UZzmvUG1oogyiwpW3eQ');
                $gMap->zoom = 10;/*6;*/
                $gMap->minZoom = 10;
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

                
                // If we have already created marker - show it                
                if ( !empty($model->map_latitude) && !empty($model->map_longitude) ) {
                    $marker = new EGMapMarker($model->map_latitude, $model->map_longitude, array('title' => Yii::t('spaces', $model->title),
                                    'icon'=>$icon), 'marker', array());
                    $marker->addHtmlInfoWindow($info_window_a);
                    $gMap->addMarker($marker);                                    
                    $gMap->setCenter($model->map_latitude, $model->map_longitude);
                    $gMap->zoom = 10;
                    $gMap->minZoom = 10;
                    $gMap->enableLatLonControl();

                    // If we don't have marker in database - make sure user can create one
                } else {
                    
                    $gMap->setCenter(55.74779594179455,37.626800537109375);                    

                }

                ob_start();
                    $gMap->renderMap(array(), Yii::app()->language);
                    $map=ob_get_contents();
                ob_end_clean();
                return $map;
        }
        
        protected function _show_map($model) {
                Yii::import('ext.EGMap.*');
                
                $gMap = new EGMap();                
                $gMap->setWidth(704);
                $gMap->setHeight(420);
                $gMap->setAPIKey('http://pp.rtvs.net', 'ABQIAAAAuKTQCaAmRIZm8fpzMcomXRSjgd74L9WyZO8Sjj0ClzXDGx3dYxQN2iImmF-UZzmvUG1oogyiwpW3eQ');
                $gMap->zoom = 10;/*6;*/
                $gMap->minZoom = 10;
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
                $('#Spaces_map_latitude').val(event.latLng.lat());    
                $('#Spaces_map_longitude').val(event.latLng.lng());
                }", false, EGMapEvent::TYPE_EVENT_DEFAULT);

                // If we have already created marker - show it                
                if ( !empty($model->map_latitude) && !empty($model->map_longitude) ) {
                    $marker = new EGMapMarker($model->map_latitude, $model->map_longitude, array('title' => Yii::t('spaces', $model->title),
                                    'icon'=>$icon, 'draggable'=>true), 'marker', array('dragevent'=>$dragevent));
                    $marker->addHtmlInfoWindow($info_window_a);
                    $gMap->addMarker($marker);                                    
                    $gMap->setCenter($model->map_latitude, $model->map_longitude);
                    $gMap->zoom = 10;
                    $gMap->minZoom = 10;
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
                                            $("#Spaces_map_latitude").val(event.latLng.lat());    
                                            $("#Spaces_map_longitude").val(event.latLng.lng());
                                            }', false, EGMapEvent::TYPE_EVENT_DEFAULT_ONCE));
                }

                ob_start();
                    $gMap->renderMap(array(), Yii::app()->language);
                    $map=ob_get_contents();
                ob_end_clean();
                return $map;
        }
        
        protected function SavePropsSpaces($model, $copid="") {
            
           // Запись списка свойств недвижемости
           $model_properties = new SpaceProperties();
           $properties = $this->SetProperty($model->id, 'property_id', $model_properties);
                             
           // Запись списка представителей
           $model_representatives = new SpaceRepresentatives();
           $representatives = $this->SetRepresentative($model->id, 'representative_id', $model_representatives);
                                     
           // Запись списка свойств недвижемости
           $model_similarities = new SpaceSimilarities();
           $similarities = $this->SetSimilarities($model->id, 'similaries_id', $model_similarities);
                             
           // Запись списка представителей
           $model_similarities1 = new SpaceSimilarities();
           $similarities1 = $this->SetSimilarities1($model->id, 'similaries_id', $model_similarities1);
                             
           // Запись фото орегинала недвижемости
           $file_picOreginal=$this->SetPicOreginal($model->id, $model, $copid);             
           if ($file_picOreginal->id) $attributes["pic_oreginal_id"]= $file_picOreginal->id ;                             
           else if ($file_picOreginal===null) $attributes["pic_oreginal_id"]= null ;                             
                             
           // Запись фото скриншота недвижемости                             
           $file_picScr=$this->SetPicScr($model->id, $model, $copid);           
           if ($file_picScr->id) $attributes["pic_scr_id"]= $file_picScr->id ; 
           else if ($file_picScr===null) $attributes["pic_scr_id"]=null; 
                             
           // Запись фото анонса недвижемости
           $file_picAnons=$this->SetPicAnons($model->id, $model, $copid);   
           if ($file_picAnons->id) $attributes["pic_anons_id"]= $file_picAnons->id ;                                 
           else if ($file_picAnons===null) $attributes["pic_anons_id"]=null; 
                             
           // Запись детального фото недвижемости
           $file_picDetile=$this->SetPicDetile($model->id, $model, $copid);
           if ($file_picDetile->id) $attributes["pic_detile_id"]= $file_picDetile->id ;                                                        
           else if ($file_picDetile===null) $attributes["pic_detile_id"]= null ;                                                        
                             
           // Обновление модели
           $model->attributes = $attributes;
           $model->update();                                                             
           
           // Запись вариантов недвижемости
           $model_fotos = new SpaceFotos();
           $representatives = $this->SetFotos($model->id, 'file_id', $model_fotos, $copid);
                                                          
           // Запись презентаций недвижемости
           $model_presentations = new SpacePresentations();
           $representatives = $this->SetPresentations($model->id, 'presentation_id', $model_presentations, $copid);                             
           
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

		if(isset($_POST['Spaces']))
		{
                        //echo "<pre>"; print_r($_FILES); echo "</pre>";
                        //echo "<pre>"; print_r($_POST); echo "</pre>";
                        //echo "<pre>"; var_dump($_FILES['Spaces']['name']['spaceFotos']); echo "</pre>";
                        //exit;
			$model->attributes=$_POST['Spaces'];       
                        
                        /* Перегенерация sid;
                           !TODO в дальнейшем нужно пересмотреть генерацию с формы*/                        
                        $model->sid = HRu::translit($model->title);
                        
                        $model->update_date=date('Y-m-d H:s:i');
                        $model->update_user=Yii::app()->user->id;
                        
                        if (trim($model->date_rang)<>'') $model->date_rang = date('Y-m-d',strtotime($model->date_rang));
                        else $model->date_rang=null;
                        if (trim($model->date_release)<>'') $model->date_release = date('Y-m-d',strtotime($model->date_release));
                        else $model->date_release=null;
                        
                        // Save Space
			if($model->save()) 
                        {   
                            $this->SavePropsSpaces($model);
                        }
		}

                /* Create map */
                $map = $this->_show_map($model);
                
                // Свойства недвижемости
                /*$properties = SpaceProperties::model()->findAll("space_id=".$id, 
                                          array("select"=>"property_id"));                
                $selProperties = array();
                foreach ( $properties as $key=>$val) 
                $selProperties[$val->property_id]=array("selected"=>true);*/
                
                // Представители недвижемости
                /*$representatives = SpaceRepresentatives::model()->findAll("space_id=".$model->id, 
                                          array("select"=>"representative_id"));
                $selRepresentatives = array();
                foreach ( $representatives as $key=>$val) 
                $selRepresentatives[$val->representative_id]=array("selected"=>true);*/                
                
                // Другая площадь
                /*$similarities1 = SpaceSimilarities::model()->findAll("space_id=".$model->id, 
                                          array("select"=>"similaries_id"));
                $selSimilarities1 = array();
                foreach ( $similarities1 as $key=>$val) 
                $selSimilarities1[$val->similarities_id]=array("selected"=>true);                
                
                // Схожие предложения
                $similarities = SpaceSimilarities::model()->findAll("space_id=".$model->id, 
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

        protected function SetFotos( $id, $field_id, $model, $copid="") {
            return $this->SetManyFieldFiles( $id, $field_id, "Fotos",$model,'Варианты '.Yii::t('all','space'), true, $copid);
        }

        protected function SetPresentations( $id, $field_id, $model, $copid="") {
            return $this->SetManyFieldFiles( $id, $field_id, "Presentations",$model,'Файл '.Yii::t('all','presentation'),false, $copid);
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
                                       
           //echo "<pre>"; print_r($_FILES["Spaces"]); "</pre>"; 
           $is_upfile = ( $key!==null ? $_FILES["Spaces"]["name"][$field]<>"" 
                                      : $_FILES["Spaces"]["name"][$field][$key]<>"" );           
           if ( isset($_FILES["Spaces"]["name"][$field]) && $is_upfile ) 
           {                             
               if ( $key!==null ) {
                   //echo "model:[$key]".$field;                        
                   $upfile=CUploadedFile::getInstancesByName("Spaces[".$field."]");                                      
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

                          /*$pathfull_original_file  = './uploads/files/'.$file_name;                    
                          $pathto_src_file         = './uploads/files/'.$model->tableName()."_".$uid."_src.".$upfile->extensionName;                    
                          $pathto_big_file         = './uploads/files/'.$model->tableName()."_".$uid."_big.".$upfile->extensionName;                    
                          $pathto_small_file       = './uploads/files/'.$model->tableName()."_".$uid."_small.".$upfile->extensionName;*/

                          //Используем функции расширения CImageHandler ; 
                          $ih = new CImageHandler(); //Инициализация
                          $ih->load($pathfull_original_file) //Загрузка оригинала картинки
                              ->watermark( $_SERVER['DOCUMENT_ROOT'].'/images/mywatermark.png', 5, 10, CImageHandler::CORNER_LEFT_BOTTOM)                                  
                              ->thumb('60', '40') //Создание превьюшки размером 200px
                              ->save($pathto_src_file) 
                              //Сохранение превьюшки в папку
                              ->reload() //Снова загрузка оригинала картинки
                              ->watermark( $_SERVER['DOCUMENT_ROOT'].'/images/mywatermark.png', 5, 10, CImageHandler::CORNER_LEFT_BOTTOM)                                                                    
                              ->thumb('120', '80') //Создание превьюшки размером 50px
                              ->save( $pathto_small_file)
                              //Сохранение превьюшки в папку
                              ->reload()//Снова загрузка оригинала картинки
                              ->watermark( $_SERVER['DOCUMENT_ROOT'].'/images/mywatermark.png', 10, 20, CImageHandler::CORNER_LEFT_BOTTOM)                                                                                                      
                              ->thumb('800', '600') //Создание превьюшки размером 1000px
                              ->save( $pathto_big_file)
                              //Сохранение превьюшки в папку
                            ;  
                          
                            /*$images = new RiImage();
                              $images->scr_photo->width=null;
                              $images->scr_photo->max_width=60;
                              $images->scr_photo->height=40;
                              $images->small_photo->width=null;//120;
                              $images->small_photo->height=80;
                              $images->big_photo->width=null;//800;
                              $images->big_photo->height=600;

                              // Ресайз картинок в выводом ошибок в буфер                               

                              $resize_src   = $images->resize( $pathfull_original_file, $pathto_src_file, $images->scr_photo);
                              $resize_small = $images->resize( $pathfull_original_file, $pathto_small_file, $images->small_photo);
                              $resize_big   = $images->resize( $pathfull_original_file, $pathto_big_file, $images->big_photo);                          
                            */

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

        protected function setManyFieldFiles ($id, $field_id, $field_imp, $model, $file_title="", $resize=true, $copid="" )  
        {                                         
            $field = 'space'.ucfirst($field_imp);       

                        
            $is_files = ( isset($_FILES['Spaces']["name"][$field]) && trim($_FILES['Spaces']["name"][$field])<>'' ? true : false);
            $is_postfiles = ( isset($_POST['Spaces'][$field]) && is_array($_POST['Spaces'][$field]) ? true : false) ;            
            // Save Representatives               
            if ( ($is_files || $is_postfiles) && !trim($copid)<>"" ) {
                
                // Зачистка файлов                
                $space_files=$model->findAll('space_id='.$id); $aid = $fid = array();   
                
                // Если файлы существую
                if ( $is_postfiles ) $space_postfiles = $_POST['Spaces'][$field];
                else $space_postfiles = array();

                // Формируем массив ID файлой для удаления 
                foreach( $space_files as $key=>$space_file )  {                   
                    if ( trim($space_file->file_id)<>'' && !in_array($space_file->id,$space_postfiles)) {
                        $aid[] = $space_file->file_id;
                        $fid[] = $space_file->id;
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
                        if( is_file(Yii::app()->getBasePath()."/../".$file->original_name)) {
                            unlink(Yii::app()->getBasePath()."/../".$file->original_name);
                            if ($resize) {
                                unlink(Yii::app()->getBasePath()."/../".str_replace("original","src",$file->original_name));                                                                           
                                unlink(Yii::app()->getBasePath()."/../".str_replace("original","small",$file->original_name));                                                                           
                                unlink(Yii::app()->getBasePath()."/../".str_replace("original","big",$file->original_name));                                                                           
                            }
                        }
     
                    }                    
                    
                    // Удаление записей в таблице файлов недвижемости  
                    $model->deleteAll('space_id='.$id.' and id in ('.$fList_id.')'); $errors = array();                                      
                }             
                
                
                if ( $is_files ) {
                    foreach ($_FILES['Spaces']['name'][$field] as $key=>$pfile )
                    {                                              
                        $file = $this->SaveFile($id, $model, $field, $file_title, true, $key, $resize );

                        if ( $file && empty($file->errors)) {

                             $attributes = array( "space_id" => $id, 'file_id' => $file->id );
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
                
            } else if ( ($is_files || $is_postfiles) && trim($copid)<>"" ) {
                /*echo $copid;
                exit;*/
                // Зачистка файлов                
                $space_files=$model->findAll('space_id='.$copid); //$aid = $fid = array();   
                
                // Если файлы существую
                if ( $is_postfiles ) $space_postfiles = $_POST['Spaces'][$field];
                else $space_postfiles = array();

                // Формируем массив ID файлой для копирования
                foreach( $space_files as $key=>$space_file )  {                   
                    if ( trim($space_file->file_id)<>'' && in_array($space_file->id,$space_postfiles)) {
                        $aid[] = $space_file->file_id;
                        $fid[] = $space_file->id;                        
                    }                    
                }
                                                       
                // Если массив не пустой копируем файлы и таблицы файлов и списка файлов свойства недвижемости   
                if (is_array($aid) && !empty($aid) ) {

                    
                    $aList_id = implode(",",$aid);
                    $fList_id = implode(",",$fid);

                    $files=Files::model()->findAll("id in (".$aList_id.")", array('select'=>'id, original_name') );                               
                                        
                    // Копирование записей
                    foreach( $files as $key=>$file ) {                                    
                                            
                        if( is_file(Yii::app()->getBasePath()."/../".$file->original_name)) 
                        {                            
                            $file_old = Yii::app()->getBasePath()."/../".$file->original_name;                            
                            $Ri = new Ri(); $uid=$Ri->genid();
                            
                            $pathto_original = "uploads/files";                            
                            $file_name =  $model->tableName()."_".$uid."_original.".$file->ext;                                        
                            $path_original_file = $pathto_original."/".$file_name;                                                        
                            $file_new = Yii::app()->getBasePath()."/../".$path_original_file;
                            
                            copy($file_old,$file_new);
                            
                            if ($resize) {
                                //echo $file_old."<br/>".$file_new;
                                
                                copy(str_replace("original","src",$file_old),
                                     str_replace("original","src",$file_new));
                                copy(str_replace("original","small",$file_old),
                                     str_replace("original","small",$file_new));                                                                           
                                copy(str_replace("original","big",$file_old),
                                     str_replace("original","big",$file_new));                                                                           
                            }
                        }     

                        // Запись записей в таблице файлов недвижемости  
                        
                        $file_new = new Files(); $file_id = $file_new->id;
                        $file_new->attributes = $file->attributes;
                        $file_new->id = $file_id;

                        if ( $file_new->save()) 
                        {                        
                            $model_new = new $model;
                            $model_new->attributes = array("space_id"=>$id, "file_id"=>$file_new->id);
                            $model_new->save();
                        }
                    }                        
                }                             
                
                if ( $is_files ) {
                    foreach ($_FILES['Spaces']['name'][$field] as $key=>$pfile )
                    {                                              
                        $file = $this->SaveFile($id, $model, $field, $file_title, true, $key, $resize );

                        if ( $file && empty($file->errors)) {

                             $attributes = array( "space_id" => $id, 'file_id' => $file->id );
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
                                   
          $field = 'space'.ucfirst($field);
          // Save Representatives                                                 
          if (isset($_POST['Spaces'][$field])) 
          {            
              $errors = array(); 
              if ( $linking_id==null ) $model->deleteAll('space_id='.$id);    
              else $model->deleteAll('space_id='.$id.' and space_linking_id='.$linking_id);    
              
              //print_r($_POST['Spaces'][$field]);
              
              foreach ($_POST['Spaces'][$field] as $key=>$many )
              { 
                if ( $linking_id===null ) {  
                    $attributes = array( "space_id" => $id, $field_id => $many,);
                }else{
                    $attributes = array( "space_id" => $id, $field_id => $many, "space_linking_id"=>$linking_id);
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
              
              if ( $linking_id==null ) $model->deleteAll('space_id='.$id);    
              else $model->deleteAll('space_id='.$id.' and space_linking_id='.$linking_id);   
              
              return false;
          }          
        }
        
        
        protected function SetPicDetile($id, $model, $copid="") {
            return $this->SetPic($id, $model, 'pic_detile_id','Картинка детально '. Yii::t('all','space'), $copid);
        }

        protected function SetPicAnons($id, $model, $copid="" ) {
            return $this->SetPic($id, $model, 'pic_anons_id','Анонс картинки '. Yii::t('all','space'), $copid);
        }

        protected function SetPicOreginal($id, $model, $copid="" ) {
            return $this->SetPic($id, $model, 'pic_oreginal_id','Орегинал '. Yii::t('all','space'), $copid);
        }

        protected function SetPicScr($id, $model, $copid="" ) {
            return $this->SetPic($id, $model, 'pic_scr_id','Скриншот '. Yii::t('all','space'),$copid);
        }
        
        protected function SetPic($id, $model, $field_imp,$file_title, $copid="") {

          if ( !(is_array($exts)) ) {
              $exts=array('jpg','jpeg','png');
          } 
          
          $field = str_replace("_", "", $field_imp);
          $field = str_replace("id", "", $field);
          $field = str_replace("pic", "", $field);
          $field = "pic".ucfirst($field);

          //Yii::app()->end();
          //print_r($_FILES); 
          //echo "<br/>".trim($_FILES['Spaces']["name"][$field]);
          //exit;
                                 
          $file = $this->SaveFile($id, $model, $field, $file_title, false );             
          
          if ( is_object($file) ) {                                                                         
                                                 
             if (isset($_POST['Spaces'][$field_imp]) && trim($_POST['Spaces'][$field_imp])<>"" && trim($copid)==="" ) 
             {                             
               
               $file_record = Files::model()->find('id=:id', array(':id'=>$_POST['Spaces'][$field_imp]));
               
               //echo $_POST['Space'][$field_imp];
               //echo "<pre>"; print_r($file_record); echo "<pre/>";
          
               // Save upload files Many Field             
                   
               if ($file_record) {                   
                   
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
                   
                   $file_record->attributes=$attributes;
                  
                   // Зачистка файлов
                   $file_old=Files::model()->findAll('id='.$file_record->id);  
             
                   if( is_file(Yii::app()->getBasePath()."/../".$file_old->original_name)) {
                       unlink(Yii::app()->getBasePath()."/../".$file_old->original_name);
                       unlink(Yii::app()->getBasePath()."/../".str_replace("original","src",$file_old->original_name));                                                                           
                       unlink(Yii::app()->getBasePath()."/../".str_replace("original","small",$file_old->original_name));                                                                           
                       unlink(Yii::app()->getBasePath()."/../".str_replace("original","big",$file_old->original_name));                                                                           
                   }
             
               }else $file_record = $file;
             }else $file_record = $file;                                           
             
             if ( $file_record->save() ) {                 
                 return $file_record; /* echo "Файл орегинала записан" */;       
             }                              
          } 

          // Удаление если не существует
          if ( !isset($_POST['Spaces'][$field_imp]) && trim($model->$field_imp)<>"" && trim($copid)==="" ) 
          {  
             /*!@TODO Проверить */   
             // Зачистка файлов
             $file_old=Files::model()->find('id=:id', array(':id'=>$model->$field_imp));               
             
             if( is_file(Yii::app()->getBasePath()."/../".$file_old->original_name)) {
                 unlink(Yii::app()->getBasePath()."/../".$file_old->original_name);
                 unlink(Yii::app()->getBasePath()."/../".str_replace("original","src",$file_old->original_name));                                                                           
                 unlink(Yii::app()->getBasePath()."/../".str_replace("original","small",$file_old->original_name));                                                                           
                 unlink(Yii::app()->getBasePath()."/../".str_replace("original","big",$file_old->original_name));                                                                           
             }                 
                                                 

             Files::model()->deleteAll('id='.$model->$field_imp);   
             return null; 
          
          // Копирование файлов изображения недвижемости                          
          } else if ( isset($_POST['Spaces'][$field_imp]) && trim($model->$field_imp)<>"" && trim($copid)<>"" ) {
             
             $file_copy=Files::model()->find('id=:id', array(':id'=>$model->$field_imp));               
             
             /*if ($field_imp == "pic_oreginal_id") {
                echo "<pre>"; print_r($file_copy->attributes); echo "</pre>";
                exit;
             }*/
                     
             $file_record = new Files();  $id=$file_record->id;           
             $file_record->attributes = $file_copy->attributes;
             $file_record->id = $id;
             
             if ( $file_record->save() ) {
                 return $file_record;   
             }else{
                return false; 
             }
          } else {
             return false;              
          }
                    
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
		$dataProvider=new CActiveDataProvider('Spaces');
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
                
		$model=new Spaces('search');                
		$model->unsetAttributes();  // clear any default values                

                if( !isset($_POST['Spaces']) ) $_POST = $_GET;

                
		if( isset($_POST['Spaces'])) :
                        
                        // Station metros on maps
                    
                        if ( isset($_POST['metro']) && !empty($_POST['metro']) ) {
                                
                                $criteria_mapid=new CDbCriteria;
                                $criteria_mapid->select= 'id,mapid';
                                $criteria_mapid->addInCondition('mapid',$_POST['metro']);
                                $mets = Metros::model()->findAll($criteria_mapid);
                                $mets_map = array();
                                foreach ( $mets as $met) {                                    
                                    $mets_map[]=$met->id;
                                }                                     
                                $_POST['Spaces']['metro_id']=$mets_map;                                                                 
                        }
                            
			$model->attributes=$_POST['Spaces'];                        
                        
                        if ( !empty($_POST['remoteness-from']) && !empty($_POST['remoteness-to'])) 
                            $model->getDbCriteria()->addBetweenCondition('remoteness', 
                                $_POST['remoteness-from'], $_POST['remoteness-to']);                          

                        if ( !empty($_POST['date_rang-from']) && !empty($_POST['date_rang-to']) )    
                            $model->getDbCriteria()->addBetweenCondition('date_rang', 
                                date('Y-m-d', strtotime($_POST['date_rang-from'])), date('Y-m-d', strtotime($_POST['date_rang-to'])));                

                        if ( !empty($_POST['date_release-from']) && !empty($_POST['date_release-to']) )    
                            $model->getDbCriteria()->addBetweenCondition('date_release', 
                                date('Y-m-d', strtotime($_POST['date_release-from'])), date('Y-m-d', strtotime($_POST['date_release-to'])));                
                       
                        if ( !empty($_POST['area-from']) && !empty($_POST['area-to'])) 
                             $model->getDbCriteria()->addBetweenCondition('area', 
                                $_POST['area-from'], $_POST['area-to']);                
                         
                        if ($_POST["is_conv"]) {
                            if ( !empty($_POST['price_from']) && !empty($_POST['price_to'])) {
                                
                                Yii::app()->currency->to = $model->valute->title;
                
                                $ainfo_curs = $this->__isCurs();
                
                                Yii::app()->currency->from =$ainfo_curs;  
                                Yii::app()->currency->timeCacheComp = 0;
                                Yii::app()->{Yii::app()->currency->nameCacheComp}->delete('currency');
                                Yii::app()->currency->init();
                
                
                                if (!empty($ainfo_curs) ) {
                                    
                                    $home_sel = "";//IF( v.title='".Yii::app()->currency->to."', t.price,";
                                    $end_sel = "";
                                    foreach ( $ainfo_curs as $key=>$val) {
                                        $home_sel.= "IF( v.title='".$val["name"]."', t.price*".Yii::app()->currency->$val["name"]." ,";// t.price)) as `price`';
                                        $end_sel.= ")";
                                    }
                                    $home_sel.= " t.price";                                    
                                    $select = $home_sel.$end_sel;
                                    
                                    $model->valute_id=null;
                                    
                                    $condition = $select.' BETWEEN '.$_POST['price_from'].' AND '.$_POST['price_to'];
                                    $model->getDbCriteria()->addCondition($condition);                                                                        
                                    $model->getDbCriteria()->join= $model->getDbCriteria()->join.' '.' LEFT JOIN valutes v on v.id=t.valute_id ';
                                    
                                }else{
                                    $model->getDbCriteria()->addBetweenCondition('price', 
                                            $_POST['price_from'], $_POST['price_to']);               
                                }                                                                                                                                                              
                            }
                             
                        }else{
                            if ( !empty($_POST['price_from']) && !empty($_POST['price_to'])) 
                                $model->getDbCriteria()->addBetweenCondition('price', 
                                            $_POST['price_from'], $_POST['price_to']);               
                        }
                        
                        
                        if ( isset($_POST['polygon']) && !empty($_POST['polygon']) ) {
                            
                            $model->getDbCriteria()->addBetweenCondition('map_longitude',
                                    $model->getMinLongCoord($_POST['polygon']),
                                    $model->getMaxLongCoord($_POST['polygon']));              
                            $model->getDbCriteria()->addBetweenCondition('map_latitude',
                                    $model->getMinLatCoord($_POST['polygon']),
                                    $model->getMaxLatCoord($_POST['polygon']));
                        }
                        
                        // Search for Space Properties
                        if ( isset($_POST["Spaces"]["spaceProperties"]) && !empty($_POST["Spaces"]["spaceProperties"])) {
                            
                            if ( !intval($_POST["is_many_properties"]) ) {
                                $model->getDbCriteria()->with['spaceProperties'] = array(
                                            'select' => false,
                                            'together' => true,
                                            'condition' => 'spaceProperties.property_id IN ('
                                                            .implode(',', $_POST["Spaces"]["spaceProperties"]).')' ,                
                                );                                
                                
                            }else{
                                $model->getDbCriteria()->with['spaceProperties'] = array(
                                            'select' => false,
                                            'together' => true,
                                            'condition' => 'spaceProperties.property_id IN ('
                                                          .implode(',', $_POST["Spaces"]["spaceProperties"]).')'
                                                          .' AND ('.'(SELECT COUNT(*) FROM space_properties sp '
                                                                    .' WHERE spaceProperties.space_id=sp.space_id AND sp.property_id IN ('
                                                                        .implode(',', $_POST["Spaces"]["spaceProperties"]).') GROUP BY space_id)='
                                                                    .count($_POST["Spaces"]["spaceProperties"]).')',                
                                            );
                                
                            }

                        }
                        
                        // Search for Space Representatives
                        if ( isset($_POST["Spaces"]["spaceRepresentatives"]) && !empty($_POST["Spaces"]["spaceRepresentatives"])) {
                            
                            /*if ( !intval($_POST["is_many_representatives"]) ) {
                                $model->getDbCriteria()->with['spaceRepresentatives'] = array(
                                            'select' => false,
                                            'together' => true,
                                            'condition' => 'spaceRepresentatives.representative_id IN ('
                                                            .implode(',', $_POST["Spaces"]["spaceRepresentatives"]).')' ,                
                                );                                
                                
                            }else{
                                $model->getDbCriteria()->with['spaceRepresentatives'] = array(
                                            'select' => false,
                                            'together' => true,
                                            'condition' => 'spaceRepresentatives.representative_id IN ('
                                                          .implode(',', $_POST["Spaces"]["spaceRepresentatives"]).')'
                                                          .' AND ('.'(SELECT COUNT(*) FROM space_representatives sr '
                                                                    .' WHERE spaceRepresentatives.space_id=sr.space_id AND sr.representative_id IN ('
                                                                       .implode(',', $_POST["Spaces"]["spaceRepresentatives"]).') GROUP BY space_id)='
                                                                    .count($_POST["Spaces"]["spaceRepresentatives"]).')',                
                                            );
                                
                            }*/
                            if ( !intval($_POST["is_many_representatives"]) ) {
                                $model->getDbCriteria()->with['spaceRepresentatives'] = array(
                                            'select' => false,
                                            'together' => true,
                                            'condition' => 'spaceRepresentatives.representative_id IN ('
                                                            .( is_array($_POST["Spaces"]["spaceRepresentatives"]) 
                                                             ? implode(',', $_POST["Spaces"]["spaceRepresentatives"]) 
                                                             : $_POST["Spaces"]["spaceRepresentatives"]).')' ,                
                                );                                
                                
                            }else{
                                $model->getDbCriteria()->with['spaceRepresentatives'] = array(
                                            'select' => false,
                                            'together' => true,
                                            'condition' => 'spaceRepresentatives.representative_id IN ('
                                                          .( is_array($_POST["Spaces"]["spaceRepresentatives"]) 
                                                             ? implode(',', $_POST["Spaces"]["spaceRepresentatives"]) 
                                                             : $_POST["Spaces"]["spaceRepresentatives"]).')'                                    
                                                          .' AND ('.'(SELECT COUNT(*) FROM space_representatives sr '
                                                                    .' WHERE spaceRepresentatives.space_id=sr.space_id AND sr.representative_id IN ('
                                                                       .( is_array($_POST["Spaces"]["spaceRepresentatives"]) 
                                                                          ? implode(',', $_POST["Spaces"]["spaceRepresentatives"]) 
                                                                          : $_POST["Spaces"]["spaceRepresentatives"]).') GROUP BY space_id)='
                                                                    .count($_POST["Spaces"]["spaceRepresentatives"]).')',                
                                            );
                                
                            }

                        }
                        
                        if ( !empty($_POST['Contact_telephone'])) {                          
                            $like_representative_telephone = str_replace(")","_",$_POST['Contact_telephone']);
                            $like_representative_telephone = str_replace("(","_",$like_representative_telephone);
                            $like_representative_telephone = str_replace("x","_",$like_representative_telephone);
                            $like_representative_telephone = str_replace("8","_",$like_representative_telephone);
                            
                            /*$model->getDbCriteria()->with['spacesRepresentatives'] = array(
                                            'select' => false,
                                            'together' => true,
                                            'condition' => "spacesRepresentatives.telephone LIKE '%".$like_representative_telephone."%'"
                            );*/
                            
                            /*$model->getDbCriteria()->with['representative'] = array(
                                            'select' => false,
                                            'together' => true,
                                            'condition' => "representative.telephone LIKE '%".$like_representative_telephone."%'",                        
                            );*/
                                                                      
                            $criteria = new CDbCriteria();                            
                            $criteria->with['spacesRepresentatives'] = array(
                                            'select' => false,
                                            'together' => true,
                                            //'condition' => "spacesRepresentatives.telephone LIKE '%".$like_representative_telephone."%'"
                            );                            
                            $criteria->with['representative'] = array(
                                            'select' => false,
                                            'together' => true,
                                            //'condition' => "representative.telephone LIKE '%".$like_representative_telephone."%'",                        
                            );                            
                            $criteria->condition ="((spacesRepresentatives.telephone LIKE '%".$like_representative_telephone."%') OR (representative.telephone LIKE '%".$like_representative_telephone."%'))";
                            
                            $model->getDbCriteria()->mergeWith($criteria);
                                
                        }                        
                            
                        // Search for Space Similarities1 
                        if ( isset($_POST["Spaces"]["spaceSimilarities1"]) && !empty($_POST["Spaces"]["spaceSimilarities1"])) {
                            
                            if ( !intval($_POST["is_many_similarities1"]) ) {
                                $model->getDbCriteria()->with['spaceSimilarities1'] = array(
                                            'select' => false,
                                            'together' => true,
                                            'condition' => 'spaceSimilarities1.similaries_id IN ('
                                                            .implode(',', $_POST["Spaces"]["spaceSimilarities1"]).')' ,                
                                );                                
                                
                            }else{
                                $model->getDbCriteria()->with['spaceSimilarities1'] = array(
                                            'select' => false,
                                            'together' => true,
                                            'condition' => 'spaceSimilarities1.similaries_id IN ('
                                                          .implode(',', $_POST["Spaces"]["spaceSimilarities1"]).')'
                                                          .' AND ('.'(SELECT COUNT(*) FROM space_similarities ss '
                                                                    .' WHERE spaceSimilarities1.space_id=ss.space_id AND ss.similaries_id IN ('
                                                                        .implode(',', $_POST["Spaces"]["spaceSimilarities1"]).') GROUP BY space_id)='
                                                                    .count($_POST["Spaces"]["spaceSimilarities1"]).')',                
                                            );
                                
                            }

                        }
                        
                        // Search for Space Similarities
                        if ( isset($_POST["Spaces"]["spaceSimilarities"]) && !empty($_POST["Spaces"]["spaceSimilarities"])) {
                            
                            if ( !intval($_POST["is_many_similarities"]) ) {
                                $model->getDbCriteria()->with['spaceSimilarities'] = array(
                                            'select' => false,
                                            'together' => true,
                                            'condition' => 'spaceSimilarities.similaries_id IN ('
                                                            .implode(',', $_POST["Spaces"]["spaceSimilarities"]).')' ,                
                                );                                
                                
                            }else{
                                $model->getDbCriteria()->with['spaceSimilarities'] = array(
                                            'select' => false,
                                            'together' => true,
                                            'condition' => 'spaceSimilarities.similaries_id IN ('
                                                          .implode(',', $_POST["Spaces"]["spaceSimilarities"]).')'
                                                          .' AND ('.'(SELECT COUNT(*) FROM space_similarities ss '
                                                                    .' WHERE spaceSimilarities.space_id=ss.space_id AND ss.similaries_id IN ('
                                                                        .implode(',', $_POST["Spaces"]["spaceSimilarities"]).') GROUP BY space_id)='
                                                                    .count($_POST["Spaces"]["spaceSimilarities"]).')',                
                                            );
                                
                            }

                        }
                                                
                endif;               

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
		$model=Spaces::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='spaces-form')
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
                $spaces = Spaces::model()->findAll($criteria);
                // обрабатываем результат
                $result = array();
                foreach($spaces as $space) {
                    $lable = '№'.$space['id'].' '.$space[$field];
                    $result[] = array('id'=>$space['id'], 'label'=>$lable, 'value'=>$space[$field]);
                }
                echo CJSON::encode($result);
                Yii::app()->end();
            }
        }
        
        public function actionAjaxShowPromCurrenty($vid,$price_from,$price_to,$is_conv) 
        {    
            if( Yii::app()->request->isAjaxRequest ) {
                
                $model = new Spaces();
                $model->valute_id = $vid;
                
                $curr_valute = Valutes::model()->findByPk($vid);
                
                Yii::app()->currency->to = $curr_valute->title;
                
                $ainfo_curs = $this->__isCurs();
                
                Yii::app()->currency->from =$ainfo_curs;  
                Yii::app()->currency->timeCacheComp = 0;
                Yii::app()->{Yii::app()->currency->nameCacheComp}->delete('currency');
                Yii::app()->currency->init();
                
                $form = new CActiveForm();
                $this->renderPartial( '_currency_search', array('model'=>$model,
                                                         'price_from'=>$price_from,
                                                         'price_to'=>$price_to,
                                                         'is_conv'=>$is_conv,
                                                         'form' =>$form,
                                                         'is_ajax'=>true,
                                                         'is_curs'=>!empty($ainfo_curs)));
                Yii::app()->end();
            }
        }

        public function actionAjaxShowCurrenty($vid,$price) 
        {    
            if( Yii::app()->request->isAjaxRequest ) {
                
                $model = new Spaces();
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

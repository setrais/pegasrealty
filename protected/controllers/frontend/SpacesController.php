<?php

class SpacesController extends FrontendController
{
	 
        public $layout='//layouts/main';
        
        /**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{                               
               
            // renders the view file 'protected/views/site/index.php'
	    // using the default layout 'protected/views/layouts/main.php'               
            if ( /*Yii::app()->user->isGuest*/ !Yii::app()->user->checkAccess('superadmin')) { 
                 $this->layout='//layouts/default';
                 $this->render('site/index');
            }else{
                    
                 $metro_stantions = Metros::model()->findAll("(mapid is not null)and((act is null)or(act=1))and((del is null)or(del=0))", array('select'=>'id, mapid, coords_map, shape_map, pointerid, style_pointer_map') );                                                                       
                 //echo "<pre>"; print_r($metro_stantions); echo "</pre>";
                 $metro_lines_dok = Manies::model()->findAll("(groups='O')and((act is null)or(act=1))and((del is null)or(del=0))", array('select'=>'sid, coords_map, shape_map, style_map') );                                                   
                 //echo "<pre>"; print_r($metro_lines_dok); echo "</pre>";
                 $metro_lines = Manies::model()->findAll(array("condition"=>"(groups='L' or groups='K' )and((shape_map is not null) or (shape_map<>''))and((act is null)or(act=1))and((del is null)or(del=0))", 'select'=>'sid, groups, title, coords_map, shape_map, style_map','order'=>'sort') );                                                                       
                 $metro_slines = Manies::model()->findAll(array("condition"=>"(groups='L')and((shape_map is not null) or (shape_map<>''))and((act is null)or(act=1))and((del is null)or(del=0))", 'select'=>'sid, groups, title, coords_map, shape_map, style_map, linesort','order'=>'linesort') );                                                                       
                 $metro_gstations = Manies::model()->findAll(array("condition"=>"(groups='K')and((shape_map is not null) or (shape_map<>''))and((act is null)or(act=1))and((del is null)or(del=0))", 'select'=>'sid, groups, title, coords_map, shape_map, style_map, linesort','order'=>'linesort') );                                                                       
                 $metro_saos = Manies::model()->findAll(array("condition"=>"(groups='R')and((act is null)or(act=1))and((del is null)or(del=0))", 'select'=>'sid, pid, groups, title, coords_map, shape_map, style_map, linesort') );                                                                                           
                 $metro_childs = Manies::model()->findAll(array("condition"=>"(groups='P')and((act is null)or(act=1))and((del is null)or(del=0))", 'select'=>'sid, pid, groups, title, coords_map, shape_map, style_map, linesort') );                                                                                           
                 $childs = array();
                 
                 foreach ($metro_saos as $key=>$sao) {                                                                        
                    foreach ( $metro_childs as $cey=>$child ) {
                        if ( $child->pid === $sao->sid ) {
                             $childs[$sao->sid][] =  $child;
                        }
                    }   
                 }
                    
                    //$metro_lines = Manies::model()->findAll("(groups='L')and((shape_map is not null) or (shape_map<>''))and((act is null)or(act=1))and((del is null)or(del=0))", array('select'=>'sid, groups, title, coords_map, shape_map, style_map','sort'=>'sort asc') );
                    //echo "<pre>"; print_r($metro_lines_dok); echo "</pre>";
                    
                    $metros["stations"] = $metro_stantions;
                    $metros["lines_dok"]= $metro_lines_dok;
                    $metros["lines"]    = $metro_lines;
                    $metros["slines"]   = $metro_slines;
                    $metros["saos"]     = $metro_saos;
                    $metros["childs"]   = $childs;
                    $metros["gstations"]= $metro_gstations;
                    
                    $model=new Spaces('search'); 
                    
                    if( !isset($_POST['Spaces']) ) $_POST = $_GET;

                
                    if( isset($_POST['Spaces'])) :

                            if ( is_array($_POST['Spaces']['operation_id']) && $_POST['Spaces']['operation_id'][0]==="") {                                                                                                  
                                 $_POST['Spaces']['operation_id']=null;
                            }   

                            if ( is_array($_POST['Spaces']['unit_id']) && $_POST['Spaces']['unit_id'][0]==="") {                                                                                                  
                                 $_POST['Spaces']['unit_id']=null;
                            }   
                            
                            if ( is_array($_POST['Spaces']['valute_id']) && $_POST['Spaces']['valute_id'][0]==="") {                                                                                                  
                                 $_POST['Spaces']['valute_id']=null;
                            }   
                            
                                                                
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
                            
                            //print_r($_POST['Spaces']['metro_id']);
                            $model->attributes=$_POST['Spaces'];                        
                            
                            if ( trim($_POST['remoteness-from'])<>'' && trim($_POST['remoteness-to'])<>'') 
                                $model->getDbCriteria()->addBetweenCondition('remoteness', 
                                    $_POST['remoteness-from'], $_POST['remoteness-to']);                          

                            if ( trim($_POST['area-from'])<>'' && trim($_POST['area-to'])<>'') 
                                 $model->getDbCriteria()->addBetweenCondition('area', 
                                    $_POST['area-from'], $_POST['area-to']);                

                            /*if ( isset($_POST["is_conv"]) && $_POST["is_conv"] ) {
                                if ( trim($_POST['price-from'])<>'' && trim($_POST['price-to'])<>'') {

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

                                        $condition = $select.' BETWEEN '.$_POST['price-from'].' AND '.$_POST['price-to'];
                                        $model->getDbCriteria()->addCondition($condition);                                                                        
                                        $model->getDbCriteria()->join= $model->getDbCriteria()->join.' '.' LEFT JOIN valutes v on v.id=t.valute_id ';

                                    }else{
                                        $model->getDbCriteria()->addBetweenCondition('price', 
                                                $_POST['price-from'], $_POST['price-to']);               
                                    }                                                                                                                                                              
                                }

                            }else{*/
                                if ( trim($_POST['price-from'])<>'' && trim($_POST['price-to'])<>'') 
                                    $model->getDbCriteria()->addBetweenCondition('price', 
                                                $_POST['price-from'], $_POST['price-to']);               
                            /*}*/


                            if ( isset($_POST['polygon']) && !empty($_POST['polygon']) ) {
                                                                 
                                $model->getDbCriteria()->addBetweenCondition('map_longitude',
                                        $model->getMinLongCoord($_POST['polygon']),
                                        $model->getMaxLongCoord($_POST['polygon']));              
                                $model->getDbCriteria()->addBetweenCondition('map_latitude',
                                        $model->getMinLatCoord($_POST['polygon']),
                                        $model->getMaxLatCoord($_POST['polygon']));
                            }
                            
                            //print_r($_POST);
                            // Search for Space Properties
                            /*if ( isset($_POST["Spaces"]["spaceProperties"]) && !empty($_POST["Spaces"]["spaceProperties"])) {

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

                            }*/

                    endif;               

                    $map = $this->_show_map_poligon($model);                
                                                        
                    $model_claim=new ClaimSendForm;

                    $this->render( 'index', 
                                   array( 'metros'=>$metros, 
                                          'map'=>$map,
                      		  	  'model'=>$model,
                                          'model_claim'=>$model_claim));
                    
                    //$this->redirect(Yii::app()->user->loginUrl);
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
        
        protected function _show_map_poligon($model) {
                                               
            Yii::import('ext.EGMap.*');
            
            Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/polygon/polygon.core.js');            
            
            $gMap = new EGMap();
            $gMap->setWidth(932);
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
            $gMap->zoom = 11;            
            $gMap->minZoom = 11;   
            $gMap->minZoom = 13;   
            //$gMap->centerOnPolygons();
            //$gMap->zoomOnPolygons(0.1); 
            //$gMap->enableLatLonControl();
            
            // Saving coordinates after polygons.
            $gMap->appendMapTo('#mapsearch');                          
            
            return $gMap;

        }

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{            
                $model = $this->loadModel($id);
                $model_claim=new ClaimSendForm;
                
		$this->render('view',array(
			'model'=>$model,
                        'map'=>$this->_view_map($model),
                        'model_claim'=>$model_claim,
		));
	}


        /**
         * Delete of the Fav Space 
         */
        public function actionFavDelete($id)
        {
            if ( in_array($id, Yii::app()->cache->get("favs")) ) {               
                
                $favs_new=array();
                $favs_old=Yii::app()->cache->get("favs");
                
                foreach($favs_old as $key=>$fav) {
                    if ($fav!==$id) {
                        $favs_new[]=$fav;
                    }
                }                
                
                Yii::app()->cache->set("favs",$favs_new);
            }
        }
        
        /**
         * Delete of the Fav Space 
         */
        public function actionFavAdd($id)
        {
           if( Yii::app()->request->isAjaxRequest ) 
           {  
                 $favs = Yii::app()->cache->get("favs");

                 if ( !in_array($id, $favs) ) {                                               
                    array_push($favs, $id);
                    Yii::app()->cache->set("favs",$favs);                 
                 }

                 $space = Spaces::model()->findByPk($id);
                 echo $space->nid;
                 Yii::app()->end();
           }
        }
        
        /**
         * Create From Send of the Fav Space
         */
        public function actionCreateFavSend($id)
        {
            if( Yii::app()->request->isAjaxRequest ) {  
               echo $id; 
               Yii::app()->end();
            }
        }
        
        /**
         * Send of the Fav Space
         */
        public function actionFavSend()
        {
            if( Yii::app()->request->isAjaxRequest ) {  
                $model=new ClaimSendForm;
		if(isset($_POST['ClaimSendForm']))
		{
                        $nid = $_POST['ClaimSendForm']['nid'];
                        
                        $space_claim = Spaces::model()->findByPk($nid);
                        $_POST['ClaimSendForm']['nid'] = $space_claim->nid;
                        
			$model->attributes=$_POST['ClaimSendForm'];
                        
			if($model->validate())
			{
                                $body = "Прошу Вас рассмотреть заявку на недвижемсоть №".$model->nid." \r\n";
                                $body.= "\r\n";
                                $body.= "Мои реквезиты \r\n";
                                if (trim($model->fio)<>"") $body.= "Ф.И.О. : ".$model->fio." ;  \r\n";
                                if (trim($model->phone)<>"") $body.= "Телефон: ".$model->phone."; \r\n";
                                if (trim($model->email)<>"") $body.= "E-mail : ".$model->email."; \r\n";
                                if (trim($model->company)<>"") $body.= "Компания арендатора : \r\n";
                                if (trim($model->company)<>"") $body.= $model->company." \r\n";
                                if (trim($model->info)<>"") $body.= "К сведенью владельца: \r\n";
                                if (trim($model->info)<>"") $body.= $model->info." \r\n";                                
                                
				$headers="From: {$model->email}\r\nReply-To: {$model->email}";
                                
                                /*$files = array();
                                $pathtofile=$this->actionPdf($nid, 'present_'.$model->nid);
                                $files[$pathtofile] = 'present_'.$model->nid.'.pdf';
                                $mail = new MailHelper;
                                $mail->SendMail($model->email, $model->subject, $body, $files);*/
                                                               
				mail(Yii::app()->params['adminEmail'],$model->subject,$body,$headers);
				//Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				//$this->refresh();                                
                                echo $model->nid;
			}
		}                         
                Yii::app()->end();
            }
        }

        /**
         * View Space on pdf of the format
         */
        public function actionPdf($id, $filename=null) {
            
            $model = $this->loadModel($id);
            $model_claim=new ClaimSendForm;
                
             
           /*# mPDF
           $mPDF1 = Yii::app()->ePdf->mpdf();*/

           # Вы можете с легкостью переопределить параметры по умолчанию для конструктора            
           $mPDF1 = Yii::app()->ePdf->mpdf('', 'A4', 0, '', 5, 5, 6, 6, 4, 4, 'P');

           # render (полная страница page)
           /*$mPDF1->WriteHTML( $this->render(
                              'view',
                              array( 'model'=>$model,
                                     'map'=>$this->_view_map($model),
                                     'model_claim'=>$model_claim,
                              ))
                            );*/

           /* Загрузить таблицу стилей в документ*/           

           $stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css') ."/screen.css" );
           $mPDF1->WriteHTML($stylesheet, 1);     

           $stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css') ."/print.css" );
           $mPDF1->WriteHTML($stylesheet, 1);    

           $stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css') ."/frontend/form.css" );
           $mPDF1->WriteHTML($stylesheet, 1);                
           
           $stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css') ."/main.css" );
           $mPDF1->WriteHTML($stylesheet, 1);     
           
           $stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css') ."/print_pdf.css" );
           $mPDF1->WriteHTML($stylesheet, 1);     
                                  
           # renderPartial (только представление текущего контроллера)
           //$mPDF1->WriteHTML($this->renderPartial('index', array(), true));
           $html = $this->renderPartial(
                                  'view_print', 
                                  array( 'model'=>$model,
                                         'map'=>$this->_view_map($model),
                                         'model_claim'=>$model_claim), 
                                  true);                                 
           $mPDF1->WriteHTML( $html ); 
           # Отрисовка картинки в документе
           //$mPDF1->WriteHTML(CHtml::image(Yii::getPathOfAlias('webroot.css') . '/bg.gif' ));

           # Вывод готового PDF
           if ($filename==null) $mPDF1->Output();
           else {
               $pathtofile = Yii::getPathOfAlias('webroot') . '/tmp/files/' . $filename . '.pdf';
               $mPDF1->Output($pathtofile, EYiiPdf::OUTPUT_TO_FILE);
               return $pathtofile; 
           }
           
        
           /*$html2pdf = Yii::app()->ePdf->HTML2PDF();
           $html2pdf->setDefaultFont('Arial');   
           $html = $this->renderPartial(
                                  'view_print', 
                                  array( 'model'=>$model,
                                         'map'=>$this->_view_map($model),
                                         'model_claim'=>$model_claim), 
                                  true);                                 
           $html2pdf->WriteHTML( $html ); 
           $html2pdf->Output();(*/
        }
        
        /**
         * Displays of the Favs spaces
         */
        public function actionFavs()
        {
                $cache=Yii::app()->cache;
                
                $filtersForm=new FiltersForm;                
                
                if (isset($_GET['FiltersForm'])) {                   
                   $filtersForm->filters=$_GET['FiltersForm'];                    
                }

                //$cache->set('favs',array("45","41"));
                
                /*!TODO Заменить данные избранного из кеша */
                if ( isset($cache["favs"]) && !empty($cache["favs"])) {                                
                    $model = Spaces::model();
                    $model->getDbCriteria()->addInCondition('id', $cache->get('favs'));
                    $rawData=$model->findAll();
                    
                }else{                    
                    $rawData = array();                                
                }
                
                $dataProvider=new CArrayDataProvider( $rawData, array(
                                    'id'=>'id',
                                    'sort'=>array( 'attributes'=>
                                              array( 'nid','title','space_vid_id','space_class_id',
                                                     'district_id','metro_id','remoteness',
                                                     'area','price','valute_id','fav','space_type_id',
                                                     'operation_id' ),
                                                 ),
                                    'pagination'=>array('pageSize'=>10),
                                ));                      
                
                $model = new ClaimSendForm;
                
                $this->render( 'favs', array( 'filtersForm' => $filtersForm,
                                              'dataProvider'=> $dataProvider,
                                              'model'=>$model
                                            )
                             );                
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
        
        protected function _view_map($model) {
                Yii::import('ext.EGMap.*');
                
                $gMap = new EGMap();
                $gMap->setWidth(930);
                $gMap->setHeight(460);
                $gMap->setAPIKey('http://pp.rtvs.net', 'ABQIAAAAuKTQCaAmRIZm8fpzMcomXRSjgd74L9WyZO8Sjj0ClzXDGx3dYxQN2iImmF-UZzmvUG1oogyiwpW3eQ');
                $gMap->zoom = 14;/*6;*/
                $gMap->minZoom = 10;
                $gMap->maxZoom = 14;
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
                    $gMap->zoom = 14;
                    $gMap->minZoom = 10;
                    $gMap->maxZoom = 14;
                    //$gMap->enableLatLonControl();

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
        
}

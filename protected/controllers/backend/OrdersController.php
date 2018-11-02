<?php

class OrdersController extends BackendController
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

        protected  function _registerScriptMap () {
            Yii::app()->clientScript->registerScriptFile("http://www.google.com/jsapi");
            Yii::app()->clientScript->registerScriptFile("http://maps.googleapis.com/maps/api/js?v=3&sensor=false&language=ru_RU");
            $js_map = " /*<![CDATA[*/ google.load('maps','3',{'other_params':'sensor=false&language=ru_RU'}); var EGMap0 = null; /*]]>*/ ";
            Yii::app()->clientScript->registerScript('loadmap', $js_map);
        }                
            
	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','ajaxcreate','ajaxupdate', 'ajaxview', 'ajaxhistory', 'ajaxsuiarea'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin','superadmin'),
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
	 * Displays Ajax a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionAjaxView($id)
	{
            $this->_clearScriptMap();
            
            /*$cs=Yii::app()->getClientScript();
            if(null!==($scriptMap=Yii::app()->request->getParam('scriptMap')) && is_string($scriptMap)){
                    foreach(explode(',', $scriptMap) as $script)
                        $cs->scriptMap[$script]=false;
            }*/            
                  
            if( Yii::app()->request->isAjaxRequest ) {
		$this->renderPartial('view_ajax',array(
			'model'=>$this->loadModel($id),
		),false,true);
            }    
	}        

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Orders;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Orders']))
		{
			$model->attributes=$_POST['Orders'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

        /**
	 * Creates Ajax a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionAjaxCreate()
	{
            //$this->layout = "//layouts/ajax";

            $cs=Yii::app()->getClientScript();
            if(null!==($scriptMap=Yii::app()->request->getParam('scriptMap')) && is_string($scriptMap)){
                    foreach(explode(',', $scriptMap) as $script)
                        $cs->scriptMap[$script]=false;
            }
            
            $this->_clearScriptMap();
            
            if ( isset($_POST["cid"]) && trim($_POST["cid"])<>'' ) {
                $cid=trim($_POST["cid"]); 
            }else{
                $cid=Yii::app()->request->getParam('id');
            }
            
            if( Yii::app()->request->isAjaxRequest ) {
                
		$model=new Orders;                
                
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if( isset($_POST['Orders']) ) 
		{
                        
			$model->attributes=$_POST['Orders'];
                        $model->createdate=date('Y-m-d H:s:i');
                        $model->createuser=Yii::app()->user->id;
                        
			if($model->save()) 
                        {                                                    
                            $clientOrders=new ClientOrders();
                            $clientOrders->client_id=$cid;
                            $clientOrders->order_id=$model->id;
                            /*$clientOrders->desc=null;
                            $clientOrders->sort=500;
                            $clientOrders->act=1;
                            $clientOrders->del=0;
                            $clientOrders->create_date=date('Y-m-d H:s:i');
                            $clientOrders->update_date=date('Y-m-d H:s:i');*/
                            
                            if ($clientOrders->save()) {
                                $data  = array( "error"=>false, "mess"=>Yii::t('all','Orders')." №".$clientOrders->id." по клиенту:".$cid, "body"=>null );
                                echo json_encode($data);
                                return;
                            }    
                        }
		}                
                                           

                $this->renderPartial('_form_ajax',array(
                        'model'=>$model,
                        'cid'=>$cid),false,true
                );                
                
                //Yii::app()->end();
            }   
	}
        
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Orders']))
		{
                        $model_old = $model;
			$model->attributes=$_POST['Orders'];
                        
			if($model->save() && $this->_save_history($model_old)) {
				$this->redirect(array('view','id'=>$model->id));
                        }        
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
        
        /**
         * Save history orders
         * @param type $id 
         */

        protected function _save_history($ord_old) {                        
                $history = new OrderHistories();                
                $history->attributes = $ord_old->attributes; 
                
                unset($history->id);
                
                $history->order_id = $ord_old->id;                
                $history->historydate = date('Y-m-d H:s:i');
                $history->historyuser = Yii::app()->user->id;
                
                if ( $history->save()) {
                    return true;
                }
           return false;
        }
        
        /**
	 * History Orders Ajax a particular model.	 
	 * @param integer $id the ID of the model to be view history
	 */
	public function actionAjaxSuiarea($id,$cid)
	{            
             //$this->_registerScriptMap();
             $this->_clearScriptMap();
             
             if( Yii::app()->request->isAjaxRequest ) {
                
                // -- Begin creating station metro -- 
                
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
                 
                // -- End creating station metro -- 
                
                $model=new Realestates('search');                
                $model->unsetAttributes();  // clear any default values                             

                if( !isset($_POST['Realestates']) ) $_POST = $_GET;

                
		if( isset($_POST['Realestates'])) {
                    
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
                                $_POST['Realestates']['metro_id']=$mets_map;                                                                 
                        }
                        
			$model->attributes=$_POST['Realestates'];                        
                        
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
                        
                        // Search for Realestate Properties
                        if ( isset($_POST["Realestates"]["realestateProperties"]) && !empty($_POST["Realestates"]["realestateProperties"])) {
                            
                            if ( !intval($_POST["is_many_properties"]) ) {
                                $model->getDbCriteria()->with['realestateProperties'] = array(
                                            'select' => false,
                                            'together' => true,
                                            'condition' => 'realestateProperties.property_id IN ('
                                                            .implode(',', $_POST["Realestates"]["realestateProperties"]).')' ,                
                                );                                
                                
                            }else{
                                $model->getDbCriteria()->with['realestateProperties'] = array(
                                            'select' => false,
                                            'together' => true,
                                            'condition' => 'realestateProperties.property_id IN ('
                                                          .implode(',', $_POST["Realestates"]["realestateProperties"]).')'
                                                          .' AND ('.'(SELECT COUNT(*) FROM realestate_properties sp '
                                                                    .' WHERE realestateProperties.realestate_id=sp.realestate_id AND sp.property_id IN ('
                                                                        .implode(',', $_POST["Realestates"]["realestateProperties"]).') GROUP BY realestate_id)='
                                                                    .count($_POST["Realestates"]["realestateProperties"]).')',                
                                            );
                                
                            }

                        }
                        
                        // Search for Realestate Representatives
                        if ( isset($_POST["Realestates"]["realestateRepresentatives"]) && !empty($_POST["Realestates"]["realestateRepresentatives"])) {
                            
                            /*if ( !intval($_POST["is_many_representatives"]) ) {
                                $model->getDbCriteria()->with['realestateRepresentatives'] = array(
                                            'select' => false,
                                            'together' => true,
                                            'condition' => 'realestateRepresentatives.representative_id IN ('
                                                            .implode(',', $_POST["Realestates"]["realestateRepresentatives"]).')' ,                
                                );                                
                                
                            }else{
                                $model->getDbCriteria()->with['realestateRepresentatives'] = array(
                                            'select' => false,
                                            'together' => true,
                                            'condition' => 'realestateRepresentatives.representative_id IN ('
                                                          .implode(',', $_POST["Realestates"]["realestateRepresentatives"]).')'
                                                          .' AND ('.'(SELECT COUNT(*) FROM realestate_representatives sr '
                                                                    .' WHERE realestateRepresentatives.realestate_id=sr.realestate_id AND sr.representative_id IN ('
                                                                       .implode(',', $_POST["Realestates"]["realestateRepresentatives"]).') GROUP BY realestate_id)='
                                                                    .count($_POST["Realestates"]["realestateRepresentatives"]).')',                
                                            );
                                
                            }*/
                            if ( !intval($_POST["is_many_representatives"]) ) {
                                $model->getDbCriteria()->with['realestateRepresentatives'] = array(
                                            'select' => false,
                                            'together' => true,
                                            'condition' => 'realestateRepresentatives.representative_id IN ('
                                                            .( is_array($_POST["Realestates"]["realestateRepresentatives"]) 
                                                             ? implode(',', $_POST["Realestates"]["realestateRepresentatives"]) 
                                                             : $_POST["Realestates"]["realestateRepresentatives"]).')' ,                
                                );                                
                                
                            }else{
                                $model->getDbCriteria()->with['realestateRepresentatives'] = array(
                                            'select' => false,
                                            'together' => true,
                                            'condition' => 'realestateRepresentatives.representative_id IN ('
                                                          .( is_array($_POST["Realestates"]["realestateRepresentatives"]) 
                                                             ? implode(',', $_POST["Realestates"]["realestateRepresentatives"]) 
                                                             : $_POST["Realestates"]["realestateRepresentatives"]).')'                                    
                                                          .' AND ('.'(SELECT COUNT(*) FROM realestate_representatives sr '
                                                                    .' WHERE realestateRepresentatives.realestate_id=sr.realestate_id AND sr.representative_id IN ('
                                                                       .( is_array($_POST["Realestates"]["realestateRepresentatives"]) 
                                                                          ? implode(',', $_POST["Realestates"]["realestateRepresentatives"]) 
                                                                          : $_POST["Realestates"]["realestateRepresentatives"]).') GROUP BY realestate_id)='
                                                                    .count($_POST["Realestates"]["realestateRepresentatives"]).')',                
                                            );
                                
                            }

                        }
                        
                        if ( !empty($_POST['Contact_telephone'])) {                          
                            $like_representative_telephone = str_replace(")","_",$_POST['Contact_telephone']);
                            $like_representative_telephone = str_replace("(","_",$like_representative_telephone);
                            $like_representative_telephone = str_replace("x","_",$like_representative_telephone);
                            $like_representative_telephone = str_replace("8","_",$like_representative_telephone);
                            
                            /*$model->getDbCriteria()->with['realestatesRepresentatives'] = array(
                                            'select' => false,
                                            'together' => true,
                                            'condition' => "realestatesRepresentatives.telephone LIKE '%".$like_representative_telephone."%'"
                            );*/
                            
                            /*$model->getDbCriteria()->with['representative'] = array(
                                            'select' => false,
                                            'together' => true,
                                            'condition' => "representative.telephone LIKE '%".$like_representative_telephone."%'",                        
                            );*/
                                                                      
                            $criteria = new CDbCriteria();                            
                            $criteria->with['realestatesRepresentatives'] = array(
                                            'select' => false,
                                            'together' => true,
                                            //'condition' => "realestatesRepresentatives.telephone LIKE '%".$like_representative_telephone."%'"
                            );                            
                            $criteria->with['representative'] = array(
                                            'select' => false,
                                            'together' => true,
                                            //'condition' => "representative.telephone LIKE '%".$like_representative_telephone."%'",                        
                            );                            
                            $criteria->condition ="((realestatesRepresentatives.telephone LIKE '%".$like_representative_telephone."%') OR (representative.telephone LIKE '%".$like_representative_telephone."%'))";
                            
                            $model->getDbCriteria()->mergeWith($criteria);
                                
                        }                        
                            
                        // Search for Realestate Others 
                        if ( isset($_POST["Realestates"]["realestateOthers"]) && !empty($_POST["Realestates"]["realestateOthers"])) {
                            
                            if ( !intval($_POST["is_many_similarities1"]) ) {
                                $model->getDbCriteria()->with['realestateOthers'] = array(
                                            'select' => false,
                                            'together' => true,
                                            'condition' => 'realestateOthers.similaries_id IN ('
                                                            .implode(',', $_POST["Realestates"]["realestateOthers"]).')' ,                
                                );                                
                                
                            }else{
                                $model->getDbCriteria()->with['realestateOthers'] = array(
                                            'select' => false,
                                            'together' => true,
                                            'condition' => 'realestateOthers.similaries_id IN ('
                                                          .implode(',', $_POST["Realestates"]["realestateOthers"]).')'
                                                          .' AND ('.'(SELECT COUNT(*) FROM realestate_similarities ss '
                                                                    .' WHERE realestateOthers.realestate_id=ss.realestate_id AND ss.similaries_id IN ('
                                                                        .implode(',', $_POST["Realestates"]["realestateOthers"]).') GROUP BY realestate_id)='
                                                                    .count($_POST["Realestates"]["realestateOthers"]).')',                
                                            );
                                
                            }

                        }
                        
                        // Search for Realestate Similarities
                        if ( isset($_POST["Realestates"]["realestateSimilarities"]) && !empty($_POST["Realestates"]["realestateSimilarities"])) {
                            
                            if ( !intval($_POST["is_many_similarities"]) ) {
                                $model->getDbCriteria()->with['realestateSimilarities'] = array(
                                            'select' => false,
                                            'together' => true,
                                            'condition' => 'realestateSimilarities.similaries_id IN ('
                                                            .implode(',', $_POST["Realestates"]["realestateSimilarities"]).')' ,                
                                );                                
                                
                            }else{
                                $model->getDbCriteria()->with['realestateSimilarities'] = array(
                                            'select' => false,
                                            'together' => true,
                                            'condition' => 'realestateSimilarities.similaries_id IN ('
                                                          .implode(',', $_POST["Realestates"]["realestateSimilarities"]).')'
                                                          .' AND ('.'(SELECT COUNT(*) FROM realestate_similarities ss '
                                                                    .' WHERE realestateSimilarities.realestate_id=ss.realestate_id AND ss.similaries_id IN ('
                                                                        .implode(',', $_POST["Realestates"]["realestateSimilarities"]).') GROUP BY realestate_id)='
                                                                    .count($_POST["Realestates"]["realestateSimilarities"]).')',                
                                            );
                                
                            }

                        }
                        
                } else {        
                    
                    $order_prs = Orders::model()->findByPk($id);
                    if ( !empty($order_prs['remoteness_to'])) {
                    
                            $_POST['remoteness-from']=intval($order_prs['remoteness_from']);
                            $_POST['remoteness-to']=intval($order_prs['remoteness_to']);
                            
                            $model->getDbCriteria()->addBetweenCondition('remoteness', 
                                $_POST['remoteness-from'], $_POST['remoteness-to']);                    
                    }
                      
                    if ( !empty($order_prs['area_from']) && !empty($order_prs['area_to'])) {
                        
                            $_POST['area-from']=$order_prs['area_from'];
                            $_POST['area-to']=$order_prs['area_to'];
                            
                            $model->getDbCriteria()->addBetweenCondition('area', 
                                $_POST['area-from'], $_POST['area-to']);                
                    }
                                        
                    if ( !empty($order_prs['price_from']) && !empty($order_prs['price_to'])) {
                        
                            $_POST['price_from']=$order_prs['price_from'];
                            $_POST['price_to']=$order_prs['price_to'];
                                
                            $model->getDbCriteria()->addBetweenCondition('price', 
                                            $_POST['price_from'], $_POST['price_to']);               
                    }
                    

                    //$model->valute_id=$order_prs['valute_id'];
                    
                    if ( !empty($order_prs['unit_id']) )   $model->unit_id=$order_prs['unit_id'];
                    if ( !empty($order_prs['operation_id']) ) $model->operation_id=$order_prs['operation_id'];                    
                    if ( !empty($order_prs['district_id']) ) $model->district_id=$order_prs['district_id'];                    
                    if ( !empty($order_prs['realestate_type_id']) ) $model->realestate_type_id=$order_prs['realestate_type_id'];                    
                    if ( !empty($order_prs['realestate_vid_id']) ) $model->realestate_vid_id=$order_prs['realestate_vid_id'];                    
                    if ( !empty($order_prs['realestate_class_id']) ) $model->realestate_class_id=$order_prs['realestate_class_id'];
                    
                    
                    /*if ( !empty($order_prs['polygon']) ) 
                    {
                         $_POST['polygon']=$order_prs['polygon'];                         
                         $model->getDbCriteria()->addBetweenCondition('map_longitude',
                                 $model->getMinLongCoord($_POST['polygon']),
                                 $model->getMaxLongCoord($_POST['polygon']));              
                         $model->getDbCriteria()->addBetweenCondition('map_latitude',
                                 $model->getMinLatCoord($_POST['polygon']),
                                 $model->getMaxLatCoord($_POST['polygon']));
                    }
                     
                    if ( !empty($order_prs['metro']) ) 
                    {
                         $_POST['metro']=implode(',',$order_prs['metros']);
                         
                         $criteria_mapid=new CDbCriteria;
                         $criteria_mapid->select= 'id,mapid';
                         $criteria_mapid->addInCondition('mapid',$_POST['metro']);
                         
                         $mets = Metros::model()->findAll($criteria_mapid);
                         $mets_map = array();
                         foreach ( $mets as $met) {                                    
                               $mets_map[]=$met->id;
                         }                                     
                         $_POST['Realestates']['metro_id']=$mets_map;                                                                 
                    }*/
                } 
                
                $map = $this->_show_map_poligon($model);                      
                //$model_order_histories->order_id=$id;
                
                $this->renderPartial('/realestates/_list_ajax',array(
                        'model'=>$model,
                        'metros'=>$metros,
                        'map'=>$map,
                        'cid'=>$cid,
                        ),false,true
                );  
                //Yii::app()->end();
                /*- End History order ----------------------------------------------------------------*/
            }     
        }
        
        protected function _show_map_poligon($model) {
                                               
            Yii::import('ext.EGMap.*');
                        
            Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/polygon/polygon.core.js');            
            
            $gMap = new EGMap();
            $gMap->setWidth(935);
            $gMap->setHeight(420);            
            /*$gMap->setAPIKey('http://pp.rtvs.net', 'ABQIAAAAuKTQCaAmRIZm8fpzMcomXRSjgd74L9WyZO8Sjj0ClzXDGx3dYxQN2iImmF-UZzmvUG1oogyiwpW3eQ');*/
            $gMap->setAPIKey('pegasrealty.ru', 'AIzaSyDu-9PAa4Wjo64NrGGwjuxdIQhxGV1XTw8'); 
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
                                        array('title' => Yii::t('realestates', $model->title), 'draggable'=>true),
                                        'polygon', array('dragevent'=>$dragevent));
            
            $polygon->addHtmlInfoWindow($info_window);  
            $gMap->addPolygon($polygon);  */                    
            $gMap->zoom = 9;    
            $gMap->minZoom = 9;
            //$gMap->centerOnPolygons();
            //$gMap->zoomOnPolygons(0.1); 
            $gMap->enableLatLonControl();
            
            // Saving coordinates after polygons.
            //$gMap->appendMapTo('#mapsearch');                          
            
            return $gMap;

        }
        
        protected function _view_map($model) {
                Yii::import('ext.EGMap.*');
                
                $gMap = new EGMap();                
                $gMap->setWidth(682);
                $gMap->setHeight(420);
                /*$gMap->setAPIKey('http://pp.rtvs.net', 'ABQIAAAAuKTQCaAmRIZm8fpzMcomXRSjgd74L9WyZO8Sjj0ClzXDGx3dYxQN2iImmF-UZzmvUG1oogyiwpW3eQ');*/
                $gMap->setAPIKey('pegasrealty.ru', 'AIzaSyDu-9PAa4Wjo64NrGGwjuxdIQhxGV1XTw8');
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
                    $marker = new EGMapMarker($model->map_latitude, $model->map_longitude, array('title' => Yii::t('realestates', $model->title),
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
        
        /**
	 * History Orders Ajax a particular model.	 
	 * @param integer $id the ID of the model to be view history
	 */
	public function actionAjaxHistory($id)
	{
            $cs=Yii::app()->getClientScript();
            if(null!==($scriptMap=Yii::app()->request->getParam('scriptMap')) && is_string($scriptMap)){
                    foreach(explode(',', $scriptMap) as $script)
                        $cs->scriptMap[$script]=false;
            }
            
            $this->_clearScriptMap();

            if( Yii::app()->request->isAjaxRequest ) {
        
                /*- Begin History order ----------------------------------------------------------------*/
                $model_order_histories=new OrderHistories('search');
		$model_order_histories->unsetAttributes();  // clear any default values                
                
		if(isset($_GET['OrderHistories']))  {                  
                    $model_order_histories->attributes=$_GET['OrderHistories'];
                }    
                
                $model_order_histories->order_id=$id;
                
                $this->renderPartial('_list_ajax',array(
                        'model'=>$model_order_histories),false,true
                );  
                /*- End History order ----------------------------------------------------------------*/
            }     
        }

      	/**
	 * Updates Ajax a particular model.	 
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionAjaxUpdate($id)
	{
            $this->_clearScriptMap(); 
                
            if(null!==($scriptMap=Yii::app()->request->getParam('scriptMap')) && is_string($scriptMap)){
                    foreach(explode(',', $scriptMap) as $script)
                        $cs->scriptMap[$script]=false;
            }

            if( Yii::app()->request->isAjaxRequest ) {
                                        
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Orders']))
		{
                        $model_old = $model;
                        
			$model->attributes=$_POST['Orders'];
                        $model->updatedate=date('Y-m-d H:s:i');
                        $model->updateuser=Yii::app()->user->id;                                                 
                        
			if($model->save() && $this->_save_history($model_old)) {
                                $data  = array( "error"=>false, "mess"=>Yii::t('all','Orders')." №".$model->id." по клиенту:".$model->clientOrders[0]->client_id, "body"=>null );
                                echo json_encode($data);
                                return;
                        } else {
                                $data  = array( "error"=>true, "mess"=>Yii::t('all','Orders')." №".$model->id." по клиенту:".$model->clientOrders[0]->client_id, "body"=>null );
                                echo json_encode($data);
                                return;
                        }       
		}

                $this->renderPartial('_form_ajax',array(
                        'model'=>$model),false,true
                );   
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
		$dataProvider=new CActiveDataProvider('Orders');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Orders('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Orders']))
			$model->attributes=$_GET['Orders'];

                $model->getDbCriteria()->order='t.id DESC';
		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Orders::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='orders-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}

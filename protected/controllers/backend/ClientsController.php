<?php

class ClientsController extends BackendController
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
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','ajaxcreate','ajaxupdate','ajaxcomplexupdate','complexupdate','complexview','ajaxsendpresents','ajaxgetinfo','ajaxget','ajaxview'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete', 'send', 'info', 'ajaxvieworders', 'ajaxviewspaces', 'ajaxviewevents', /*'vieworders', 'viewspaces',*/ 'groupDelete', 'groupSend', 
                                                 'groupDeleteOrder', 'groupSendOrder', 'groupDeleteEvent', 'groupPrintEvent', 'groupSendNews', 'groupSendArticle', 'groupSendAdvartisement'),
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
            
            $cs=Yii::app()->getClientScript();
            if(null!==($scriptMap=Yii::app()->request->getParam('scriptMap')) && is_string($scriptMap)){
                    foreach(explode(',', $scriptMap) as $script)
                        $cs->scriptMap[$script]=false;
            }

            if( Yii::app()->request->isAjaxRequest ) {
		$this->renderPartial('view_ajax',array(
			'model'=>$this->loadModel($id),
		),false,true);
            }    
	}        
        
        /**
	 * Creates Ajax a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionAjaxCreate()
	{
            //$this->layout = "//layouts/ajax";

            $this->_clearScriptMap();
            
            $cs=Yii::app()->getClientScript();
            if(null!==($scriptMap=Yii::app()->request->getParam('scriptMap')) && is_string($scriptMap)){
                    foreach(explode(',', $scriptMap) as $script)
                        $cs->scriptMap[$script]=false;
            }
                        
            if( Yii::app()->request->isAjaxRequest ) {
                
		$model=new Clients;                
                
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if( isset($_POST['Clients']) ) 
		{
                        
			$model->attributes=$_POST['Clients'];
                        $model->create_date=date('Y-m-d H:s:i');
                        $model->create_user=Yii::app()->user->id;
                        
			if($model->save()) {
                                $data  = array( "error"=>false, "mess"=>Yii::t('all','Clients')." №".$model->id." успешно добавлен", "body"=>null );
                                echo json_encode($data);
                                return;
                        } else {
                                $data  = array( "error"=>true, "mess"=>Yii::t('all','Clients')." не добавлен", "body"=>null );
                                echo json_encode($data);
                                return;
                        }     
		}                
                                           

                $this->renderPartial('_form_ajax',array(
                        'model'=>$model),false,true
                );                
                
                //Yii::app()->end();
            }   
	}
        
      	/**
	 * Updates Ajax a particular model.	 
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionAjaxUpdate($id)
	{
            $this->_clearScriptMap();
            
            $cs=Yii::app()->getClientScript();
            if(null!==($scriptMap=Yii::app()->request->getParam('scriptMap')) && is_string($scriptMap)){
                    foreach(explode(',', $scriptMap) as $script)
                        $cs->scriptMap[$script]=false;
            }

            if( Yii::app()->request->isAjaxRequest ) {
                                        
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Clients']))
		{
                                               
			$model->attributes=$_POST['Clients'];
                        $model->update_date=date('Y-m-d H:s:i');
                        $model->update_user=Yii::app()->user->id;                                                 
                        
			if($model->save()) {
                                $data  = array( "error"=>false, "mess"=>Yii::t('all','Clients')." №".$model->id." успешно обновлен", "body"=>null );
                                echo json_encode($data);
                                return;
                        } else {
                                $data  = array( "error"=>true, "mess"=>Yii::t('all','Clients')." №".$model->id." не обновлен", "body"=>null );
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
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionAjaxViewEvents($id)
	{
                $this->_clearScriptMap();

                /*- Begin client ---------------------------------------------*/
		$model=$this->loadModel($id);            
                
                /*- Begin client developments---------------------------------------------*/
                $model_client_developments=new ClientDevelopments('search');
		$model_client_developments->unsetAttributes();  // clear any default values
		if(isset($_GET['ClientDevelopments']))
			$model_client_developments->attributes=$_GET['ClientDevelopments'];
                /*- End client developments-----------------------------------------------*/
                
                if( Yii::app()->request->isAjaxRequest ) {
                    /*- End list orders -----------------------------------------------*/
                    $model_client_developments->getDbCriteria()->order='t.id DESC';
                    $this->renderPartial('_client_devs',array(
                            'model'=>$model_client_developments, 'model_client'=>$model),false,true
                    );
                }
	}
        
       	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionAjaxViewOrders($id)
	{
                $this->_clearScriptMap();

                /*- Begin client ---------------------------------------------*/
		$model=$this->loadModel($id);            
                
                /*- Begin list orders ---------------------------------------------*/
                $model_orders=new Orders('search');                
		$model_orders->unsetAttributes();  // clear any default values
                
		if(isset($_GET['Orders']))
			$model_orders->attributes=$_GET['Orders'];
                
                $model_orders->getDbCriteria()->with['clientOrders'] = array(
                                            'select' => false,
                                            'together' => true,
                                            'condition' => 'clientOrders.client_id='.$model->id ,                
                                );      
                if( Yii::app()->request->isAjaxRequest ) {
                    /*- End list orders -----------------------------------------------*/
                    $model_orders->getDbCriteria()->order='t.id DESC';
                    $this->renderPartial('_list_orders',array(
                            'model'=>$model_orders, 'model_client'=>$model),false,true
                    );
                }
	}
        
        /**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionAjaxViewSpaces($id)
	{
                $this->_clearScriptMap();            
                
                //$this->_registerScriptMap();  
                
                /*- Begin client ---------------------------------------------*/
		$model=$this->loadModel($id);
                
                /*- Begin list spaces ---------------------------------------------*/
                $model_realestates=new Realestates('search');                
		$model_realestates->unsetAttributes();  // clear any default values
                
		if(isset($_GET['Realestates'])) 
                $model_realestates->attributes=$_GET['Realestates'];
                
                $model_realestates->getDbCriteria()->with['realestateClients'] = array(
                                            'select' => false,
                                            'together' => true,
                                            'condition' => 'realestateClients.client_id='.$model->id ,                                                            
                );                                          
                /*- End list spaces -----------------------------------------------*/
                 if( Yii::app()->request->isAjaxRequest ) {
                    $this->renderPartial('_list_spaces',array(
                            'model'=>$model_realestates, 'model_client'=>$model), false, true
                    );
                 }
	}
        
       	/**
	 * Displays Complex a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionComplexView($id)
	{
                $this->layout='//layouts/column3_1';
            
                $this->_registerScriptMap();  
            
                $model = $this->loadModel($id);
                
                $amodels=$this->_create_ainfo_client($model);
                
		$this->render('view_complex',$amodels);
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{                                
		$model=new Clients;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Clients']))
		{
			$model->attributes=$_POST['Clients'];                        
			if($model->save()) 
                        {                             
                             $this->redirect(array('view','id'=>$model->id));
                        }
		}                
                
		$this->render('create',array('model'=>$model));
	}
        
        protected function _create_ainfo_client($model) {
            
            /*- Begin client developments---------------------------------------------*/
                $model_client_developments=new ClientDevelopments('search');
		$model_client_developments->unsetAttributes();  // clear any default values
		if(isset($_GET['ClientDevelopments']))
			$model_client_developments->attributes=$_GET['ClientDevelopments'];
                /*- End client developments-----------------------------------------------*/
                
                /*- Begin list orders ---------------------------------------------*/
                $model_orders=new Orders('search');                
		$model_orders->unsetAttributes();  // clear any default values
                
		if(isset($_GET['Orders']))
			$model_orders->attributes=$_GET['Orders'];
                
                $model_orders->getDbCriteria()->with['clientOrders'] = array(
                                            'select' => false,
                                            'together' => true,
                                            'condition' => 'clientOrders.client_id='.$model->id ,                
                                );                
                /*- End list orders -----------------------------------------------*/
                
                /*- Begin list spaces ---------------------------------------------*/
                $model_realestates=new Realestates('search');                
		$model_realestates->unsetAttributes();  // clear any default values
                
		if(isset($_GET['Realestates'])) 
                $model_realestates->attributes=$_GET['Realestates'];
                
                $model_realestates->getDbCriteria()->with['clientRealestates'] = array(
                                            'select' => false,
                                            'together' => true,
                                            'condition' => 'clientRealestates.client_id='.$model->id ,                
                );                                          
                /*- End list spaces -----------------------------------------------*/
                
                /*- Begin view order ----------------------------------------------*/
                $model_order = new Orders;                                
                
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if(isset($_POST['Orders']))
		{
			$model_order->attributes=$_POST['Orders'];
			$model_order->save();
		}
                /*- End view order-------------------------------------------------*/ 
                
                /*- Begin Suitable area ----------------------------------------------------------------*/
                $model_suitable_area=new Realestates('search');                
		$model_suitable_area->unsetAttributes();  // clear any default values                

                if( !isset($_POST['Realestates']) ) $_POST = $_GET;

                
		if( isset($_POST['Realestates'])) :

			$model_suitable_area->attributes=$_POST['Realestates'];                        
                        
                        if ( !empty($_POST['remoteness-from']) && !empty($_POST['remoteness-to'])) 
                            $model_suitable_area->getDbCriteria()->addBetweenCondition('remoteness', 
                                $_POST['remoteness-from'], $_POST['remoteness-to']);                          

                        if ( !empty($_POST['date_rang-from']) && !empty($_POST['date_rang-to']) )    
                            $model_suitable_area->getDbCriteria()->addBetweenCondition('date_rang', 
                                date('Y-m-d', strtotime($_POST['date_rang-from'])), date('Y-m-d', strtotime($_POST['date_rang-to'])));                

                        if ( !empty($_POST['date_release-from']) && !empty($_POST['date_release-to']) )    
                            $model_suitable_area->getDbCriteria()->addBetweenCondition('date_release', 
                                date('Y-m-d', strtotime($_POST['date_release-from'])), date('Y-m-d', strtotime($_POST['date_release-to'])));                
                       
                        if ( !empty($_POST['area-from']) && !empty($_POST['area-to'])) 
                             $model_suitable_area->getDbCriteria()->addBetweenCondition('area', 
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
                                    
                                    $model_suitable_area->valute_id=null;
                                    
                                    $condition = $select.' BETWEEN '.$_POST['price_from'].' AND '.$_POST['price_to'];
                                    $model_suitable_area->getDbCriteria()->addCondition($condition);                                                                        
                                    $model_suitable_area->getDbCriteria()->join= $model_suitable_area->getDbCriteria()->join.' '.' LEFT JOIN valutes v on v.id=t.valute_id ';
                                    
                                }else{
                                    $model_suitable_area->getDbCriteria()->addBetweenCondition('price', 
                                            $_POST['price_from'], $_POST['price_to']);               
                                }                                                                                                                                                              
                            }
                             
                        }else{
                            if ( !empty($_POST['price_from']) && !empty($_POST['price_to'])) 
                                $model_suitable_area->getDbCriteria()->addBetweenCondition('price', 
                                            $_POST['price_from'], $_POST['price_to']);               
                        }
                        
                        
                        if ( isset($_POST['polygon']) && !empty($_POST['polygon']) ) {
                            
                            $model_suitable_area->getDbCriteria()->addBetweenCondition('map_longitude',
                                    $model_suitable_area->getMinLongCoord($_POST['polygon']),
                                    $model_suitable_area->getMaxLongCoord($_POST['polygon']));              
                            $model_suitable_area_suitable_area->getDbCriteria()->addBetweenCondition('map_latitude',
                                    $model_suitable_area->getMinLatCoord($_POST['polygon']),
                                    $model_suitable_area->getMaxLatCoord($_POST['polygon']));
                        }
                        
                        // Search for Realestate Properties
                        if ( isset($_POST["Realestates"]["realestateProperties"]) && !empty($_POST["Realestates"]["realestateProperties"])) {
                            
                            if ( !intval($_POST["is_many_properties"]) ) {
                                $model_suitable_area->getDbCriteria()->with['realestateProperties'] = array(
                                            'select' => false,
                                            'together' => true,
                                            'condition' => 'realestateProperties.property_id IN ('
                                                            .implode(',', $_POST["Realestates"]["realestateProperties"]).')' ,                
                                );                                
                                
                            }else{
                                $model_suitable_area->getDbCriteria()->with['realestateProperties'] = array(
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
                                $model_suitable_area->getDbCriteria()->with['realestateRepresentatives'] = array(
                                            'select' => false,
                                            'together' => true,
                                            'condition' => 'realestateRepresentatives.representative_id IN ('
                                                            .implode(',', $_POST["Realestates"]["realestateRepresentatives"]).')' ,                
                                );                                
                                
                            }else{
                                $model_suitable_area->getDbCriteria()->with['realestateRepresentatives'] = array(
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
                                $model_suitable_area->getDbCriteria()->with['realestateRepresentatives'] = array(
                                            'select' => false,
                                            'together' => true,
                                            'condition' => 'realestateRepresentatives.representative_id IN ('
                                                            .( is_array($_POST["Realestates"]["realestateRepresentatives"]) 
                                                             ? implode(',', $_POST["Realestates"]["realestateRepresentatives"]) 
                                                             : $_POST["Realestates"]["realestateRepresentatives"]).')' ,                
                                );                                
                                
                            }else{
                                $model_suitable_area->getDbCriteria()->with['realestateRepresentatives'] = array(
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
                            
                            /*$model_suitable_area->getDbCriteria()->with['realestatesRepresentatives'] = array(
                                            'select' => false,
                                            'together' => true,
                                            'condition' => "realestatesRepresentatives.telephone LIKE '%".$like_representative_telephone."%'"
                            );*/
                            
                            /*$model_suitable_area->getDbCriteria()->with['representative'] = array(
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
                            
                            $model_suitable_area->getDbCriteria()->mergeWith($criteria);
                                
                        }                        
                            
                        // Search for Realestate Others
                        if ( isset($_POST["Realestates"]["realestateOthers"]) && !empty($_POST["Realestates"]["realestateOthers"])) {
                            
                            if ( !intval($_POST["is_many_similarities1"]) ) {
                                $model_suitable_area->getDbCriteria()->with['realestateOthers'] = array(
                                            'select' => false,
                                            'together' => true,
                                            'condition' => 'realestateOthers.similaries_id IN ('
                                                            .implode(',', $_POST["Realestates"]["realestateOthers"]).')' ,                
                                );                                
                                
                            }else{
                                $model_suitable_area->getDbCriteria()->with['realestateOthers'] = array(
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
                                $model_suitable_area->getDbCriteria()->with['realestateSimilarities'] = array(
                                            'select' => false,
                                            'together' => true,
                                            'condition' => 'realestateSimilarities.similaries_id IN ('
                                                            .implode(',', $_POST["Realestates"]["realestateSimilarities"]).')' ,                
                                );                                
                                
                            }else{
                                $model_suitable_area->getDbCriteria()->with['realestateSimilarities'] = array(
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
                                                
                endif;               
                /*- End Suitable area ----------------------------------------------------------------*/
                
                /*- Begin History order ----------------------------------------------------------------*/
                $model_history_order=new OrderHistories('search');
		$model_history_order->unsetAttributes();  // clear any default values
		if(isset($_GET['OrderHistories']))
                    $model_history_order->attributes=$_GET['OrderHistories'];
                /*- End History order ----------------------------------------------------------------*/
                                
                return array(
			'model'=>$model,
                        'model_order'=>$model_order,
                        'model_orders'=>$model_orders,
                        'model_realestates'=>$model_realestates,
                        'model_suitable_area'=>$model_suitable_area,
                        'model_history_order'=>$model_history_order,
                        'model_client_developments'=>$model_client_developments
		);
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

		if(isset($_POST['Clients']))
		{
			$model->attributes=$_POST['Clients'];
			if($model->save()) {
                            $this->redirect(array('view','id'=>$model->id));
                        }
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
                
        /**
	 * Updates Complex a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionComplexUpdate($id)
	{
                $this->_registerScriptMap();                                
                
                $this->layout='//layouts/column3_1';
                
                /*- Begin client ---------------------------------------------*/
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Clients']))
		{
			$model->attributes=$_POST['Clients'];
			if($model->save()) {
				$this->redirect(array('view','id'=>$model->id));
                        }        
		}
                /*- End client -----------------------------------------------*/
               
                $amodels=$this->_create_ainfo_client($model);
                
                
		$this->render('update_complex',$amodels);
	}
        
        public function actionAjaxComplexUpdate($id)
	{
                //$this->_registerScriptMap();          
                        
                if( Yii::app()->request->isAjaxRequest ) {
                
                    //$this->layout='//layouts/column3_1';

                    /*- Begin client ---------------------------------------------*/
                    $model=$this->loadModel($id);

                    // Uncomment the following line if AJAX validation is needed
                    // $this->performAjaxValidation($model);

                    if(isset($_POST['Clients']))
                    {
                            $model->attributes=$_POST['Clients'];
                            if($model->save()) {
                                    $data  = array( "error"=>false, "mess"=>Yii::t('all','Clients')." №".$model->id." успешно обновлен", "body"=>null );
                                    echo json_encode($data);
                                    return;
                            } else {
                                    $data  = array( "error"=>true, "mess"=>Yii::t('all','Clients')." №".$model->id." не обновлен", "body"=>null );
                                    echo json_encode($data);
                                    return;
                            }            
                    }
                    /*- End client -----------------------------------------------*/
               
                    $amodels=$this->_create_ainfo_client($model);

                    $this->renderPartial('_update_complex_ajax',$amodels,false,true);  
                }
	}

        /** 
         * Send Ajax Presents model
         * @param type $id 
         */
        public function actionAjaxSendPresents($id) {
           if( Yii::app()->request->isAjaxRequest ) {               
                              
               $client = Clients::model()->findByPk($id);
               
               if ( $client) {
                    $body = "Здравствуйте! \r\n";
                    $body.= "Уважаемый : ".$client->contact_person."\r\n";
                    $body.= "\r\n";
                    $body.= "Прошу Вас рассмотреть коммерческое предложение по Вашым заявкам:\r\n";                 
                    $body.= "\r\n";
                    /*$body.= "Предлагаемая недвижемость: ".$realestate->title."\r\n";
                    $body.= "\tКласс - ".CHtml::encode($realestate->realestateClass->title)."\r\n";
                    $body.= "\tВид - ".CHtml::encode($realestate->realestateVid->title)."\r\n";
                    $body.= "\tРайон - ".CHtml::encode($realestate->district->title)."\r\n";
                    $body.= "\tМетро - ".CHtml::encode($realestate->metro->title)."\r\n";
                    $body.= "\tРасстояние - ".CHtml::encode($realestate->remoteness)." (".CHtml::encode($realestate->unit->short_title).")\r\n";
                    //$body.= "\tAдрес - ".CHtml::encode($realestate->address)."\r\n";
                    $body.= "\tПлощадь - ".CHtml::encode($realestate->area)." м.кв. \r\n";
                    $body.= "\tСтоимость - ". CHtml::encode(round($realestate->price))." кв/м в год \r\n";
                    $body.= "\tПланировка - ".CHtml::encode($realestate->planning->title)."\r\n";
                    $body.= "\tПарковка - ".CHtml::encode($realestate->parking->title)." ".CHtml::encode($realestate->cnt_parking_place)." м/м \r\n";                    

                            
                    $props = CHtml::listData(Properties::model()->findAll("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                                array("order"=>"sort")), 'id', 'title');                 
                    
                    $cnt=count($realestate->realestateProperties);
                    if ($cnt<>0) {
                        foreach ($realestate->realestateProperties as $key=>$realestatePropertie) { 
                           if ($cnt<>($key+1)) echo CHtml::encode($props[$realestatePropertie->property_id])."/";
                               else $body.= CHtml::encode($props[$realestatePropertie->property_id]).'/';
                        } 	                    
                        $body.= "\tCвойства - ".implode(',',$realestate->realestateProperties->title)."\r\n";
                    }
                    if ($realestate->anons) {
                        $body.= "\tКраткое описание: \r\n";
                        $body.= "\t".$realestate->anons." \r\n";
                    }*/
                    $body.= "\r\n";
                    $body.= "\r\n";
                    $body.= "\r\n";
                    $body.= " Cообщение отправлено с сайта "./*"<a href='".Yii::app()->request->getServerName()."'>"*/Yii::app()->request->getServerName()/*"</a>"*/."\r\n";
                    $body.= " C уважением администрация "./*"<a href='".Yii::app()->request->getServerName()."'>".*/"<< Pegas Realty >>"./*"</a>".*/"\r\n";
                    
                    
                    
                    $headers="From: ".Yii::app()->params['adminEmail']." \r\nReply-To: ".$client->email;
                    $subject="Вашы заявки с сайта << Pegas Realty >>";
		    mail($client->email,$subject,$body,$headers);
		    //Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
		    //$this->refresh();                                                    
                    $data  = array( "error"=>false, "mess"=>Yii::t('all','Заявки')."(а) по клиенту:".$id, "body"=>null );
                    echo json_encode($data);
                    return;
               } else {
                    $data  = array( "error"=>true, "mess"=>Yii::t('all','Заявки')."(а) по клиенту:".$id, "body"=>null );
                    echo json_encode($data);
                    return;
               }
            }                   
        } 
        
       /**
	* Displays a particular model.
	* @param integer $id the ID of the model to be displayed
	*/
	public function actionAjaxGet($id)
	{
                $model = $this->loadModel($id);
                echo json_encode($model->attributes);                    
                Yii::app()->end();
	}
        
        public function actionInfo($id) {
                $model = $this->loadModel($id);
                //echo $model->getInfo();   
                $this->renderPartial('_info',array(
			'data'=>$model,
		));
                Yii::app()->end();
        }
        
       /**
	* Displays a particular model.
	* @param integer $id the ID of the model to be displayed
	*/
	public function actionAjaxGetInfo($id)
	{
                $model = $this->loadModel($id);
                //echo $model->getInfo();   
                $this->renderPartial('_info',array(
			'data'=>$model,
		));
                Yii::app()->end();
	}
        
        public function actionSend($id) { 
            $subs = $this->loadModel($id);  
            if( Yii::app()->request->isAjaxRequest ) {      
                echo json_encode($this->getCreateSend($subs));
                Yii::app()->end(); 
            }        
        }
        
        public function actionGroupSend($type=null) {
            
           $criteria=new CDbCriteria; 
           $criteria->compare('typesubs_id',$type,true);
           if( isset($_POST['group-checkbox-column']) ) {
               $id = $_POST['group-checkbox-column'];                
               $criteria->compare('id',$id,true);
               $subs = Subscribe::model()->findAll($criteria);
           }else{
               $subs = Subscribe::model()->findAll($criteria);
           }
           
           $errors = array();           
           if ($subs) {
               foreach ($subs as $sub) { 
                   $send=$this->getCreateSend($sub);
                   if ($send["error"]) $errors[$sub->email] = $send["mess"];
               }    
           }
           
           if( Yii::app()->request->isAjaxRequest ) {  
               if ($subs && empty($errors) ) {   
                  $data = array( "error"=>false, "mess"=>Yii::t('all','Рассылка успешно отправлена!'), "content"=>null);
               }else{
                  $data = array( "error"=>true, "mess"=>Yii::t('all','Рассылка не отправлена!<br/>на следующие email:'.implode(','.$errors)), "content"=>null);         
               }
               echo json_encode($data);
               Yii::app()->end(); 
           }
        }
        
        /*public function actionGroupSendNews() {
            return $this->actionGroupSend(5);
        }
        
        public function actionGroupSendArticle() {
            return $this->actionGroupSend(4);
        }        
        
        public function actionSendAdvartisement() {
            return $this->actionGroupSend(8);
        }*/    
              
        public function actionGroupDeleteOrder() {
           $criteria=new CDbCriteria; 
           if( isset($_POST['group-checkbox-column']) ) {
               $id = $_POST['group-checkbox-column']; 
               $criteria->compare('id',$id,true);
               $subs = Orders::model()->deleteAll($criteria);
           }else{
               $subs = Orders::model()->deleteAll($criteria);
           }
                      
           if( Yii::app()->request->isAjaxRequest ) {             
               $data = array( "error"=>false, "mess"=>Yii::t('all','Заявка(и): '.($id ? implode(',', $id).' ' : '').'успешно удалена(ы)!'), "content"=>null);         
               echo json_encode($data);
               Yii::app()->end(); 
           }
        }
        
        public function actionGroupSendOrder($type=null) {
            
           $criteria=new CDbCriteria; 
           $criteria->compare('typesubs_id',$type,true);
           if( isset($_POST['group-checkbox-column']) ) {
               $id = $_POST['group-checkbox-column'];                
               $criteria->compare('id',$id,true);
               $subs = Subscribe::model()->findAll($criteria);
           }else{
               $subs = Subscribe::model()->findAll($criteria);
           }
           
           $errors = array();           
           if ($subs) {
               foreach ($subs as $sub) { 
                   $send=$this->getCreateSend($sub);
                   if ($send["error"]) $errors[$sub->email] = $send["mess"];
               }    
           }
           
           if( Yii::app()->request->isAjaxRequest ) {  
               if ($subs && empty($errors) ) {   
                  $data = array( "error"=>false, "mess"=>Yii::t('all','Рассылка успешно отправлена!'), "content"=>null);
               }else{
                  $data = array( "error"=>true, "mess"=>Yii::t('all','Рассылка не отправлена!<br/>на следующие email:'.implode(','.$errors)), "content"=>null);         
               }
               echo json_encode($data);
               Yii::app()->end(); 
           }
        }
        
        public function actionGroupDelete() {
           $criteria=new CDbCriteria; 
           if( isset($_POST['group-checkbox-column']) ) {
               $id = $_POST['group-checkbox-column']; 
               $criteria->compare('id',$id,true);
               $subs = Clients::model()->deleteAll($criteria);
           }else{
               $subs = Clients::model()->deleteAll($criteria);
           }
                      
           if( Yii::app()->request->isAjaxRequest ) {             
               $data = array( "error"=>false, "mess"=>Yii::t('all','Клиент: '.($id ? implode(',', $id).' ' : '').'успешно удален(ы)!'), "content"=>null);         
               echo json_encode($data);
               Yii::app()->end(); 
           }
        }
        
        public function getCreateSend($subs) {               
                
            switch ($subs->typesubs_id) {
                case 4:
                    $sends = Iblocks::model()->findFreshNews(); 
                    break;
                case 5:
                    $sends = Iblocks::model()->findFreshArticle();
                    break;
                case 8: 
                    $sends = Realestates::model()->getLastAdv(10);
                    break;
            }
            if ($sends) {
                $subject = 'Рассылка '.mb_strtolower($subs->typesubs->title_send,'UTF-8').' с сайта РосРиэлт-Недвижимость';
                $body_begin = '<html><head><title>'.$subs->typesubs->title_send.' сайта РосРиэлт-Недвижимость'.'</title></head><body>';
                $body.= "Здравствуйте ".$subs->email."<br/><br/>
                             <p>
                                <h1 style='font-size:18px'>Обратите внимание на последние ".mb_strtolower($subs->typesubs->title,'UTF-8')."!</h1></p>";
                $body.= "<p>";
                $body.= '<table width="100%"><tr><td>';
                foreach ($sends as $send) {                        
                    $temps = str_replace('%NAME%',$send->getMaskName(),$subs->typesubs->template);                        
                    $temps = str_replace('%TITLE%',$send->getMaskTitle(),$temps);
                    $temps = str_replace('%ANONS%',$send->getMaskAnons(),$temps);

                    if ($subs->typesubs_id==8) {
                        $temps = str_replace('%PIC_ANONS%',$send->getMaskLinkPicAnons(),$temps);
                    } else if ($subs->typesubs_id==5) {
                        $temps = str_replace('%PIC_ANONS%',$send->getMaskLinkPicAnonsNews(),$temps);
                    } else if ($subs->typesubs_id==4) {
                        $temps = str_replace('%PIC_ANONS%',$send->getMaskLinkPicAnonsArticle(),$temps);
                    }   

                    $temps = str_replace('%DATE%',$send->getMaskDate(),$temps);

                    if ($subs->typesubs_id==8) {
                        $temps = str_replace('%PIC_DETILE%',$send->getMaskLinkPicDetile(),$temps);
                        $temps = str_replace('%URL%',$send->getMaskUrl(),$temps);
                    } else if ($subs->typesubs_id==5) {
                        $temps = str_replace('%PIC_DETILE%',$send->getMaskLinkPicDetileNews(),$temps);
                        $temps = str_replace('%URL%',$send->getMaskUrlNews(),$temps);
                    } else if ($subs->typesubs_id==4) {
                        $temps = str_replace('%PIC_DETILE%',$send->getMaskLinkPicDetileArticle(),$temps); 
                        $temps = str_replace('%URL%',$send->getMaskUrlArticle(),$temps);
                    }   
                    $body.= $temps;
                } 
                $body.= "</tr></td></table>";
                $body.= "</p>";
                    
                $body.= "C уважением Ваш ".CHtml::link('Rosday.ru',
                                   'http://'.Yii::app()->request->serverName,
                                   array('title'=>'Переход на сайт Rosday.ru'))." </br>";//"\r\n";

                $body.= "</p>";                                
                $headers= "Content-type: text/html; charset=utf-8 \r\n";             
                $headers.="From: ".Yii::app()->params['adminEmail']."\r\nReply-To: ".$subs->email."\r\n";                                
                $body_end = '</p></body></html>';                
                mail($subs->email,$subject,$body_begin.$body.$body_end,$headers);  
                                   
                $data = array( "error"=>false, "mess"=>Yii::t('all','Рассылка '.mb_strtolower($subs->typesubs->title_send,'UTF-8').' на '.$subs->email.'<br/> успешно отправлена!'), "content"=>null);
            }else{
                $data = array( "error"=>true, "mess"=>Yii::t('all','Рассылка '.mb_strtolower($subs->typesubs->title_send,'UTF-8').' на '.$subs->email.' '.mb_strtolower($subs->typesubs->title_send,'UTF-8').'<br/> не отправлена!'), "content"=>null);         
            }  
            return $data;
        }
        
        public function actionGroupDeleteEvent() {
           $criteria=new CDbCriteria; 
           if( isset($_POST['group-checkbox-column']) ) {
               $id = $_POST['group-checkbox-column']; 
               /* Определяем клиента */
               $client = ClientDevelopments::model()->findByPk($id[0])->client->id;               
               $criteria->compare('id',$id,true);               
               $subs = ClientDevelopments::model()->deleteAll($criteria);
           }else{
               $subs = ClientDevelopments::model()->deleteAll($criteria);
           }
                      
           if( Yii::app()->request->isAjaxRequest ) {             
               $data = array( "error"=>false, "mess"=>Yii::t('all','События: '.($id ? implode(',', $id).' ' : '').($client ? ' по клиенту '.$client->id : '').' успешно удалено(ы)!'), "content"=>null);         
               echo json_encode($data);
               Yii::app()->end(); 
           }
        }
        
        
        public function actionGroupPrintEvent() {
            
           $criteria=new CDbCriteria; 
           if( isset($_POST['group-checkbox-column']) ) {
               $id = $_POST['group-checkbox-column']; 
               $criteria->compare('id',$id,true);
               $subs = ClientDevelopments::model()->search($criteria);
           }else{
               $subs = ClientDevelopments::model()->search($criteria);
           }
           
           //@TODO Form print
           
           if( Yii::app()->request->isAjaxRequest ) {             
               $data = array( "error"=>false, "mess"=>Yii::t('all','Событие(я): '.($id ? implode(',', $id).' ' : '').'по клиенту '.$_POST['cid'].' успешно распечатано(ы)!'), "content"=>null);         
               echo json_encode($data);
               Yii::app()->end(); 
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
		$dataProvider=new CActiveDataProvider('Clients');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
            
                $this->layout='//layouts/column3_1';
            
		$model=new Clients('search');
		$model->unsetAttributes();  // clear any default values
                
		if(isset($_GET['Clients'])) {                                           
			$model->attributes=$_GET['Clients'];                                                                                                      
                        
                        if ( !empty($_GET['create_date_from']) && !empty($_POST['create_date_to']) )    
                            $model->getDbCriteria()->addBetweenCondition('create_date', 
                                date('Y-m-d', strtotime($_POST['create_date_from'])), date('Y-m-d', strtotime($_POST['create_date_to'])));                

                        if ( !empty($_POST['update_date_from']) && !empty($_POST['update_date_to']) )    
                            $model->getDbCriteria()->addBetweenCondition('update_date', 
                                date('Y-m-d', strtotime($_POST['update_date_from'])), date('Y-m-d', strtotime($_POST['update_date_to'])));                

                }
                
                if ( !Yii::app()->user->checkAccess('superadmin') ) $model->create_user=Yii::app()->user->getId();
                
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
		$model=Clients::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='clients-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}

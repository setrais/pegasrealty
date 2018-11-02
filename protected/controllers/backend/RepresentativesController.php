<?php

class RepresentativesController extends BackendController
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
				'actions'=>array('index','view','ajaxget','ajaxupdate','ajaxcreate','ajaxsave'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','ajaxdelete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);*/
                return array(
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','view','create'),
				'users'=>array('@'),
			),
                    	array('allow', // allow member user to perform 'create' actions
				'actions'=>array('create'),
				'users'=>array('member'),
			),                    
			array('allow', // allow manager and admin and superadmin user to perform 'create' and 'update' actions
				'actions'=>array('create','ajaxupdate','ajaxcreate','ajaxsave','ajaxget','ajaxgetinfo'),
				'roles'=>array('manager','admin','superadmin'),
			),                    
			array('allow', // allow admin and superadmin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','update','ajaxdelete','send', 'info', 'groupDelete', 'groupSend', 'groupSendNews', 'groupSendArticle', 'groupSendAdvartisement'),
				'roles'=>array('admin','superadmin'),
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

        // $what - что записываем собственника (owners) или представителя (representatives)
        public function actionAjaxSave() {
            if (trim($_POST["Representatives"]["id"])<>"") {
                $this->actionAjaxUpdate($_POST["Representatives"]["id"]);                           
            } else {
                $this->actionAjaxCreate();
            }
        }
        
        /**
	 * Creates Ajax a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionAjaxCreate()
	{
		$model=new Representatives;

		// Uncomment the following line if AJAX validation is needed
		//$this->performAjaxValidation($model);
              
                $data = array();
                $data["success"]=false;
                
		if(isset($_POST['Representatives']))
		{
			$model->attributes=$_POST['Representatives'];                        
                        
			if($model->save()) {
                            $data["success"]=true;                            
                            $data["message"]="OK";
                            $data["id"]=$model->id;
                            $data["name"]=$model->name;
                            $data["oper"]="create";
                            $data["what"]=$_POST['what'];
                        } else {
                            
                            $message = Yii::t("form","Errors entering").": ";

                            foreach ($model->errors as $key=>$val) {                                                                
                                $message.=/*$key." : ".*/implode(";",$val)." \n\r";                                
                            }

                            $data["success"]=false;
                            $data["message"]=$message;
                            $data["id"]=$model->id;
                            $data["name"]=$model->name;
                            $data["oper"]="create";
                            $data["what"]=$_POST['what'];
                        }
                        
                        echo json_encode($data);    				
		}else{
                   echo json_encode($data);    		
                }
                Yii::app()->end();       
	}
        
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Representatives;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Representatives']))
		{
			$model->attributes=$_POST['Representatives'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

        /**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionAjaxUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		//$this->performAjaxValidation($model);
                
                $data = array();
                $data["success"]=false;
                
		if(isset($_POST['Representatives']))
		{
			$model->attributes=$_POST['Representatives'];                                                
                        
                        if($model->save()) { 
                            $data["success"]=true;                            
                            $data["message"]="OK";
                            $data["id"]=$model->id;
                            $data["name"]=$model->name;
                            $data["oper"]="update";
                            $data["what"]='owners';
                        } else {
                            $message = Yii::t("form","Errors entering").": ";
                            foreach ($model->errors as $key=>$val) {                                                                
                                $message.=/*$key." : ".*/implode(";",$val)." \n\r";                                
                            }
                            $data["success"]=false;                            
                            $data["message"]=$message;
                            $data["id"]=$model->id;
                            $data["name"]=$model->name;
                            $data["oper"]="update";
                            $data["what"]='owners';
                        }
                        
                        echo json_encode($data);    				                        
		}else{
                        echo json_encode($data);     
                }                                
                Yii::app()->end();
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
		//$this->performAjaxValidation($model);

		if(isset($_POST['Representatives']))
		{                        
			$model->attributes=$_POST['Representatives'];
                        
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

       	public function actionAjaxDelete($id)
	{
                    // we only allow deletion via POST request
                    if ($this->loadModel($id)->delete()) {                                        
                        $data = array( "id"=>$id,"success"=>true, "message"=>"OK" );
                        echo json_encode($data);
                    }
                    else
                    {                            
                        $message = "ERR";
                        $data = array( "id"=>$id,"success"=>false, "message"=>$message );
                        echo json_encode($data);
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
                $dataProvider=new CActiveDataProvider('Representatives',array(
                    'criteria'=>array('order'=>'id DESC'))); 
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
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
        
        public function actionGroupSendNews() {
            return $this->actionGroupSend(5);
        }
        
        public function actionGroupSendArticle() {
            return $this->actionGroupSend(4);
        }        
        
        public function actionSendAdvartisement() {
            return $this->actionGroupSend(8);
        }        
                        
        public function actionGroupDelete() {
           $criteria=new CDbCriteria; 
           if( isset($_POST['group-checkbox-column']) ) {
               $id = $_POST['group-checkbox-column']; 
               $criteria->compare('id',$id,true);
               $subs = Representatives::model()->deleteAll($criteria);
           }else{
               $subs = Representatives::model()->deleteAll($criteria);
           }
                      
           if( Yii::app()->request->isAjaxRequest ) {             
               $data = array( "error"=>false, "mess"=>Yii::t('all','Представитель: '.($id ? implode(',', $id).' ' : '').'успешно удален(ы)!'), "content"=>null);         
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
        
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
                $this->layout='//layouts/column3';
            
		$model=new Representatives('search');
                
		$model->unsetAttributes();  // clear any default values
                                
		if(isset($_GET['Representatives']))
			$model->attributes=$_GET['Representatives'];                
                        $model->getDbCriteria()->select = '*, IF((SELECT count(*) FROM realestates owner WHERE owner.representative_id=t.id)>0,1,0) as isowner ';
                
                $_POST = $_GET;                        
                /*if ( $model->isowner<>'') {                                            
                    if (intval($model->isowner)) {                        
                        $model->getDbCriteria()->addCondition('EXISTS (SELECT * FROM realestates owner WHERE owner.representative_id=t.id)');
                    }    
                    else 
                    {                           
                        $model->getDbCriteria()->addCondition('NOT EXISTS (SELECT * FROM realestates owner WHERE owner.representative_id=t.id)');
                    }    
                }*/
                        
                if ( !empty($_POST['create_date-from']) && !empty($_POST['create_date-to']) )    
                            $model->getDbCriteria()->addBetweenCondition('create_date', 
                            date('Y-m-d', strtotime($_POST['create_date-from'])), date('Y-m-d', strtotime($_POST['create_date-to'])));                

                if ( !empty($_POST['update_date-from']) && !empty($_POST['update_date-to']) )    
                            $model->getDbCriteria()->addBetweenCondition('update_date', 
                                date('Y-m-d', strtotime($_POST['update_date-from'])), date('Y-m-d', strtotime($_POST['update_date-to'])));    
                
                if ( !empty($_POST['Contact_telephone'])) {     
                            $like_telephone = str_replace(")","_",$_POST['Contact_telephone']);
                            $like_telephone = str_replace("(","_",$like_telephone);
                            $like_telephone = str_replace("x","_",$like_telephone);
                            $like_telephone = str_replace("8","_",$like_telephone);
                                         
                                                                      
                            $criteria = new CDbCriteria();                                                   
                            $criteria->condition ="(  (telephone LIKE '%".$like_telephone."%') 
                                                    OR(telephone_1 LIKE '%".$like_telephone."%')
                                                    OR(telephone_2 LIKE '%".$like_telephone."%')
                                                    OR(telephone_3 LIKE '%".$like_telephone."%')    
                                                    )";
                            
                            $model->getDbCriteria()->mergeWith($criteria);
                                
                }    
                
                if ( !empty($_POST['Contact_fax'])) {     
                            $like_fax = str_replace(")","_",$_POST['Contact_fax']);
                            $like_fax = str_replace("(","_",$like_fax);
                            $like_fax = str_replace("x","_",$like_fax);
                            $like_fax = str_replace("8","_",$like_fax);
                                         
                                                                      
                            $criteria = new CDbCriteria();                                                   
                            $criteria->condition ="(  (t.fax LIKE '%".$like_fax."%'))";
                            
                            $model->getDbCriteria()->mergeWith($criteria);
                                
                }   
                
                
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
		$model=Representatives::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='representatives-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}

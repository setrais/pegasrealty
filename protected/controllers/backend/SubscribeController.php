<?php

class SubscribeController extends BackendController
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
			'postOnly + delete', // we only allow deletion via POST request
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
				'actions'=>array('index','view','getAjaxCities','getAjaxSection','getAjaxObject'),
				'users'=>array('*'),
			),
			array(  'allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create'),
				'users'  =>array('user'),
			),
			array('allow', // allow manager and admin and superadmin user to perform 'create' and 'update' actions
				'actions'=>array( 'create','update'),
				'users'  =>array( 'manager','admin','superadmin','director'),
			),                    
			array(  'allow', // allow admin user to perform 'admin' actions
				'actions'=>array('admin', 'send', 'groupSend', 'groupSendNews', 'groupSendArticle', 'groupSendAdvartisement'),
				'users'  =>array('expert','superadmin','admin','director'),
			),
			array(  'allow', // allow admin user to perform 'delete' actions
				'actions'=>array('delete','groupDelete'),
				'users'  =>array('superadmin','admin','director'),
			),                    
			array(  'deny',  // deny all users
				'users'  =>array('*'),
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
               $subs = Subscribe::model()->deleteAll($criteria);
           }else{
               $subs = Subscribe::model()->deleteAll($criteria);
           }
                      
           if( Yii::app()->request->isAjaxRequest ) {             
               $data = array( "error"=>true, "mess"=>Yii::t('all','Рассылка успешно удалена!'), "content"=>null);         
               echo json_encode($data);
               Yii::app()->end(); 
           }
        }
        
        public function actionTypeSubscribe() {
            return TypeSubscribeController::actionAdmin();
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
        
        public function actionSend($id) { 
            $subs = $this->loadModel($id);  
            if( Yii::app()->request->isAjaxRequest ) {      
                echo json_encode($this->getCreateSend($subs));
                Yii::app()->end(); 
            }        
        }
        
        public function actionGetAjaxCities() {
            if( Yii::app()->request->isAjaxRequest ) {                               
                if ( isset($_POST['regions']) ) 
                {    
                    $regions = $_POST['regions'];
                    if (is_array($regions)) 
                    {
                        $render = '_cities';
                    }else{
                        $render = '_city';
                    }   
                    
                    $model=new Subscribe('search');
                    $model->unsetAttributes();  // clear any default values                    
                    $this->renderPartial($render,array(
			'model'=>$model, 'regions'=>$regions
                    ));
                }                 
                Yii::app()->end();
            }  
        }

        public function actionGetAjaxSection() {
            if( Yii::app()->request->isAjaxRequest ) {      
                if ( isset($_POST['typesubs']) ) 
                {                                  
                    $model = array();
                    
                    if (is_array($_POST['typesubs'])) 
                    {
                        $render = '_sections';
                    }else{
                        $render = '_section';
                    }    
                                        
                    
                    $typesubs = TypeSubscribe::model()->findByPk($_POST['typesubs']);
                    if ($typesubs) {                        
                       switch ($typesubs->name) {
                            case 'news' || 'article' :                                
                                $sections =  Iblocks::model()->findAll(
                                array('condition'=>'(typesIblock.id='.$typesubs->tid.')AND(t.grid IS NULL OR t.grid=0)AND(t.act IS NULL OR t.act=1)AND(t.del IS NULL OR t.del=0)',
                                      'order'=>'t.sort',
                                      'with'=>'typesIblock',
                                      'together'=>true,  
                                      'select'=>"t.id,name"));                        
                                foreach($sections as $section) {
                                    $model[] = array('id'=>Iblocks::tableName().$section->id,'text'=>$section->name,'group'=>$typesubs->title);
                                }
                                break;
                            case 'realestate' : 
                                $sections = RealestateFilters::model()->findAll(array("order"=>"name",
                                            'select'=>"id,name"));                        
                                foreach($sections as $section) {
                                    $model[] = array('id'=>  RealestateFilters::tableName().$filter->id,'text'=>$section->name,'group'=>$typesubs->title);  
                                }
                                break;                            
                            default :
                        }
                    }
                                                       
                    $this->renderPartial($render,array(
			'model'=>$model, 'typesubs'=>$_POST['typesubs']
                    ));
                }                 
                Yii::app()->end();
            }  
        }        

        public function actionGetAjaxObject() {
            if( Yii::app()->request->isAjaxRequest ) {                               
                if ( isset($_POST['gid']) ) 
                {   
                    // Имя таблицы 
                    $otable = Order::tableName();                    
                    
                    if (is_array($_POST['gid'])) 
                    {
                        $gids = $_POST['gid'];
                        $render = '_objects';
                    }else{
                        $gids = array($_POST['gid']);
                        $render = '_object';
                    }   
                    
                    $objects = Object::model()->findAll();
                    foreach ( $gids as $gid ) {
                        
                        // Ид.объекта
                        $tid = substr($gid,strlen($otable));
                        // Наименование таблицы объекта
                        $tname = substr($gid,0,strlen($otable));
                        
                        if ($tname===$otable) {
                           foreach ($objects as $object) {  
                             if ( !$object->sorder || in_array($tid,explode(',',$object->sorder))) { 
                                $group =  Order::model()->findByPk(intval($tid));
                                $model[] = array('id'=>$otable.$object->objectid,'text'=>$object->name, 'group'=>$group->name);                                                        
                             }
                           }
                        }
                    } 
                    
                    //print_r($model);
                    //exit();                       
                           
                    $this->renderPartial($render,array(
			'model'=>$model
                    ));
                }                 
                Yii::app()->end();
            }  
        }       
        
        /**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Subscribe;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Subscribe']))
		{
			$model->attributes=$_POST['Subscribe'];
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
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Subscribe']))
		{
			$model->attributes=$_POST['Subscribe'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Subscribe');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Subscribe('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Subscribe']))
			$model->attributes=$_GET['Subscribe'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Subscribe the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Subscribe::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Subscribe $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='subscribe-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}

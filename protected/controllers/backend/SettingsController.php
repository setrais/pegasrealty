<?php

class SettingsController extends BackendController
{
        public $layout='//layouts/column2';
        
        /**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			/*array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array(  'allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create'),
				'users'  =>array('user'),
			),
			array('allow', // allow manager and admin and superadmin user to perform 'create' and 'update' actions
				'actions'=>array( 'create','update'),
				'users'  =>array( 'manager','admin','superadmin'),
			),                    
			array(  'allow', // allow admin user to perform 'admin' actions
				'actions'=>array('admin'),
				'users'  =>array('expert','superadmin','admin'),
			),*/
			array(  'allow', // allow admin user to perform 'delete' actions
				'actions'=>array('index','params','valcurs','send','social'),
				'users'  =>array('superadmin'),
			),   
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

       	/** 
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
	       // renders the view file 'protected/views/site/index.php'
	       // using the default layout 'protected/views/layouts/main.php'
               
               if ( Yii::app()->user->isGuest==false && Yii::app()->user->checkAccess('superadmin')) { 
                    $this->render('index');
               }else{                    
                    $this->redirect(Yii::app()->user->loginUrl);
               }		
	}

        /**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionParams()
	{
	       // renders the view file 'protected/views/site/index.php'
	       // using the default layout 'protected/views/layouts/main.php'
               
               if ( Yii::app()->user->isGuest==false && Yii::app()->user->checkAccess('superadmin')) { 
                    $this->render('params');
               }else{                    
                    $this->redirect(Yii::app()->user->loginUrl);
               }		
	}
        
        /**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionMail()
	{
	       // renders the view file 'protected/views/site/index.php'
	       // using the default layout 'protected/views/layouts/main.php'
               
               if ( Yii::app()->user->isGuest==false && Yii::app()->user->checkAccess('superadmin')) { 
                    $this->render('mail');
               }else{                    
                    $this->redirect(Yii::app()->user->loginUrl);
               }		
	}
        
        /**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionConversion()
	{
	       // renders the view file 'protected/views/site/index.php'
	       // using the default layout 'protected/views/layouts/main.php'
               
               if ( Yii::app()->user->isGuest==false && Yii::app()->user->checkAccess('superadmin')) { 
                    $this->render('conversion');
               }else{                    
                    $this->redirect(Yii::app()->user->loginUrl);
               }		
	}
        
        /**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionSocial()
	{
	       // renders the view file 'protected/views/site/index.php'
	       // using the default layout 'protected/views/layouts/main.php'
               
               if ( Yii::app()->user->isGuest==false && Yii::app()->user->checkAccess('superadmin')) { 
                    $this->render('social');
               }else{                    
                    $this->redirect(Yii::app()->user->loginUrl);
               }		
	}
        
	/** !CSetrais
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
            $this->pageTitle = 'Ошибка';
            
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}
        
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 *
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 *
	public function actionCreate()
	{
		$model=new AuthItem;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['AuthItem']))
		{
			$model->attributes=$_POST['AuthItem'];
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
	 *
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['AuthItem']))
		{
			$model->attributes=$_POST['AuthItem'];
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
	 *
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 *
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('AuthItem');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 *
	public function actionAdmin()
	{
		$model=new AuthItem('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['AuthItem']))
			$model->attributes=$_GET['AuthItem'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return AuthItem the loaded model
	 * @throws CHttpException
	 *
	public function loadModel($id)
	{
		$model=AuthItem::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param AuthItem $model the model to be validated
	 *
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='auth-item-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}*/           
}
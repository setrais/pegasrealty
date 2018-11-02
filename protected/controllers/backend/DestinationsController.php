<?php

class DestinationsController extends BackendController
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
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','view','create','genTitle', 'genDescription','genKeywords'),
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
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Destinations;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Destinations']))
		{
			$model->attributes=$_POST['Destinations'];
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

		if(isset($_POST['Destinations']))
		{
			$model->attributes=$_POST['Destinations'];
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
		$dataProvider=new CActiveDataProvider('Destinations');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Destinations('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Destinations']))
			$model->attributes=$_GET['Destinations'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

        public function actionGenTitle($id=null) {
        
            if( Yii::app()->request->isAjaxRequest ) {
                // Uncomment the following line if AJAX validation is needed
                // $this->performAjaxValidation($model);

                if(isset($_POST['Destinations']))
                {               
                    $model = new Destinations();
                    $model->attributes = $_POST['Destinations'];

                    $data = array( "error"=>false, "mess"=>Yii::t('all','Gen field title for destination').($id ? " №".$id : ""), "content"=>$model->createTitle());
                }else{
                    $data = array( "error"=>true, "mess"=>Yii::t('all','No gen field title for destination').($id ? " №".$id : ""), "content"=>null);         
                }  

                echo json_encode($data);                             

                Yii::app()->end();
            }       
        
        }
        
        public function actionGenDescription($id=null) {
        
            if( Yii::app()->request->isAjaxRequest ) {
                // Uncomment the following line if AJAX validation is needed
                // $this->performAjaxValidation($model);

                if(isset($_POST['Destinations']))
                {               
                    $model = new Destinations();
                    $model->attributes = $_POST['Destinations'];

                    $data = array( "error"=>false, "mess"=>Yii::t('all','Gen field description for destination').($id ? " №".$id : ""), "content"=>$model->createDescription());
                }else{
                    $data = array( "error"=>true, "mess"=>Yii::t('all','No gen field description for destination').($id ? " №".$id : ""), "content"=>null);         
                }  

                echo json_encode($data);                             

                Yii::app()->end();
            }       
        
        }
       
        public function actionGenKeywords($id=null) {
        
            if( Yii::app()->request->isAjaxRequest ) {
                // Uncomment the following line if AJAX validation is needed
                // $this->performAjaxValidation($model);

                if(isset($_POST['Destinations']))
                {               
                    $model = new Destinations();
                    $model->attributes = $_POST['Destinations'];

                    $data = array( "error"=>false, "mess"=>Yii::t('all','Gen field keywords for destination').($id ? " №".$id : ""), "content"=>$model->createKeywords());
                }else{
                    $data = array( "error"=>true, "mess"=>Yii::t('all','No gen field keywords for destination').($id ? " №".$id : ""), "content"=>null);         
                }  

                echo json_encode($data);                             

                Yii::app()->end();
            }       
        
        }
        
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Destinations::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='destinations-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}

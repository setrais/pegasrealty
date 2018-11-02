<?php

class DevelopmentsController extends BackendController
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
				'actions'=>array('create','update','ajaxcreate','ajaxview','ajaxupdate'),
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
	 * Displays a particular model.
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
		),false,true);
            }    
	}        

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($cid=null)
	{
		$model=new Developments;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Developments']) && isset($_POST["cid"]) && trim($_POST["cid"]<>'') )
		{
                        $cid = $_POST["cid"];
                        
                        $model->attributes=$_POST['Developments'];
			if($model->save()) 
                        {                        
                            $clientDevelopments=new ClientDevelopments;
                            $clientDevelopments->client_id=$cid;
                            $clientDevelopments->development_id=$model->id;
                            $clientDevelopments->desc=null;
                            $clientDevelopments->sort=500;
                            $clientDevelopments->act=1;
                            $clientDevelopments->del=0;
                            $clientDevelopments->create_date=date('Y-m-d H:s:i');
                            $clientDevelopments->update_date=date('Y-m-d H:s:i');
                            if ($clientDevelopments->save()) {
                                $this->redirect(array('view','id'=>$model->id));
                            }
                        }
		}

		$this->render('create',array(
			'model'=>$model,
                        'cid'=>$cid,
		));
	}

        /**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionAjaxCreate($cid=null)
	{
            //$this->layout = "//layouts/ajax";

            $cs=Yii::app()->getClientScript();
            if(null!==($scriptMap=Yii::app()->request->getParam('scriptMap')) && is_string($scriptMap)){
                    foreach(explode(',', $scriptMap) as $script)
                        $cs->scriptMap[$script]=false;
            }

            if( Yii::app()->request->isAjaxRequest ) {
		$model=new Developments;
                
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Developments']) && isset($_POST["cid"]) && trim($_POST["cid"]<>'') )
		{
                        $cid = $_POST["cid"];
                        
			$model->attributes=$_POST['Developments'];
			if($model->save()) 
                        {                                                    
                            $clientDevelopments=new ClientDevelopments;
                            $clientDevelopments->client_id=$cid;
                            $clientDevelopments->development_id=$model->id;
                            $clientDevelopments->desc=null;
                            $clientDevelopments->sort=500;
                            $clientDevelopments->act=1;
                            $clientDevelopments->del=0;
                            $clientDevelopments->create_date=date('Y-m-d H:s:i');
                            $clientDevelopments->update_date=date('Y-m-d H:s:i');
                            if ($clientDevelopments->save()) {
                                $data  = array( "error"=>false, "mess"=>Yii::t('all','Developments')." №".$clientDevelopments->id." по клиенту:".$cid, "body"=>null );
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

		if(isset($_POST['Developments']))
		{
			$model->attributes=$_POST['Developments'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
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
            $cs=Yii::app()->getClientScript();
            if(null!==($scriptMap=Yii::app()->request->getParam('scriptMap')) && is_string($scriptMap)){
                    foreach(explode(',', $scriptMap) as $script)
                        $cs->scriptMap[$script]=false;
            }

            if( Yii::app()->request->isAjaxRequest ) {
                                        
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Developments']))
		{
			$model->attributes=$_POST['Developments'];
			if($model->save()) {
                                $data  = array( "error"=>false, "mess"=>Yii::t('all','Developments')." №".$model->clientDevelopments->id." по клиенту:".$cid, "body"=>null );
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
		$dataProvider=new CActiveDataProvider('Developments');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Developments('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Developments']))
			$model->attributes=$_GET['Developments'];

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
		$model=Developments::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='developments-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}

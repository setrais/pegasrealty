<?php

class ClientDevelopmentsController extends BackendController
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
				'actions'=>array('admin','delete','groupprint','groupdelete'),
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

        public function actionGroupDelete() {
           $criteria=new CDbCriteria; 
           if( isset($_POST['group-checkbox-column']) ) {
               $id = $_POST['group-checkbox-column']; 
               $criteria->compare('id',$id,true);
               $subs = ClientDevelopments::model()->deleteAll($criteria);
           }else{
               $subs = ClientDevelopments::model()->deleteAll($criteria);
           }
                      
           if( Yii::app()->request->isAjaxRequest ) {             
               $data = array( "error"=>false, "mess"=>Yii::t('all','События: '.($id ? implode(',', $id).' ' : '').'по клиенту '.$_POST['cid'].' успешно удален(ы)!'), "content"=>null);         
               echo json_encode($data);
               Yii::app()->end(); 
           }
        }
        
        
        public function actionGroupPrint() {
            
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
               $data = array( "error"=>false, "mess"=>Yii::t('all','События: '.($id ? implode(',', $id).' ' : '').'по клиенту '.$_POST['cid'].' успешно распечатан(ы)!'), "content"=>null);         
               echo json_encode($data);
               Yii::app()->end(); 
           }
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
		),false,true);
            }    
	}    
        
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new ClientDevelopments;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ClientDevelopments']))
		{
			$model->attributes=$_POST['ClientDevelopments'];
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
	public function actionAjaxCreate($id=null)
	{
            //$this->layout = "//layouts/ajax";
            
            $cs=Yii::app()->getClientScript();
            if(null!==($scriptMap=Yii::app()->request->getParam('scriptMap')) && is_string($scriptMap)){
                    foreach(explode(',', $scriptMap) as $script)
                        $cs->scriptMap[$script]=false;
            }

            if( Yii::app()->request->isAjaxRequest ) {
		$model=new ClientDevelopments;
                
                $model->client_id = $id;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ClientDevelopments']))
		{                                               
			$model->attributes=$_POST['ClientDevelopments'];
                        $model->createdate=date('Y-m-d H:s:i');
                        $model->createuser=Yii::app()->user->id;
                        
			if($model->save()) 
                        {                                                    
                            $data  = array( "error"=>false, "mess"=>Yii::t('all','Developments')." №".$model->id." по клиенту:".$model->client_id, "body"=>null );
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
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ClientDevelopments']))
		{
			$model->attributes=$_POST['ClientDevelopments'];
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

		if(isset($_POST['ClientDevelopments']))
		{
			$model->attributes=$_POST['ClientDevelopments'];
                        $model->updatedate=date('Y-m-d H:s:i');
                        $model->updateuser=Yii::app()->user->id;
			if($model->save()) {
                                $data  = array( "error"=>false, "mess"=>Yii::t('all','Developments')." №".$model->id." по клиенту:".$model->client_id, "body"=>null );
                                echo json_encode($data);
                                return;
                        }
		}

		$this->renderPartial('_form_ajax',array(
			'model'=>$model,
		),false,true);
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
		$dataProvider=new CActiveDataProvider('ClientDevelopments');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new ClientDevelopments('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ClientDevelopments']))
			$model->attributes=$_GET['ClientDevelopments'];

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
		$model=ClientDevelopments::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='client-developments-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
                
}

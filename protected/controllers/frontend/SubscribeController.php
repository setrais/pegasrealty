<?php

class SubscribeController extends FrontendController
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
				'actions'=>array('add'),
				'users'=>array('*'),
			),
			array(  'deny',  // deny all users
				'users'  =>array('*'),
			),
		);
	}
        
        /**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionAdd()
	{
            if( Yii::app()->request->isAjaxRequest ) {  
                
		$model=new Subscribe();
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_GET['Subscribe']))                    
		{   
                    $model->attributes=$_GET['Subscribe'];                
                    $issubs = Subscribe::model()->exists(array("condition"=>"email=:email AND typesubs_id=:typesubs_id",
                                                               "params"=>array(":email"=>$model->email,":typesubs_id"=>$model->typesubs_id)));
                    if (!$issubs) {
                        
                        if (Yii::app()->user->isGuest) {                             
                            $model->rid = Yii::app()->session['region'];
                            $model->cid = Yii::app()->session['city'];
                        }else{
                            $model->rid = Yii::app()->user->region;
                            $model->cid = Yii::app()->user->city;                            
                        }
                        
			if ($model->save()) {				                                           
                            $data = array( "error"=>false, "mess"=>Yii::t('all','Вы успешно подписаны!</br> на рассылку '
                                    .mb_strtolower($model->typesubs->title_send,'UTF-8')), "content"=>null);
                        }else{                                    
                            $data = array( "error"=>true, "mess"=>Yii::t('all','Ошибка регистрации подписки</br> на рассылку '
                                    .mb_strtolower($model->typesubs->title_send.'<br/>'.CHtml::errorSummary($model),'UTF-8')), "content"=>null);                            
                        }    
                    }else{
                        $data = array( "error"=>true, "mess"=>Yii::t('all','Вы уже подписаны!<br/> на рассылку'), "content"=>null);         
                    }
                }else{
                    $data = array( "error"=>true, "mess"=>Yii::t('all','Данные для подписки не указаны!'), "content"=>null);         
                }     
                echo json_encode($data);
                Yii::app()->end();
            }    
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

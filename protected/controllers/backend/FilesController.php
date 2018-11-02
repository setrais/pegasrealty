<?php

class FilesController extends Controller
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
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','upload'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
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

        public function actionUpload($name="",$source_action="",$source_controller="",$status="created",$description="") {
            
            Yii::import('application.extensions.EAjaxUpload.FileUploader');            
            $folder = 'uploads/files/';
            $uploader = new FileUploader(array('jpeg','jpg', 'gif', 'png'));
            $result = $uploader->handleUpload(MyFilesystem::makeDirs('uploads/files/'));

            if (isset($result['success']) && $result['success'] === true) {
                $files = new Files;                
                $ri = new Ri();                
                $files->uid = $ri->genid();
                $files->name = trim($name);

                $files->file_size = filesize($folder.$result['filename']);                                
                $files->ext = CFileHelper::getExtension($folder.$result['filename']);
                $files->subdir = $folder;                
                $files->file_name = $result['filename'];
                         
                $files->content_type = CFileHelper::getMimeType($result['filename']);
                $files->original_name =$files->subdir.$result['filename'];                                   
              
                if ( !(strpos($files->content_type,"image")===false) ) {
                    $image = new MySimpleImage;
                    $image->load(Yii::app()->basePath . '/../'.$files->original_name);
                    $files->height = $image->getHeight();
                    $files->width = $image->getWidth();
                }
                
                $files->action =$source_action;
                $files->controller =$source_controller;                
                               
                if ( $status=='created' || trim($files->created)=="") {
                    $files->created = strtotime(time());
                    $files->created_user =Yii::app()->user->id;                
                    $files->status = $status;
                }
                
                if ( $status=='updated') {
                    $files->updated = strtotime(time());
                    $files->updated_user =Yii::app()->user->id;
                    $files->status = "refused";
                }
                
                if (trim($description)<>"") {                    
                    $files->description =$description;
                }      
                
                $files->timetamp_x=time();
                
                //print_r($files->attributes); exit;                   
                if ( !$files->save() ) $result['success'] = false;
            }

            echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);
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
		$model=new Files;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Files']))
		{
			$model->attributes=$_POST['Files'];
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

		if(isset($_POST['Files']))
		{
			$model->attributes=$_POST['Files'];
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
		$dataProvider=new CActiveDataProvider('Files');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Files('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Files']))
			$model->attributes=$_GET['Files'];

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
		$model=Files::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='files-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}

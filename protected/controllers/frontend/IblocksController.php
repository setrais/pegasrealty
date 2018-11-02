<?php

class IblocksController extends Controller
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
				'actions'=>array('create','update'),
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
				'actions'=>array('index','view'),
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
		$model=new Iblocks;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
                // Генерация ID                        
                $model = $this->genIds($model);
                
		if(isset($_POST['Iblocks']))
		{
			$model->attributes=$_POST['Iblocks'];
                        // Генерация ID                        
                        $model = $this->genIds($model);
                        
                        if (trim($model->createdate)<>'') $model->createdate = date('Y-m-d',strtotime($model->createdate));
                        else $model->createdate=null;
                        if (trim($model->updatedate)<>'') $model->updatedate = date('Y-m-d',strtotime($model->updatedate));
                        else $model->updatedate=null;
                        
			if($model->save()) :
                            // Запись свойств недвижемести
                            $this->SavePropsIblocks($model);
                            $this->redirect(array('view','id'=>$model->id));
                        endif;

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
                // Генерация ID в случае если нет параметров                       
                $model = $this->genIds($model);
                
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Iblocks']))
		{			
                    	$model->attributes=$_POST['Iblocks'];
                        
                        /* Перегенерация sid;
                           !TODO в дальнейшем нужно пересмотреть генерацию с формы*/                        
                        $model->sid = HRu::translit($model->name);
                        
                        if (trim($model->createdate)<>'') $model->createdate = date('Y-m-d',strtotime($model->createdate));
                        else $model->createdate=null;
                        if (trim($model->createdate)<>'') $model->createdate = date('Y-m-d',strtotime($model->createdate));
                        else $model->createdate=null;
                                                
			if($model->save())
                        {    
                            $this->SavePropsIblocks($model);
			    $this->redirect(array('view','id'=>$model->id));
                        }
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

        protected function SavePropsIblocks($model, $copid="") {            
                             
           // Запись фото орегинала недвижемости
           $file_picOreginal=$this->SetPicOreginal($model->id, $model, $copid);             
           if ($file_picOreginal->id) $attributes["pic_oreginal_id"]= $file_picOreginal->id ;                             
           else if ($file_picOreginal===null) $attributes["pic_oreginal_id"]= null ;                             
                             
           // Запись фото скриншота недвижемости                             
           $file_picScr=$this->SetPicScr($model->id, $model, $copid);           
           if ($file_picScr->id) $attributes["pic_scr_id"]= $file_picScr->id ; 
           else if ($file_picScr===null) $attributes["pic_scr_id"]=null; 
                             
           // Запись фото анонса недвижемости
           $file_picAnons=$this->SetPicAnons($model->id, $model, $copid);   
           if ($file_picAnons->id) $attributes["pic_anons_id"]= $file_picAnons->id ;                                 
           else if ($file_picAnons===null) $attributes["pic_anons_id"]=null; 
                             
           // Запись детального фото недвижемости
           $file_picDetile=$this->SetPicDetile($model->id, $model, $copid);
           if ($file_picDetile->id) $attributes["pic_detile_id"]= $file_picDetile->id ;                                                        
           else if ($file_picDetile===null) $attributes["pic_detile_id"]= null ;                                                        
                             
           // Обновление модели
           $model->attributes = $attributes;
           $model->update();                                                                        
           
           // Запись 
           $errors = array();
           if (is_array($model->errors))
               $errors = array_merge($errors,$model->errors);
                             
           if (is_array($properties->errors)) 
               $errors = array_merge($errors,$properties->errors);                             
           if (is_array($representatives->errors)) 
               $errors = array_merge($errors,$representatives->errors);
           if (is_array($similarities->errors)) 
               $errors = array_merge($errors,$similarities->errors);                             
           if (is_array($others->errors)) 
               $errors = array_merge($errors,$others->errors);
           if (is_array($file_picOreginal->errors))
               $errors = array_merge($errors,$file_picOreginal->errors);                             
           if (is_array($file_picScr->errors))
               $errors = array_merge($errors,$file_picScr->errors);
           if (is_array($file_picAnons->errors))
               $errors = array_merge($errors,$file_picAnons->errors);
           if (is_array($file_picDetile->errors))
               $errors = array_merge($errors,$file_picDetile->errors);
                                     
           // !@TODO Cобрать все ошибки Переход при удачной записи
           if ( empty($errors)) $this->redirect(array('view','id'=>$model->id));                                                                                                                                                                         

        }

        protected function SetPicDetile($id, $model, $copid="") {
            return $this->SetPic($id, $model, 'pic_detile_id','Картинка детально '. Yii::t('all','iblock'), $copid);
        }

        protected function SetPicAnons($id, $model, $copid="" ) {
            return $this->SetPic($id, $model, 'pic_anons_id','Анонс картинки '. Yii::t('all','iblock'), $copid);
        }

        protected function SetPicOreginal($id, $model, $copid="" ) {
            return $this->SetPic($id, $model, 'pic_oreginal_id','Орегинал '. Yii::t('all','iblock'), $copid);
        }

        protected function SetPicScr($id, $model, $copid="" ) {
            return $this->SetPic($id, $model, 'pic_scr_id','Скриншот '. Yii::t('all','iblock'),$copid);
        }
        
        protected function SetPic($id, $model, $field_imp,$file_title, $copid="") {

          if ( !(is_array($exts)) ) {
              $exts=array('jpg','jpeg','png');
          } 
          
          $field = str_replace("_", "", $field_imp);
          $field = str_replace("id", "", $field);
          $field = str_replace("pic", "", $field);
          $field = "pic".ucfirst($field);

          //Yii::app()->end();
          //print_r($_FILES); 
          //echo "<br/>".trim($_FILES['Iblocks']["name"][$field]);
          //exit;
                                 
          $file = $this->SaveFile($id, $model, $field, $file_title, false );             
          
          if ( is_object($file) ) {                                                                         
                                                 
             if (isset($_POST['Iblocks'][$field_imp]) && trim($_POST['Iblocks'][$field_imp])<>"" && trim($copid)==="" ) 
             {                             
               
               $file_record = Files::model()->find('id=:id', array(':id'=>$_POST['Iblocks'][$field_imp]));
               
               //echo $_POST['Iblocks'][$field_imp];
               //echo "<pre>"; print_r($file_record); echo "<pre/>";
          
               // Save upload files Many Field             
                   
               if ($file_record) {                   
                   
                   $attributes = array( "status"          => "refused",
                                        "height"          => $file->height,
                                        "width"           => $file->width,
                                        "file_size"       => $file->file_size,
                                        "ext"             => $file->ext,
                                        "subdir"          => $file->subdir,
                                        "file_name"       => $file->file_name,
                                        "original_name"   => $file->original_name,
                                        "content_type"    => $file->content_type,                                                          
                                        "updated_user"    => Yii::app()->user->id,
                                        "updated"         => date('Y-m-d'),
                                        "controller"      => $file->controller,
                                        "action"          => $file->action);                        
                   
                   $file_record->attributes=$attributes;
                  
                   // Зачистка файлов
                   $file_old=Files::model()->findAll('id='.$file_record->id);  
             
                   if( is_file(Yii::app()->getBasePath()."/../".$file_old->original_name)) {
                       unlink(Yii::app()->getBasePath()."/../".$file_old->original_name);
                       unlink(Yii::app()->getBasePath()."/../".str_replace("original","src",$file_old->original_name));                                                                           
                       unlink(Yii::app()->getBasePath()."/../".str_replace("original","small",$file_old->original_name));                                                                           
                       unlink(Yii::app()->getBasePath()."/../".str_replace("original","big",$file_old->original_name));                                                                           
                   }
             
               }else $file_record = $file;
             }else $file_record = $file;                                           
             
             if ( $file_record->save() ) {                 
                 return $file_record; /* echo "Файл орегинала записан" */;       
             }                              
          } 

          // Удаление если не существует
          if ( !isset($_POST['Iblocks'][$field_imp]) && trim($model->$field_imp)<>"" && trim($copid)==="" ) 
          {  
             /*!@TODO Проверить */   
             // Зачистка файлов
             $file_old=Files::model()->find('id=:id', array(':id'=>$model->$field_imp));               
             
             if( is_file(Yii::app()->getBasePath()."/../".$file_old->original_name)) {
                 unlink(Yii::app()->getBasePath()."/../".$file_old->original_name);
                 unlink(Yii::app()->getBasePath()."/../".str_replace("original","src",$file_old->original_name));                                                                           
                 unlink(Yii::app()->getBasePath()."/../".str_replace("original","small",$file_old->original_name));                                                                           
                 unlink(Yii::app()->getBasePath()."/../".str_replace("original","big",$file_old->original_name));                                                                           
             }                 
                                                 

             Files::model()->deleteAll('id='.$model->$field_imp);   
             return null; 
          
          // Копирование файлов изображения недвижемости                          
          } else if ( isset($_POST['Iblocks'][$field_imp]) && trim($model->$field_imp)<>"" && trim($copid)<>"" ) {
             
             $file_copy=Files::model()->find('id=:id', array(':id'=>$model->$field_imp));               
             
             /*if ($field_imp == "pic_oreginal_id") {
                echo "<pre>"; print_r($file_copy->attributes); echo "</pre>";
                exit;
             }*/
                     
             $file_record = new Files();  $id=$file_record->id;           
             $file_record->attributes = $file_copy->attributes;
             $file_record->id = $id;
             
             if ( $file_record->save() ) {
                 return $file_record;   
             }else{
                return false; 
             }
          } else {
             return false;              
          }
                    
        }

        // Save files        
        protected function SaveFile($id, $model, $field, $file_title, $save_model=false, $key=null, $is_image=true) {                                        
                                       
           //echo "<pre>"; print_r($_FILES["Iblocks"]); "</pre>"; 
           $is_upfile = ( $key!==null ? $_FILES["Iblocks"]["name"][$field]<>"" 
                                      : $_FILES["Iblocks"]["name"][$field][$key]<>"" );           
           if ( isset($_FILES["Iblocks"]["name"][$field]) && $is_upfile ) 
           {                             
               if ( $key!==null ) {
                   //echo "model:[$key]".$field;                        
                   $upfile=CUploadedFile::getInstancesByName("Iblocks[".$field."]");                                      
                   $upfile=$upfile[$key];
               }    
               else 
               { 
                   $upfile=CUploadedFile::getInstance($model,$field);   
                   //print_r($upfile);
                   //exit;
               }
                                                
               if (!empty($upfile)) {                            

                   $pathto = Yii::app()->getBasePath()."/../";                                                        
                   $pathto_tmp = "uploads/tmp";                                                        
                   $pathfull_tmp_file = $pathto.$pathto_tmp."/".$upfile->name;                
                                                           
                   $Ri = new Ri(); $uid=$Ri->genid();

                   $pathto_original = "uploads/files";                            
                   $file_name =  $model->tableName()."_".$uid."_original.".$upfile->extensionName;                                        
                   $path_original_file = $pathto_original."/".$file_name;                            
                   $pathfull_original_file = $pathto.$path_original_file; 
      
                   if ( $upfile->saveAs($pathfull_original_file) ) {                                                                                                        
  
                       // Ресайз картинок 
                       if ($is_image) 
                       {          
                           
                          $pathto_src_file  = $pathto.$pathto_original."/".$model->tableName()."_".$uid."_src.".$upfile->extensionName;                    
                          $pathto_big_file  = $pathto.$pathto_original."/".$model->tableName()."_".$uid."_big.".$upfile->extensionName;                    
                          $pathto_small_file= $pathto.$pathto_original."/".$model->tableName()."_".$uid."_small.".$upfile->extensionName;

                          $images = new RiImage();
                          $images->scr_photo->width=null;
                          $images->scr_photo->max_width=60;
                          $images->scr_photo->height=40;
                          $images->small_photo->width=null;//120;
                          $images->small_photo->height=80;
                          $images->big_photo->width=null;//800;
                          $images->big_photo->height=600;

                          // Ресайз картинок в выводом ошибок в буфер                               

                          $resize_src   = $images->resize( $pathfull_original_file, $pathto_src_file, $images->scr_photo);
                          $resize_small = $images->resize( $pathfull_original_file, $pathto_small_file, $images->small_photo);
                          $resize_big   = $images->resize( $pathfull_original_file, $pathto_big_file, $images->big_photo);                          
                          
                          // Получаем размеры в масив
                          $imgwh = getimagesize($pathfull_original_file); 
                          $img_height = $imgwh[1]; 
                          $img_width = $imgwh[0]; 

                       }else{
                           $img_height = null;
                           $img_width = null;
                       } 
                                             
                       // Запись картинки орегинала
                       $file = new Files();                                              

                       $attributes = array( "uid"                => $uid,
                                               "status"          => "created",
                                               "name"            => $file_title." №".$id,  
                                               "order"           => 500,
                                               "height"          => $img_height,
                                               "width"           => $img_width,
                                               "file_size"       => $upfile->size,
                                               "ext"             => $upfile->extensionName,
                                               "subdir"          => $pathto_original,
                                               "file_name"       => $file_name,
                                               "original_name"   => $path_original_file,
                                               "content_type"    => $upfile->type,
                                               "created_user"    => Yii::app()->user->id,
                                               "created"         => date('Y-m-d'),
                                               "controller"      => $this->getId(),
                                               "action"          => $this->getAction()->getId());                                           

                       $file->attributes=$attributes;                    
                       if ( $save_model ) {
                           if ( !($file->save()) ) $errors = $file->errors; /* echo "Файл орегинала записан" */
                       }
                       return $file;
                   }
                   else return false;
               }          
               else return false;
            }             
        }

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Iblocks');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Iblocks('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Iblocks']))
			$model->attributes=$_GET['Iblocks'];

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
		$model=Iblocks::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='ri-iblocks-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
        protected function genIds($model, $is_gen=false) 
        {
            $Ri = new Ri;
            if (trim($model->uid)=='' || $is_gen ) $model->uid = $Ri->genid();                         
            if ( ( trim($model->sid)=='' || $is_gen ) && trim($model->name)<>'' ) $model->sid = HRu::translit($model->name);
            //if (trim($model->nid)=='') $model->nid = strtoupper(HCommon::genRandomString());
            if (trim($model->nid)=='' || $is_gen ) $model->nid = rand(1,99999).strtoupper(HCommon::genRandomString(2,'',array('num'=>false)));
                
            return $model;
        } 
}

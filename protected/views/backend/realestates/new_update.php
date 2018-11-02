<?php
$this->breadcrumbs=array(
	Yii::t('all','Realestates')=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	Yii::t('all','Update'),
);

$this->menu=array(
	array('label'=>Yii::t('menu-adm','List Realestates'), 'url'=>array('index'),
              'visible'=>   Yii::app()->user->checkAccess('superadmin') 
                         || Yii::app()->user->checkAccess('admin') 
                         || Yii::app()->user->checkAccess('manager') 
                         || Yii::app()->user->checkAccess('expert')
                         || Yii::app()->user->checkAccess('member')
                         || Yii::app()->user->checkAccess('editor')
        ),
	array('label'=>Yii::t('form','Create Realestates'), 'url'=>array('create'),
            'visible'=>   Yii::app()->user->checkAccess('superadmin') 
                         || Yii::app()->user->checkAccess('admin') 
                         || Yii::app()->user->checkAccess('manager') 
                         || Yii::app()->user->checkAccess('expert')
             ),
	array('label'=>Yii::t('all','View Realestates'), 'url'=>array('view', 'id'=>$model->id),
              'visible'=>   Yii::app()->user->checkAccess('superadmin') 
                         || Yii::app()->user->checkAccess('admin') 
                         || Yii::app()->user->checkAccess('manager') 
                         || Yii::app()->user->checkAccess('expert')
                         || Yii::app()->user->checkAccess('member')
                         || Yii::app()->user->checkAccess('editor')
        ),
	array('label'=>Yii::t('menu-adm','Manage Realestates'), 'url'=>array('admin'),
              'visible'=>   Yii::app()->user->checkAccess('superadmin') 
                         || Yii::app()->user->checkAccess('admin') 
                         || Yii::app()->user->checkAccess('manager') 
                         || Yii::app()->user->checkAccess('editor')
             ),
);
?>

<h1><?php echo Yii::t('menu-adm','Update Realestates');?> №<?php echo $model->id; ?></h1>
<?php echo $this->renderPartial('_new_form', array('model'=>$model,'map'=>$map)); ?>
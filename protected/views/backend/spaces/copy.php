<?php
$this->breadcrumbs=array(
	Yii::t('all','Spaces')=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	Yii::t('all','Copy'),
);

$this->menu=array(
	array('label'=>Yii::t('menu-adm','List Spaces'), 'url'=>array('index'),
              'visible'=>   Yii::app()->user->checkAccess('superadmin') 
                         || Yii::app()->user->checkAccess('admin') 
                         || Yii::app()->user->checkAccess('manager') 
                         || Yii::app()->user->checkAccess('expert')
                         || Yii::app()->user->checkAccess('member')),
	array('label'=>Yii::t('form','Create Spaces'), 'url'=>array('create'),
            'visible'=>   Yii::app()->user->checkAccess('superadmin') 
                         || Yii::app()->user->checkAccess('admin') 
                         || Yii::app()->user->checkAccess('manager') 
                         || Yii::app()->user->checkAccess('expert')
             ),
	array('label'=>Yii::t('all','View Spaces'), 'url'=>array('view', 'id'=>$model->id),
              'visible'=>   Yii::app()->user->checkAccess('superadmin') 
                         || Yii::app()->user->checkAccess('admin') 
                         || Yii::app()->user->checkAccess('manager') 
                         || Yii::app()->user->checkAccess('expert')
                         || Yii::app()->user->checkAccess('member')),
	array('label'=>Yii::t('menu-adm','Manage Spaces'), 'url'=>array('admin'),
              'visible'=>   Yii::app()->user->checkAccess('superadmin') 
                         || Yii::app()->user->checkAccess('admin') 
                         || Yii::app()->user->checkAccess('manager') 
                         
             ),
);
?>

<h1><?php echo Yii::t('menu-adm','Copy Spaces');?> №<?php echo $model->id; ?></h1>
<?php echo $this->renderPartial('_form', array('model'=>$model,'map'=>$map)); ?>
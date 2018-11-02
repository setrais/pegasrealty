<?php
$this->breadcrumbs=array(
	Yii::t('all','Spaces')=>array('index'),
	Yii::t('all','Create'),
);

$this->menu=array(
	array('label'=>Yii::t('menu-adm','List Spaces'), 'url'=>array('index'),
              'visible'=>   Yii::app()->user->checkAccess('superadmin') 
                         || Yii::app()->user->checkAccess('admin') 
                         || Yii::app()->user->checkAccess('manager') 
                         || Yii::app()->user->checkAccess('expert')
                         || Yii::app()->user->checkAccess('member')),
	array('label'=>Yii::t('menu-adm','Manage Spaces'), 'url'=>array('admin'),
              'visible'=>   Yii::app()->user->checkAccess('superadmin') 
                         || Yii::app()->user->checkAccess('admin') 
                         || Yii::app()->user->checkAccess('manager') 
             )        
);
?>

<h1><?=Yii::t('form','Create Spaces');?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'map'=>$map)); ?>
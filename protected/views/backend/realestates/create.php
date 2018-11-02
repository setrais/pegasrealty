<?php
$this->breadcrumbs=array(
	Yii::t('all','Realestates')=>array('index'),
	Yii::t('all','Create'),
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
	array('label'=>Yii::t('menu-adm','Manage Realestates'), 'url'=>array('admin'),
              'visible'=>   Yii::app()->user->checkAccess('superadmin') 
                         || Yii::app()->user->checkAccess('admin') 
                         || Yii::app()->user->checkAccess('manager') 
                         || Yii::app()->user->checkAccess('editor')
             )        
);
?>

<h1><?=Yii::t('form','Create Realestates');?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'map'=>$map)); ?>
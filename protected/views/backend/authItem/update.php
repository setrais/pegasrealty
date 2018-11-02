<?php
/* @var $this AuthItemController */
/* @var $model AuthItem */

$this->breadcrumbs=array(
	Yii::t('all','Auth Items')=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	Yii::t('all','Update'),
);

$this->menu=array(
	array('label'=>Yii::t('adm-menu','List AuthItem'), 'url'=>array('index')),
	array('label'=>Yii::t('adm-menu','Create AuthItem'), 'url'=>array('create')),
	array('label'=>Yii::t('adm-menu','View AuthItem'), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>Yii::t('adm-menu','Manage AuthItem'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('all','Update AuthItem');?> #<?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
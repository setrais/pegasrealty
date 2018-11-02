<?php
/* @var $this AuthItemController */
/* @var $model AuthItem */

$this->breadcrumbs=array(
	Yii::t('all','Auth Items')=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>Yii::t('adm-menu','List AuthItem'), 'url'=>array('index')),
	array('label'=>Yii::t('adm-menu','Create AuthItem'), 'url'=>array('create')),
	array('label'=>Yii::t('adm-menu','Update AuthItem'), 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>Yii::t('adm-menu','Delete AuthItem'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t('adm-menu','Manage AuthItem'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('form','View AuthItem');?> #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'type',
		'description',
		'bizrule',
		'data',
	),
)); ?>

<?php
$this->breadcrumbs=array(
	Yii::t('all','Developments')=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>Yii::t('adm-menu','List Developments'), 'url'=>array('index')),
	array('label'=>Yii::t('adm-menu','Create Developments'), 'url'=>array('create')),
	array('label'=>Yii::t('adm-menu','Update Developments'), 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>Yii::t('adm-menu','Delete Developments'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t('adm-menu','Manage Developments'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('adm-menu','View Developments');?> №<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'abbr',
		'title',
		'sort',
		'act',
		'del',
		'createdate',
		'updatedate',
		'desc',
	),
)); ?>

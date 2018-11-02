<?php
$this->breadcrumbs=array(
	Yii::t('all','Orders')=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>Yii::t('adm-menu','List Orders'), 'url'=>array('index')),
	array('label'=>Yii::t('adm-menu','Create Orders'), 'url'=>array('create')),
	array('label'=>Yii::t('adm-menu','Update Orders'), 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>Yii::t('adm-menu','Delete Orders'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t('adm-menu','Manage Orders'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('adm-menu','View Orders'); ?> #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'createdate',
		'updatedate',
		'createuser',
		'updateuser',
		'act',
		'del',
		'sort',
		'operation_id',
		'price_from',
		'price_to',
		'area_from',
		'area_to',
		'realestate_type_id',
		'realestate_vid_id',
		'realestate_class_id',
		'district_id',
		'valute_id',
		'unit_id',
		'remoteness',
		'unit_value',
		'poligon',
	),
)); ?>

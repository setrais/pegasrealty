<?php
$this->breadcrumbs=array(
	'Fcost Offers'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List FcostOffers', 'url'=>array('index')),
	array('label'=>'Create FcostOffers', 'url'=>array('create')),
	array('label'=>'Update FcostOffers', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete FcostOffers', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage FcostOffers', 'url'=>array('admin')),
);
?>

<h1>View FcostOffers #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'uid',
		'sid',
		'valute_id',
		'grid',
		'init_value',
		'final_value',
		'sort',
		'act',
		'del',
		'desc',
		'anons',
		'detile',
		'description',
		'seo_title',
		'seo_desc',
		'seo_keywords',
		'create_date',
		'update_date',
	),
)); ?>

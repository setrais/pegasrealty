<?php
$this->breadcrumbs=array(
	'Fsimilar Offers'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List FsimilarOffers', 'url'=>array('index')),
	array('label'=>'Create FsimilarOffers', 'url'=>array('create')),
	array('label'=>'Update FsimilarOffers', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete FsimilarOffers', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage FsimilarOffers', 'url'=>array('admin')),
);
?>

<h1>View FsimilarOffers #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'init_value',
		'final_value',
		'approx',
		'sort',
		'act',
		'del',
		'create_date',
		'update_date',
		'desc',
	),
)); ?>

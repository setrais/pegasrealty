<?php
$this->breadcrumbs=array(
	'Realestate Similarities'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List RealestateSimilarities', 'url'=>array('index')),
	array('label'=>'Create RealestateSimilarities', 'url'=>array('create')),
	array('label'=>'Update RealestateSimilarities', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete RealestateSimilarities', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage RealestateSimilarities', 'url'=>array('admin')),
);
?>

<h1>View RealestateSimilarities #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'realestate_id',
		'similaries_id',
	),
)); ?>

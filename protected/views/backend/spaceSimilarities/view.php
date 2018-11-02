<?php
$this->breadcrumbs=array(
	'Space Similarities'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List SpaceSimilarities', 'url'=>array('index')),
	array('label'=>'Create SpaceSimilarities', 'url'=>array('create')),
	array('label'=>'Update SpaceSimilarities', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete SpaceSimilarities', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SpaceSimilarities', 'url'=>array('admin')),
);
?>

<h1>View SpaceSimilarities #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'space_id',
		'similaries_id',
	),
)); ?>

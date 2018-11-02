<?php
$this->breadcrumbs=array(
	'Source Messages'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List SourceMessages', 'url'=>array('index')),
	array('label'=>'Create SourceMessages', 'url'=>array('create')),
	array('label'=>'Update SourceMessages', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete SourceMessages', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SourceMessages', 'url'=>array('admin')),
);
?>

<h1>View SourceMessages #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'uid',
		'category',
		'section',
		'message',
	),
)); ?>

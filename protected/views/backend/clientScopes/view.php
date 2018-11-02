<?php
$this->breadcrumbs=array(
	'Client Scopes'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List ClientScopes', 'url'=>array('index')),
	array('label'=>'Create ClientScopes', 'url'=>array('create')),
	array('label'=>'Update ClientScopes', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ClientScopes', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ClientScopes', 'url'=>array('admin')),
);
?>

<h1>View ClientScopes #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'abbr',
		'title',
		'sort',
		'act',
		'del',
		'create_date',
		'update_date',
		'desc',
	),
)); ?>

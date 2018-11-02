<?php
$this->breadcrumbs=array(
	'Realestate Filters'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List RealestateFilters', 'url'=>array('index')),
	array('label'=>'Create RealestateFilters', 'url'=>array('create')),
	array('label'=>'Update RealestateFilters', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete RealestateFilters', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage RealestateFilters', 'url'=>array('admin')),
);
?>

<h1>View RealestateFilters #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'aid',
		'name_title',
		'name_many',
		'name_that',
		'fomula',
		'desc',
		'uid',
		'name',
	),
)); ?>

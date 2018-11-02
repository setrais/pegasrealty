<?php
$this->breadcrumbs=array(
	'Realestate Filters'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List RealestateFilters', 'url'=>array('index')),
	array('label'=>'Create RealestateFilters', 'url'=>array('create')),
	array('label'=>'View RealestateFilters', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage RealestateFilters', 'url'=>array('admin')),
);
?>

<h1>Update RealestateFilters <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
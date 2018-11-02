<?php
$this->breadcrumbs=array(
	'Realestate Types'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List RealestateTypes', 'url'=>array('index')),
	array('label'=>'Create RealestateTypes', 'url'=>array('create')),
	array('label'=>'View RealestateTypes', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage RealestateTypes', 'url'=>array('admin')),
);
?>

<h1>Update RealestateTypes <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
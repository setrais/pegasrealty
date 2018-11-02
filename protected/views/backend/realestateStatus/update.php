<?php
$this->breadcrumbs=array(
	'Realestate Statuses'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List RealestateStatus', 'url'=>array('index')),
	array('label'=>'Create RealestateStatus', 'url'=>array('create')),
	array('label'=>'View RealestateStatus', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage RealestateStatus', 'url'=>array('admin')),
);
?>

<h1>Update RealestateStatus <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
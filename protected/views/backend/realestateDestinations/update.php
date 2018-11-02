<?php
$this->breadcrumbs=array(
	'Realestate Destinations'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List RealestateDestinations', 'url'=>array('index')),
	array('label'=>'Create RealestateDestinations', 'url'=>array('create')),
	array('label'=>'View RealestateDestinations', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage RealestateDestinations', 'url'=>array('admin')),
);
?>

<h1>Update RealestateDestinations <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
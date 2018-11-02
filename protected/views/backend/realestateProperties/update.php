<?php
$this->breadcrumbs=array(
	'Realestate Properties'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List RealestateProperties', 'url'=>array('index')),
	array('label'=>'Create RealestateProperties', 'url'=>array('create')),
	array('label'=>'View RealestateProperties', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage RealestateProperties', 'url'=>array('admin')),
);
?>

<h1>Update RealestateProperties <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
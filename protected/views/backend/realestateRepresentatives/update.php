<?php
$this->breadcrumbs=array(
	'Realestate Representatives'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List RealestateRepresentatives', 'url'=>array('index')),
	array('label'=>'Create RealestateRepresentatives', 'url'=>array('create')),
	array('label'=>'View RealestateRepresentatives', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage RealestateRepresentatives', 'url'=>array('admin')),
);
?>

<h1>Update RealestateRepresentatives <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
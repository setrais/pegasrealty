<?php
$this->breadcrumbs=array(
	'Plannings'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Plannings', 'url'=>array('index')),
	array('label'=>'Create Plannings', 'url'=>array('create')),
	array('label'=>'View Plannings', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Plannings', 'url'=>array('admin')),
);
?>

<h1>Update Plannings <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
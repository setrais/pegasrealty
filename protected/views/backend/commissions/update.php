<?php
$this->breadcrumbs=array(
	'Commissions'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Commissions', 'url'=>array('index')),
	array('label'=>'Create Commissions', 'url'=>array('create')),
	array('label'=>'View Commissions', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Commissions', 'url'=>array('admin')),
);
?>

<h1>Update Commissions <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
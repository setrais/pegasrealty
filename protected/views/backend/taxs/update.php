<?php
$this->breadcrumbs=array(
	'Taxs'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Taxs', 'url'=>array('index')),
	array('label'=>'Create Taxs', 'url'=>array('create')),
	array('label'=>'View Taxs', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Taxs', 'url'=>array('admin')),
);
?>

<h1>Update Taxs <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
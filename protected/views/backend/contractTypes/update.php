<?php
$this->breadcrumbs=array(
	'Contract Types'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ContractTypes', 'url'=>array('index')),
	array('label'=>'Create ContractTypes', 'url'=>array('create')),
	array('label'=>'View ContractTypes', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ContractTypes', 'url'=>array('admin')),
);
?>

<h1>Update ContractTypes <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
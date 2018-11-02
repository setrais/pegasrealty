<?php
$this->breadcrumbs=array(
	'Tax References'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List TaxReference', 'url'=>array('index')),
	array('label'=>'Create TaxReference', 'url'=>array('create')),
	array('label'=>'View TaxReference', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage TaxReference', 'url'=>array('admin')),
);
?>

<h1>Update TaxReference <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
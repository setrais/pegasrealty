<?php
$this->breadcrumbs=array(
	'Realestate Foto Types'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List RealestateFotoTypes', 'url'=>array('index')),
	array('label'=>'Create RealestateFotoTypes', 'url'=>array('create')),
	array('label'=>'View RealestateFotoTypes', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage RealestateFotoTypes', 'url'=>array('admin')),
);
?>

<h1>Update RealestateFotoTypes <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
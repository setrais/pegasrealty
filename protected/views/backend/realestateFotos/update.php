<?php
$this->breadcrumbs=array(
	'Realestate Fotoses'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List RealestateFotos', 'url'=>array('index')),
	array('label'=>'Create RealestateFotos', 'url'=>array('create')),
	array('label'=>'View RealestateFotos', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage RealestateFotos', 'url'=>array('admin')),
);
?>

<h1>Update RealestateFotos <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
<?php
$this->breadcrumbs=array(
	'Space Presentations'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List SpacePresentations', 'url'=>array('index')),
	array('label'=>'Create SpacePresentations', 'url'=>array('create')),
	array('label'=>'View SpacePresentations', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage SpacePresentations', 'url'=>array('admin')),
);
?>

<h1>Update SpacePresentations <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
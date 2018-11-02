<?php
$this->breadcrumbs=array(
	'Realestate Presentations'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List RealestatePresentations', 'url'=>array('index')),
	array('label'=>'Create RealestatePresentations', 'url'=>array('create')),
	array('label'=>'View RealestatePresentations', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage RealestatePresentations', 'url'=>array('admin')),
);
?>

<h1>Update RealestatePresentations <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
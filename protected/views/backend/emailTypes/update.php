<?php
$this->breadcrumbs=array(
	'Email Types'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List EmailTypes', 'url'=>array('index')),
	array('label'=>'Create EmailTypes', 'url'=>array('create')),
	array('label'=>'View EmailTypes', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage EmailTypes', 'url'=>array('admin')),
);
?>

<h1>Update EmailTypes <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
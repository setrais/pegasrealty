<?php
$this->breadcrumbs=array(
	'Space Vids'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List SpaceVids', 'url'=>array('index')),
	array('label'=>'Create SpaceVids', 'url'=>array('create')),
	array('label'=>'View SpaceVids', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage SpaceVids', 'url'=>array('admin')),
);
?>

<h1>Update SpaceVids <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
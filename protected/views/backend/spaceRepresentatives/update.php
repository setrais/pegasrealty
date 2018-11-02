<?php
$this->breadcrumbs=array(
	'Space Representatives'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List SpaceRepresentatives', 'url'=>array('index')),
	array('label'=>'Create SpaceRepresentatives', 'url'=>array('create')),
	array('label'=>'View SpaceRepresentatives', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage SpaceRepresentatives', 'url'=>array('admin')),
);
?>

<h1>Update SpaceRepresentatives <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
<?php
$this->breadcrumbs=array(
	'Space Similarities'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List SpaceSimilarities', 'url'=>array('index')),
	array('label'=>'Create SpaceSimilarities', 'url'=>array('create')),
	array('label'=>'View SpaceSimilarities', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage SpaceSimilarities', 'url'=>array('admin')),
);
?>

<h1>Update SpaceSimilarities <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
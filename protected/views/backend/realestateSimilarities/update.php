<?php
$this->breadcrumbs=array(
	'Realestate Similarities'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List RealestateSimilarities', 'url'=>array('index')),
	array('label'=>'Create RealestateSimilarities', 'url'=>array('create')),
	array('label'=>'View RealestateSimilarities', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage RealestateSimilarities', 'url'=>array('admin')),
);
?>

<h1>Update RealestateSimilarities <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
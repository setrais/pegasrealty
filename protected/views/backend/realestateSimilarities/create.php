<?php
$this->breadcrumbs=array(
	'Realestate Similarities'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List RealestateSimilarities', 'url'=>array('index')),
	array('label'=>'Manage RealestateSimilarities', 'url'=>array('admin')),
);
?>

<h1>Create RealestateSimilarities</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
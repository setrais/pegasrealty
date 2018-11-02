<?php
$this->breadcrumbs=array(
	'Realestate Types'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List RealestateTypes', 'url'=>array('index')),
	array('label'=>'Manage RealestateTypes', 'url'=>array('admin')),
);
?>

<h1>Create RealestateTypes</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
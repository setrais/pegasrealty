<?php
$this->breadcrumbs=array(
	'Realestate Properties'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List RealestateProperties', 'url'=>array('index')),
	array('label'=>'Manage RealestateProperties', 'url'=>array('admin')),
);
?>

<h1>Create RealestateProperties</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
<?php
$this->breadcrumbs=array(
	'Realestate Destinations'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List RealestateDestinations', 'url'=>array('index')),
	array('label'=>'Manage RealestateDestinations', 'url'=>array('admin')),
);
?>

<h1>Create RealestateDestinations</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
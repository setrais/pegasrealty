<?php
$this->breadcrumbs=array(
	'Realestate Filters'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List RealestateFilters', 'url'=>array('index')),
	array('label'=>'Manage RealestateFilters', 'url'=>array('admin')),
);
?>

<h1>Create RealestateFilters</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
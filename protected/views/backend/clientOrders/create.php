<?php
$this->breadcrumbs=array(
	'Client Orders'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ClientOrders', 'url'=>array('index')),
	array('label'=>'Manage ClientOrders', 'url'=>array('admin')),
);
?>

<h1>Create ClientOrders</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
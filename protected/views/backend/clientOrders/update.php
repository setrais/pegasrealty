<?php
$this->breadcrumbs=array(
	'Client Orders'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ClientOrders', 'url'=>array('index')),
	array('label'=>'Create ClientOrders', 'url'=>array('create')),
	array('label'=>'View ClientOrders', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ClientOrders', 'url'=>array('admin')),
);
?>

<h1>Update ClientOrders <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
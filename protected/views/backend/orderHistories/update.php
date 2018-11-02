<?php
$this->breadcrumbs=array(
	'Order Histories'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List OrderHistories', 'url'=>array('index')),
	array('label'=>'Create OrderHistories', 'url'=>array('create')),
	array('label'=>'View OrderHistories', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage OrderHistories', 'url'=>array('admin')),
);
?>

<h1>Update OrderHistories <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
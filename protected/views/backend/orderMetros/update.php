<?php
$this->breadcrumbs=array(
	'Order Metroses'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List OrderMetros', 'url'=>array('index')),
	array('label'=>'Create OrderMetros', 'url'=>array('create')),
	array('label'=>'View OrderMetros', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage OrderMetros', 'url'=>array('admin')),
);
?>

<h1>Update OrderMetros <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
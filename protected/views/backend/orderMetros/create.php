<?php
$this->breadcrumbs=array(
	'Order Metroses'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List OrderMetros', 'url'=>array('index')),
	array('label'=>'Manage OrderMetros', 'url'=>array('admin')),
);
?>

<h1>Create OrderMetros</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
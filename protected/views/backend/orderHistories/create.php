<?php
$this->breadcrumbs=array(
	'Order Histories'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List OrderHistories', 'url'=>array('index')),
	array('label'=>'Manage OrderHistories', 'url'=>array('admin')),
);
?>

<h1>Create OrderHistories</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
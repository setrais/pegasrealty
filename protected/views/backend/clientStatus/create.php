<?php
$this->breadcrumbs=array(
	'Client Statuses'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ClientStatus', 'url'=>array('index')),
	array('label'=>'Manage ClientStatus', 'url'=>array('admin')),
);
?>

<h1>Create ClientStatus</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
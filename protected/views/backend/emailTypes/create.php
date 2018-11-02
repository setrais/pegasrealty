<?php
$this->breadcrumbs=array(
	'Email Types'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List EmailTypes', 'url'=>array('index')),
	array('label'=>'Manage EmailTypes', 'url'=>array('admin')),
);
?>

<h1>Create EmailTypes</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
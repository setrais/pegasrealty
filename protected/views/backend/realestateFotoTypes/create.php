<?php
$this->breadcrumbs=array(
	'Realestate Foto Types'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List RealestateFotoTypes', 'url'=>array('index')),
	array('label'=>'Manage RealestateFotoTypes', 'url'=>array('admin')),
);
?>

<h1>Create RealestateFotoTypes</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
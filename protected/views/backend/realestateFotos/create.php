<?php
$this->breadcrumbs=array(
	'Realestate Fotoses'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List RealestateFotos', 'url'=>array('index')),
	array('label'=>'Manage RealestateFotos', 'url'=>array('admin')),
);
?>

<h1>Create RealestateFotos</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
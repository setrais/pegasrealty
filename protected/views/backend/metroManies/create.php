<?php
$this->breadcrumbs=array(
	'Metro Manies'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List MetroManies', 'url'=>array('index')),
	array('label'=>'Manage MetroManies', 'url'=>array('admin')),
);
?>

<h1>Create MetroManies</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
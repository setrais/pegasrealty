<?php
$this->breadcrumbs=array(
	'Taxs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Taxs', 'url'=>array('index')),
	array('label'=>'Manage Taxs', 'url'=>array('admin')),
);
?>

<h1>Create Taxs</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
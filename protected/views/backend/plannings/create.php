<?php
$this->breadcrumbs=array(
	'Plannings'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Plannings', 'url'=>array('index')),
	array('label'=>'Manage Plannings', 'url'=>array('admin')),
);
?>

<h1>Create Plannings</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
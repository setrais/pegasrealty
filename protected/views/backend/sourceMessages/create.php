<?php
$this->breadcrumbs=array(
	'Source Messages'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SourceMessages', 'url'=>array('index')),
	array('label'=>'Manage SourceMessages', 'url'=>array('admin')),
);
?>

<h1>Create SourceMessages</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
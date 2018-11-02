<?php
$this->breadcrumbs=array(
	'Realestate Presentations'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List RealestatePresentations', 'url'=>array('index')),
	array('label'=>'Manage RealestatePresentations', 'url'=>array('admin')),
);
?>

<h1>Create RealestatePresentations</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
<?php
$this->breadcrumbs=array(
	'Phone Types'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List PhoneTypes', 'url'=>array('index')),
	array('label'=>'Manage PhoneTypes', 'url'=>array('admin')),
);
?>

<h1>Create PhoneTypes</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
<?php
$this->breadcrumbs=array(
	'Client Contacts'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ClientContacts', 'url'=>array('index')),
	array('label'=>'Manage ClientContacts', 'url'=>array('admin')),
);
?>

<h1>Create ClientContacts</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
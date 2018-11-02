<?php
$this->breadcrumbs=array(
	'Client Scopes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ClientScopes', 'url'=>array('index')),
	array('label'=>'Manage ClientScopes', 'url'=>array('admin')),
);
?>

<h1>Create ClientScopes</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
<?php
$this->breadcrumbs=array(
	'Client Contacts'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List ClientContacts', 'url'=>array('index')),
	array('label'=>'Create ClientContacts', 'url'=>array('create')),
	array('label'=>'Update ClientContacts', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ClientContacts', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ClientContacts', 'url'=>array('admin')),
);
?>

<h1>View ClientContacts #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'abbr',
		'name',
		'sort',
		'act',
		'del',
		'create_date',
		'update_date',
		'desc',
		'clients_id',
	),
)); ?>

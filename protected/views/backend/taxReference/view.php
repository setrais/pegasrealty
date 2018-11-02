<?php
$this->breadcrumbs=array(
	'Tax References'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List TaxReference', 'url'=>array('index')),
	array('label'=>'Create TaxReference', 'url'=>array('create')),
	array('label'=>'Update TaxReference', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete TaxReference', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TaxReference', 'url'=>array('admin')),
);
?>

<h1>View TaxReference #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'num',
		'abbr',
		'title',
		'sort',
		'act',
		'del',
		'create_date',
		'update_date',
		'desc',
		'grid',
		'district_id',
		'index',
		'address',
		'index_fact',
		'address_fact',
		'metro_id',
		'proezd',
		'phone',
		'phone_2',
		'phone_3',
		'fax',
		'site',
		'email',
		'anons',
		'detile',
		'description',
		'seo_title',
		'seo_desc',
		'seo_keywords',
	),
)); ?>

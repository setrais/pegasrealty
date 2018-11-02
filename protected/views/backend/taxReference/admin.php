<?php
$this->breadcrumbs=array(
	'Tax References'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List TaxReference', 'url'=>array('index')),
	array('label'=>'Create TaxReference', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('tax-reference-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Tax References</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'tax-reference-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'num',
		'abbr',
		'title',
		'sort',
		'act',
		/*
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
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>

<?php
$this->breadcrumbs=array(
	Yii::t('all','Developments')=>array('index'),
	Yii::t('all','Manage'),
);

$this->menu=array(
	array('label'=>Yii::t('adm-menu','List Developments'), 'url'=>array('index')),
	array('label'=>Yii::t('adm-menu','Create Developments'), 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('developments-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo Yii::t('adm-menu','Manage Developments'); ?></h1>

<p>
<?=Yii::t('form','You may optionally enter a comparison operator (<, <=, >, >=, <> or =) at the beginning of each of your search values to specify how the comparison should be done.');?>
</p>

<?php echo CHtml::link(Yii::t('application','Advanced Search'),'#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'developments-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'abbr',
		'title',
		'sort',
		'act',
		'del',
		/*
		'create_date',
		'update_date',
		'desc',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>

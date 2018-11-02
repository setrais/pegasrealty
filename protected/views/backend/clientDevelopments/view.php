<?php
$this->breadcrumbs=array(
	Yii::t('all','Client Developments')=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>Yii::t('label','List ClientDevelopments'), 'url'=>array('index')),
	array('label'=>Yii::t('label','Create ClientDevelopments'), 'url'=>array('create')),
	array('label'=>Yii::t('label','Update ClientDevelopments'), 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>Yii::t('label','Delete ClientDevelopments'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t('label','Manage ClientDevelopments'), 'url'=>array('admin')),
);
?>

<h1><? echo Yii::t('all','View ClientDevelopments');?> №<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'client_id',
		'development_id',
		'desc',
		'sort',
		'act',
		'del',
		'createdate',
                'createuser',
		'updatedate',            	
		'updateuser',
	),
)); ?>

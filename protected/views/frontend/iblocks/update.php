<?php
$this->breadcrumbs=array(
	Yii::t('all','Iblocks')=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	Yii::t('all','Update'),
);

$this->menu=array(
	array('label'=>Yii::t('menu','List Iblocks'), 'url'=>array('index')),
	array('label'=>Yii::t('menu','Create Iblocks'), 'url'=>array('create')),
	array('label'=>Yii::t('menu','View Iblocks'), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>Yii::t('menu','Manage Iblocks'), 'url'=>array('admin')),
);
?>

<h1><?=Yii::t('menu','Update Iblocks');?> №<?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
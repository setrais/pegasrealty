<?php
$this->breadcrumbs=array(
	Yii::t('all','Client Developments')=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	Yii::t('all','Update'),
);

$this->menu=array(
	array('label'=>Yii::t('label','List ClientDevelopments'), 'url'=>array('index')),
	array('label'=>Yii::t('label','Create ClientDevelopments'), 'url'=>array('create')),
	array('label'=>Yii::t('label','View ClientDevelopments'), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>Yii::t('label','Manage ClientDevelopments'), 'url'=>array('admin')),
);
?>

<h1><? echo Yii::t('all','Update ClientDevelopments');?> №<?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
<?php
$this->breadcrumbs=array(
	Yii::t('all','Streets')=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	Yii::t('all','Update'),
);

$this->menu=array(
	array('label'=>Yii::t('adm-menu','List Streets'), 'url'=>array('index')),
	array('label'=>Yii::t('adm-menu','Create Streets'), 'url'=>array('create')),
	array('label'=>Yii::t('adm-menu','View Streets'), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>Yii::t('adm-menu','Manage Streets'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('adm-menu','Update Streets');?> №<?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
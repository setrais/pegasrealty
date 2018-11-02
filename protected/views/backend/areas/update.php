<?php
$this->breadcrumbs=array(
	Yii::t('all','Areases')=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	Yii::t('all','Update'),
);

$this->menu=array(
	array('label'=>Yii::t('adm-menu','List Areas'), 'url'=>array('index')),
	array('label'=>Yii::t('adm-menu','Create Areas'), 'url'=>array('create')),
	array('label'=>Yii::t('adm-menu','View Areas'), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>Yii::t('adm-menu','Manage Areas'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('adm-menu','Update Areas'); ?>№ <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
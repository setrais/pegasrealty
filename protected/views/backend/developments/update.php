<?php
$this->breadcrumbs=array(
	Yii::t('all','Developments')=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	Yii::t('all','Update'),
);

$this->menu=array(
	array('label'=>Yii::t('adm-menu','List Developments'), 'url'=>array('index')),
	array('label'=>Yii::t('adm-menu','Create Developments'), 'url'=>array('create')),
	array('label'=>Yii::t('adm-menu','View Developments'), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>Yii::t('adm-menu','Manage Developments'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('adm-menu','Update Developments');?> <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
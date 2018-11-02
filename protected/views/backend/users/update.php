<?php
$this->breadcrumbs=array(
	Yii::t('all','Users')=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	Yii::t('all','Update'),
);

$this->menu=array(
	array('label'=>Yii::t('adm-menu','List Users'), 'url'=>array('index')),
	array('label'=>Yii::t('adm-menu','Create Users'), 'url'=>array('create')),
	array('label'=>Yii::t('adm-menu','View Users'), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>Yii::t('adm-menu','Manage Users'), 'url'=>array('admin')),
);
?>

<h1><? echo Yii::t('adm-menu','Update Users'); ?> <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
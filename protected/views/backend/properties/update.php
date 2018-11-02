<?php
$this->breadcrumbs=array(
	Yii::t('all','Properties')=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	Yii::t('all','Update'),
);

$this->menu=array(
	array('label'=>Yii::t('adm-menu','List Properties'), 'url'=>array('index')),
	array('label'=>Yii::t('adm-menu','Create Properties'), 'url'=>array('create')),
	array('label'=>Yii::t('adm-menu','View Properties'), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>Yii::t('adm-menu','Manage Properties'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('adm-menu','Update Properties');?> № <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
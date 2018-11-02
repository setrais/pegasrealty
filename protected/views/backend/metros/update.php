<?php
$this->breadcrumbs=array(
	Yii::t('all','Metroses')=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	Yii::t('all','Update'),
);

$this->menu=array(
	array('label'=>Yii::t('adm-menu','List Metros'), 'url'=>array('index')),
	array('label'=>Yii::t('adm-menu','Create Metros'), 'url'=>array('create')),
	array('label'=>Yii::t('adm-menu','View Metros'), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>Yii::t('adm-menu','Manage Metros'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('adm-menu','Update Metros');?> № <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
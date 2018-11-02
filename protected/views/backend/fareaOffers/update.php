<?php
$this->breadcrumbs=array(
	Yii::t('all','Space Intervals')=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	Yii::t('all','Update'),
);

$this->menu=array(
	array('label'=>Yii::t('adm-menu','List Space Intervals'), 'url'=>array('index')),
	array('label'=>Yii::t('adm-menu','Create Space Intervals'), 'url'=>array('create')),
	array('label'=>Yii::t('adm-menu','View Space Intervals'), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>Yii::t('adm-menu','Manage Space Intervals'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('adm-menu','Update Space Intervals');?> № <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
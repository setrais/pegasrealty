<?php
$this->breadcrumbs=array(
	Yii::t('all','Space Intervals')=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>Yii::t('adm-menu','List Space Intervals'), 'url'=>array('index')),
	array('label'=>Yii::t('adm-menu','Manage Space Intervals'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('adm-menu','Create Space Intervals'); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
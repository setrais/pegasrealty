<?php
$this->breadcrumbs=array(
	Yii::t('all','Destinations')=>array('index'),
	Yii::t('all','Create'),
);

$this->menu=array(
	array('label'=>Yii::t('adm-menu','List Destinations'), 'url'=>array('index')),
	array('label'=>Yii::t('adm-menu','Manage Destinations'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('adm-menu','Create Destinations');?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
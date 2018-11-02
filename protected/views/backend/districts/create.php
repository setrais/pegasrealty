<?php
$this->breadcrumbs=array(
	'Districts'=>array('index'),
	Yii::t('all','Create'),
);

$this->menu=array(
	array('label'=>Yii::t('adm-menu','List Districts'), 'url'=>array('index')),
	array('label'=>Yii::t('adm-menu','Manage Districts'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('adm-menu','Create Districts'); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
<?php
$this->breadcrumbs=array(
	Yii::t('all','Orders')=>array('index'),
	Yii::t('all','Create'),
);

$this->menu=array(
	array('label'=>Yii::t('adm-menu','List Orders'), 'url'=>array('index')),
	array('label'=>Yii::t('adm-menu','Manage Orders'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('adm-menu','Create Orders');?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
<?php
$this->breadcrumbs=array(
	Yii::t('all','Partners')=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	Yii::t('all','Update'),
);

$this->menu=array(
	array('label'=>Yii::t('adm-menu','List Partners'), 'url'=>array('index')),
	array('label'=>Yii::t('adm-menu','Create Partners'), 'url'=>array('create')),
	array('label'=>Yii::t('adm-menu','View Partners'), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>Yii::t('adm-menu','Manage Partners'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('adm-menu','Update Partners'); ?> № <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
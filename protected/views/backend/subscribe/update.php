<?php
/* @var $this SubscribeController */
/* @var $model Subscribe */

$this->breadcrumbs=array(
	'Subscribes'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	Yii::t('all','Update'),
);

$this->menu=array(
	array('label'=>Yii::t('adm-menu', 'List Subscribe'), 'url'=>array('index')),
	array('label'=>Yii::t('adm-menu', 'Create Subscribe'), 'url'=>array('create')),
	array('label'=>Yii::t('adm-menu', 'View Subscribe'), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>Yii::t('adm-menu', 'Manage Subscribe'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('adm-menu', 'Update Subscribe');?> № <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
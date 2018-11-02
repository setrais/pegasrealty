<?php
$this->breadcrumbs=array(
	Yii::t('all','Orders')=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	Yii::t('all','Update'),
);

$this->menu=array(
	array('label'=>Yii::t('adm-menu','List Orders'), 'url'=>array('index')),
	array('label'=>Yii::t('adm-menu','Create Orders'), 'url'=>array('create')),
	array('label'=>Yii::t('adm-menu','View Orders'), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>Yii::t('adm-menu','Manage Orders'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('all','Update Orders');?> <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
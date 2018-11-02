<?php
$this->breadcrumbs=array(
	Yii::t('adm-menu','Representatives')=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	Yii::t('all','Update'),
);

$this->menu=array(
	array('label'=>Yii::t('adm-menu','List Representatives'), 'url'=>array('index')),
	array('label'=>Yii::t('adm-menu','Create Representatives'), 'url'=>array('create')),
	array('label'=>Yii::t('adm-menu','View Representatives'), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>Yii::t('adm-menu','Manage Representatives'), 'url'=>array('admin')),
);
?>

<h1><?=Yii::t('adm-menu','Update Representatives');?> <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
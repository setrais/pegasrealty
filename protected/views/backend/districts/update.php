<?php
$this->breadcrumbs=array(
	Yii::t('all','Districts')=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	Yii::t('all','Update'),
);

$this->menu=array(
	array('label'=>Yii::t('adm-menu','List Districts'), 'url'=>array('index')),
	array('label'=>Yii::t('adm-menu','Create Districts'), 'url'=>array('create')),
	array('label'=>Yii::t('adm-menu','View Districts'), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>Yii::t('adm-menu','Manage Districts'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('adm-menu','Update Districts')?> <?php echo '№'.$model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
<?php
$this->breadcrumbs=array(
	Yii::t('all','Clients')=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	Yii::t('all','Update'),
);

$this->menu=array(
	array('label'=>Yii::t('adm-menu','List Clients'), 'url'=>array('index')),
	array('label'=>Yii::t('adm-menu','Create Clients'), 'url'=>array('create')),
	array('label'=>Yii::t('adm-menu','View Clients'), 'url'=>array('view', 'id'=>$model->id)),
        //array('label'=>Yii::t('adm-menu','Complex Update Clients'), 'url'=>array('complexupdate', 'id'=>$model->id)),
	array('label'=>Yii::t('adm-menu','Manage Clients'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('adm-menu','Update Clients'); ?> №<?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', 
          array('model'=>$model)); ?> 
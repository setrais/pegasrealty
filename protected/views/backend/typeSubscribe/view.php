<?php
/* @var $this TypeSubscribeController */
/* @var $model TypeSubscribe */

$this->breadcrumbs=array(
	Yii::t('all','Шаблоны рассылки'/*Type Subscribes*/)=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>Yii::t('adm-menu','Список шаблонов рассылки'/*'List TypeSubscribe'*/), 'url'=>array('index')),
	array('label'=>Yii::t('adm-menu','Создать шаблон рассылки'/*Create TypeSubscribe*/), 'url'=>array('create')),
	array('label'=>Yii::t('adm-menu','Редактирование шаблона рассылки'/*Update TypeSubscribe'*/), 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>Yii::t('adm-menu','Удаление шаблона рассылки'/*Delete TypeSubscribe'*/), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t('adm-menu','Управление шаблонами рассылки'/*'Manage TypeSubscribe'*/), 'url'=>array('admin')),
);
?>

<h1><?=Yii::t('adm-menu','Просмотр шаблона рассылки'/*View TypeSubscribe*/);?> #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
              	array('name'=>'icon',
                      'visible'=>true
                ),               
              	array('name'=>'grid',                      
                      'visible'=>false
                ),            
              	array('name'=>'name',
                      'visible'=>true
                ),         
              	array('name'=>'title',
                      'visible'=>true
                ),    
		'template',            
		'description',
              	array('name'=>'keywords',
                      'visible'=>false
                ),      
                array('name'=>'act',
                      'visible'=>true,
                      'value'=>($model->act ? 'да' : 'нет'),
                ), 
                array('name'=>'act',
                      'visible'=>true,
                      'value'=>($model->del===null || $model->del==0 ? 'нет' : 'да'),
                ),             
	),
)); ?>

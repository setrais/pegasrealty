<?php
/* @var $this SubscribeController */
/* @var $model Subscribe */

$this->breadcrumbs=array(
	Yii::t('all','Subscribes')=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>Yii::t('adm-menu','List Subscribe'), 'url'=>array('index')),
	array('label'=>Yii::t('adm-menu','Create Subscribe'), 'url'=>array('create')),
	array('label'=>Yii::t('adm-menu','Update Subscribe'), 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>Yii::t('adm-menu','Delete Subscribe'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t('adm-menu','Manage Subscribe'), 'url'=>array('admin')),
);
?>

<h1><?=Yii::t('adm-menu','View Subscribe');?> #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'email',
              	array('name'=>'typesubs_id',
                      'value'=>$model->typesubs->title ? $model->typesubs->title : 'не указан' ,
                      'visible'=>true
                ),
                array('name'=>'act',
                      'visible'=>true,
                      'value'=>($model->act ? 'да' : 'нет'),
                ),                                  
                array('name'=>'fid',
                      'value'=>$model->getSection()->name ? $model->getSection()->name : 'не указан' ,                    
                      'visible'=>true
                ),             
                array('header'=>'Последний Ид.',
                      'name'=>'lastsubs_id',                      
                      'visible'=>true
                ),            
              	array('header'=>'Последняя Дата',
                      'name'=>'lastsubs_date',                      
                      'visible'=>true
                ),  
		'description',            
                array('name'=>'del',
                      'visible'=>true,
                      'value'=>($model->del ? 'да' : 'нет'),
                ),                                         
	),
)); ?>

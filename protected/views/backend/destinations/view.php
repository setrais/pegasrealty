<?php
$this->breadcrumbs=array(
	Yii::t('all','Destinations')=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>Yii::t('adm-menu','List Destinations'), 'url'=>array('index')),
	array('label'=>Yii::t('adm-menu','Create Destinations'), 'url'=>array('create')),
	array('label'=>Yii::t('adm-menu','Update Destinations'), 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>Yii::t('adm-menu','Delete Destinations'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t('adm-menu','Manage Destinations'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('adm-menu','View Destinations'); ?> №<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'sid',
		'abbr',
		'title',
		'sort',
		array( 'name'=>'act',
                       'value'=>($model->act ? 'да' : 'нет') ), 
                array( 'name'=>'del',
                       'value'=>($model->del ? 'да' : 'нет') ),
                array( 'name'=>'desc',
                       'label'=>'Расшифровка аббривиатуры',
                     ),
                array( 'name'=>'anons',
                       'type'=>'text', 
                     ),
                array( 'name'=>'detile',
                       'type'=>'html', 
                     ),            
                array( 'name'=>'description',
                       'type'=>'html', 
                     ),
                array( 'name'=>'seo_title',
                       'label'=>'SEO заголовок', 
                       'type'=>'text', 
                     ),                        
                array( 'name'=>'seo_desc',
                       'label'=>'SEO описание',                    
                       'type'=>'text', 
                     ),                          
                array( 'name'=>'seo_keywords',
                       'label'=>'SEO ключевые слова',                                        
                       'type'=>'text', 
                     ),
            	/*'create_date',
		'update_date',*/
	),
)); ?>
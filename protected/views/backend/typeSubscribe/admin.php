<?php
/* @var $this TypeSubscribeController */
/* @var $model TypeSubscribe */

$this->breadcrumbs=array(
	Yii::t('all','Шаблоны рассылки'/*'Type Subscribes'*/)=>array('index'),
	Yii::t('all','Управление'/*'Manage'*/),
);

$this->menu=array(
	array('label'=>Yii::t('adm-menu','Список шаблонов'/*'List TypeSubscribe'*/), 'url'=>array('index')),
	array('label'=>Yii::t('adm-menu','Создание шаблона'/*'Create TypeSubscribe'*/), 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#type-subscribe-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?=Yii::t('adm-menu','Управление шаблонами рассылки');?></h1>

<p>
<?=Yii::t('form','You may optionally enter a comparison operator (<, <=, >, >=, <> or =) at the beginning of each of your search values to specify how the comparison should be done.');?>
</p>

<?php echo CHtml::link(Yii::t('all','Advanced Search'),'#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'type-subscribe-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
        'summaryText'=>Yii::t('core',                 
                              'Displaying Items {start} - {end} of {count} results', 
                               $model->search()->getTotalItemCount()),
        'emptyText'=>Yii::t('core','No results found.'), 
        'pager'=>array(
            'header' => Yii::t('grid','Перейти к странице:'),
            //'firstPageLabel' => '&lt;&lt;',
            'prevPageLabel'  => Yii::t('grid','< Вперед'),//'<img src="images/pagination/left.png">',
            'nextPageLabel'  => Yii::t('grid','Назад >'),//'<img src="images/pagination/left.png">',
            //'nextPageLabel'  => '<img src="images/pagination/right.png">',
            //'lastPageLabel'  => '&gt;&gt;',
        ),      
	'columns'=>array(
		array( 'name'=>'id',
                       'visible'=>false
                ),
                array( 'name'=>'grid',
                       'visible'=>false
                ),            
                array( 'name'=>'icon',
                       'type'=>'raw',
                       'value'=> 'CHtml::image( 
                            ( trim($data->icon)<>"" && file_exists($_SERVER[DOCUMENT_ROOT].trim($data->icon)) 
                            ? trim($data->icon) : "/images/no_foto_scr.png" ))',
                       'filter'=>'',
                       'headerHtmlOptions'=>array('width'=>'60'),
                       'htmlOptions'=>array('style'=>'width:60px;text-align: center;vertical-align: middle;'),
                       'visible'=>true,                    
                ),                 
                array( 'name'=>'title',
                       'visible'=>true
                ),               
                array( 'name'=>'name',
                       'header' => 'Cимвольный Ид',
                       'visible'=>true,
                       'htmlOptions'=>array('width'=>120,'style'=>'width:120px;text-align:left;'),
                       'headerHtmlOptions'=>array('width'=>120,'style'=>'text-align:center;'),                       
                ),                                   
                array( 'name'=>'template',
                       'visible'=>true
                ),                     
                array( 'name'=>'description',
                       'visible'=>true
                ),              
		array( 'name'=>'keywords',
                       'visible'=>false
                ),            
           array( 'name'=>'sort', 
                  'header'=>'Сорт.',
                  'htmlOptions'=>array('width'=>12,'style'=>'width:12px;text-align:center;'),
                  'headerHtmlOptions'=>array('width'=>12,'style'=>'text-align:center;'),               
                ),            
           array( 'name'=>'act',
                  'header'=>Yii::t('all','A'),
                  'type'=>'text',
                  'filter'=>CHtml::activecheckBox($model,'act',array('style'=>'width:10px;text-align:center;')),
                  'value'=>'$data->act ? "x" : ""',                     
                  'htmlOptions'=>array('width'=>10,'style'=>'width:10px;text-align:center;'),
                  'headerHtmlOptions'=>array('width'=>10,'style'=>'text-align:center;'),
                  'visible'=>true,
                ),
           array( 'name'=>'del',
                  'header'=>Yii::t('all','D'),
                  'type'=>'text',
                  'filter'=>CHtml::activecheckBox($model,'del',array('style'=>'width:10px;text-align:center;')),
                  'value'=>'($data->del ? "x" : "")',                     
                  'htmlOptions'=>array('width'=>10,'style'=>'width:8px;text-align:center;'),
                  'headerHtmlOptions'=>array('width'=>10,'style'=>'text-align:center;'),
                  'visible'=>true,
                ),          
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>

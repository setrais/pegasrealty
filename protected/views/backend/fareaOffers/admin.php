<?php
$this->breadcrumbs=array(
	Yii::t('all','Space Intervals')=>array('index'),
	Yii::t('all','Manage'),
);

$this->menu=array(
	array('label'=>Yii::t('adm-menu','List Space Intervals'), 'url'=>array('index')),
	array('label'=>Yii::t('adm-menu','Create Space Intervals'), 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('farea-offers-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo Yii::t('adm-menu','Manage Space Intervals');?></h1>

<p><?=Yii::t('form','You may optionally enter a comparison operator (<, <=, >, >=, <> or =) at the beginning of each of your search values to specify how the comparison should be done.');?></p>

<?php echo CHtml::link(Yii::t('all','Advanced Search'),'#',array('class'=>'search-button')); ?>


<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'farea-offers-grid',
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
            array( 'name'=>'id', 'type'=>'text',
                   'headerHtmlOptions'=>array('width'=>'60'),
                   'htmlOptions'=>array('style'=>'width:60px;'),
                   'visible'=>true,
            ),  
            array( 'name'=>'sid', 'type'=>'text',
                   'headerHtmlOptions'=>array('width'=>'100'),
                   'htmlOptions'=>array('style'=>'width:100px;'),
                   'visible'=>false,
            ),       
           array( 'name'=>'init_value', 'type'=>'text',
                  'header'=>'От',
                  'headerHtmlOptions'=>array('width'=>'40'),
                  'htmlOptions'=>array('style'=>'width:40px;'),
                  'visible'=>true,
            ),                         
           array( 'name'=>'final_value', 'type'=>'text',
                  'header'=>'До',
                  'headerHtmlOptions'=>array('width'=>'40'),
                  'htmlOptions'=>array('style'=>'width:40px;'),
                  'visible'=>true,
            ),                                                      
           array( 'name'=>'title', 'type'=>'text',
                  /*'headerHtmlOptions'=>array('width'=>'150'),
                  'htmlOptions'=>array('style'=>'width:150px;'),*/
                  'visible'=>true,
            ),             
           array( 'name'=>'sort', 
                  'headerHtmlOptions'=>array('width'=>'40'),
                  'htmlOptions'=>array('style'=>'width:40px;'),               
                  'header'=>'Сорт.'),
           array( 'name'=>'desc', 
                  'header'=>'Расшифровка',
                  'headerHtmlOptions'=>array('width'=>'100'),
                  'htmlOptions'=>array('style'=>'width:100px;'),  
                ),            
           array( 'name'=>'anons',
                  'visible'=>false),                 
           array( 'name'=>'detile',
                  'visible'=>false),            
           array( 'name'=>'description', 
                  'visible'=>false
                ),
           array( 'name'=>'act',
                  'header'=>Yii::t('all','A'),
                  'type'=>'text',
                  'filter'=>CHtml::activecheckBox($model,'act',array('style'=>'width:10px;text-align:center;')),
                  'value'=>'($data->act===null || $data->act ? "x" : "")',                     
                  'htmlOptions'=>array('width'=>10,'style'=>'width:10px;text-align:center;'),
                  'headerHtmlOptions'=>array('width'=>10,'style'=>'text-align:center;'),
                  'visible'=>true,
                ),
           array( 'name'=>'del',
                  'header'=>Yii::t('all','D'),
                  'type'=>'text',
                  'filter'=>CHtml::activecheckBox($model,'del',array('style'=>'width:10px;text-align:center;')),
                  'value'=>'($data->del===null || $data->del ? "x" : "")',                     
                  'htmlOptions'=>array('width'=>10,'style'=>'width:8px;text-align:center;'),
                  'headerHtmlOptions'=>array('width'=>10,'style'=>'text-align:center;'),
                  'visible'=>true,
                ),                   
           array( 'name'=>'seo_title',
                  'visible'=>false),            
           array( 'name'=>'seo_keywords',
                  'visible'=>false),
           array( 'name'=>'seo_desc',
                  'visible'=>false), 
         /*
           'create_date',
           'update_date',
	   'desc',
		*/            
           array(
                  'class'=>'CButtonColumn',
           ),
	),
)); ?>
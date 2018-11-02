<?php
$this->pageTitle=Yii::t('all','Partners').' - '.Yii::t('all',Yii::app()->name);

$this->breadcrumbs=array(
	Yii::t('all','Partners'),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('partners-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo Yii::t('all','Partners');?></h1>

<?php 
$this->renderPartial('/realestates/_social',array('model'=>(object)array('title'=>$this->pageTitle)));?>  

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'partners-grid',
	'dataProvider'=>$dataProvider,	
        'summaryText'=>Yii::t('core',                 
                              'Displaying Items {start} - {end} of {count} results', 
                               $dataProvider->getTotalItemCount()),
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
		/*array('name'=>'id',
                      'visible'=>true,
                      'htmlOptions'=>array('style'=>'text-align:right;width:25'),
                     ),*/ 
            	array('name'=>'title',
                      'visible'=>true,
                      'htmlOptions'=>array('style'=>'text-align:left;width:220px;','class'=>'p-l10 tahoma'),
                      'headerHtmlOptions'=>array('width'=>'220'),
                     ),                                                                   
                array('name'=>'infocode',
                      'type'=>'raw',
                      'value'=>'CHtml::tag("div",array("class"=>"infocode"),$data->getInfoCode());',
                      'htmlOptions'=>array('class'=>'infocode','style'=>'text-align:center;','class'=>'tahoma'),
                      'headerHtmlOptions'=>array('width'=>'150'),
                      'visible'=>true),
                array('name'=>'site',
                      'type'=>'raw',
                      'value'=>'CHtml::tag("noindex",array(),CHtml::link($data->site,"http://".str_replace("http://","",$data->site),array("rel"=>"nofollow")));',
                      'htmlOptions'=>array('style'=>'text-align:left;width:150px;','class'=>'tahoma'),
                      'headerHtmlOptions'=>array('width'=>'150'),
                      'visible'=>true),   
                array('name'=>'anons',
                      'htmlOptions'=>array('style'=>'text-align:left;vertical-align:top;','class'=>'p-8 tahoma'),
                      'visible'=>true), 
                array('name'=>'address',
                      'visible'=>false),            
	),
)); ?>

<script>
        var infocode = $('.infocode a');
        infocode.attr('rel','nofollow')
        infocode.wrap('<noindex></noindex>');        
        $('.infocode a').live('click',function(){return false;});
</script>
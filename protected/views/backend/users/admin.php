<?php
$this->breadcrumbs=array(
	Yii::t('all','Users')=>array('index'),
	Yii::t('all','Manage'),
);

$this->menu=array(
	array('label'=>Yii::t('adm-menu','List Users'), 'url'=>array('index')),
	array('label'=>Yii::t('adm-menu','Create Users'), 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('users-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><? echo Yii::t('adm-menu','Manage Users'); ?></h1>

<p><?=Yii::t('form','You may optionally enter a comparison operator (<, <=, >, >=, <> or =) at the beginning of each of your search values to specify how the comparison should be done.');?>
</p>

<?php echo CHtml::link(Yii::t('application','Advanced Search'),'#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'users-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
        'nullDisplay'=>Yii::t('all','Not set'),
        'summaryText'=>Yii::t('core',                 
                              'Displaying Items {start} - {end} of {count} results', 
                               $model->search()->getTotalItemCount()),
        'emptyText'=>Yii::t('core','No results found.'),      
	'columns'=>array(
		array( 'name'=>'id',
                       'visible'=>true,
                ),
                array( 'name'=>'uid',
                       'visible'=>false,
                ),
                array( 'name'=>'title',
                       'visible'=>true,
                ),
                array( 'name'=>'usersRoles',
                       'header'=>Yii::t('all','Roles'),
                       'type'=>'html',
                       'filter'=>CHtml::listData(AuthItem::model()->findAll(), 'id', 'name'),                     
                       'value'=>'$data->usersRoles[0]->name;',
                       'htmlOptions'=>array('style'=>'width:80px;text-align:center;'),
                       'headerHtmlOptions'=>array('width'=>'80'),
                       'visible'=>true,
                ),  
                array( 'name'=>'sort', 
                       'header'=>'Сорт.',
                       'htmlOptions'=>array('width'=>30,'style'=>'width:30px;text-align:center;'),
                       'headerHtmlOptions'=>array('width'=>30,'style'=>'text-align:center;'),
                       'visible'=>true,
                ),
                array( 'name'=>'act',
                       'header'=>Yii::t('all','A'),
                       'type'=>'text',
                       'filter'=>CHtml::activecheckBox($model,'act',array('style'=>'width:10px;text-align:center;')),
                       'value'=>'($data->act ? "x" : "")',                     
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
                array( 'name'=>'username',
                       'visible'=>true,
                ),
                array( 'name'=>'password',
                       'visible'=>false,
                ),
                array( 'name'=>'email',
                       'visible'=>true, 
                ),
                array( 'name'=>'send_email',
                       'visible'=>true, 
                ),        
               array(  'name'=>'register_date',
                       'header'=>Yii::t('all','Дата регистрации'),
                       'type'=>'text',
                       'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', 
                        array( 'language'=> Yii::app()->params->language,                                        
                               'model'=>$model,
                               'attribute'=>'register_date',   
                               'theme'=>'ui-lightness',
                               'options'=>array(
                                     'showAnim'=>'fold',
                                     'dateFormat'=>'dd.mm.yy',                                 
                                     'defaultDate'=>date('d.m.Y'),                                                
                                     'showButtonPanel'=>true,
                                     /*'showOn'=> "button",
                                       'buttonImage'=> "/images/calendar.gif",
                                       'buttonImageOnly'=> true,*/
                                     //set calendar z-index higher then UI Dialog z-index 
                                       'beforeShow'=>"js:function() {
                                         $('.ui-datepicker').css('font-size', '0.8em');
                                         $('.ui-datepicker').css('z-index', parseInt($(this).parents('.ui-dialog').css('z-index'))+1);
                                       }",
                               ),   
                               'htmlOptions'=>array('size'=>8 ),
                        ),true),                                    
                        'value'=>'date("d.m.Y",strtotime($data->register_date))',
                        'htmlOptions'=>array('style'=>'width:'/*110*/.'70px;text-align:center;'),
                        'headerHtmlOptions'=>array('width'=>'70'/*'110'*/),
                        'visible'=>true,
                ),              
               array(  'name'=>'lastvisit_date',
                       'header'=>Yii::t('all','Дата последнего везита'),
                       'type'=>'text',
                       'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', 
                        array( 'language'=> Yii::app()->params->language,                                        
                               'model'=>$model,
                               'attribute'=>'lastvisit_date',   
                               'theme'=>'ui-lightness',
                               'options'=>array(
                                     'showAnim'=>'fold',
                                     'dateFormat'=>'dd.mm.yy',                                 
                                     'defaultDate'=>date('d.m.Y'),                                                
                                     'showButtonPanel'=>true,
                                     /*'showOn'=> "button",
                                       'buttonImage'=> "/images/calendar.gif",
                                       'buttonImageOnly'=> true,*/
                                     //set calendar z-index higher then UI Dialog z-index 
                                       'beforeShow'=>"js:function() {
                                         $('.ui-datepicker').css('font-size', '0.8em');
                                         $('.ui-datepicker').css('z-index', parseInt($(this).parents('.ui-dialog').css('z-index'))+1);
                                       }",
                               ),   
                               'htmlOptions'=>array('size'=>8 ),
                        ),true),                                    
                        'value'=>'date("d.m.Y",strtotime($data->lastvisit_date))',
                        'htmlOptions'=>array('style'=>'width:'/*110*/.'70px;text-align:center;'),
                        'headerHtmlOptions'=>array('width'=>'70'/*'110'*/),
                        'visible'=>true,
                ),                          
                array( 'name'=>'description',
                       'visible'=>false, 
                ),
               array(  'name'=>'create_date',
                       'header'=>Yii::t('all','Дата создания'),
                       'type'=>'text',
                       'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', 
                        array( 'language'=> Yii::app()->params->language,                                        
                               'model'=>$model,
                               'attribute'=>'create_date',   
                               'theme'=>'ui-lightness',
                               'options'=>array(
                                     'showAnim'=>'fold',
                                     'dateFormat'=>'dd.mm.yy',                                 
                                     'defaultDate'=>date('d.m.Y'),                                                
                                     'showButtonPanel'=>true,
                                     /*'showOn'=> "button",
                                       'buttonImage'=> "/images/calendar.gif",
                                       'buttonImageOnly'=> true,*/
                                     //set calendar z-index higher then UI Dialog z-index 
                                       'beforeShow'=>"js:function() {
                                         $('.ui-datepicker').css('font-size', '0.8em');
                                         $('.ui-datepicker').css('z-index', parseInt($(this).parents('.ui-dialog').css('z-index'))+1);
                                       }",
                               ),   
                               'htmlOptions'=>array('size'=>8 ),
                        ),true),                                    
                        'value'=>'date("d.m.Y",strtotime($data->create_date))',
                        'htmlOptions'=>array('style'=>'width:'/*110*/.'70px;text-align:center;'),
                        'headerHtmlOptions'=>array('width'=>'70'/*'110'*/),
                        'visible'=>true,
                ),                 
               array(  'name'=>'update_date',
                       'header'=>Yii::t('all','Дата обновления'),
                       'type'=>'text',
                       'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', 
                        array( 'language'=> Yii::app()->params->language,                                        
                               'model'=>$model,
                               'attribute'=>'update_date',   
                               'theme'=>'ui-lightness',
                               'options'=>array(
                                     'showAnim'=>'fold',
                                     'dateFormat'=>'dd.mm.yy',                                 
                                     'defaultDate'=>date('d.m.Y'),                                                
                                     'showButtonPanel'=>true,
                                     /*'showOn'=> "button",
                                       'buttonImage'=> "/images/calendar.gif",
                                       'buttonImageOnly'=> true,*/
                                     //set calendar z-index higher then UI Dialog z-index 
                                       'beforeShow'=>"js:function() {
                                         $('.ui-datepicker').css('font-size', '0.8em');
                                         $('.ui-datepicker').css('z-index', parseInt($(this).parents('.ui-dialog').css('z-index'))+1);
                                       }",
                               ),   
                               'htmlOptions'=>array('size'=>8 ),
                        ),true),                                    
                        'value'=>'date("d.m.Y",strtotime($data->update_date))',
                        'htmlOptions'=>array('style'=>'width:'/*110*/.'70px;text-align:center;'),
                        'headerHtmlOptions'=>array('width'=>'70'/*'110'*/),
                        'visible'=>true,
                ),                             
                array( 'name'=>'param_id',
                       'visible'=>false, 
                ),                          
                array( 'name'=>'param_uid',
                       'visible'=>false, 
                ),                                  
                array( 'name'=>'phpBBLogin',
                       'visible'=>false, 
                ),                                  
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>

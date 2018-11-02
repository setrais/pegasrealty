<?php
$this->breadcrumbs=array(
	Yii::t('all','Partners')=>array('index'),
	Yii::t('all','Manage'),
);

$this->menu=array(
	array('label'=>Yii::t('adm-menu','List Partners'), 'url'=>array('index')),
	array('label'=>Yii::t('adm-menu','Create Partners'), 'url'=>array('create')),
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

<h1><?php echo Yii::t('adm-menu','Manage Partners');?></h1>

<p>
<?=Yii::t('form','You may optionally enter a comparison operator (<, <=, >, >=, <> or =) at the beginning of each of your search values to specify how the comparison should be done.');?>
</p>

<?php echo CHtml::link(Yii::t('application','Advanced Search'),'#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'partners-grid',
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
		array('name'=>'id',
                      'visible'=>true,
                      'htmlOptions'=>array('style'=>'text-align:lright;width:25'/*60px;'/*25px*/),
                     ), 
            	array('name'=>'title',
                      'visible'=>true,
                      'htmlOptions'=>array('style'=>'text-align:left;width:250px;'/*25px*/),
                      'headerHtmlOptions'=>array('width'=>'250'/*'60'/*25px*/),
                     ),
		array('name'=>'abbr',
                      'visible'=>false),                                                                    
                array( 'name'=>'client_type_id',
                       'header'=>Yii::t('all','T</br>K'),
                       'type'=>'text',
                       'htmlOptions'=>array('style'=>'text-align:center;width:15px'/*60px;'/*25px*/),
                       'value'=>'$data->clientType->abbr;',                   
                       'filter'=>CHtml::listData(ClientTypes::model()->findAll("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                                array("order"=>"sort")), 'id', 'abbr'),
                       'headerHtmlOptions'=>array('width'=>'15'/*'60'/*25px*/),
                       'visible'=>true,
                ),   
            	array(	'name'=>'client_id',
                        'htmlOptions'=>array('style'=>'text-align:center;width:15px'/*60px;'/*25px*/),
                        'value'=>'$data->client->email;',                   
                        'filter'=>CHtml::listData(Clients::model()->findAll("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                                array("order"=>"sort")), 'id', 'email'),
                        'headerHtmlOptions'=>array('width'=>'15'/*'60'/*25px*/),
                        'visible'=>true
                ),
		//'uid',		
		//'anons',
                array('name'=>'infocode',
                      'type'=>'raw',
                      'htmlOptions'=>array('class'=>'infocode','style'=>'text-align:center;'),
                      'value'=>'$data->getInfoCode();',  
                      'visible'=>true),
		//'ddog',
		//'ndog',
		//'login',
		//'password',
                array('name'=>'mypage',
                      'type'=>'raw',
                      'value'=>'CHtml::link($data->mypage, $data->mypage)',
                      'visible'=>false), 
		//'desc',
		//'logo_id',
                array('name'=>'contact',
                      'header'=>Yii::t('all','Контакт'),
                      'htmlOptions'=>array('style'=>'text-align:left;width:50px;'/*25px*/),                    
                      'visible'=>true),
                array('name'=>'site',
                      'type'=>'raw',
                      'value'=>'CHtml::link($data->site, $data->site)',
                      'visible'=>true),             
                array('name'=>'phone',            
                      'type'=>'text',  
                      'htmlOptions'=>array('style'=>'width:50px;text-align:center;'),
                      'headerHtmlOptions'=>array('style'=>'width:50px'),
                      'visible'=>true),                		     
                array( 'name'=>'email',
                       'type'=>'email',
                       'header'=>Yii::t('all','Email'),
                       'htmlOptions'=>array('style'=>'text-align:left;width:50px;'/*25px*/),
                       'value'=>'$data->email;',                   
                       'headerHtmlOptions'=>array('style'=>'width:50px'/*25px*/),
                       'visible'=>true,
                ),                                      
		array( 'name'=>'sort',
                       'header'=>Yii::t('all','Cорт'),
                       'visible'=>false),                        
                array(  'name'=>'act',
                        'header'=>Yii::t('all','A'),
                        'type'=>'text',
                        'filter'=>CHtml::activeDropDownList($model,'act',array(""=>"в","0"=>"н","1"=>"x")),//CHtml::activecheckBox($model,'in_stock'),
                        'value'=>'($data->act ? "x" : "")',                     
                        'htmlOptions'=>array('style'=>'width:20px;text-align:center;'),
                        'headerHtmlOptions'=>array('style'=>'width:20px'),
                        'visible'=>true,
                ),  
                array(  'name'=>'del',
                        'header'=>Yii::t('all','D'),
                        'type'=>'text',
                        'filter'=>CHtml::activeDropDownList($model,'del',array(""=>"в","0"=>"н","1"=>"x")),//CHtml::activecheckBox($model,'in_stock'),
                        'value'=>'($data->del ? "x" : "")',                     
                        'htmlOptions'=>array('style'=>'width:20px;text-align:center;'),
                        'headerHtmlOptions'=>array('style'=>'width:20px'),
                        'visible'=>false,
                ),  
            
                array(  'name'=>'create_date',
                          'header'=>Yii::t('label','Create Date'),
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
                          'value'=>'$data->create_date ? date("d.m.Y",strtotime($data->create_date)) : ""',
                          'htmlOptions'=>array('style'=>'width:'/*110*/.'60px;text-align:center;'),
                          'headerHtmlOptions'=>array('width'=>'60'/*'110'*/),
                          'visible'=>true,
                        ),    
                  array( 'name'=>'update_user',                  
                         'type'=>'text',
                         'htmlOptions'=>array('style'=>'text-align:center;width:50px;'),
                         'value'=>'$data->updateUser->username;',                   
                         'filter'=>CHtml::listData(Users::model()->findAll("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                                      array("order"=>"sort")), 'id', 'username'),
                         'headerHtmlOptions'=>array('width'=>'50'),
                         'visible'=>true,
                  ),  
                  array(  'name'=>'update_date',
                          'header'=>Yii::t('all','Update Date'),
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
                          'visible'=>false,
                        ),                           
                array('name'=>'desc',
                      'visible'=>false),           
                array('name'=>'address',
                      'visible'=>false),            
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>

<?php
    // Прикрытие инфо кода
    include __DIR__ . '/include/_var_infocode.php';
?> 
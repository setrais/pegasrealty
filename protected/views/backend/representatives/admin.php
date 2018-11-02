<?php
$this->breadcrumbs=array(
	Yii::t('adm-menu','Representatives')=>array('index'),
	Yii::t('all','Manage'),
);

$this->menu=array(
	array('label'=>Yii::t('adm-menu','List Representatives'), 'url'=>array('index')),
	array('label'=>Yii::t('adm-menu','Create Representatives'), 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('representatives-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php
$js_send =<<< EOD
function() {
    var url = $(this).attr('href');
    $.get(url, function(data) {
        //alert(data.mess);
        /*var effect_in = 'scale';
        var easing_in = 'easeOutElastic';
        var effect_out = 'same';
        var easing_out = 'same';
        if (effect_out == 'same') effect_out = effect_in;
        if (easing_out == 'same') easing_out = easing_in;
        var speed = '700';
        if (speed.match(/^\d+$/)) speed = parseInt(speed);
        var options_in = {
            easing: easing_in
        };
        var options_out = {
            easing: easing_out
        };
        if (effect_in == 'scale') options_in.percent = 100;
        if (effect_out == 'scale') options_out.percent = 0;
        $.pnotify({
            pnotify_title: 'Информация',
            pnotify_text: data.mess,
            pnotify_animate_speed: speed,
            pnotify_animation: {
                'effect_in': 'scale',
                'options_in': options_in,
                'effect_out': effect_out,
                'options_out': options_out
            }
        });*/
        $.pnotify({
            pnotify_width: 100,
            pnotify_nonblock: true,
            pnotify_title: 'Информация', 
            pnotify_text: data.mess,
            pnotify_animation: {
                effect_in: function(status, callback, pnotify) {
                    var source_note = 'Always call the callback when the animation completes.';
                    var cur_angle = 0;
                    var cur_opacity_scale = 0;
                    var timer = setInterval(function() {
                        cur_angle += 10;
                        if (cur_angle == 360) {
                            cur_angle = 0;
                            cur_opacity_scale = 1;
                            clearInterval(timer);
                        } else {
                            cur_opacity_scale = cur_angle / 360;
                        }
                        pnotify.css({
                            '-moz-transform': ('rotate(' + cur_angle + 'deg) scale(' + cur_opacity_scale + ')'),
                            '-webkit-transform': ('rotate(' + cur_angle + 'deg) scale(' + cur_opacity_scale + ')'),
                            '-o-transform': ('rotate(' + cur_angle + 'deg) scale(' + cur_opacity_scale + ')'),
                            '-ms-transform': ('rotate(' + cur_angle + 'deg) scale(' + cur_opacity_scale + ')'),
                            'filter': ('progid:DXImageTransform.Microsoft.BasicImage(rotation=' + (cur_angle / 360 * 4) + ')')
                        }).fadeTo(0, cur_opacity_scale);
                        if (cur_angle == 0) callback();
                    }, 20);
                },
                effect_out: function(status, callback, pnotify) {
                    var source_note = 'Always call the callback when the animation completes.';
                    var cur_angle = 0;
                    var cur_opacity_scale = 1;
                    var timer = setInterval(function() {
                        cur_angle += 10;
                        if (cur_angle == 360) {
                            cur_angle = 0;
                            cur_opacity_scale = 0;
                            clearInterval(timer);
                        } else {
                            cur_opacity_scale = cur_angle / 360;
                            cur_opacity_scale = 1 - cur_opacity_scale;
                        }
                        pnotify.css({
                            '-moz-transform': ('rotate(' + cur_angle + 'deg) scale(' + cur_opacity_scale + ')'),
                            '-webkit-transform': ('rotate(' + cur_angle + 'deg) scale(' + cur_opacity_scale + ')'),
                            '-o-transform': ('rotate(' + cur_angle + 'deg) scale(' + cur_opacity_scale + ')'),
                            '-ms-transform': ('rotate(' + cur_angle + 'deg) scale(' + cur_opacity_scale + ')'),
                            'filter': ('progid:DXImageTransform.Microsoft.BasicImage(rotation=' + (cur_angle / 360 * 4) + ')')
                        }).fadeTo(0, cur_opacity_scale);
                        if (cur_angle == 0) {
                            pnotify.hide();
                            callback();
                        }
                    }, 20);
                }
            }
        });
    },"json");
    return false;
}
EOD;
?>

<?php
$js_info =<<< EOD
function() {
    var url = $(this).attr('href');
    $.get(url, function(data) {          
          $('#represative-info').html(data);
          $('#represative-info').dialog({ closeOnEscape: true, width: 'auto', title:'Информация о собственнике',modal: true});                                                                      
    });
    //alert('Информация о недвижимости собственника/представителя(карточка) В стадии разработки');    
    return false;
}
EOD;
?>

<h1><?=Yii::t('adm-menu','Manage Representatives');?></h1>

<p><?=Yii::t('form','You may optionally enter a comparison operator (<, <=, >, >=, <> or =) at the beginning of each of your search values to specify how the comparison should be done.');?></p>

<?php echo CHtml::link(Yii::t('all','Advanced Search'),'#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('application.components.widgets.RGridView', array(
	'id'=>'representatives-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
        'summaryText'=>Yii::t('core',                 
                              'Displaying Items {start} - {end} of {count} results', 
                               $model->search()->getTotalItemCount()),
        'emptyText'=>Yii::t('core','No results found.'),
        'afterAjaxUpdate'=>"
            function(id, data) {           
              //changeBrowserUrl($.fn.yiiGridView.getUrl(id));  
                                //changeBrowserUrl($.fn.yiiGridView.getUrl(id));                              
                                /*$('#Realestates_date_release').datepicker($.datepicker.regional['".Yii::app()->params->language."']);
                                $('#Realestates_date_release').datepicker( 'option', 'altFormat', 'dd.mm.yy' );                                
                                $('#Realestates_date_release').datepicker( 'option', 'dateFormat', 'dd.mm.yy' );
                                
                                $('#Realestates_date_rang').datepicker($.datepicker.regional['".Yii::app()->params->language."']);
                                $('#Realestates_date_rang').datepicker( 'option', 'altFormat', 'dd.mm.yy' );                                
                                $('#Realestates_date_rang').datepicker( 'option', 'dateFormat', 'dd.mm.yy' );*/
                                $('.fancyImage').fancybox(
                                           {'overlayShow': true, 'hideOnContentClick': true}
                                );    
                            }",
        /*'htmlOptions'=>array('style'=>'width:auto;overflow-x:scroll'),  */
        'pager'=>array(
              'header' => Yii::t('grid','Перейти к странице:'),
              //'firstPageLabel' => '&lt;&lt;',
              'prevPageLabel'  => Yii::t('grid','< Вперед'),//'<img src="images/pagination/left.png">',
              'nextPageLabel'  => Yii::t('grid','Назад >'),//'<img src="images/pagination/left.png">',
              //'nextPageLabel'  => '<img src="images/pagination/right.png">',
              //'lastPageLabel'  => '&gt;&gt;',
          ),    
        'groupActions'=>array(
           'groupSendInfo'=>'Разослать информацию', 
           'groupSend'=>'Подписать на все',
           'groupSendNews'=>'Подписать на новости',
           'groupSendArticles'=>'Подписать на cтатьи', 
           'groupSendAdvartisement'=>'Подписать на обьявления',            
           'groupDelete'=>'Удалить представителей', 
        ),        
	'columns'=>array(
		array('name'=>'id',
                      'htmlOptions'=>array('style'=>'width:40px;text-align:right;'),
                      'headerHtmlOptions'=>array('style'=>'width:40px'),  
                      'visible'=>true,
                ),		
		array('name'=>'fio',
                      'htmlOptions'=>array('style'=>'width:155px;text-align:left;'),
                      'headerHtmlOptions'=>array('style'=>'width:155px'),  
                      'visible'=>true,
                ),            
		array('name'=>'telephone',
                      'htmlOptions'=>array('style'=>'width:75px;text-align:left;'),
                      'headerHtmlOptions'=>array('style'=>'width:75px'),  
                      'visible'=>true,
                ),                        		              
                array( 'name'=>'site',
                       'type'=>'html',
                       'value'=>'CHtml::link($data->site)',  
                       'htmlOptions'=>array('style'=>'width:125px;text-align:left;'),
                       'headerHtmlOptions'=>array('style'=>'width:125px'),  
                       'visible'=>true,
                ),              
                array( 'name'=>'email',
                       'type'=>'html',
                       'value'=>'CHtml::mailto($data->email)',                     
                       'htmlOptions'=>array('style'=>'width:125px;text-align:left;'),
                       'headerHtmlOptions'=>array('style'=>'width:125px'),                      
                       'visible'=>true,
                ),
                array( 
                  'name'=>'isowner',
                  'header'=>Yii::t('all','C'),  
                  'type'=>'html',
                  'filter'=>CHtml::activeDropDownList($model,'isowner',array(""=>"в","0"=>"н","1"=>"x")),  
                  'value'=>'$data->isowner ? CHtml::image("/images/icons/owner.png","Собственник") : CHtml::image("/images/icons/representative.png","Представитель") ',   
                  'htmlOptions'=>array('style'=>'width:40px;text-align:center;'),
                  'headerHtmlOptions'=>array('style'=>'width:40px'),                    
                  'visible'=>true,
                ),     
                array( 
                  'name'=>'realestates',
                  'header'=>Yii::t('all','Realestates'),  
                  'type'=>'html',
                  'filter'=>false,  
                  'value'=>'$data->getRealestates()',   
                  'htmlOptions'=>array('style'=>'width:80px;text-align:center;'),
                  'headerHtmlOptions'=>array('style'=>'width:80px'),                    
                  'visible'=>true,
                ),     
                array(  'name'=>'act',
                  'header'=>Yii::t('all','A'),
                  'type'=>'text',
                  'filter'=>CHtml::activeDropDownList($model,'act',array(""=>"в","0"=>"н","1"=>"x")),
                  'value'=>'($data->act ? "x" : "")',                     
                  'htmlOptions'=>array('style'=>'width:40px;text-align:center;'),
                  'headerHtmlOptions'=>array('style'=>'width:40px'),
                  'visible'=>false,
                ),  
                array(  'name'=>'del',
                  'header'=>Yii::t('all','D'),
                  'type'=>'text',
                  'filter'=>CHtml::activeDropDownList($model,'del',array(""=>"в","0"=>"н","1"=>"x")),
                  'value'=>'($data->act ? "x" : "")',                     
                  'htmlOptions'=>array('style'=>'width:40px;text-align:center;'),
                  'headerHtmlOptions'=>array('style'=>'width:40px'),
                  'visible'=>false,
                ),               
		/*
                'fax',
                'telephone_1',
                'telephone_2',
                'telephone_3',  
		'sort',
		'create_date',
		'update_date',
		'desc',
		*/
		/*array(
			'class'=>'CButtonColumn',
		),*/
            	array(
                    'class'=>'CButtonColumn',
                    'template'=>( Yii::app()->user->checkAccess('superadmin') ?  '{info} {view} {update} {send} {delete}' : '{info} {view} {update} {send}' ),
                    'buttons'=>array( 'send'=> array( 'label'=>'Send',
                                                       'url'=>'Yii::app()->controller->createUrl("send",array("id"=>$data->primaryKey))',
                                                       'imageUrl'=>Yii::app()->request->baseUrl.'/images/icons/mail-send.png',    
                                                       'click'=>$js_send,
                                                       'visible'=>'true',    
                                       ),
                                       'info'=> array( 'label'=>'Info', 
                                                       'url'=>'Yii::app()->controller->createUrl("info",array("id"=>$data->primaryKey,"ajax"=>"representatives-form"))',
                                                       'imageUrl'=>Yii::app()->request->baseUrl.'/images/icons/info-process.png',    
                                                       'click'=>$js_info,
                                                       'visible'=>'true',
                                       ),
                    ),     
		),
	),
)); ?>
<div id="represative-info" class="popup hidden"></div>
<?php
/* @var $this SubscribeController */
/* @var $model Subscribe */

$this->breadcrumbs=array(
	Yii::t('all','Subscribes')=>array('index'),
	Yii::t('all','Manage'),
);

$this->menu=array(
	array('label'=>Yii::t('adm-menu','List Subscribe'), 'url'=>array('index')),
	array('label'=>Yii::t('adm-menu','Create Subscribe'), 'url'=>array('create')),
        //array('label'=>Yii::t('adm-menu','List Templates Subscribe'), 'url'=>array('/typeSubscribe/index')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#subscribe-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?=Yii::t('adm-menu','Manage Subscribes');?></h1>

<p><?=Yii::t('form','You may optionally enter a comparison operator (<, <=, >, >=, <> or =) at the beginning of each of your search values to specify how the comparison should be done.');?></p>

<?php echo CHtml::link(Yii::t('all','Advanced Search'),'#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

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

<?php $this->widget('application.components.widgets.RGridView', array(
	'id'=>'subscribe-grid',
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
        'groupActions'=>array(
           'groupSend'=>'Разослать Все',
           'groupSendNews'=>'Разослать новости',
           'groupSendArticles'=>'Разослать cтатьи', 
           'groupSendAdvartisement'=>'Разослать обьявления', 
           'groupDelete'=>'Удалить подписку', 
        ),    
	'columns'=>array(
                /*array(
                    'class'=>'CCheckBoxColumn',
                ),*/
		array( 'name'=>'id',
                       'visible'=>false
                ),
                array( 'name'=>'email',                
                       'header'=>Yii::t('all','Подписчик'),
                       'htmlOptions'=>array('style'=>'padding: 0 5px;'),
                ),
                array( 'name'=>'typesubs_id',
                       'header'=>Yii::t('label','Тип'), 
                       'type'=>'raw',
                       'htmlOptions'=>array('style'=>'text-align:center;'),
                       'filter'=>CHtml::listData(TypeSubscribe::model()->findAll(array("condition"=>"(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                                      "order"=>"sort")), 'id', 'title'),
                       'value'=>'mb_strtolower($data->typesubs->title, "UTF-8");',
                       'headerHtmlOptions'=>array('width'=>'60'),
                       'visible'=>true,
                ),            
		array( 'name'=>'lastsubs_id',
                       'visible'=>false 
                ), 
                array( 'name'=>'lastsubs_date',
                       //'header'=>Yii::t('all','Дата создания'),
                       'type'=>'text',
                       'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', 
                          array( 'language'=> Yii::app()->params->language,                                        
                                 'model'=>$model,
                                 'attribute'=>'lastsubs_date',   
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
                       'value'=>'($data->lastsubs_date ? date("d.m.Y",strtotime($data->lastsubs_date)) : "")',
                       'htmlOptions'=>array('style'=>'width:'/*110*/.'70px;text-align:center;'),
                       'headerHtmlOptions'=>array('width'=>'70'/*'110'*/),
                       'visible'=>true,
                ),             
		/*'description',*/		
                array( 'name'=>'fid',
                       'header'=>Yii::t('label','Фильтр'),
                       'type'=>'text',
                       'htmlOptions'=>array('style'=>'text-align:center;width:50px;'),
                       'value'=>'mb_strtolower($data->filter->name,"UTF-8");',                   
                       'filter'=>CHtml::listData(RealestateFilters::model()->findAll(), 'id', 'name'),
                       'headerHtmlOptions'=>array('width'=>'50'),
                       'visible'=>true,
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
                  'template'=>'{view} {update} {send} {delete}',
                  'buttons'=>array( 'send'=>
                                  array( 'label'=>'Send',
                                         'url'=>'Yii::app()->controller->createUrl("send",array("id"=>$data->primaryKey))',
                                         'imageUrl'=>Yii::app()->request->baseUrl.'/images/icons/mail-send.png',    
                                         'click'=>$js_send,
                                         'visible'=>'true',    
                               ),
                  ),     
		),
            
            
	),
)); ?>

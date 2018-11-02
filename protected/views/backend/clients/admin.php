<?php
$this->breadcrumbs=array(
	Yii::t('all','Clients')=>array('index'),
	Yii::t('all','Manage'),
);

$this->menu=array(
	array('label'=>Yii::t('adm-menu','List Clients'), 'url'=>array('index')),
	array('label'=>Yii::t('adm-menu','Create Clients'), 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('clients-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php
$js_info =<<< EOD
function() {
    var url = $(this).attr('href');
    $.get(url, function(data) {          
          $('#editbox-client').html(data);
          $('#editbox-client').dialog({ 
                closeOnEscape: true, width: 'auto', title:'Информация о клиенте',modal: true});                                                                      
    });
    //alert('Информация о клиенте(карточка) В стадии разработки');    
    return false;
}
EOD;
?>

<?php
$js_view =<<< EOD
function() {
    var url = $(this).attr('href');
    $.get(url, function(data) {          
          $('#editbox-client').html(data);
          $('#editbox-client').dialog({ closeOnEscape: true, width: 'auto', title:'Информация о клиенте',modal: true});                                                                      
    });
    //alert('Информация о клиенте(карточка) В стадии разработки');    
    return false;
}
EOD;
?>

<?php
$js_orders =<<< EOD
function() {
    var url = $(this).attr('href');
    $.get(url, function(data) {          
          $('#editbox-client').html(data);
          $('#editbox-client.popup').dialog(
               { closeOnEscape: true, 
                 width: 1000, 
                 title:'Просмотр заявок клиента',
                 modal: true,  
                 close: function(event, ui) { 
                 
                    /* Clear div editbox for orders grid */
                    $('#editbox-order').remove();     
                    
                    /* Die event live orders grid */                    
                    $('#orders-grid a.view').die();
                    $('#orders-grid a.update').die();
                    $('#orders-grid a.create').die();
                    $('#orders-grid a.delete').die();
                    $('#orders-grid a.history').die();
                    $('#orders-grid a.suiarea').die();
                    
                    /* Clear div editbox for clients grid */
                    $('#editbox-client').empty();                               
                    $('#editbox-client').dialog('destroy');                                                                               
                 }
               });                                                                      
    });
    //alert('Просмотр заявок клиента В стадии разработки');    
    return false;
}
EOD;
?>

<?php
$js_developments =<<< EOD
function() {
    var url = $(this).attr('href');
    $.get(url, function(data) {          
          $('#editbox-client').html(data);
          $('#editbox-client.popup').dialog(
               { closeOnEscape: true, 
                 width: 1000, 
                 title:'Просмотр событий клиента',
                 modal: true,  
                 close: function(event, ui) { 
                 
                    /* Clear div editbox for orders grid */
                    $('#editbox-development').remove();     
                    
                    /* Die event live orders grid */                    
                    $('#client-developments-grid a.view').die();
                    $('#client-developments-grid a.update').die();
                    $('#client-developments-grid a.create').die();
                    $('#client-developments-grid a.delete').die();
                    
                    /* Clear div editbox for clients grid */
                    $('#editbox-client').empty();                               
                    $('#editbox-client').dialog('destroy');                                                                               
                 }
               });                                                                      
    });
    //alert('Просмотр заявок клиента В стадии разработки');    
    return false;
}
EOD;
?>

<?php
$js_spaces =<<< EOD
function() {
    var url = $(this).attr('href');
    $.get(url, function(data) {          
          $('#editbox-client').html(data);
          $('#editbox-client.popup').dialog(
               { closeOnEscape: true, width: '1000', 
                 title:'Просмотр заказов клиента',
                 modal: true,  
                 close: function(event, ui) {                     
                    /* Clear div editbox for orders grid */
                    $('#list-realestates').remove();     
                    
                    /* Die event live orders grid */                    
                    $('#realestates-client-grid a.view').die();
                    $('#realestates-client-grid a.status').die();
                    $('#realestates-client-grid a.send').die();
                    $('#realestates-client-grid a.delete').die();
                    
                    /* Clear div editbox for clients grid */
                    $('#editbox-client').empty();                               
                    $('#editbox-client').dialog('destroy');                                                                                              
                 }
               });            
    });
    //alert('Просмотр заказов клиента В стадии разработки');    
    return false;
}
EOD;
?>

<?php
$js_create_clients =<<< EOD
function() {
    var url = $(this).attr('href');
    $.get(url, function(data) {          
        $('#editbox-client').html(data);                               
        $('#editbox-client.popup').dialog({title:'Добавление клиента',
                            modal: true,
                            width: 'auto',
                            close: function(event, ui) { 
                                /* Clear div editbox for clients form */
                                $('#editbox-client').empty();                               
                                $('#editbox-client').dialog('destroy'); 
                            }
        });   
    });
    return false;
}
EOD;
?>

<?php
$js_update_clients =<<< EOD
function() {
    var url = $(this).attr('href');
    $.get(url, function(data) {          
        $('#editbox-client').html(data);                               
        $('#editbox-client.popup').dialog({title:'Редактирование клиента',
                            modal: true,
                            width: 'auto',
                            close: function(event, ui) { 
                                /* Clear div editbox for clients form */
                                $('#editbox-client').empty();                               
                                $('#editbox-client').dialog('destroy'); 
                            }
        });   
    });
    return false;
}
EOD;
?>

<?php
$js_complex_update =<<< EOD
function() {
    var url = $(this).attr('href');
    $.get(url, function(data) {          
        $('#editbox-client').html(data);                               
        $('#editbox-client.popup').dialog({title:'Комплексное редактирование клиента',
                            modal: true,
                            width: 'auto',
                            close: function(event, ui) { $('#editbox-client').html('') }
        });   
    });
    return false;
}
EOD;
?>

<?php
$js_complex_update_ajax =<<< EOD
function() {
    var url = $(this).attr('href');
    $.get(url, function(data) {          
        $('#editbox-client').html(data);                               
        $('#editbox-client.popup').dialog({title:'Комплексное редактирование клиента',
                            modal: true,
                            width: 'auto',
                            close: function(event, ui) { $('#editbox-client').html('') }
        });   
    });
    return false;
}
EOD;
?>

<?php
$js_send =<<< EOD
function() {
    var url = $(this).attr('href');
    $.get(url, function(data) {
     var val = $.parseJSON(data);
          $.pnotify({
            pnotify_width: 100,
            pnotify_nonblock: true,
            pnotify_title: 'Информация', 
            pnotify_text: val.mess+'<br/>успешно отправлена!',
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
    });
    return false;
}
EOD;
?>

<h1><?php echo Yii::t('adm-menu','Manage Clients');?></h1>

<p>
<?=Yii::t('form','You may optionally enter a comparison operator (<, <=, >, >=, <> or =) at the beginning of each of your search values to specify how the comparison should be done.');?>
</p>

<?php echo CHtml::link(Yii::t('application','Advanced Search'),'#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('application.components.widgets.RGridView', array(
	'id'=>'clients-grid',
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
           'groupDelete'=>'Удалить клиентов', 
        ),            
        'columns'=>array(            
		array('name'=>'id',
                      'visible'=>true,
                      'htmlOptions'=>array('style'=>'text-align:lright;width:25'/*60px;'/*25px*/),
                     ), 
            	array('name'=>'name',
                      'visible'=>true,
                      'htmlOptions'=>array('style'=>'text-align:left;width:75px;'/*25px*/),
                     ),
		array('name'=>'sid',
                      'visible'=>false),
                array( 'name'=>'status_id',
                       'header'=>Yii::t('all','Статус'),
                       'type'=>'html',
                       'htmlOptions'=>array('style'=>'text-align:center;width:15px;'/*25px*/),
                       'value'=>'$data->getStatusIcon();',                   
                       'filter'=>CHtml::listData(ClientStatus::model()->findAll("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                                array("order"=>"sort")), 'id', 'title'),
                       'headerHtmlOptions'=>array('width'=>'15'/*25px*/),
                       'visible'=>true,
                ),                    
                array( 'name'=>'scope_id',
                       'type'=>'text',
                       'header'=>Yii::t('all','C<br>ф<br>Д'),
                       'htmlOptions'=>array('style'=>'text-align:center;width:15px'/*60px;'/*25px*/),
                       'value'=>'$data->scope->abbr;',                   
                       'filter'=>CHtml::listData(ClientScopes::model()->findAll("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                                array("order"=>"sort")), 'id', 'abbr'),
                       'headerHtmlOptions'=>array('width'=>'15'/*'60'/*25px*/),
                       'visible'=>true,
                ),                                
                array( 'name'=>'site_vids_id',
                       'header'=>Yii::t('all','В</br>С'),
                       'type'=>'text',
                       'htmlOptions'=>array('style'=>'text-align:center;width:15px'/*60px;'/*25px*/),
                       'value'=>'$data->siteVids->abbr;',                   
                       'filter'=>CHtml::listData(SiteVids::model()->findAll("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                                array("order"=>"sort")), 'id', 'abbr'),
                       'headerHtmlOptions'=>array('width'=>'15'/*'60'/*25px*/),
                       'visible'=>true,
                ),                                                                                          
                array( 'name'=>'client_type_id',
                       'header'=>Yii::t('all','T</br>K'),
                       'type'=>'text',
                       'htmlOptions'=>array('style'=>'text-align:center;width:15px'/*60px;'/*25px*/),
                       'value'=>'$data->siteVids->abbr;',                   
                       'filter'=>CHtml::listData(ClientTypes::model()->findAll("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                                array("order"=>"sort")), 'id', 'abbr'),
                       'headerHtmlOptions'=>array('width'=>'15'/*'60'/*25px*/),
                       'visible'=>true,
                ),   
                array('name'=>'contact_person',
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
                array( 'name'=>'phone_types_id',
                       'type'=>'text',
                       'header'=>Yii::t('all','T</br>T'),
                       'htmlOptions'=>array('style'=>'text-align:center;width:15px'/*60px;'/*25px*/),
                       'value'=>'$data->phoneTypes->abbr;',                   
                       'filter'=>CHtml::listData(PhoneTypes::model()->findAll("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                                array("order"=>"sort")), 'id', 'abbr'),
                       'headerHtmlOptions'=>array('width'=>'15'/*'60'/*25px*/),
                       'visible'=>true,
                ),       
                array( 'name'=>'email',
                       'type'=>'email',
                       'header'=>Yii::t('all','Email'),
                       'htmlOptions'=>array('style'=>'text-align:left;width:50px;'/*25px*/),
                       'value'=>'$data->email;',                   
                       'filter'=>CHtml::listData(PhoneTypes::model()->findAll("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                                array("order"=>"sort")), 'id', 'abbr'),
                       'headerHtmlOptions'=>array('style'=>'width:50px'/*25px*/),
                       'visible'=>true,
                ),              
                array( 'name'=>'email_types_id',
                       'type'=>'text',
                       'header'=>Yii::t('all','T</br>E'),
                       'htmlOptions'=>array('style'=>'text-align:center;width:15px'/*60px;'/*25px*/),
                       'value'=>'$data->emailTypes->abbr;',                   
                       'filter'=>CHtml::listData(EmailTypes::model()->findAll("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                                array("order"=>"sort")), 'id', 'abbr'),
                       'headerHtmlOptions'=>array('width'=>'15'/*'60'/*25px*/),
                       'visible'=>true,
                ),                           
		array( 'name'=>'sort',
                       'header'=>Yii::t('all','Cорт'),
                       'visible'=>false),
            
                /*array(  'name'=>'act',
                        'header'=>Yii::t('all','A'),
                        'type'=>'text',
                        'filter'=>CHtml::activecheckBox($model,'act'),
                        'value'=>'($data->act ? "x" : "")',                     
                        'htmlOptions'=>array('style'=>'width:10px;text-align:center;'),
                        'headerHtmlOptions'=>array('width'=>'10'),
                        'visible'=>true,
                ),              
                array(  'name'=>'del',
                        'header'=>Yii::t('all','D'),
                        'type'=>'text',
                        'filter'=>CHtml::activecheckBox($model,'del'),
                        'value'=>'($data->del ? "x" : "")',                     
                        'htmlOptions'=>array('style'=>'width:10px;text-align:center;'),
                        'headerHtmlOptions'=>array('width'=>'10'),
                        'visible'=>true,
                ),*/
            
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
                array('name'=>'contacts',
                      'visible'=>false),
		array(
                      'class'=>'CButtonColumn',
                      /*'header'=>CHtml::link( CHtml::image(Yii::app()->request->baseUrl.'/images/add-item.png', 
                                                Yii::t('all','Create Orders')), Yii::app()->controller->createUrl("create") 
                                            , array("onclick"=>"location.href=$(this).attr('href');") ),*/
                      
                      'header'=>CHtml::ajaxlink( CHtml::image(Yii::app()->request->baseUrl.'/images/add-item.png', 
                                                Yii::t('all','Create Orders'),array()), 
                                                    Yii::app()->controller->createUrl("/clients/ajaxcreate"),                                                      
                                                    array("success"=>"function(data) {          
                                                                $('#editbox-client').html(data);                               
                                                                $('#editbox-client.popup').dialog({
                                                                    title:'Добавление клиента',
                                                                    modal: true,
                                                                    width: 'auto',
                                                                     close: function(event, ui) { 
                                                                        /* Clear div editbox for clients form */
                                                                        $('#editbox-client').empty();                               
                                                                        $('#editbox-client').dialog('destroy'); 
                                                                    }
                                                                  });   
                                                                }"),
                                                    array('id'=>'add_item')
                                              ),
                      'template'=>( Yii::app()->user->checkAccess('superadmin') ? '{view}  {update} {create} {delete} <br/>{info} {orders} {spaces} {complexview} {ajaxcomplexupdate} {complexupdate} {send_presents} {events} ' : '{view} {update} {create} <br/>{info} {orders} {spaces} {complexview} {complexupdate} {send_presents} {events}') ,
                      'buttons'=>array(   'send_presents'=>
                                            array( 'label'=>'Send Presentation',
                                                   'url'=>'Yii::app()->controller->createUrl("ajaxsendpresents",array("id"=>$data->primaryKey))',
                                                   'imageUrl'=>Yii::app()->request->baseUrl.'/images/mail-send.png',    
                                                   'click'=>$js_send,
                                                   'visible'=>'true',    
                                          ),
                                          'update'=>
                                                      array( 'label'=>Yii::t('all','Update Clients'),
                                                             //'url'=>'Yii::app()->controller->createUrl("/clients/update",array("id"=>$data->id))', 
                                                             'url'=>'Yii::app()->controller->createUrl("/clients/ajaxupdate",array("id"=>$data->id))', 
                                                             'click'=>$js_update_clients,
                                                             'visible'=>'true',  
                                                           ),  
                                          'create'=>
                                                      array( 'label'=>Yii::t('all','Create Clients'),
                                                             //'url'=>'Yii::app()->controller->createUrl("/clients/create")',
                                                             'url'=>'Yii::app()->controller->createUrl("/clients/ajaxcreate")',                                                             
                                                             'imageUrl'=>Yii::app()->request->baseUrl.'/images/add-item.png',    
                                                             'click'=>$js_create_clients,
                                                             'visible'=>'true',    
                                                      ),
                                          'complexview'=> array( 'label'=>'Complex View', 
                                                       'url'=>'Yii::app()->controller->createUrl("complexview",array("id"=>$data->primaryKey))',
                                                       'imageUrl'=>Yii::app()->request->baseUrl.'/images/icons/complex-stock-view-fields-16.png',    
                                                       'click'=>$js_complex_view,
                                                       'visible'=>'false',
                                          ),
                                         'complexupdate'=> array( 'label'=>'Complex Update', 
                                                       'url'=>'Yii::app()->controller->createUrl("complexupdate",array("id"=>$data->primaryKey))',
                                                       'imageUrl'=>Yii::app()->request->baseUrl.'/images/icons/editor-tool-node.png',    
                                                       'click'=>$js_complex_update,
                                                       'visible'=>'false',
                                          ),
                                         'ajaxcomplexupdate'=> array( 'label'=>'Complex Update Ajax', 
                                                       'url'=>'Yii::app()->controller->createUrl("/clients/ajaxcomplexupdate",array("id"=>$data->primaryKey))',
                                                       'imageUrl'=>Yii::app()->request->baseUrl.'/images/icons/editor-tool-node.png',    
                                                       'click'=>$js_complex_update_ajax,
                                                       'visible'=>'false',
                                          ),                          
                                          'view'=> array( 'label'=>'View',                                                      
                                                       'url'=>'Yii::app()->controller->createUrl("ajaxview",array("id"=>$data->primaryKey))',
                                                       //'imageUrl'=>Yii::app()->request->baseUrl.'/images/icons/info-process.png',    
                                                       'click'=>$js_view,
                                                       'visible'=>'true',
                                          ),                          
                                          'info'=> array( 'label'=>'Info', 
                                                       'url'=>'Yii::app()->controller->createUrl("info",array("id"=>$data->primaryKey))',                                                       
                                                       'imageUrl'=>Yii::app()->request->baseUrl.'/images/icons/info-process.png',    
                                                       'click'=>$js_info,
                                                       'visible'=>'false',
                                          ),
                                          'spaces'=> array( 'label'=>'View Spaces', 
                                                       'url'=>'Yii::app()->controller->createUrl("/clients/ajaxviewspaces",array("id"=>$data->primaryKey))',
                                                       'imageUrl'=>Yii::app()->request->baseUrl.'/images/icons/order-yellow3.png',    
                                                       'click'=>$js_spaces,
                                                       'visible'=>'true',
                                          ),
                                          'orders'=> array( 'label'=>'View Orders', 
                                                       'url'=>'Yii::app()->controller->createUrl("/clients/ajaxvieworders",array("id"=>$data->primaryKey))',
                                                       'imageUrl'=>Yii::app()->request->baseUrl.'/images/icons/filter-activation-order16x16.png',    
                                                       'click'=>$js_orders,
                                                       'visible'=>'true',
                                          ),
                                          'events'=> array( 'label'=>'View Events', 
                                                       'url'=>'Yii::app()->controller->createUrl("/clients/ajaxviewevents",array("id"=>$data->primaryKey))',
                                                       'imageUrl'=>Yii::app()->request->baseUrl.'/images/icons/events.png',    
                                                       'click'=>$js_developments,
                                                       'visible'=>'true',
                                          ),
                        ), 
                       'htmlOptions'=>array('style'=>'text-align:center;width:80px'/*60px;'/*25px*/),
                       'headerHtmlOptions'=>array('width'=>'80'/*'60'/*25px*/),
		),
	),
)); ?>

<div id="editbox-client" class="popup hidden"></div>
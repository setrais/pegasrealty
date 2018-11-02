<?php
$js_create_orders =<<< EOD
function() {
    var url = $(this).attr('href');
    $.get(url, function(data) {          
        $('#editbox-order').html(data);                               
        $('#editbox-order.popup').dialog({
                    closeOnEscape: true,
                            title:'Добавление заявки',
                            stack: true,
                            modal: true,
                            width: 660,
                            zIndex: 1090,
                            close: function(event, ui) { 
                                $('#editbox-order').empty();
                                $.fn.yiiGridView.update('orders-grid', {
                                            type: 'post',
                                            data: $(this).serialize()
                                      });            
                }
        });   
    });
    return false;
}
EOD;
?>

<?
$js_update_orders =<<< EOD
function() {
    var url = $(this).attr('href');   
    $.get(url, function(data) {          
        $('#editbox-order').html(data);                               
        $('#editbox-order.popup').dialog({
                    closeOnEscape: true,
                            title:'Редактирование заявки',
                            stack: true,
                            modal: true,
                            width: 660,
                            zIndex: 1090,
                            close: function(event, ui) { 
                                $('#editbox-order').empty();                                                                                                
                                $.fn.yiiGridView.update('orders-grid', {
                                            type: 'post',
                                            data: $(this).serialize()
                                      });          
              }
        });   
    });
    return false;
}
EOD;
?>

<?
$js_view_orders =<<< EOD
function() {
    var url = $(this).attr('href');
    $.get(url, function(data) {          
        $('#editbox-order').html(data);                               
        $('#editbox-order.popup').dialog({
                            title: 'Просмотр заявки',
                    closeOnEscape: true,
                            modal: true,
                            stack: true,
                            width: 660,
                            zIndex: 1090,
                            close: function(event, ui) { 
                                $('#editbox-order').empty();                                
                            }                            
    });   
    });
    return false;
}
EOD;
?>

<?
$js_history_orders =<<< EOD
function() {    
    var url = $(this).attr('href');
    $.get(url, function(data) {          
        $('#editbox-order').html(data);                               
        $('#editbox-order.popup').dialog({
                            closeOnEscape: true,
                            title:'История заявки',
                            modal: true,
                            width: 960,
                            stack: true,
                            zIndex: 1090,
                            close: function(event, ui) { 
                                /* Clear div editbox for orders grid */
                                $('#wind-histories').remove();     
                    
                                /* Die event live orders grid */                    
                                $('#order-histories-grid a.view').die();
                                $('#order-histories-grid a.delete').die();
                    
                                /* Clear div editbox for orders grid */
                                $('#editbox-order').empty();                               
                                $('#editbox-order').dialog('destroy');                                      
                            }
        });   
    });
    return false;
}
EOD;
?>

<?
$js_suiarea_orders = <<< EOD
function() {
    var url = $(this).attr('href');
    $.get(url, function(data) {                                     
        $('#editbox-order.popup').dialog({
            closeOnEscape: true,
            title:'Подходящие плошади',
            modal: true,
            width: 960,
            stack: true,
            zIndex: 1090,
            close: function(event, ui) { 
                
                /* Clear div oper relestates for space orders grid */
                $('#oper-realestates').remove();     
                    
                /* Die event live oper relestates for space orders grid */                    
                $('#realestates-grid a.view').die();
                $('#realestates-grid a.send').die();
                $('#realestates-grid a.copy').die();
                    
                /* Clear div editbox for orders grid */
                $('#editbox-order').empty();                               
                $('#editbox-order').dialog('destroy');     
            }
        });   
        $('#editbox-order').html(data);                        
    });
    /*$.ajax({url: url,
            success: function() {
                $('#editbox-order.popup').dialog({title:'Подходящие плошади',
                            modal: true,
                            width: 1000});  
                            
            }
    }).done(function( data ) {         
        $('#editbox-order').append(data);     
    });*/        
    return false;
}
EOD;
?>

<div>
<?php $this->widget('application.components.widgets.RGridView', array(
                    'id'=>'orders-grid',
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
                       'groupSendOrder'=>'Разослать информацию', 
                       'groupDeleteOrder'=>'Удалить заявки', 
                    ),            
                    'columns'=>array(
                            array( 'name'=>'id', 'type'=>'text',
                                   'headerHtmlOptions'=>array('width'=>'60'),
                                   'htmlOptions'=>array('style'=>'width:60px;'),
                                   'visible'=>true,
                            ),  
                            array( 'name'=>'district_id',
                                   'header'=>Yii::t('all','District'),
                                   'type'=>'text',
                                   'value'=>'$data->district->title;',
                                   'htmlOptions'=>array('style'=>'width:40px;'/*60px*/),
                                   'filter'=>CHtml::listData(Districts::model()->findAll("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                                              array("order"=>"sort")), 'id', 'title'),
                                   'headerHtmlOptions'=>array('width'=>'40'/*60px*/),
                                   'visible'=>true,
                                ),       
                            array( 'name'=>'remoteness',
                                   'header'=>Yii::t('all','From ungr'),
                                   'type'=>'html',
                                   //'value'=>'round($data->remoteness)."<span style=padding-left:2px;color:#0078ae;font-family:Tahoma;font-size:9px;font-weight:bold;vertical-align:middle; >".$data->unit->short_title;',
                                   'value'=>'round($data->remoteness)',
                                   'htmlOptions'=>array('style'=>'width:60px;text-align:right;'),
                                   'headerHtmlOptions'=>array('width'=>'60'),
                                   'visible'=>true,
                            ),              
                            array( 'name'=>'unit_id',
                                   'header'=>Yii::t('all','Ed.'),
                                   'type'=>'html',
                                   'value'=>'$data->unit->short_title',
                                   'filter'=>CHtml::listData(Units::model()->findAll(), 'id', 'abbr'), 
                                   'htmlOptions'=>array('style'=>'width:40px'/*60px*/.';text-align:right;'),
                                   'headerHtmlOptions'=>array('width'=>'40'/*'60'*/),
                                   'visible'=>true,
                            ),                          
                            array( 'name'=>'operation_id',
                                   'header'=>Yii::t('all','ОП'),
                                   'type'=>'text',
                                   'filter'=>CHtml::listData(Operations::model()->findAll(), 'id', 'abbr'), 
                                   'value'=>'$data->operation->abbr;',                     
                                   'htmlOptions'=>array('style'=>'width:80px;text-align:center;'),
                                   'headerHtmlOptions'=>array('width'=>'80'),
                                   'visible'=>true,
                            ),   
                           array(  'name'=>'realestate_type_id',
                                   'header'=>Yii::t('all','Type'),
                                   'type'=>'text',
                                   'filter'=>CHtml::listData(RealestateTypes::model()->findAll(), 'id', 'abbr'), 
                                   'value'=>'$data->realestateType->abbr;',                     
                                   'htmlOptions'=>array('style'=>'width:80px;text-align:center;'),
                                   'headerHtmlOptions'=>array('width'=>'80'),
                                   'visible'=>true,
                           ),  
                           array( 'name'=>'realestate_vid_id',
                                  'header'=>Yii::t('all','View'),
                                  'type'=>'text',
                                  'htmlOptions'=>array('style'=>'text-align:center;width:25'/*60px;'/*25px*/),
                                  'value'=>'$data->realestateVid->abbr;',                   
                                  'filter'=>CHtml::listData(RealestateVids::model()->findAll("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                                                array("order"=>"sort")), 'id', 'abbr'),
                                  'headerHtmlOptions'=>array('width'=>'25'/*'60'/*25px*/),
                                  'visible'=>true,
                                ),
                           array( 'name'=>'realestate_class_id',
                                  'header'=> Yii::t('grid','Class'),
                                  'type'=>'text',
                                  'value'=>'$data->realestateClass->abbr;',
                                  'htmlOptions'=>array('style'=>'text-align:center;width:30px;'/*30px*/),
                                  'filter'=>CHtml::listData(RealestateClasses::model()->findAll("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                                                array("order"=>"sort")), 'id', 'abbr'),
                                  'headerHtmlOptions'=>array('width'=>'30'/*30px*/),
                                  'visible'=>true,
                                ),                              
                            array( 'name'=>'price_from',
                                   'type'=>'text',
                                   'htmlOptions'=>array('style'=>'width:60px;text-align:right;'),
                                   'headerHtmlOptions'=>array('width'=>'60'),
                                   'visible'=>true,
                            ),                           
                            array( 'name'=>'price_to',
                                   'type'=>'text',
                                   'htmlOptions'=>array('style'=>'width:60px;text-align:right;'),
                                   'headerHtmlOptions'=>array('width'=>'60'),
                                   'visible'=>true,
                            ),   
                            array(  'name'=>'valute_id',
                                    'header'=>Yii::t('all','Valute'),
                                    'type'=>'text',
                                    'filter'=>CHtml::listData(Valutes::model()->findAll(), 'id', 'title'),              
                                    'value'=>'$data->valute->title',
                                    'htmlOptions'=>array('style'=>'width:50px;text-align:right;'),
                                    'headerHtmlOptions'=>array('width'=>'50'),
                                    'visible'=>true,
                            ),                     
                            array( 'name'=>'area_from',
                                   'header'=>Yii::t('all','Пл. от'),
                                   'type'=>'text',
                                   'htmlOptions'=>array('style'=>'width:60px;text-align:right;'),
                                   'headerHtmlOptions'=>array('width'=>'60'),
                                   'visible'=>true,
                            ),                           
                            array( 'name'=>'area_to',
                                   'header'=>Yii::t('all','Пл. до'),
                                   'type'=>'text',
                                   'htmlOptions'=>array('style'=>'width:60px;text-align:right;'),
                                   'headerHtmlOptions'=>array('width'=>'60'),
                                   'visible'=>true,
                            ),  
                            array(  'name'=>'poligon',
                                    'htmlOptions'=>array('style'=>'width:60px;text-align:center;'),
                                    'headerHtmlOptions'=>array('width'=>'60'),
                                    'visible'=>false,
                            ),                          
                            array(  'name'=>'orderMetroses',
                                    'type'=>'text',
                                    'htmlOptions'=>array('style'=>'width:60px;text-align:center;'),
                                    'headerHtmlOptions'=>array('width'=>'60'),
                                    'visible'=>false,
                            ),                                
                            array(  'name'=>'createdate',
                                    'type'=>'text',
                                    'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', 
                                        array( 'language'=> Yii::app()->params->language,                                        
                                               'model'=>$model,
                                               'attribute'=>'createdate',   
                                               'theme'=>'cupertino',//'ui-lightness',
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
                                    'value'=>'($data->createdate===null) ? "" : date("d.m.Y",strtotime($data->createdate))',
                                    'htmlOptions'=>array('style'=>'width:'/*110*/.'70px;text-align:center;'),
                                    'headerHtmlOptions'=>array('width'=>'70'/*'110'*/),
                                    'visible'=>true,
                            ),            
                            array(  'name'=>'createuser',                  
                                    'type'=>'text',
                                    'htmlOptions'=>array('style'=>'text-align:center;width:50px;'),
                                    'value'=>'$data->updateUser->username;',                   
                                    'filter'=>CHtml::listData(Users::model()->findAll("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                                                array("order"=>"sort")), 'id', 'username'),
                                    'headerHtmlOptions'=>array('width'=>'50'),
                                    'visible'=>true,
                            ),                            
                            array(  'name'=>'updatedate',
                                    'type'=>'text',
                                    'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', 
                                        array( 'language'=> Yii::app()->params->language,                                        
                                               'model'=>$model,
                                               'attribute'=>'updatedate',   
                                               'theme'=>'cupertino',//'ui-lightness',
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
                                    'value'=>'($data->updatedate===null) ? "" : date("d.m.Y",strtotime($data->updatedate))',
                                    'htmlOptions'=>array('style'=>'width:'/*110*/.'70px;text-align:center;'),
                                    'headerHtmlOptions'=>array('width'=>'70'/*'110'*/),
                                    'visible'=>false,
                            ),   
                            array(  'name'=>'updateuser',                  
                                    'type'=>'text',
                                    'htmlOptions'=>array('style'=>'text-align:center;width:50px;'),
                                    'value'=>'$data->updateUser->username;',                   
                                    'filter'=>CHtml::listData(Users::model()->findAll("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                                                array("order"=>"sort")), 'id', 'username'),
                                    'headerHtmlOptions'=>array('width'=>'50'),
                                    'visible'=>false,
                            ),                              
                            array(  'name'=>'sort',
                                    'header'=>Yii::t('all','Сорт.'),
                                    'type'=>'text',                                    
                                    'visible'=>true, 
                            ),
                            array(  'name'=>'act',
                                    'header'=>Yii::t('all','А'),
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
                            ),                                                
                            array(  'header'=>CHtml::ajaxlink( CHtml::image(Yii::app()->request->baseUrl.'/images/add-item.png', 
                                                Yii::t('all','Create Orders'),array()), 
                                                    Yii::app()->controller->createUrl("/orders/ajaxcreate",array("id"=>$model_client->id)), 
                                                    array("success"=>"function(data) {          
                                                                $('#editbox-order').html(data);                               
                                                                $('#editbox-order.popup').dialog({    
                                                                    closeOnEscape: true,
                                                                    title:'Добавление заявки',
                                                                    stack: true,
                                                                    modal: true,
                                                                    width: 660,
                                                                    zIndex: 1090,
                                                                    close: function(event, ui) { 
                                                                        $('#editbox-order').empty();
                                                                        $.fn.yiiGridView.update('orders-grid', {
                                                                                type: 'post',
                                                                                data: $(this).serialize()
                                                                        });            
                                                                    }    
                                                                 });   
                                                                }"), 
                                                    array('id'=>'add_order')
                                              ),
                                    'class'=>'CButtonColumn',
                                    'template'=>'{view} {update}</br>{create} {delete}</br>{history} {suiarea}',
                                    'headerHtmlOptions'=>array('width'=>'130'),
                                    'htmlOptions'=>array('style'=>'width:130px;text-align:center;'),
                                    'buttons'=>array( 'create'=>
                                                      array( 'label'=>Yii::t('all','Create Orders'),
                                                             'url'=>'Yii::app()->controller->createUrl("/orders/ajaxcreate",array("id"=>'.$model_client->id.'))',
                                                             'imageUrl'=>Yii::app()->request->baseUrl.'/images/add-item.png',    
                                                             'click'=>$js_create_orders,
                                                             'visible'=>'true',    
                                                      ),
                                                      'delete'=>
                                                      array( 'label'=>Yii::t('all','Delete Orders'),
                                                             'url'=>'Yii::app()->controller->createUrl("/orders/delete",array("id"=>$data->id))',                                                   
                                                             'visible'=>'true',  
                                                           ),  
                                                      'view'=>
                                                      array( 'label'=>Yii::t('all','View Orders'),
                                                             //'url'=>'Yii::app()->controller->createUrl("/developments/view",array("id"=>$data->development_id))', 
                                                             'url'=>'Yii::app()->controller->createUrl("/orders/ajaxview",array("id"=>$data->id))', 
                                                             'click'=>$js_view_orders,
                                                             'visible'=>'true',  
                                                           ),  
                                                      'update'=>
                                                      array( 'label'=>Yii::t('all','Update Orders'),
                                                             //'url'=>'Yii::app()->controller->createUrl("/developments/update",array("id"=>$data->development_id))', 
                                                             'url'=>'Yii::app()->controller->createUrl("/orders/ajaxupdate",array("id"=>$data->id))', 
                                                             'click'=>$js_update_orders,
                                                             'visible'=>'true',  
                                                           ),  
                                                     'history'=>
                                                      array( 'label'=>Yii::t('all','History Orders'),
                                                             'imageUrl'=>Yii::app()->request->baseUrl.'/images/history.png',    
                                                             //'url'=>'Yii::app()->controller->createUrl("/developments/update",array("id"=>$data->development_id))', 
                                                             'url'=>'Yii::app()->controller->createUrl("/orders/ajaxhistory",array("id"=>$data->id))', 
                                                             'click'=>$js_history_orders,
                                                             'visible'=>'true',  
                                                           ),       
                                                      'suiarea'=>
                                                      array( 'label'=>Yii::t('all','Suitable area'),
                                                             'imageUrl'=>Yii::app()->request->baseUrl.'/images/realestate.png',    
                                                             //'url'=>'Yii::app()->controller->createUrl("/developments/update",array("id"=>$data->development_id))', 
                                                             'url'=>'Yii::app()->controller->createUrl("/orders/ajaxsuiarea",array("id"=>$data->id,"cid"=>'.$model_client->id.'))', 
                                                             'click'=>$js_suiarea_orders,
                                                             'visible'=>'true',  
                                                           )   
                                    ),                            

                            ),
                    ),
            )); ?>
</div>
<div id="editbox-order" class="popup p-t20 hidden" ></div>
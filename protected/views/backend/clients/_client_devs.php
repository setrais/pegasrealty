<?php
$js_create_developments =<<< EOD
function() {
    var url = $(this).attr('href');
    $.get(url, function(data) {          
        $('#editbox-development').html(data);                               
        $('#editbox-development.popup').dialog({
                            title:'Добавление события',
                            stack: true,
                            modal: true,
                            width: 660,
                            zIndex: 1090,
                            close: function(event, ui) { 
                                $('#editbox-development').empty();
                                $('#editbox-development').dialog('destroy');
                                $.fn.yiiGridView.update('client-developments-grid', {
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
$js_update_developments =<<< EOD
function() {
    var url = $(this).attr('href');
    $.get(url, function(data) {          
        $('#editbox-development').html(data);                               
        $('#editbox-development.popup').dialog({
                            title:'Редактирование события',
                            stack: true,
                            modal: true,
                            width: 660,
                            zIndex: 1090,
                            close: function(event, ui) { 
                                $('#editbox-development').empty();
                                $('#editbox-development').dialog('destroy');
                                $.fn.yiiGridView.update('client-developments-grid', {
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
$js_view_developments =<<< EOD
function() {
    var url = $(this).attr('href');
    $.get(url, function(data) {          
        $('#editbox-development').html(data);                               
        $('#editbox-development.popup').dialog({title:'Просмотр события',
                            stack: true,
                            modal: true,
                            width: 660,
                            zIndex: 1090,
                            close: function(event, ui) { 
                                $('#editbox-development').empty();
                                $('#editbox-development').dialog('destroy');
                                $.fn.yiiGridView.update('client-developments-grid', {
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

<?php $this->widget('application.components.widgets.RGridView', array(
            'id'=>'client-developments-grid',
            'dataProvider'=>$model->search(),
            'filter'=>$model,
            'summaryText'=>Yii::t('core',                 
                              'Displaying Items {start} - {end} of {count} results', 
                               $model->search()->getTotalItemCount()),
            'emptyText'=>Yii::t('core','No results found.'),   
            'afterAjaxUpdate'=>"function() { 
                                $('#ClientDevelopmets_createdate').datepicker($.datepicker.regional['".Yii::app()->params->language."']);
                                $('#ClientDevelopmets_createdate').datepicker( 'option', 'altFormat', 'dd.mm.yy' );                                
                                $('#ClientDevelopmets_createdate').datepicker( 'option', 'dateFormat', 'dd.mm.yy' );
                                
                                $('#ClientDevelopmets_updatedate').datepicker($.datepicker.regional['".Yii::app()->params->language."']);
                                $('#ClientDevelopmets_updatedate').datepicker( 'option', 'altFormat', 'dd.mm.yy' );                                
                                $('#ClientDevelopmets_updatedate').datepicker( 'option', 'dateFormat', 'dd.mm.yy' );

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
                       'groupPrintEvent'=>'Раcпечатать информацию', 
                       'groupDeleteEvent'=>'Удалить собятия', 
            ),          
            'columns'=>array(
                    array( 'name'=>'id', 'type'=>'text',
                           'headerHtmlOptions'=>array('width'=>'60'),
                           'htmlOptions'=>array('style'=>'width:60px;'),
                           'visible'=>true,
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
                              'visible'=>true,
                    ),                            
                    array( 'name'=>'client_id', 'type'=>'text',
                           'value'=>'$data->client->name;',                   
                           'filter'=>CHtml::listData(Clients::model()->findAll(array("condition"=>"(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                                     "order"=>"sort")), 'id', 'name'),                           
                           'visible'=>false,
                    ),                
                    array( 'name'=>'development_id', 'type'=>'text',
                           'value'=>'$data->development->title;',                   
                           'filter'=>CHtml::listData(Developments::model()->findAll(array("condition"=>"(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                                     "order"=>"sort")), 'id', 'title'),                           
                           'visible'=>true,
                    ),                                
                    array( 'name'=>'desc', 'type'=>'text',
                           'headerHtmlOptions'=>array('width'=>'255'),
                           'htmlOptions'=>array('style'=>'width:255px;'),
                           'visible'=>true,                        
                    ),                                                                   
                    array( 'name'=>'sort', 'type'=>'text',
                           'visible'=>false, 
                    ),
                    array(  'name'=>'act',
                            'header'=>Yii::t('all','А'),
                            'type'=>'text',
                            'filter'=>CHtml::activecheckBox($model,'act',array('checked'=>($model->act==null ? 'checked' : $model->act) )),
                            'value'=>'( $data->act ? "x" : "")',                     
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
                    array(  'header'=>CHtml::ajaxlink( CHtml::image(Yii::app()->request->baseUrl.'/images/add-event.png', 
                                        Yii::t('all','Create Developments'),array()), 
                                            Yii::app()->controller->createUrl("/clientDevelopments/ajaxcreate",array("id"=>$model_client->id)), 
                                            array(  "type"=>"get",
                                                    "typeData"=>'text',
                                                    "success"=>"function(data) {          
                                                        $('#editbox-development').html(data);                               
                                                        $('#editbox-development.popup').dialog({
                                                            title:'Добавление события',
                                                            stack: true,
                                                            modal: true,
                                                            width: 660,
                                                            zIndex: 1090,
                                                            close: function(event, ui) { 
                                                                $('#editbox-development').empty();
                                                                $('#editbox-development').dialog('destroy');
                                                                $.fn.yiiGridView.update('client-developments-grid', {
                                                                            type: 'post',
                                                                            data: $(this).serialize()
                                                                      });            
                                                            }
                                                         });   
                                                      }"), 
                                            array('id'=>'add_event')
                                      ),
                            'class'=>'CButtonColumn',
                            'template'=>'{view} {update} {delete} {create}',
                            'buttons'=>array( 'create'=>
                                              array( 'label'=>Yii::t('all','Add Developments'),
                                                     'url'=>'Yii::app()->controller->createUrl("/clientDevelopments/ajaxcreate",array("id"=>'.$model_client->id.'))',
                                                     'imageUrl'=>Yii::app()->request->baseUrl.'/images/add-event.png',    
                                                     'click'=>$js_create_developments,
                                                     'visible'=>'true',    
                                              ),
                                              'delete'=>
                                              array( 'label'=>Yii::t('all','Delete Developments'),
                                                     'url'=>'Yii::app()->controller->createUrl("/clientDevelopments/delete",array("id"=>$data->id))',                                                   
                                                     'visible'=>'true',  
                                                   ),  
                                              'view'=>
                                              array( 'label'=>Yii::t('all','View Developments'),
                                                     //'url'=>'Yii::app()->controller->createUrl("/developments/view",array("id"=>$data->development_id))', 
                                                     'url'=>'Yii::app()->controller->createUrl("/clientDevelopments/ajaxview",array("id"=>$data->id))', 
                                                     'click'=>$js_view_developments,
                                                     'visible'=>'true',  
                                                   ),  
                                              'update'=>
                                              array( 'label'=>Yii::t('all','Update Developments'),
                                                     //'url'=>'Yii::app()->controller->createUrl("/developments/update",array("id"=>$data->development_id))', 
                                                     'url'=>'Yii::app()->controller->createUrl("/clientDevelopments/ajaxupdate",array("id"=>$data->id))', 
                                                     'click'=>$js_update_developments,
                                                     'visible'=>'true',  
                                                   )  
                                       ),                            
                        
                    ),
            ),
)); ?>
<div id="editbox-development" class="popup p-t20 hidden" >
    
</div>
<?php
$js_preview =<<< EOD
function() {
    var url = $(this).attr('href');
    $.get(url, function(data) {
        $('#oper-realestates.popup').dialog({
                            title:'Просмотр недвижемости',                            
                            modal: true,
                            width: '730',
                            close: function(event, ui) { 
                                 $('#oper-realestates').empty();
                                 $('#oper-realestates').dialog('destroy');
                               }
        });                         
        $('#oper-realestates').html(data);                               
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

<?php 
$js_copy =<<< EOD
function() {
    var url = $(this).attr('href');
    $.get(url, function(data){        
          $.fn.yiiGridView.update('realestates-grid', {
                type: 'post',
		data: $(this).serialize()
  	  });
          var val = $.parseJSON(data);
          $.pnotify({
            pnotify_width: 100,
            pnotify_nonblock: true,
            pnotify_title: 'Информация', 
            pnotify_text: val.mess+'<br/>успешно присвоено!',
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


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'realestates-grid',
	'dataProvider'=>$model->search(),
        'afterAjaxUpdate'=>"function() { 
                                $('#Realestates_date_release').datepicker($.datepicker.regional['".Yii::app()->params->language."']);
                                $('#Realestates_date_release').datepicker( 'option', 'altFormat', 'dd.mm.yy' );                                
                                $('#Realestates_date_release').datepicker( 'option', 'dateFormat', 'dd.mm.yy' );
                                
                                $('#Realestates_date_rang').datepicker($.datepicker.regional['".Yii::app()->params->language."']);
                                $('#Realestates_date_rang').datepicker( 'option', 'altFormat', 'dd.mm.yy' );                                
                                $('#Realestates_date_rang').datepicker( 'option', 'dateFormat', 'dd.mm.yy' );
                                $('.fancyImage').fancybox(
                                   {'overlayShow': true, 'hideOnContentClick': false});
                            }",
	'filter'=>$model,
        'summaryText'=>Yii::t('core',                 
                              'Displaying Items {start} - {end} of {count} results', 
                               $model->search()->getTotalItemCount()),
        'emptyText'=>Yii::t('core','No results found.'),
        /*'htmlOptions'=>array('style'=>'width:auto;overflow-x:scroll'),  */
	'columns'=>array(
            /*array(
		'class'=>'CButtonColumn',                
	    ),*/
            array(
                'class'=>'CCheckBoxColumn',
                'id'=>'check-boxes'
            ),
            array( 'name'=>'id', 'type'=>'text',
                  'headerHtmlOptions'=>array('width'=>'60'),
                  'htmlOptions'=>array('style'=>'width:60px;'),
                  'visible'=>false,
                ),   
            array( 'name'=>'nid', 'type'=>'text',
                  'headerHtmlOptions'=>array('width'=>'80'),
                  'htmlOptions'=>array('style'=>'width:80px;'),
                  'visible'=>false,
                ),                
            array(
                   'name'=>'pic_scr_id',
                   //'htmlOptions'=>array("width"=>60),
                   'type'=>'raw',
                    //тут самое интересное: если файла картинки нет, 
                    // то отображается файл no_photo.gif
                    // Значение value обрабатывается функцией eval() поэтому 
                    // тут такие странные ковычки.
                    /*'value'=> '"/".( trim($data->picOreginal->original_name)<>"" 
                                     && file_exists($_SERVER[DOCUMENT_ROOT]."/".str_replace("_original","_src",trim($data->picOreginal->original_name)))
                                     ? str_replace("_original","_src",trim($data->picOreginal->original_name))
                                     : ( trim($data->picScr->original_name)<>"" 
                                         && file_exists($_SERVER[DOCUMENT_ROOT]."/".str_replace("_original","_src",trim($data->picScr->original_name)))
                                         ? str_replace("_original","_src",trim($data->picScr->original_name)) 
                                         : "images/no_foto_small.png" ))',*/
                    /*'value'=> '"/".( trim($data->picScr->original_name)<>"" 
                                     && file_exists($_SERVER[DOCUMENT_ROOT]."/".str_replace("_original","_src",trim($data->picScr->original_name)))
                                     ? str_replace("_original","_src",trim($data->picScr->original_name))
                                     : ( trim($data->picOreginal->original_name)<>"" 
                                         && file_exists($_SERVER[DOCUMENT_ROOT]."/".str_replace("_original","_src",trim($data->picOreginal->original_name)))
                                         ? str_replace("_original","_src",trim($data->picOreginal->original_name)) 
                                         : "images/no_foto_small.png" ))',*/
                    'value'=> 'CHtml::link(CHtml::image( 
                                   "/".( trim($data->picScr->original_name)<>"" 
                                     && file_exists($_SERVER[DOCUMENT_ROOT]."/".str_replace("_original","_src",trim($data->picScr->original_name)))
                                     ? str_replace("_original","_src",trim($data->picScr->original_name))
                                     : ( trim($data->picOreginal->original_name)<>"" 
                                         && file_exists($_SERVER[DOCUMENT_ROOT]."/".str_replace("_original","_src",trim($data->picOreginal->original_name)))
                                         ? str_replace("_original","_src",trim($data->picOreginal->original_name)) 
                                         : "images/no_foto_small.png" )),"", 
                                         array("title"=>$data->picOreginal->name )), 
                                         "/".$data->picOreginal->original_name, array("class"=>"fancyImage"))',
                    'filter'=>'',
                    'headerHtmlOptions'=>array('width'=>'60'),
                    'htmlOptions'=>array('style'=>'width:60px;text-align: center;vertical-align: middle;'),
                    'visible'=>true,
                 ),	
           array( 'name'=>'title', 'type'=>'text',
                  'headerHtmlOptions'=>array('width'=>'100'),
                  'htmlOptions'=>array('style'=>'width:100px;'),
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
           array( 'name'=>'areas_id',
                  'header'=>Yii::t('all','Areas'),
                  'type'=>'text',
                  'value'=>'$data->areas->title;',
                  'htmlOptions'=>array('style'=>'width:80px;'/*60px*/),               
                  //'filter'=>CHtml::activeListBox( $model, 'metro_id', CHtml::listData(Areas::model()->findAll(), 'id', 'title'), array("multiple"=>"multiple","size"=>3)),               
                  'filter'=>CHtml::listData(Areas::model()->findAll(), 'id', 'title'),
                  'headerHtmlOptions'=>array('width'=>'80px'/*60px*/),
                  'visible'=>false,
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
                  'htmlOptions'=>array('style'=>'width:40px'/*60px*/.';text-align:right;'),
                  'headerHtmlOptions'=>array('width'=>'40'/*'60'*/),
                  'filter'=>CHtml::listData(Units::model()->findAll(), 'id', 'short_title'),
                  'visible'=>true,
                ),  
           /*array( 'name'=>'date_release',
                  'header'=>Yii::t('all','Delivery date'),
                  'type'=>'text',
                  'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', 
                    array( 'language'=> Yii::app()->params->language,                                        
                           'model'=>$model,
                           'attribute'=>'date_release',   
                           'theme'=>'ui-lightness',
                           'options'=>array(
                                'showAnim'=>'fold',
                                'dateFormat'=>'dd.mm.yy',                                 
                                'defaultDate'=>date('d.m.Y'),                                                
                                'showButtonPanel'=>true,
                                /*'showOn'=> "button",
                                'buttonImage'=> "/images/calendar.gif",
                                'buttonImageOnly'=> true,
                                //set calendar z-index higher then UI Dialog z-index 
                                'beforeShow'=>"js:function() {
                                  $('.ui-datepicker').css('font-size', '0.8em');
                                  $('.ui-datepicker').css('z-index', parseInt($(this).parents('.ui-dialog').css('z-index'))+1);
                                }",
                           ),   
                           'htmlOptions'=>array('size'=>8 ),
                    ),true),                                    
                  'value'=>'date("d.m.Y",strtotime($data->date_release))',
                  'htmlOptions'=>array('style'=>'width:110px;text-align:center;'),
                  'headerHtmlOptions'=>array('width'=>'110'),
                  'visible'=>true,
                ),*/  
          array(  'name'=>'date_rang',
                  'header'=>Yii::t('all','Date of call'),
                  'type'=>'text',
                  'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', 
                    array( 'language'=> Yii::app()->params->language,                                        
                           'model'=>$model,
                           'attribute'=>'date_rang',   
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
                  'value'=>'date("d.m.Y",strtotime($data->date_rang))',
                  'htmlOptions'=>array('style'=>'width:'/*110*/.'70px;text-align:center;'),
                  'headerHtmlOptions'=>array('width'=>'70'/*'110'*/),
                  'visible'=>true,
                ),            
          array(  'name'=>'in_stock',
                  'header'=>Yii::t('all','H'),
                  'type'=>'text',
                  'filter'=>CHtml::activecheckBox($model,'in_stock'),
                  'value'=>'($data->in_stock ? "x" : "")',                     
                  'htmlOptions'=>array('style'=>'width:10px;text-align:center;'),
                  'headerHtmlOptions'=>array('width'=>'10'),
                  'visible'=>true,
                ),  
          array(  'name'=>'area',
                  'header'=>Yii::t('all','Area'),
                  'type'=>'text',
                  'value'=>'round($data->area).""',                     
                  'htmlOptions'=>array('style'=>'width:30px;text-align:right;'),
                  'headerHtmlOptions'=>array('width'=>'30'),
                  'visible'=>true,
                ),             
          array(  'name'=>'planning_id',
                  'header'=>Yii::t('all','Pl-ing'),
                  'type'=>'text',
                  'value'=>'$data->planning->abbr',          
                  'filter'=>CHtml::listData(Plannings::model()->findAll(), 'id', 'abbr'),              
                  'htmlOptions'=>array('style'=>'width:40px;/*20px;*/text-align:center;'),
                  'headerHtmlOptions'=>array('width'=>'40'/*20*/),
                  'visible'=>true,
               ),               
          array(  'name'=>'price',
                  'header'=>Yii::t('all','Price'),
                  'type'=>'text',
                  'value'=>'round($data->price)',         
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
          array(  'name'=>'tax_id',
                  'header'=>Yii::t('all','Tax'),
                  'type'=>'text',
                  'filter'=>CHtml::listData(Taxs::model()->findAll(), 'id', 'abbr'),              
                  'value'=>'$data->tax->abbr',                     
                  'htmlOptions'=>array('style'=>'width:20px;text-align:center;'),
                  'headerHtmlOptions'=>array('width'=>'20'),
                  'visible'=>true,
                ),             
          array(  'name'=>'parking_id',
                  'header'=>Yii::t('all','Parking'),
                  'type'=>'text',
                  'value'=>'$data->parking->abbr',                     
                  'filter'=>CHtml::listData(Parkings::model()->findAll(), 'id', 'abbr'), 
                  'htmlOptions'=>array('style'=>'width:10px;text-align:center;'),
                  'headerHtmlOptions'=>array('width'=>'10'),
                  'visible'=>true,
                ),    
          array(  'name'=>'representative_id',
                  'header'=>Yii::t('all','Owner'),
                  'type'=>'html',
                  'filter'=>CHtml::listData(Representatives::model()->findAll(), 'id', 'name'), 
                  'value'=>'$data->representative->name."<br/>".$data->representative->telephone;',                     
                  'htmlOptions'=>array('style'=>'width:80px;text-align:center;'),
                  'headerHtmlOptions'=>array('width'=>'80'),
                  'visible'=>false,
                ),                      
          array(  'name'=>'realestateRepresentatives',
                  'header'=>Yii::t('all','Representative'),
                  'type'=>'html',
                  'filter'=>CHtml::listData(Representatives::model()->findAll(), 'id', 'name'),                     
                  'value'=>'( $data->realestateRepresentatives[0]->id==null ? $data->representative->name."<br/>".$data->representative->telephone/*."<br/>".$data->representative->site*/ : Representatives::model()->findByPk($data->realestateRepresentatives[0]->representative_id)->name."<br/>".Representatives::model()->findByPk($data->realestateRepresentatives[0]->representative_id)->telephone/*."<br/>".Representatives::model()->findByPk($data->realestateRepresentatives[0]->representative_id)->site*/ );',
                  'htmlOptions'=>array('style'=>'width:80px;text-align:center;'),
                  'headerHtmlOptions'=>array('width'=>'80'),
                  'visible'=>true,
                ),  
          array(  'name'=>'cnt_parking_place',
                  'header'=>Yii::t('all','№ parking'),
                  'type'=>'text',
                  'value'=>'$data->cnt_parking_place',         
                  'htmlOptions'=>array('style'=>'width:60px;text-align:right;'),
                  'headerHtmlOptions'=>array('width'=>'60'),
                  'visible'=>false,
                ),   
          array(  'name'=>'commission_id',
                  'header'=>Yii::t('all','Type commission'),
                  'type'=>'text',
                  'filter'=>CHtml::listData(Commissions::model()->findAll(), 'id', 'abbr'), 
                  'value'=>'$data->commission->abbr;',                     
                  'htmlOptions'=>array('style'=>'width:80px;text-align:center;'),
                  'headerHtmlOptions'=>array('width'=>'80'),
                  'visible'=>false,
                ),               
          array(  'name'=>'procent_commission',
                  'header'=>Yii::t('all','% commission'),
                  'type'=>'text',                  
                  'value'=>'$data->procent_commission;',                     
                  'htmlOptions'=>array('style'=>'width:80px;text-align:center;'),
                  'headerHtmlOptions'=>array('width'=>'80'),
                  'visible'=>false,
                ),  
         array(   'name'=>'is_separate_entrance',
                  'header'=>Yii::t('all','Sep'),
                  'type'=>'text',
                  'filter'=>CHtml::activecheckBox($model,'is_separate_entrance'),
                  'value'=>'($data->is_separate_entrance  ? "x" : "")',                     
                  'htmlOptions'=>array('style'=>'width:10px;text-align:center;'),
                  'headerHtmlOptions'=>array('width'=>'10'),
                  'visible'=>false,
                ),              
          array(  'name'=>'fav',
                  'header'=>Yii::t('all','Fav'),
                  'type'=>'text',
                  'filter'=>CHtml::activecheckBox($model,'fav'),
                  'value'=>'($data->fav ? "x" : "")',                     
                  'htmlOptions'=>array('style'=>'width:10px;text-align:center;'),
                  'headerHtmlOptions'=>array('width'=>'10'),
                  'visible'=>false,
                ),  
          array(  'name'=>'recommend',
                  'header'=>Yii::t('all','Recommend'),
                  'type'=>'text',
                  'filter'=>CHtml::activecheckBox($model,'recommend'),
                  'value'=>'($data->recommend ? "x" : "")',                     
                  'htmlOptions'=>array('style'=>'width:10px;text-align:center;'),
                  'headerHtmlOptions'=>array('width'=>'10'),
                  'visible'=>false,
                ),               
          array(  'name'=>'advertised',
                  'header'=>Yii::t('all','Advertised'),
                  'type'=>'text',
                  'filter'=>CHtml::activecheckBox($model,'advertised'),
                  'value'=>'($data->advertised ? "x" : "")',                     
                  'htmlOptions'=>array('style'=>'width:10px;text-align:center;'),
                  'headerHtmlOptions'=>array('width'=>'10'),
                  'visible'=>false,
                ),             
          array(  'name'=>'rented',
                  'header'=>Yii::t('all','Rented'),
                  'type'=>'text',
                  'filter'=>CHtml::activecheckBox($model,'rented'),
                  'value'=>'($data->rented ? "x" : "")',                     
                  'htmlOptions'=>array('style'=>'width:10px;text-align:center;'),
                  'headerHtmlOptions'=>array('width'=>'10'),
                  'visible'=>false,
                ),            
          array(  'name'=>'number_tax',
                  'header'=>Yii::t('all','Tax code'),
                  'type'=>'text',                  
                  'filter'=>CHtml::listData(TaxReference::model()->findAll(), 'id', 'abbr'), 
                  'value'=>'$data->taxReference->abbr;',                     
                  'htmlOptions'=>array('style'=>'width:80px;text-align:center;'),
                  'headerHtmlOptions'=>array('width'=>'80'),
                  'visible'=>false,
                ),                            
          array(  'name'=>'realestate_type_id',
                  'header'=>Yii::t('all','Type'),
                  'type'=>'text',
                  'filter'=>CHtml::listData(RealestateTypes::model()->findAll(), 'id', 'abbr'), 
                  'value'=>'$data->realestateType->abbr;',                     
                  'htmlOptions'=>array('style'=>'width:80px;text-align:center;'),
                  'headerHtmlOptions'=>array('width'=>'80'),
                  'visible'=>false,
                ),   
         array(   'name'=>'operation_id',
                  'header'=>Yii::t('all','Operation'),
                  'type'=>'text',
                  'filter'=>CHtml::listData(Operations::model()->findAll(), 'id', 'abbr'), 
                  'value'=>'$data->operation->abbr;',                     
                  'htmlOptions'=>array('style'=>'width:80px;text-align:center;'),
                  'headerHtmlOptions'=>array('width'=>'80'),
                  'visible'=>false,
                ),               
          array(  'name'=>'coefficient_corridor', 
                  'type'=>'text',
                  'filter'=>CHtml::listData(array_combine(range(1,26,1),range(5,30,1)),'id','coefficient_corridor'), 
                  'value'=>'$data->getCoefficientCorridor();',                                                    
                  'headerHtmlOptions'=>array('width'=>'50'),
                  'htmlOptions'=>array('style'=>'width:50px;'),
                  'visible'=>false,
                ),             
          array(  'name'=>'street_id', 
                  'type'=>'text',                  
                  'headerHtmlOptions'=>array('width'=>'100'),
                  'filter'=>CHtml::listData(Streets::model()->findAll(array("select"=>"id,concat(t.SOCR,'.',t.name) as 'name'")), 'id', 'name'),               
                  'value'=>'$data->street->SOCR.".".$data->street->name;',                    
                  'htmlOptions'=>array('style'=>'width:100px;'),
                  'visible'=>false,
                ),              
          array(  'name'=>'newstreet', 'type'=>'text',                  
                  'headerHtmlOptions'=>array('width'=>'100'),
                  'htmlOptions'=>array('style'=>'width:100px;'),
                  'visible'=>false,
                ),            
          array(  'name'=>'address', 'type'=>'text',
                  'headerHtmlOptions'=>array('width'=>'100'),
                  'htmlOptions'=>array('style'=>'width:100px;'),
                  'visible'=>false,
                ),               
          array(  'name'=>'map_latitude',
                  //'header'=>Yii::t('all','Широта'),
                  'type'=>'text',                  
                  'value'=>'$data->map_latitude;',                     
                  'htmlOptions'=>array('style'=>'width:80px;text-align:center;'),
                  'headerHtmlOptions'=>array('width'=>'80'),
                  'visible'=>false,
                ),    
          array(  'name'=>'map_longitude',
                  //'header'=>Yii::t('all','Долгота'),
                  'type'=>'text',                  
                  'value'=>'$data->map_longitude;',                     
                  'htmlOptions'=>array('style'=>'width:80px;text-align:center;'),
                  'headerHtmlOptions'=>array('width'=>'80'),
                  'visible'=>false,
                ),    
         array(   'name'=>'sid', 'type'=>'text',
                  'headerHtmlOptions'=>array('width'=>'100'),
                  'htmlOptions'=>array('style'=>'width:100px;'),
                  'visible'=>false,
                ),   
         array(
                'class'=>'CButtonColumn',
                'template'=>'{view} {send} {copy}',
                'buttons'=>array( 'view'=>
                                  array( 'label'=>'View',
                                         'url'=>'Yii::app()->controller->createUrl("/realestates/ajaxview",array("id"=>$data->primaryKey))',                                             
                                         'click'=>$js_preview,
                                         'visible'=>'true',    
                                  ),
                                  'send'=>
                                  array( 'label'=>'Send',
                                         'url'=>'Yii::app()->controller->createUrl("/realestates/ajaxsendinclient",array("id"=>$data->primaryKey,"cid"=>'.$cid.'))',
                                         'imageUrl'=>Yii::app()->request->baseUrl.'/images/mail-send.png',    
                                         'click'=>$js_send,
                                         'visible'=>'true',    
                                  ),
                                  'copy'=>
                                  array( 'label'=>'Copy',
                                         'url'=>'Yii::app()->controller->createUrl("/realestates/ajaxcopyinclient",array("id"=>$data->primaryKey,"cid"=>'.$cid.'))',
                                         'imageUrl'=>Yii::app()->request->baseUrl.'/images/copy.png',    
                                         'click'=>$js_copy,
                                         'visible'=>'true',    
                                  ),                    
                           ),                
         ),
               
		/* Скрытые поля 
                 * 'id',
                   'pic_scr_id',
                   'pic_anons_id',
                   'pic_detile_id',
                   'telephone', // Удалить
                   'site',      // Удалить
                   'unit_value',// Удалить
                 
		/* Не используються
                 * 'contract_type_id', 
                   'contract_number',
                 
                /* Вывести в инфо через иконки anons, detile, decription
                 * при этом фильтр filter=>''
                 * 
                   'anons',
                   'detile',
                   'description',
                
                 * Множественные поля
                   'realestateProperties',
                   'realestateRepresentatives',
                   'realestateOthers',
                   'realestateSimilarities',
                   'picScr'
                   'picAnons'
                   'picDetile'
                   'realestateFotos',
                   'realestatePresentations',
		*/            
            
	),
)); ?>
<div id="oper-realestates" class="popup"></div>

<script>
    //$(document).ready(function() {
    $(".fancyImage").fancybox(
       {'overlayShow': true, 'hideOnContentClick': false});
    //}); 
</script>  
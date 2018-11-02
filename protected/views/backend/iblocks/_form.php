<div class="wide form l150">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'iblocks-form',
	'enableAjaxValidation'=>false,
        'method'=>'post',
        'htmlOptions'=>array('enctype'=>'multipart/form-data'),    
)); ?>

	<p class="note"><?=Yii::t('form','*');?></p>

	<?php echo $form->errorSummary($model); ?>

        <?/* Begin main of tabs the infoblock */ ob_start(); ?>
        <div class="tabs">
            <div class="row">
                   <?php echo $form->labelEx($model,'name'); ?>
                   <?php echo $form->textField($model,'name',array('style'=>'width:380px','size'=>60,'maxlength'=>255)); ?>
                   <?php echo $form->error($model,'name'); ?>
            </div>
            <div class="row">
                   <?php echo $form->labelEx($model,'act'); ?>
                   <?php echo $form->checkBox($model,'act'); ?>
                   <?php echo $form->error($model,'act'); ?>
            </div>
            <div class="row">
                    <?php echo $form->labelEx($model,'sort'); ?>
                    <?php echo $form->textField($model,'sort', array('style'=>'width:34px;', 'maxlength'=>'4')); ?>
                    <?php echo $form->error($model,'sort'); ?>
            </div>

            <div class="row">
                    <?php echo $form->labelEx($model,'types_iblocks_id'); ?>
                    <?php// echo $form->textField($model,'types_iblocks_id'); ?>
                    <?php echo $form->dropDownList($model,'types_iblocks_id',                           
                           CHtml::listData( TypesIblocks::model()->findAll("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                             array("order"=>"sort")), 'id', 'desc'), array('prompt'=>Yii::t('all','Select')."...",'onchange'=>'getAjaxSection()')); ?>                                                                     
                    <?php echo $form->error($model,'types_iblocks_id'); ?>
                    <script>
                              function getAjaxSection() {
                                  var action = "/bax.php/ru/iblocks/getajaxsection/";                                  
                                  var types_iblocks_id = $("#Iblocks_types_iblocks_id").val();                                    
                                  if (types_iblocks_id) {                                      
                                      $.ajax({    url: action,
                                                 data: { types_iblocks_id : types_iblocks_id },
                                                 type: "POST",
                                              success: function(data) 
                                                       {               
                                                          $('#grid').html(data);            
                                                          $('#grid').removeClass('hidden'); 
                                                       },
                                                error: function(XMLHttpRequest, textStatus, errorThrown) {
                                                               alert(XMLHttpRequest.responseText);
                                                       }
                                              });
                                  }else{
                                      $('#grid').addClass('hidden');
                                  }            
                              }
                      </script>
            </div>            
            <div class="row" id="grid" >
                <? if ($model->grid)  { ?> 
                    <?php// echo $model->types_iblocks_id; ?>
                    <?php $data = CHtml::listData(Iblocks::model()->findAll("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0) ".( trim($model->types_iblocks_id)<>'' ? "AND (TYPES_IBLOCKS_ID='".$model->types_iblocks_id."')" : "")."AND ((GRID=0)OR(GRID IS NULL))",
                             array("order"=>"sort")), 'id', 'name'); ?>
                    <?php if (!empty($data)) { ?>
                    <?php echo $form->labelEx($model,'grid'); ?>               
                    <?php echo $form->dropDownList($model,'grid',$data); ?>                                                                                     
                    <?php echo $form->error($model,'grid'); ?>
                    <?php } ?>
                <? } ?>
            </div>
            <div class="row" style="padding-top:10px;">
		<?php echo $form->labelEx($model,'is_resize'); ?>             
                <?php $htmlOpt = array( "onclick"=>" if ( $('#Iblocks_is_resize').attr('checked')=='checked' ) "
                                           ."{ "                           
                                           ."  $('#pic_oreginal').show(); $('#pic_oreginal').removeClass('hidden'); "
                                           ."  $('#pic_scr').hide(); $('#pic_anons').hide(); $('#pic_detile').hide();"                               
                                           ."}else{"
                                           ."  $('#pic_oreginal').hide(); "
                                           ."  $('#pic_scr').show(); $('#pic_scr').removeClass('hidden'); $('#pic_anons').show(); $('#pic_anons').removeClass('hidden'); $('#pic_detile').show();$('#pic_detile').removeClass('hidden');"                                                      
                                           ."}");
                      if ( $model->is_resize===null ) $htmlOpt = array_merge($htmlOpt,array("checked"=> "checked"));
                ?>
                <?php echo $form->checkBox($model,'is_resize', $htmlOpt); ?>                
		<?php// echo $form->textField($model,'is_resize'); ?>
		<?php echo $form->error($model,'is_resize'); ?>
            </div>        
            <div id="pic_oreginal" class="row <?=( $model->is_resize || $model->is_resize===null ? '' : 'hidden' );?>">
		<?php echo $form->labelEx($model,'picOreginal'); ?>
                <?php echo $form->fileField($model,'picOreginal'); ?>   
                <?php echo CHtml::button('Очистить', array( 'onclick'=>"$('#pic_anons #ytIblocks_picOreginal').val('');$('#pic_oreginal #Iblocks_picOreginal').val('');" )); ?>
                <?php // echo CHtml::button('Удалить', array( 'onclick'=>"$('#pic_anons #ytIblocks_picOreginal').val('');$('#pic_oreginal #Iblocks_picOreginal').val('');$('#Iblocks_pic_anons_id').val('');" )); ?>            
                <?php if ( trim($model->pic_oreginal_id)<>"" ) : ?>                
                <?php //print_r($model->pic_oreginal_id); ?>             
                <?php $picOreginal = '/'.str_replace('_original'.substr($model->picOreginal->original_name,-4,4),
                                                '_small'.substr($model->picOreginal->original_name,-4,4),
                                                $model->picOreginal->original_name); 
                ?>
                <div id="iblock-pic-oreginal" class="iblock-pic">
                    <div class="pic">
                    <?php         
                      echo CHtml::link(CHtml::image( $picOreginal,'', 
                                                     array('title'=>$model->picOreginal->name,
                                                           'style'=>"padding-left:10px;vertical-align:middle")), 
                                                           '/'.$model->picOreginal->original_name, 
                                                           array('class'=>'fancyImage'));

                    ?>
                    </div>
                    <div class="del-pic" >
                    <?php
                      echo Chtml::link('x', 'javascript:void();', array("id"=>'del_pic_oreginal', "onclick"=>"$('#iblock-pic-oreginal').remove();$('#Iblocks_pic_oreginal_id').remove();"));
                      /*echo Chtml::ajaxLink('x', 
                                           '/bax.php/iblocks/ajaxdeletepicoreginal', 
                                           array(), // Свойства ajax
                                           array("id"=>'del_pic_oreginal'));*/
                    ?>
                    </div>
                </div>    
                <?php endif; ?>
                <?php// echo $form->checkbox($model,'del_pic_oreginal_id'); ?>
		<?php// echo $form->textField($model,'picOreginal'); ?>
		<?php echo $form->error($model,'picOreginal'); ?>
            </div>
            <div class="clear" ></div>
            <div id="pic_scr" class="row <?=( $model->is_resize || $model->is_resize===null ? 'hidden' : '');?>">
                        <?php echo $form->labelEx($model,'picScr'); ?>                
                        <?php echo $form->fileField($model,'picScr'); ?>                
                        <?php echo CHtml::button('Очистить', array( 'onclick'=>"$('#pic_scr #ytIblocks_picScr').val('');$('#pic_scr #Iblocks_picScr').val('');" )); ?>
                        <?php// echo CHtml::button('Удалить', array( 'onclick'=>"$('#pic_scr #ytIblocks_picScr').val('');$('#pic_scr #Iblocks_picScr').val('');$('#pic_scr_id').val('');" )); ?>
                        <?php if ( trim($model->pic_scr_id)<>"" ) : ?>
                        <?php $picScr = '/'.str_replace('_original'.substr($model->picScr->original_name,-4,4),
                                                        '_small'.substr($model->picScr->original_name,-4,4),
                                                        $model->picScr->original_name); 
                        ?>                           
                        <div id="iblock-pic-scr" class="iblock-pic">
                            <div class="pic">
                            <?php 
                              echo CHtml::link(CHtml::image( $picScr,'', 
                                                             array('title'=>$model->picScr->name,
                                                                   'style'=>"padding-left:10px;vertical-align:middle")), 
                                                                   '/'.$model->picScr->original_name, 
                                                                    array('class'=>'fancyImage'));
                            ?>                                   
                            </div>
                            <div class="del-pic" >
                        <?php
                              echo Chtml::link('x', 'javascript:void();', array("id"=>'del_pic_src', "onclick"=>"$('#iblock-pic-scr').remove();$('#Iblocks_pic_scr_id').remove();"));
                        ?>
                            </div>
                        </div>            
                        <?php endif; ?>
                        <?php echo $form->error($model,'picScr'); ?>
                </div>
                <div class="clear" ></div>            
        </div>                
        <? /* End Main of tabs   the infoblock */ $ib_main = ob_get_contents(); ob_end_clean(); ?>

        <? /* Begin Anons of tabs the infoblock */ ob_start(); ?>        
        <div class="tabs" >
            <div class="row">
                    <?php echo $form->labelEx($model,'anons'); ?>
                    <?php echo $form->textArea($model,'anons',array('style'=>'height: 74px;width: 400px;vertical-align:middle;margin:0;'/*,'maxlength'=>450*/)); ?>
                    <?php echo $form->error($model,'anons'); ?>
            </div>
            <div class="row">
                <?php/* echo $form->labelEx($model,'pic_anons_id'); ?>
                <?php echo $form->fileField($model,'pic_anons_id'); ?>
                <?php echo $form->error($model,'pic_anons_id'); */?>
                <div id="pic_anons" class="row <?=( $model->is_resize || $model->is_resize===null ? 'hidden' : '');?>">
                    <?php echo $form->labelEx($model,'picAnons'); ?>                
                    <?php echo $form->fileField($model,'picAnons'); ?>                
                    <?php echo CHtml::button('Очистить', array( 'onclick'=>"$('#pic_anons #ytIblocks_picAnons').val('');$('#pic_anons #Iblocks_picAnons').val('');" )); ?>
                    <?php// echo CHtml::button('Удалить', array( 'onclick'=>"$('#pic_anons #ytIblocks_picAnons').val('');$('#pic_anons #Iblocks_picAnons').val('');$('#pic_anons_id').val('');" )); ?>
                    <?php if ( trim($model->pic_anons_id)<>"" ) : ?>
                    <?php $picAnons = '/'.str_replace('_original'.substr($model->picAnons->original_name,-4,4),
                                                    '_small'.substr($model->picAnons->original_name,-4,4),
                                                    $model->picAnons->original_name); 
                    ?>                           
                    <div id="iblock-pic-anons" class="iblock-pic">
                        <div class="pic">
                        <?php 
                          echo CHtml::link(CHtml::image( $picAnons,'', 
                                                         array('title'=>$model->picAnons->name,
                                                               'style'=>"padding-left:10px;vertical-align:middle")), 
                                                               '/'.$model->picAnons->original_name, 
                                                                array('class'=>'fancyImage'));
                        ?>                                   
                        </div>
                        <div class="del-pic" >
                    <?php
                          echo Chtml::link('x', 'javascript:void();', array("id"=>'del_pic_anons', "onclick"=>"$('#iblock-pic-anons').remove();$('#Iblock_pic_anons_id').remove();"));
                    ?>
                        </div>
                    </div>            
                    <?php endif; ?>
                    <?php echo $form->error($model,'picAnons'); ?>
                </div>
                <div class="clear" ></div>
            </div>
        </div>
        <? /* End Anons of tabs   the infoblock */ $ib_anons = ob_get_contents(); ob_end_clean(); ?>
        
        <? /* Begin Detile of tabs the infoblock */ ob_start(); ?>    
        <div class="tabs" >
            <?/*<div class="row">
                    <?php echo $form->labelEx($model,'pic_detile_id'); ?>
                    <?php echo $form->textArea($model,'pic_detile_id',array('rows'=>6, 'cols'=>50)); ?>
                    <?php echo $form->error($model,'pic_detile_id'); ?>
            </div>*/?>
            <?/*<div class="row">
                    <?php echo $form->labelEx($model,'detile'); ?>
                    <?php echo $form->textArea($model,'detile',array('rows'=>6, 'cols'=>50)); ?>
                    <?php echo $form->error($model,'detile'); ?>
            </div>*/?>
            <div class="row editor detile" style="padding-top:10px;">		
                <center class="plashka" ><?php echo $form->labelEx($model,'detile'); ?></center>  
                <div>
                <?php $this->widget('application.extensions.eckeditor.ECKEditor', array(
                        'model'=>$model,
                        'attribute'=>'detile',
                        'config' => array(
                            'language'=> $langs[Yii::app()->language],
                            'uiColor' => '#ebebeb',//#ededed',// '#AADC6E',
                            'toolbar'=>array(
                                array('Source','DocProps','-','NewPage','Preview','-','Templates'),
                                array('Cut','Copy','Paste','PasteText','PasteWord','-','Print','SpellCheck'),
                                array('Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'),
                                array('FitWindow','ShowBlocks','-','About'),
                                array('Image','Flash','Table','Rule','Smiley','SpecialChar','PageBreak'),
                                '/',
                                array('Bold','Italic','Underline','StrikeThrough','-','Subscript','Superscript'),
                                array('OrderedList','UnorderedList','-','Outdent','Indent','Blockquote','CreateDiv'),
                                array('JustifyLeft','JustifyCenter','JustifyRight','JustifyFull'),
                                array('Link','Unlink','Anchor'),
                                array('TextColor','BGColor'),
                                array('Style','FontFormat','FontName','FontSize'),
                                
                            ),                            
                            /*'toolbar'=>array(
                                array( 'Source', '-', 'Bold', 'Italic', 'Underline', 'Strike' ),
                                array( 'Image', 'Link', 'Unlink', 'Anchor' ) ,
                            ),*/
                        ),
                     )); ?>
		<?php// echo $form->textArea($model,'detile',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'detile'); ?>
                </div>    
            </div>            
            <div id="pic_detile" class="row <?=( $model->is_resize || $model->is_resize===null ? 'hidden' : '');?>">
                    <?php echo $form->labelEx($model,'picDetile'); ?>
                    <?php echo $form->fileField($model,'picDetile'); ?>
                    <?php echo CHtml::button('Очистить', array( 'onclick'=>"$('#pic_detile #ytIblocks_picDetile').val('');$('#pic_detile #Iblocks_picDetile').val('');" )); ?>
                    <?php// echo CHtml::button('Удалить', array( 'onclick'=>"$('#pic_detile #ytIblocks_picDetile').val('');$('#pic_detile #Iblocks_picDetile').val('');$('#pic_detile_id').val('');" )); ?>            
                    <?php $picDetile = '/'.str_replace('_original'.substr($model->picDetile->original_name,-4,4),
                                                    '_small'.substr($model->picDetile->original_name,-4,4),
                                                    $model->picDetile->original_name); 
                    ?>
                    <?php if ( trim($model->pic_detile_id)<>"" ) : ?>
                    <div id="iblock-pic-detile" class="iblock-pic">
                        <div class="pic">
                        <?php 
                            echo CHtml::link(CHtml::image( $picDetile, '', 
                                             array('title'=>$model->picDetile->name,
                                                   'style'=>"padding-left:10px;vertical-align:middle")), 
                                                   '/'.$model->picDetile->original_name, 
                                                   array('class'=>'fancyImage'));
                        ?>                                             
                        </div>
                        <div class="del-pic" >
                    <?php
                        echo Chtml::link('x', 'javascript:void();', array("id"=>'del_pic_detile', "onclick"=>"$('#iblock-pic-detile').remove();$('#Iblocks_pic_detile_id').remove();"));
                    ?>
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php echo $form->error($model,'picDetile'); ?>
                    <script>
                       $(document).ready(function() {
                       $(".fancyImage").fancybox(
                            {'overlayShow': true, 'hideOnContentClick': false});
                       }); 
                    </script>  
            </div>
            <div class="clear" ></div>                 
        </div>    
        <? /* End Detile of tabs   the infoblock */ $ib_detile = ob_get_contents(); ob_end_clean(); ?>
        
        <? /* Begin SEO of tabs the infoblock */ ob_start(); ?>        
        <div class="tabs" >
            <div class="row">
                    <?php echo $form->labelEx($model,'title'); ?>
                    <?php echo $form->textField($model,'title',array('style'=>'width:380px','size'=>60,'maxlength'=>255,
                          'onfocus'=>/*"var title=$('#Iblocks_title').val();
                                        if (title.length()===0) { ".*/CHtml::ajax( array(
                                                                'url'=>Yii::app()->createUrl('iblocks/genTitle'),
                                                                'type'=>'POST', 
                                                                'dataType'=>'json',    
                                                                'data'=>'js:$("#iblocks-form").serialize()',    
                                                                'beforeSend'=>'function(){   
                                                                    var title=$("#Iblocks_title").val();
                                                                    if (title.length>0) {
                                                                        return false;
                                                                    }                                                                        
                                                                     //$("#myDiv").addClass("loading");
                                                                }', 
                                                               'complete' => 'function(){                                                                       
                                                                     //$("#loadTitle").show();
                                                                     //$("#myDiv").removeClass("loading");
                                                                }',
                                                                //'update'=>'#loadCity',     
                                                                'success' => "js:function(data){                                                                     
                                                                    $('#Iblocks_title').val(data.content); 
                                                                 }"
                                                       )/*."} else { return false; }"*/
                                    ))); ?>
                    <?php echo $form->error($model,'title'); ?>
            </div>        
            <div class="row">
                    <?php echo $form->labelEx($model,'keywords'); ?>
                    <?php echo $form->textArea($model,'keywords',array('style'=>'width:380px','rows'=>6, 'cols'=>50,
                        'onfocus'=>/*"var title=$('#Iblocks_title').val();
                                        if (title.length()===0) { ".*/CHtml::ajax( array(
                                                                'url'=>Yii::app()->createUrl('iblocks/genKeywords'),
                                                                'type'=>'POST', 
                                                                'dataType'=>'json',    
                                                                'data'=>'js:$("#iblocks-form").serialize()',    
                                                                'beforeSend'=>'function(){   
                                                                    var desc=$("#Iblocks_keywords").val();
                                                                    if (desc.length>0) {
                                                                        return false;
                                                                    }                                                                        
                                                                     //$("#myDiv").addClass("loading");
                                                                }', 
                                                               'complete' => 'function(){                                                                       
                                                                     //$("#loadDesc").show();
                                                                     //$("#myDiv").removeClass("loading");
                                                                }',
                                                                //'update'=>'#loadCity',     
                                                                'success' => "js:function(data){                                                                     
                                                                    $('#Iblocks_keywords').val(data.content); 
                                                                 }"
                                                       )))); ?>
                    <?php echo $form->error($model,'keywords'); ?>
            </div>
            <div class="row">
                    <?php echo $form->labelEx($model,'description'); ?>
                    <?php echo $form->textArea($model,'description',array('style'=>'width:380px','rows'=>6, 'cols'=>50, 
                            'onfocus'=>/*"var title=$('#Iblocks_title').val();
                                        if (title.length()===0) { ".*/CHtml::ajax( array(
                                                                'url'=>Yii::app()->createUrl('iblocks/genDescription'),
                                                                'type'=>'POST', 
                                                                'dataType'=>'json',    
                                                                'data'=>'js:$("#iblocks-form").serialize()',    
                                                                'beforeSend'=>'function(){   
                                                                    var desc=$("#Iblocks_description").val();
                                                                    if (desc.length>0) {
                                                                        return false;
                                                                    }                                                                        
                                                                     //$("#myDiv").addClass("loading");
                                                                }', 
                                                               'complete' => 'function(){                                                                       
                                                                     //$("#loadDesc").show();
                                                                     //$("#myDiv").removeClass("loading");
                                                                }',
                                                                //'update'=>'#loadCity',     
                                                                'success' => "js:function(data){                                                                     
                                                                    $('#Iblocks_description').val(data.content); 
                                                                 }"
                                                       )/*."} else { return false; }"*/
                                    ))); ?>
                    <?php echo $form->error($model,'description'); ?>
            </div>
        </div>
        <? /* End SEO of tabs   the infoblock */ $ib_seo = ob_get_contents(); ob_end_clean(); ?>
                
        <? /* Begin App of tabs   the infoblock */ ob_start(); ?>        
        <div class="tabs" >
            <div class="row">
                    <?php echo $form->labelEx($model,'del'); ?>
                    <?php echo $form->checkBox($model,'del'); ?>
                    <?php echo $form->error($model,'del'); ?>
            </div>          
            <?/*<div class="row">
                    <?php echo $form->labelEx($model,'sid'); ?>
                    <?php echo $form->textField($model,'sid',array('style'=>'width:300px;','size'=>50,'maxlength'=>75)); ?>
                    <?php echo $form->error($model,'sid'); ?>
            </div>*/?>            
            <?/*<div class="row">
                    <?php echo $form->labelEx($model,'uid'); ?>
                    <?php echo $form->textField($model,'uid',array('style'=>'width:380px','size'=>60,'maxlength'=>75)); ?>
                    <?php echo $form->error($model,'uid'); ?>
            </div>*/?>
            <div class="row">
		<?php echo $form->labelEx($model,'action'); ?>
		<?php echo $form->textField($model,'action',array('style'=>'width:380px','size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'action'); ?>
            </div>            
            <div class="row">
                    <?php echo $form->labelEx($model,'url'); ?>
                    <?php echo $form->textField($model,'url',array('style'=>'width:380px','size'=>60,'maxlength'=>255)); ?>
                    <?php echo $form->error($model,'url'); ?>
            </div>
            <div class="row">
                    <?php echo $form->labelEx($model,'url_detile'); ?>
                    <?php echo $form->textField($model,'url_detile',array('style'=>'width:380px','size'=>60,'maxlength'=>255)); ?>
                    <?php echo $form->error($model,'url_detile'); ?>
            </div>        
            <div class="row">
                    <?php echo $form->labelEx($model,'url_list'); ?>
                    <?php echo $form->textField($model,'url_list',array('style'=>'width:380px','size'=>60,'maxlength'=>255)); ?>
                    <?php echo $form->error($model,'url_list'); ?>
            </div>            
            <?/*<div class="row">
                    <?php echo $form->labelEx($model,'is_main'); ?>
                    <?php echo $form->checkBox($model,'is_main'); ?>
                    <?php echo $form->error($model,'is_main'); ?>
            </div>
            <div class="row">
                    <?php echo $form->labelEx($model,'is_pay'); ?>
                    <?php echo $form->checkBox($model,'is_pay'); ?>
                    <?php echo $form->error($model,'is_pay'); ?>
            </div>
            <div class="row">
                    <?php echo $form->labelEx($model,'is_arhiv'); ?>
                    <?php echo $form->checkBox($model,'is_arhiv'); ?>
                    <?php echo $form->error($model,'is_arhiv'); ?>
            </div>
            <div class="row">
                    <?php echo $form->labelEx($model,'is_use'); ?>
                    <?php echo $form->checkBox($model,'is_use'); ?>
                    <?php echo $form->error($model,'is_use'); ?>
            </div>*/?>            
        </div>
        <? /* End App of tabs   the infoblock */  $ib_app = ob_get_contents(); ob_end_clean(); ?>        
        
        <? /* Begin Dop of tabs   the infoblock */ ob_start(); ?>        
        <div class="tabs" >
            <div class="row" >
		<?php echo $form->labelEx($model,'city'); ?>
		<?php// echo $form->textField($model,'city'); ?>                
                <?php echo $form->dropDownList($model,'city',                           
                           CHtml::listData( Cities::model()->findAll("",
                             array("order"=>"sort")), 'id', 'name'), array('prompt'=>Yii::t('all','Select')."...")); ?>                                                                                     
		<?php echo $form->error($model,'city'); ?>
            </div>
            <?/*<div class="row">
                    <?php echo $form->labelEx($model,'maps_id'); ?>
                    <?php echo $form->textField($model,'maps_id',array('size'=>60,'maxlength'=>75)); ?>
                    <?php echo $form->error($model,'maps_id'); ?>
            </div>*/?>
            <?/*<div class="row">
                    <?php echo $form->labelEx($model,'createusers'); ?>
                    <?php// echo $form->textField($model,'createusers'); ?>
                    <?php echo $form->dropDownList($model,'createusers',                           
                           CHtml::listData( Users::model()->findAll("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                             array("order"=>"sort")), 'id', 'username'), array('prompt'=>Yii::t('all','Select')."...")); ?>                                                                     
                    <?php echo $form->error($model,'createusers'); ?>
            </div>            
            <div class="row">
                    <?php// echo $form->labelEx($model,'createdate'); ?>
                    <?php echo $form->textField($model,'createdate'); ?>
                    <?php echo $form->error($model,'createdate'); ?>
           <?php echo $form->labelEx($model,'createdate'); ?>
            <?php $langs = array_flip(Yii::app()->params->languages); 
                  if ($model->createdate) 
                      $model->createdate = date('d.m.Y',  strtotime($model->createdate))
            ?>
            <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'language'=> $langs[Yii::app()->language],                                        
                    'model'=>$model,
                    'attribute'=>'createdate',   
                    'theme'=>'ui-lightness',
                    'options'=>array(
                        'showAnim'=>'fold',
                        'dateFormat'=>'dd.mm.yy',  
                        'defaultDate'=>date('d.m.Y'),                                                
                        'showButtonPanel'=>true,
                        'showOn'=> "button",
			'buttonImage'=> "/images/calendar.gif",
			'buttonImageOnly'=> true,
                        //set calendar z-index higher then UI Dialog z-index 
                        'beforeShow'=>"js:function() {
                            $('.ui-datepicker').css('font-size', '0.8em');
                            $('.ui-datepicker').css('z-index', parseInt($(this).parents('.ui-dialog').css('z-index'))+1);
                }",

                     ),   
                    'htmlOptions'=>array('size'=>8 ),
                )); ?>                
            </div>            
            <div class="row">
                    <?php echo $form->labelEx($model,'updateusers'); ?>
                    <?php// echo $form->textField($model,'updateusers'); ?>
                    <?php echo $form->dropDownList($model,'updateusers',                           
                           CHtml::listData( Users::model()->findAll("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                             array("order"=>"sort")), 'id', 'username'), array('prompt'=>Yii::t('all','Select')."...")); ?>                                                                     
                    <?php echo $form->error($model,'updateusers'); ?>                                                        
            </div>
            <div class="row">
                    <?php// echo $form->labelEx($model,'updatedate'); ?>
                    <?php// echo $form->textField($model,'updatedate'); ?>
                    <?php echo $form->labelEx($model,'updatedate'); ?>
                    <?php $langs = array_flip(Yii::app()->params->languages); 
                          if ($model->updatedate) 
                              $model->updatedate = date('d.m.Y',  strtotime($model->updatedate))
                    ?>
                    <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                            'language'=> $langs[Yii::app()->language],                                        
                            'model'=>$model,
                            'attribute'=>'updatedate',   
                            'theme'=>'ui-lightness',
                            'options'=>array(
                                'showAnim'=>'fold',
                                'dateFormat'=>'dd.mm.yy',  
                                'defaultDate'=>date('d.m.Y'),                                                
                                'showButtonPanel'=>true,
                                'showOn'=> "button",
                                'buttonImage'=> "/images/calendar.gif",
                                'buttonImageOnly'=> true,
                                //set calendar z-index higher then UI Dialog z-index 
                                'beforeShow'=>"js:function() {
                                    $('.ui-datepicker').css('font-size', '0.8em');
                                    $('.ui-datepicker').css('z-index', parseInt($(this).parents('.ui-dialog').css('z-index'))+1);
                        }",

                             ),   
                            'htmlOptions'=>array('size'=>8 ),
                        )); ?>                                 
                    <?php echo $form->error($model,'updatedate'); ?>
            </div> */?>           	
        </div>    
        <?/* End Dop of tabs   the infoblock */ $ib_dop = ob_get_contents(); ob_end_clean(); ?>
         
        <? 
          $this->widget('zii.widgets.jui.CJuiTabs', array(
            //'name'=>'tabpanel-iblock',  
            'tabs'=>array(
                 Yii::t('all','Основное')       =>array('content'=>$ib_main,   'id'=>'iblock-main'),
                 Yii::t('all','Анонс')          =>array('content'=>$ib_anons,  'id'=>'iblock-anons'),
                 Yii::t('all','Детально')       =>array('content'=>$ib_detile, 'id'=>'iblock-detile'),
                 Yii::t('all','SEO')            =>array('content'=>$ib_seo,    'id'=>'iblock-seo'),
                 Yii::t('all','Управление')     =>array('content'=>$ib_app,    'id'=>'iblock-app'),
                 Yii::t('all','Дополнительно')  =>array('content'=>$ib_dop,    'id'=>'iblock-dop'),
                
                 // panel 3 contains the content rendered by a partial view
                 //'AjaxTab'=>array('ajax'=>$ajaxUrl),
            ),
            // additional javascript options for the tabs plugin
            'options'=>array(
                'collapsible'=>true,
                'selected'=>0,
            ),
          ));
        ?>
        
	<div class="row buttons">
            <?php echo $form->hiddenField($model,'pic_detile_id'); ?>
            <?php echo $form->hiddenField($model,'pic_anons_id'); ?>
            <?php echo $form->hiddenField($model,'pic_oreginal_id'); ?>
            <?php echo $form->hiddenField($model,'pic_scr_id'); ?>  
            <?php echo $form->hiddenField($model,'uid');?>
            <?php echo $form->hiddenField($model,'nid');?>            
            <?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('form','Create') : Yii::t('form','Save')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
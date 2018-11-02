<?php  // Подключаем скрипт посчета поля textarea
    Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/cnttextarea.css');      
    Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/cnttextarea.js');  
    Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/charCount.js');
    Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/js/kwcount/kwcount.css');
    Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/kwcount/kwcount.js');   
?>

<div class="wide form l150">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'metros-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note"><?=Yii::t('form','Fields marked <span color="red">*</span> are required for entry.');?></p>

	<?php echo $form->errorSummary($model); ?>
        
	<?/*<div class="row">
		<?php echo $form->labelEx($model,'id'); ?>
		<?php echo $form->textField($model,'id',array('size'=>10,'maxlength'=>11)); ?>
		<?php echo $form->error($model,'uid'); ?>
	</div>*/?>
        
	<?/*<div class="row">
		<?php echo $form->labelEx($model,'sid'); ?>
		<?php echo $form->textField($model,'sid',array('size'=>20,'maxlength'=>75)); ?>
		<?php echo $form->error($model,'sid'); ?>
	</div>*/?>

	<?/*<div class="row">
		<?php echo $form->labelEx($model,'uid'); ?>
		<?php echo $form->textField($model,'uid',array('size'=>20,'maxlength'=>75)); ?>
		<?php echo $form->error($model,'uid'); ?>
	</div>*/?>                               
        
	<?/*<div class="row">
		<?php echo $form->labelEx($model,'city_id'); ?>
		<?php echo $form->textField($model,'city_id'); ?>
		<?php echo $form->error($model,'city_id'); ?>
	</div>*/?>
        <?php echo $form->hiddenField($model,'city_id',array('value'=>($model->isNewRecord ? 2 : $model->city_id))); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'map_latitude'); ?>
		<?php echo $form->textField($model,'map_latitude',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'map_latitude'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'map_longitude'); ?>
		<?php echo $form->textField($model,'map_longitude',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'map_longitude'); ?>
	</div>

	<?/*<div class="row">
		<?php echo $form->labelEx($model,'street'); ?>
		<?php echo $form->textField($model,'street',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'street'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'house'); ?>
		<?php echo $form->textField($model,'house',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'house'); ?>
	</div>*/?>

       <div class="row <?/*editor anons*/?>">
		<?php echo $form->labelEx($model,'anons'); ?>
		<?php echo $form->textArea($model,'anons',array('rows'=>6, 'cols'=>65,'style'=>"width:540px;", 'OnKeyUp'=>'createStat(this, 200, 450);', 'OnChange'=>'createStat(this, 200, 450);')); ?>		
                <?php/* $this->widget('application.extensions.eckeditor.ECKEditor', array(
                        'model'=>$model,
                        'attribute'=>'anons',
                        'config' => array(
                        'toolbar'=>array(
                            array( 'Source', '-', 'Bold', 'Italic', 'Underline', 'Strike' ),
                            array( 'Image', 'Link', 'Unlink', 'Anchor' ) ,
                        ),
                      ),                    
                     )); */?>
                <?php echo $form->error($model,'anons'); ?>
                <script>
                    createTextAreaWidget('Metros_anons', 200, 450);
                </script>
	</div>

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

        <div class="row editor desc" style="padding-top:10px;" >
		<center class="plashka" ><?php echo $form->labelEx($model,'description'); ?></center>  
                <div>
                <?php $this->widget('application.extensions.eckeditor.ECKEditor', array(
                        'model'=>$model,
                        'attribute'=>'description',   
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
                        ),    
                     )); ?>            
		<?php// echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'description'); ?>
                </div>    
	</div>
	<div class="row">
            <div>
		<?php// echo $form->labelEx($model,'seo_title',array('label'=>'SEO заголовок')); ?>
                <?php $optTitle=CHtml::ajaxLink('',Yii::app()->createUrl('metros/genTitle'), array(
                                                                'type'=>'POST', 
                                                                'dataType'=>'json',    
                                                                'data'=>'js:$("#metros-form").serialize()',    
                                                                'beforeSend'=>'function(){                                                            
                                                                     //$("#myDiv").addClass("loading");
                                                                }', 
                                                               'complete' => 'function(){
                                                                     //$("#loadTitle").show();
                                                                     //$("#myDiv").removeClass("loading");
                                                                }',
                                                                //'update'=>'#loadCity',     
                                                                'success' => "js:function(data){                                                                     
                                                                    $('#Metros_seo_title').val(data.content); 
                                                                    createTextAreaWidget('Metros_seo_title', 175, 250, false)
                                                                 }"
                                                       ),
                                                       array('class'=>'genTitle', 'title'=>'Авто генерация seo-заголовка', 'rel'=>'nofollow')); ?>                
                <?php echo MyCHtml::activeLabelEx($model,'seo_title',array('label'=>'SEO заголовок', 'optional'=>$optTitle)); ?>
		<?php echo $form->textField($model,'seo_title',
                                array('size'=>87,'maxlength'=>255, 'style'=>'width:540px;',
                                      'onfocus'=>/*"var seo_title=$('#Realestates_seo_title').val();
                                        if (seo_title.length()===0) { ".*/CHtml::ajax( array(
                                                                'url'=>Yii::app()->createUrl('metros/genTitle'),
                                                                'type'=>'POST', 
                                                                'dataType'=>'json',    
                                                                'data'=>'js:$("#metros-form").serialize()',    
                                                                'beforeSend'=>'function(){   
                                                                    var seo_title=$("#Metros_seo_title").val();
                                                                    if (seo_title.length>0) {
                                                                        return false;
                                                                    }                                                                        
                                                                     //$("#myDiv").addClass("loading");
                                                                }', 
                                                               'complete' => 'function(){                                                                       
                                                                     //$("#loadTitle").show();
                                                                     //$("#myDiv").removeClass("loading");
                                                                }',
                                                                //'update'=>'#loadTitle',     
                                                                'success' => "js:function(data){                                                                     
                                                                    $('#Metros_seo_title').val(data.content); 
                                                                 }"
                                                       )/*."} else { return false; }"*/
                                    ))); ?>
		<?php echo $form->error($model,'seo_title'); ?>      
                <script>
                    $("#Metros_seo_title").charCount({
                        allowed: 80,
                        warning: 75,
                        counterText: 'Количество символов: '
                    });
                </script>    
             </div>   
	</div>    
        <? if ( Yii::app()->user->checkAccess('superadmin') || Yii::app()->user->name == 'adminone' || Yii::app()->user->name == '7777998@mail.ru' ) { ?> 
        <div class="row">
                 <?php $optDesc=CHtml::ajaxLink('',Yii::app()->createUrl('metros/genDescription'), array(
                                                                'type'=>'POST', 
                                                                'dataType'=>'json',    
                                                                'data'=>'js:$("#metros-form").serialize()',    
                                                                'beforeSend'=>'function(){                                                            
                                                                     //$("#myDiv").addClass("loading");
                                                                }', 
                                                               'complete' => 'function(){
                                                                     //$("#loadDescription").show();
                                                                     //$("#myDiv").removeClass("loading");
                                                                }',
                                                                //'update'=>'#loadCity',     
                                                                'success' => "js:function(data){                                                                     
                                                                    $('#Metros_seo_desc').val(data.content); 
                                                                    createTextAreaWidget('Metros_seo_desc', 175, 250, false)
                                                                 }"
                                                       ),
                                                       array('class'=>'genDescription', 'title'=>'Авто генерация seo-описания', 'rel'=>'nofollow')); ?>

		<?php echo MyCHtml::activeLabelEx($model,'seo_desc',array('label'=>'SEO описание', 'optional'=>$optDesc)); ?>
		<?php echo $form->textArea($model,'seo_desc',
                                           array('rows'=>6, 'cols'=>65, /*'maxlength'=>450,*/ 'OnKeyUp'=>'createStat(this, 175, 250, false);', 'OnChange'=>'createStat(this, 175, 250, false);', 'style'=>"width:540px;", 
                                                 'onfocus'=>/*"var seo_title=$('#Realestates_seo_desc').val();
                                                 if (seo_desc.length()===0) { ".*/CHtml::ajax( array(
                                                                'url'=>Yii::app()->createUrl('metros/genDescription'),
                                                                'type'=>'POST', 
                                                                'dataType'=>'json',    
                                                                'data'=>'js:$("#metros-form").serialize()',    
                                                                'beforeSend'=>'function(){   
                                                                    var seo_desc=$("#Metros_seo_desc").val();
                                                                    if (seo_desc.length>0) {
                                                                        return false;
                                                                    }                                                                        
                                                                     //$("#myDiv").addClass("loading");
                                                                }', 
                                                               'complete' => 'function(){                                                                       
                                                                     //$("#loadDescription").show();
                                                                     //$("#myDiv").removeClass("loading");
                                                                }',
                                                                //'update'=>'#loadTitle',     
                                                                'success' => "js:function(data){                                                                     
                                                                    $('#Metros_seo_desc').val(data.content); 
                                                                    createTextAreaWidget('Metros_seo_desc', 175, 250, false)
                                                                 }"
                                                       )/*."} else { return false; }"*/
                                    )
                                               )); ?>		
                <?php echo $form->error($model,'seo_desc'); ?>
            <script>            
                createTextAreaWidget('Metros_seo_desc', 200, 450, false);
                /*$('#Realestates_seo_desc').kwcount({ hide_delay: 2000,
                                                     show_max: true,
                                                     maxlength: 450, 
                                                     limit: true/*,
                                                     count_type: 'words'
                                                   });*/
            </script>
	</div>        
        <div class="row">
		<?php// echo $form->labelEx($model,'seo_keywords',array('label'=>'SEO ключевые слова')); ?>
                <?php $optKeywords = CHtml::ajaxLink('',Yii::app()->createUrl('metros/genKeywords'), array(
                                                                'type'=>'POST', 
                                                                'dataType'=>'json',    
                                                                'data'=>'js:$("#metros-form").serialize()',    
                                                                'beforeSend'=>'function(){                                                            
                                                                     //$("#myDiv").addClass("loading");
                                                                }', 
                                                               'complete' => 'function(){
                                                                     //$("#loadKeywords").show();
                                                                     //$("#myDiv").removeClass("loading");
                                                                }',
                                                                //'update'=>'#loadCity',     
                                                                'success' => "js:function(data){                                                                     
                                                                    $('#Metros_seo_keywords').val(data.content); 
                                                                    createTextAreaWidget('Metros_seo_keywords', 175, 300, false)
                                                                 }"
                                                       ),
                                                       array('class'=>'genKeywords', 'title'=>'Авто генерация seo-описания', 'rel'=>'nofollow')); ?>            
                <?php echo MyCHtml::activeLabelEx($model,'seo_keywords',array('label'=>'SEO ключ.слова', 'optional'=>$optKeywords)); ?>            
		<?php echo $form->textArea($model,'seo_keywords',
                           array('rows'=>6, 'cols'=>65, /*'maxlength'=>175,*/ 'OnKeyUp'=>'createStat(this, 175, 300, false);', 'OnChange'=>'createStat(this, 175, 300, false);', 'style'=>"width:540px;",
                                 'onfocus'=>/*"var title=$('#Iblocks_title').val();
                                        if (title.length()===0) { ".*/CHtml::ajax( array(
                                                                'url'=>Yii::app()->createUrl('metros/genKeywords'),
                                                                'type'=>'POST', 
                                                                'dataType'=>'json',    
                                                                'data'=>'js:$("#metros-form").serialize()',    
                                                                'beforeSend'=>'function(){   
                                                                    var seo_keywords=$("#Metros_seo_keywords").val();
                                                                    if (seo_keywords.length>0) {
                                                                        return false;
                                                                    }                                                                        
                                                                     //$("#myDiv").addClass("loading");
                                                                }', 
                                                               'complete' => 'function(){                                                                       
                                                                     //$("#loadKeywords").show();
                                                                     //$("#myDiv").removeClass("loading");
                                                                }',
                                                                //'update'=>'#loadCity',     
                                                                'success' => "js:function(data){                                                                     
                                                                    $('#Metros_seo_keywords').val(data.content); 
                                                                    createTextAreaWidget('Metros_seo_keywords', 175, 300, false);
                                                                 }"
                                                       )/*."} else { return false; }"*/
                                    ))); ?>		
                <?php echo $form->error($model,'seo_keywords'); ?>
            <script>
                createTextAreaWidget('Metros_seo_keywords', 175, 300, false);
                /*$('#Realestates_seo_keywords').kwcount({ hide_delay: 2000,
                                                     show_max: true,
                                                     maxlength: 250/*, 
                                                     limit: true,
                                                     count_type: 'words'
                                                   });*/
            </script>
	</div>          
        <?php } ?> 
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('form','Create') : Yii::t('form','Save')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
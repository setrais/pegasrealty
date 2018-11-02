<?php
/* @var $this SubscribeController */
/* @var $model Subscribe */
/* @var $form CActiveForm */
?>

<div class="wide form l130">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'subscribe-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note"><?=Yii::t('form','Fields marked <span color="red">*</span> are required for entry.');?></p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

        <div class="row">
		<?php echo $form->labelEx($model,'act'); ?>
		<?php echo $form->checkBox($model,'act', ( $model->act==null ? array("checked"=>"checked") : "" )); ?>
		<?php echo $form->error($model,'act'); ?>
	</div>
        
	<div class="row">
		<?php echo $form->label($model,'typesubs_id'); ?>
		<?php// echo $form->textField($model,'typesubs_id'); ?>     
                <?php $data = CHtml::listData(TypeSubscribe::model()->findAll(
                                array("condition"=>"(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)", "order"=>"sort")), 'id', 'title');?>
                <?php/* $data = CHtml::listData(TypeSubscribe::model()->findAll(
                                array("condition"=>"(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)", "order"=>"sort")), 'id', 'title');?>            
                <?php echo CHtml::activeDropDownList( $model,'typesubs_id', $data, array('prompt'=>Yii::t('application','Select Options').'...')); */?>    
                <?php $this->widget('ext.widgets.EchMultiSelect', array(
                          // the data model associated with this widget:
                          'model' => $model,
                          // the attribute associated with drop down list of this widget:
                          'dropDownAttribute' => 'typesubs_id',     
                          // data for generating the options of the drop down list:
                          'data' => $data,    
                          // the name of the drop down list (this must be set if 'model' and 'dropDownAttribute' are not set):
                          //'name' => 'Subscribe_typesubs_id',
                          // additional HTML attributes for the drop down list:                           
                          'dropDownHtmlOptions'=> array(
                            'style'=>'width:auto'/*'width:378px;'*/, 
                            'multiple'=>false, 
                            'onchange'=>'getAjaxSection();',
                            'prompt'=>Yii::t('application','Select Options').'...',
                          ),
                          // options for the jQuery UI MultiSelect Widget
                          // (see the project page for available options):
                          'options' => array( 
                            'selectedList'=>5,
                            'header'=>false,
                            // set this to true, if you want to use the Filter Plugin
                            'checkAllText' => Yii::t('EchMultiSelect.EchMultiSelect','Выбрать все'),
                            'uncheckAllText' => Yii::t('EchMultiSelect.EchMultiSelect','Отмена'),
                            'selectedText' =>Yii::t('EchMultiSelect.EchMultiSelect','# выбрано'),
                            'noneSelectedText'=>Yii::t('EchMultiSelectEchMultiSelect','Выбор типа рассылки...'),                                
                            // set this to true, if you want to use the Filter Plugin
                            'filter'=>false,
                            'height'=>100,                               
                            'multiple'=>false,     
                          ),
                          'filterOptions'=>array(
                            'label' => Yii::t('EchMultiSelect.EchMultiSelect','Фильтр:'),
                            'placeholder'=>Yii::t('EchMultiSelect.EchMultiSelect','Ввод слов'),
                          )
                          /*'foptions' => array(
                              'autoReset'=>false,
                          )*/
                )); ?> 
                <?php echo $form->error($model,'typesubs_id'); ?>
	</div>
        <script>
            function getAjaxSection() {
                var action = "/bax.php/ru/subscribe/getajaxsection/";
                var typesubs = $("#Subscribe_typesubs_id").val();                
                if (typesubs) {
                    $.ajax({    url: action,
                               data: { typesubs : typesubs },
                               type: "POST",
                            success: function(data) 
                                     {                                                 
                                        $('#Subscribe_fid').multiselect('clear');  
                                        $('#fid').html(data);            
                                        //$('#Subscribe_fid').multiselect('refresh');
                                        $('#fid').removeClass('hidden'); 
                                     },
                              error: function(XMLHttpRequest, textStatus, errorThrown) {
                                             alert(XMLHttpRequest.responseText);
                                     }
                            });
                }else{
                    $('#fid').addClass('hidden');
                    $('#Subscribe_fid').val(null);
                }            
            }
        </script>
        
	<div class="row <?=$model->fid ? '' : 'hidden';?>" id="fid" >
		<?php echo $form->label($model,'fid'); ?>
		<?php// echo $form->textField($model,'gid'); ?>
                <?php $data = CHtml::listData($model->getListSection(),'id', 'text', 'group');?>
                <?php $this->widget('ext.widgets.EchMultiSelect', array(
                              // the data model associated with this widget:
                              'model' => $model,
                              // the attribute associated with drop down list of this widget:
                              'dropDownAttribute' => 'fid',     
                              // data for generating the options of the drop down list:
                              'data' => $data,  
                              //'id'=> 'Subscribe_fid',
                              // the name of the drop down list (this must be set if 'model' and 'dropDownAttribute' are not set):
                              'name' => 'Subscribe[fid]',
                              // additional HTML attributes for the drop down list:                           
                              'dropDownHtmlOptions'=> array(
                                'style'=>'width:auto'/*'width:378px;'*/, 
                                'multiple'=>false,  
                                'prompt'=>Yii::t('application','Select Options').'...',
                              ),
                              // options for the jQuery UI MultiSelect Widget
                              // (see the project page for available options):
                              'options' => array( 
                                'selectedList'=>5,
                                'header'=>false,
                                // set this to true, if you want to use the Filter Plugin
                                'checkAllText' => Yii::t('EchMultiSelect.EchMultiSelect','Выбрать все'),
                                'uncheckAllText' => Yii::t('EchMultiSelect.EchMultiSelect','Отмена'),
                                'selectedText' =>Yii::t('EchMultiSelect.EchMultiSelect','# выбрано'),
                                'noneSelectedText'=>Yii::t('EchMultiSelectEchMultiSelect','Выбор фильтра...'),                                
                                // set this to true, if you want to use the Filter Plugin
                                'filter'=>false,
                                'height'=>80,                               
                                'multiple'=>false, 
                              ),
                              'filterOptions'=>array(
                                'label' => Yii::t('EchMultiSelect.EchMultiSelect','Фильтр:'),
                                'placeholder'=>Yii::t('EchMultiSelect.EchMultiSelect','Ввод слов'),
                              )                
                              /*'foptions' => array(
                                  'autoReset'=>false,
                              )*/
                    )); ?>       
                    <?php echo $form->error($model,'fid'); ?>            
	</div>
        
	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>
	<div class="row">
            <?php echo $form->label($model,'lastsubs_id',array('label'=>'Последний элемент')); ?>
            <?php echo $form->textField($model,'lastsubs_id',array('style'=>'width:80px;','maxlength'=>11)); ?>            
            <?php echo $form->error($model,'lastsubs_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'lastsubs_date'); ?>
                <?php// echo $form->label($model,'lastsubs_date'); ?>
                <?php// echo $form->textField($model,'lastsubs_date'); ?>
                <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'language'=> Yii::app()->params->language,                                        
                    //'name'=>'lastsubs_date',
                    'model'=>$model,
                    'attribute'=>'lastsubs_date',   
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
                    'htmlOptions'=>array('size'=>9 ),
                )); ?>                
		<?php echo $form->error($model,'lastsubs_date'); ?>
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($model,'del'); ?>
		<?php echo $form->checkBox($model,'del', ( $model->act==null ? "" :  array("checked"=>"checked"))); ?>
		<?php echo $form->error($model,'del'); ?>
	</div>
        
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('form','Create') : Yii::t('form','Save')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
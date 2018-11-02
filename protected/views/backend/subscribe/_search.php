<?php
/* @var $this SubscribeController */
/* @var $model Subscribe */
/* @var $form CActiveForm */
?>

<div class="wide form l150">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id',array(/*'size'=>60*/'style'=>'width:80px;','maxlength'=>11)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'email'); ?>
		<?php echo $form->textField($model,'email',array(/*'size'=>60*/'style'=>'width:226px;','maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'typesubs_id'); ?>
		<?php// echo $form->textField($model,'typesubs_id'); ?>     
                <?php $data = CHtml::listData(TypeSubscribe::model()->findAll(
                                array("condition"=>"(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)", "order"=>"sort")), 'id', 'title');?>
                <?php $this->widget('ext.widgets.EchMultiSelect', array(
                          // the data model associated with this widget:
                          'model' => $model,
                          // the attribute associated with drop down list of this widget:
                          'dropDownAttribute' => 'typesubs_id',     
                          // data for generating the options of the drop down list:
                          'data' => $data,    
                          // the name of the drop down list (this must be set if 'model' and 'dropDownAttribute' are not set):
                          'name' => 'Subscribe_typesubs_id',
                          // additional HTML attributes for the drop down list:                           
                          'dropDownHtmlOptions'=> array(
                            'style'=>'width:auto'/*'width:378px;'*/, 
                            'multiple'=>true, 
                            'onchange'=>'getAjaxSection();'  
                            /*'prompt'=>Yii::t('application','Select Options').'...',*/  
                          ),
                          // options for the jQuery UI MultiSelect Widget
                          // (see the project page for available options):
                          'options' => array( 
                            'selectedList'=>5,
                            'header'=>true,
                            // set this to true, if you want to use the Filter Plugin
                            'checkAllText' => Yii::t('EchMultiSelect.EchMultiSelect','Выбрать все'),
                            'uncheckAllText' => Yii::t('EchMultiSelect.EchMultiSelect','Отмена'),
                            'selectedText' =>Yii::t('EchMultiSelect.EchMultiSelect','# выбрано'),
                            'noneSelectedText'=>Yii::t('EchMultiSelectEchMultiSelect','Выбор типа рассылки...'),                                
                            // set this to true, if you want to use the Filter Plugin
                            'filter'=>false,
                            'height'=>100,                               
                            'multiple'=>true,     
                          ),
                          'filterOptions'=>array(
                            'label' => Yii::t('EchMultiSelect.EchMultiSelect','Фильтр:'),
                            'placeholder'=>Yii::t('EchMultiSelect.EchMultiSelect','Ввод слов'),
                          )
                          /*'foptions' => array(
                              'autoReset'=>false,
                          )*/
                )); ?>                                 
	</div>
        <script>
            function getAjaxSection() {
                var action = "/admin.php/subscribe/getajaxsection/";
                var typesubs = $("#Subscribe_typesubs_id").val();
                if (typesubs) {
                    $.ajax({    url: action,
                               data: { typesubs : typesubs },
                               type: "POST",
                            success: function(data) 
                                     {                                         
                                        $('#gid').html(data);                                                                                                           
                                        $('#gid').removeClass('hidden'); 
                                     },
                              error: function(XMLHttpRequest, textStatus, errorThrown) {
                                             alert(XMLHttpRequest.responseText);
                                     }
                            });
                }else{
                    $('#gid').addClass('hidden');
                    $('#Subscribe_gid').val(null);
                    $('#Subscribe_oid').val(null);
                }            
            }
        </script>

	<div class="row hidden" id="fid" >
		<?php echo $form->label($model,'fid'); ?>
		<?php// echo $form->textField($model,'fid'); ?>
                <?php $data = array(); //CHtml::listData(RealestateFilters::model()->findAll(array("order"=>"name")), 'id', 'name'); ?>
                <?php $this->widget('ext.widgets.EchMultiSelect', array(
                              // the data model associated with this widget:
                              //'model' => $model,
                              // the attribute associated with drop down list of this widget:
                              //'dropDownAttribute' => 'gid',     
                              // data for generating the options of the drop down list:
                              'data' => $data,  
                              'id'=> 'Subscribe_fid',
                              // the name of the drop down list (this must be set if 'model' and 'dropDownAttribute' are not set):
                              'name' => 'Subscribe[fid]',
                              // additional HTML attributes for the drop down list:                           
                              'dropDownHtmlOptions'=> array(
                                'style'=>'width:auto'/*'width:378px;'*/, 
                                'multiple'=>true,  
                                /*'prompt'=>Yii::t('application','Select Options').'...',*/  
                              ),
                              // options for the jQuery UI MultiSelect Widget
                              // (see the project page for available options):
                              'options' => array( 
                                'selectedList'=>5,
                                'header'=>true,
                                // set this to true, if you want to use the Filter Plugin
                                'checkAllText' => Yii::t('EchMultiSelect.EchMultiSelect','Выбрать все'),
                                'uncheckAllText' => Yii::t('EchMultiSelect.EchMultiSelect','Отмена'),
                                'selectedText' =>Yii::t('EchMultiSelect.EchMultiSelect','# выбрано'),
                                'noneSelectedText'=>Yii::t('EchMultiSelectEchMultiSelect','Выбор объекта...'),                                
                                // set this to true, if you want to use the Filter Plugin
                                'filter'=>false,
                                'height'=>80,                               
                                'multiple'=>true, 
                              ),
                              'filterOptions'=>array(
                                'label' => Yii::t('EchMultiSelect.EchMultiSelect','Фильтр:'),
                                'placeholder'=>Yii::t('EchMultiSelect.EchMultiSelect','Ввод слов'),
                              )                
                              /*'foptions' => array(
                                  'autoReset'=>false,
                              )*/
                    )); ?>                           
	</div>
	<div class="row">
            <?php echo $form->label($model,'lastsubs_id',array('label'=>'Последний элемент')); ?>
            <?php echo $form->textField($model,'lastsubs_id',array('style'=>'width:80px;','maxlength'=>11)); ?>            
	</div>
	<div class="row">         
		<?php// echo $form->label($model,'date'); ?>
		<?php// echo $form->textField($model,'date'); ?>
	</div>
	<div class="row">
            <?php// echo $form->label($model,'lastsubs_date'); ?>
            <?php// echo $form->textField($model,'lastsubs_date'); ?>
            <?php// echo date('Y-m-d',strtotime($model->lastsubs_date_from)); ?>
            <label for="lastsubs_date_from"><?=Yii::t('all','Дата рассылки с');?></label>		
            <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'language'=> Yii::app()->params->language,                                        
                    //'name'=>'lastsubs_date_from',
                    'model'=>$model,
                    'attribute'=>'lastsubs_date_from',   
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
            <?php// echo CHtml::textField('date_rang-from','',array('size'=>10,'maxlength'=>10));  ?>
            <b> <?=Yii::t('all','on');?> </b>
            <?php// echo CHtml::textField('date_rang-to','',array('size'=>10,'maxlength'=>10));  ?>
            <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'language'=> Yii::app()->params->language,                                        
                    //'name'=>'lastsubs_date_to',
                    'model'=>$model,
                    'attribute'=>'lastsubs_date_to',                 
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
		<?php echo $form->label($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'del'); ?>
                <?php echo $form->dropDownList($model,'del',  
                                     array(""=>"все","0"=>"нет","1"=>"да")); ?>            
		<?php// echo $form->textField($model,'del'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'act'); ?>
                <?php echo $form->dropDownList($model,'act',  
                                     array(""=>"все","0"=>"нет","1"=>"да")); ?>                        
		<?php// echo $form->textField($model,'act'); ?>
	</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton(Yii::t('form','Search')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
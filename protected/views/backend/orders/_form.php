<div class="wide form l150">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'orders-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note"><?=Yii::t('form','Fields marked <span color="red">*</span> are required for entry.');?></p>

	<?php echo $form->errorSummary($model); ?>

	<?/*<div class="row">
		<?php echo $form->labelEx($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
		<?php echo $form->error($model,'id'); ?>
	</div>*/?>
        <?/*
         <div class="row">
             <?php echo $form->labelEx($model,'createuser'); ?>
             <?php// echo $form->textField($model,'createusers'); ?>
             <?php echo $form->dropDownList($model,'createuser',                           
                           CHtml::listData( Users::model()->findAll("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                             array("order"=>"sort")), 'id', 'username'), array('prompt'=>Yii::t('all','Select')."...")); ?>                                                                     
             <?php echo $form->error($model,'createuser'); ?>
        </div>            
        <div class="row">             
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
            <?php// echo $form->textField($model,'createdate'); ?>
            <?php echo $form->error($model,'createdate'); ?>
	</div>

        <div class="row">
             <?php echo $form->labelEx($model,'updateuser'); ?>
             <?php// echo $form->textField($model,'createusers'); ?>
             <?php echo $form->dropDownList($model,'updateuser',                           
                           CHtml::listData( Users::model()->findAll("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                             array("order"=>"sort")), 'id', 'username'), array('prompt'=>Yii::t('all','Select')."...")); ?>                                                                     
             <?php echo $form->error($model,'updateuser'); ?>
        </div>            
        <div class="row">
             <?php echo $form->labelEx($model,'updatedate'); ?>
             <?php $langs = array_flip(Yii::app()->params->languages); 
                          if ($model->createdate) 
                              $model->createdate = date('d.m.Y',  strtotime($model->createdate))
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
            <?php// echo $form->textField($model,'createdate'); ?>
            <?php echo $form->error($model,'updatedate'); ?>
	</div>
        
        <div class="row">
             <?php echo $form->labelEx($model,'act'); ?>
             <?php echo $form->checkBox($model,'act'); ?>
             <?php echo $form->error($model,'act'); ?>
        </div>

        <div class="row">
             <?php echo $form->labelEx($model,'del'); ?>
             <?php echo $form->checkBox($model,'del'); ?>
             <?php echo $form->error($model,'del'); ?>
        </div>
        
	<div class="row">
		<?php echo $form->labelEx($model,'sort'); ?>
		<?php echo $form->textField($model,'sort'); ?>
		<?php echo $form->error($model,'sort'); ?>
	</div>*/?>
        <div class="row">
          <?php echo $form->labelEx($model,'realestate_type_id'); ?>
          <?php echo $form->dropDownList($model,'realestate_type_id',                           
                       CHtml::listData( RealestateTypes::model()->findAll("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                         array("order"=>"sort")), 'id', 'title'), array('prompt'=>Yii::t('all','Select')."...")); ?>             
            <?php// echo $form->textField($model,'realestate_type_id'); ?>
            <?php echo $form->error($model,'realestate_type_id'); ?>
	</div>

        <div class="row">
		<?php echo $form->labelEx($model,'realestate_vid_id'); ?>
                <?php echo $form->dropDownList($model,'realestate_vid_id',   
                              CHtml::listData(RealestateVids::model()->findAll("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                                array("order"=>"sort")), 'id', 'title'), array('prompt'=>Yii::t('all','Select')."..." )); ?>                                     
		<?php// echo $form->textField($model,'realestate_vid_id'); ?>
		<?php echo $form->error($model,'realestate_vid_id'); ?>
	</div>

        
	<div class="row" >
		<?php echo $form->labelEx($model,'realestate_class_id'); ?>
                <?php echo $form->dropDownList($model,'realestate_class_id',   
                              CHtml::listData(RealestateClasses::model()->findAll("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                                array("order"=>"sort")), 'id', 'abbr'), array('prompt'=>Yii::t('all','Select')."...")); ?>                                     
		<?php// echo $form->textField($model,'realestate_class_id'); ?>
		<?php echo $form->error($model,'realestate_class_id'); ?>
	</div>        
        
        <div class="row">
          <?php echo $form->labelEx($model,'operation_id'); ?>
          <?php echo $form->dropDownList($model,'operation_id',   
                       CHtml::listData(Operations::model()->findAll("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                         array("order"=>"sort")), 'id', 'title'), array('prompt'=>Yii::t('all','Select')."...")); ?>             
	  <?php// echo $form->textField($model,'realestate_type_id'); ?>
	  <?php echo $form->error($model,'operation_id'); ?>
	</div>

        <div class="row">
          <?php echo $form->labelEx($model,'district_id'); ?>
	  <?php// echo $form->textField($model,'district_id'); ?>
          <?php echo $form->dropDownList($model,'district_id',
                        CHtml::listData(Districts::model()->findAll("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                          array("order"=>"sort")), 'id', 'title'), array('prompt'=>Yii::t('all','Select')."...")); ?>
	  <?php echo $form->error($model,'district_id'); ?>
	</div>

	<div class="row">
	  <?php echo $form->labelEx($model,'remoteness'); ?>                                
	  <?php echo $form->textField($model,'remoteness',array('size'=>10,'maxlength'=>10,
                                                                'value'=>($model->remoteness===null ? $model->remoteness : round($model->remoteness )))); ?>
	  <?php echo $form->error($model,'remoteness'); ?>                
          <?php echo $form->dropDownList($model,'unit_id',
                         CHtml::listData(Units::model()->findAll("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                         array("order"=>"sort")), 'id', 'short_title'), array('prompt'=>Yii::t('all','Выберите ед.измерения'))); ?>    		
	  <?php echo $form->error($model,'unit_id'); ?>                
	</div>
        
	<div class="row">
            <?php echo $form->labelEx($model,'price_from'); ?>
            <?php echo $form->textField($model,'price_from',array('size'=>10,'maxlength'=>10)); ?>
            <?php echo $form->error($model,'price_from'); ?>
            <?php echo $form->labelEx($model,'price_to',array('class'=>'w-auto p-l8')); ?>
            <?php echo $form->textField($model,'price_to',array('size'=>10,'maxlength'=>10)); ?>
            <?php echo $form->error($model,'price_to'); ?>
            <?php echo $form->labelEx($model,'valute_id', array('class'=>'w-auto p-l8')); ?>
            <?php// echo $form->textField($model,'valute_id'); ?>
            <?php $data = CHtml::listData(Valutes::model()->findAll("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                         array("order"=>"sort")), 'id', 'abbr'); ?>
            <?php $this->widget('ext.widgets.EchMultiSelect', 
                        array( // the data model associated with this widget:
                               'theme'=>'cupertino',//'ui-lightness',
                               'model' => $model,
                               // the attribute associated with drop down list of this widget:
                               'dropDownAttribute' => 'valute_id',
                               // data for generating the options of the drop down list:
                               'data' => $data,
                               // the name of the drop down list (this must be set if 'model' and 'dropDownAttribute' are not set):
                               'name' => 'Realestates[valute_id]',
                               'value' => ( trim($model->valute_id)<>'' ? $model->valute_id : 2),
                                            // additional HTML attributes for the drop down list:
                                            'dropDownHtmlOptions'=> array(
                                            'style'=>'width:auto'/*'width:378px;'*/,
                                            'multiple'=>false,
                                            'prompt'=>'...',
                                            'name' => 'Realestates[valute_id]',
                               ),
                               // options for the jQuery UI MultiSelect Widget
                               // (see the project page for available options):
                               'options' => array(
                                   'selectedList'=>5,
                                   'header'=>false,
                                   // set this to true, if you want to use the Filter Plugin
                                   'filter'=>false,
                                   'height'=>106,
                                   //'noneSelectedText'=>'...',
                                   'minWidth'=>60,
                                   'multiple'=>false,
                                ),
                                /*'foptions' => array(
                                   'autoReset'=>false,
                                )*/
                )); ?>
                <?php echo $form->error($model,'valute_id'); ?>            
	</div>
        
	<div class="row">
		<?php echo $form->labelEx($model,'area_from'); ?>
		<?php echo $form->textField($model,'area_from',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'area_from'); ?>
		<?php echo $form->labelEx($model,'area_to',array('class'=>'w-auto p-l8')); ?>
		<?php echo $form->textField($model,'area_to',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'area_to'); ?>
            
	</div>
        
	<?/*<div class="row">
		<?php echo $form->labelEx($model,'unit_value'); ?>
		<?php echo $form->textField($model,'unit_value',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'unit_value'); ?>
	</div>*/?>

	<?/*<div class="row">
		<?php echo $form->labelEx($model,'poligon'); ?>
		<?php echo $form->textArea($model,'poligon',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'poligon'); ?>
	</div>*/?>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('form','Create') : Yii::t('form','Save')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
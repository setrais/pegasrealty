<div class="wide form l150">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

        <div class="row">
		<?php echo $form->label($model,'sid'); ?>
		<?php echo $form->textField($model,'sid',array('size'=>30,'maxlength'=>75)); ?>
	</div>
    
        <div class="row">
		<?php echo $form->label($model,'uid'); ?>
		<?php echo $form->textField($model,'uid',array('size'=>30,'maxlength'=>75)); ?>
	</div>    

	<div class="row">
		<?php echo $form->label($model,'abbr'); ?>
		<?php echo $form->textField($model,'abbr',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
	</div>
    
    	<div class="row">
		<?php echo $form->label($model,'act'); ?>
                <?php// echo $form->checkBox($model,'act',array('value'=>null)); ?>
                <?php echo $form->dropDownList($model,'act',  
                                     array(""=>"все","0"=>"нет","1"=>"да")); ?>
		<?php// echo $form->textField($model,'act'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'del'); ?>
                <?php// echo $form->checkBox($model,'del',array('value'=>null)); ?>
                <?php echo $form->dropDownList($model,'del',  
                                     array(""=>"все","0"=>"нет","1"=>"да")); ?>
		<?php// echo $form->textField($model,'del'); ?>
	</div>    

	<div class="row">
		<?php echo $form->label($model,'sort'); ?>
		<?php echo $form->textField($model,'sort'); ?>
	</div>

	<div class="row">
            <?php echo $form->label($model,'district_id'); ?>      
            <?php $data = CHtml::listData(Districts::model()->findAll("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                         array("order"=>"sort")), 'id', 'title'); ?>
            <?php $this->widget('ext.widgets.EchMultiSelect', array(
                          // the data model associated with this widget:
                          'model' => $model,
                          // the attribute associated with drop down list of this widget:
                          'dropDownAttribute' => 'district_id',     
                          // data for generating the options of the drop down list:
                          'data' => $data,    
                          // the name of the drop down list (this must be set if 'model' and 'dropDownAttribute' are not set):
                          'name' => 'Areas_district_id',
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
                            'filter'=>false,
                            'height'=>100,                               
                            'multiple'=>true, 
                          ),
                          /*'foptions' => array(
                              'autoReset'=>false,
                          )*/
                )); ?>             
                <?php/* echo $form->dropDownList($model,'district_id',                           
                           CHtml::listData(Districts::model()->findAll("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                           array("order"=>"sort")), 'id', 'title'), array('prompt'=>Yii::t('all','Select').'...')); */?>
		<?php// echo $form->textField($model,'district_id'); ?>                
	</div>    

    
	<div class="row">
		<?php echo $form->label($model,'desc',array('label'=>'Расшифровка аббривиатуры')); ?>
		<?php echo $form->textArea($model,'desc',array('rows'=>1, 'cols'=>50)); ?>
	</div>
    
	<div class="row">
		<?php echo $form->label($model,'anons'); ?>
		<?php echo $form->textArea($model,'anons',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'detile'); ?>
		<?php echo $form->textArea($model,'detile',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
	</div>
    
	<div class="row">
		<?php echo $form->label($model,'grid'); ?>
		<?php echo $form->textField($model,'grid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'weigth'); ?>
		<?php echo $form->textField($model,'weigth'); ?>
	</div>
    
	<div class="row buttons">
		<?php echo CHtml::submitButton(Yii::t('form','Search')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->

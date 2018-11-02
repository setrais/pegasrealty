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
    
    	<?php /*<div class="row">
		<?php echo $form->label($model,'create_date'); ?>
		<?php echo $form->textField($model,'create_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'update_date'); ?>
		<?php echo $form->textField($model,'update_date'); ?>
	</div>*/?>
    
	<div class="row buttons">
		<?php echo CHtml::submitButton(Yii::t('form','Search')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
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
		<?php echo $form->label($model,'code'); ?>
		<?php echo $form->textField($model,'code',array('size'=>17,'maxlength'=>17)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>40,'maxlength'=>40)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'SOCR'); ?>
		<?php echo $form->textField($model,'SOCR',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'index'); ?>
		<?php echo $form->textField($model,'index',array('size'=>6,'maxlength'=>6)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'GNINMB'); ?>
		<?php echo $form->textField($model,'GNINMB',array('size'=>4,'maxlength'=>4)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'UNO'); ?>
		<?php echo $form->textField($model,'UNO',array('size'=>4,'maxlength'=>4)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'OCATD'); ?>
		<?php echo $form->textField($model,'OCATD',array('size'=>11,'maxlength'=>11)); ?>
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
    
	<div class="row buttons">
		<?php echo CHtml::submitButton(Yii::t('form','Search')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
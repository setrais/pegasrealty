<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'order_id'); ?>
		<?php echo $form->textField($model,'order_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'createdate'); ?>
		<?php echo $form->textField($model,'createdate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'updatedate'); ?>
		<?php echo $form->textField($model,'updatedate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'createuser'); ?>
		<?php echo $form->textField($model,'createuser'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'updateuser'); ?>
		<?php echo $form->textField($model,'updateuser'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'act'); ?>
		<?php echo $form->textField($model,'act'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'del'); ?>
		<?php echo $form->textField($model,'del'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sort'); ?>
		<?php echo $form->textField($model,'sort'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'operation_id'); ?>
		<?php echo $form->textField($model,'operation_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'price_from'); ?>
		<?php echo $form->textField($model,'price_from',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'price_to'); ?>
		<?php echo $form->textField($model,'price_to',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'area_from'); ?>
		<?php echo $form->textField($model,'area_from'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'area_to'); ?>
		<?php echo $form->textField($model,'area_to'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'realestate_type_id'); ?>
		<?php echo $form->textField($model,'realestate_type_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'realestate_vid_id'); ?>
		<?php echo $form->textField($model,'realestate_vid_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'realestate_class_id'); ?>
		<?php echo $form->textField($model,'realestate_class_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'district_id'); ?>
		<?php echo $form->textField($model,'district_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'valute_id'); ?>
		<?php echo $form->textField($model,'valute_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'unit_id'); ?>
		<?php echo $form->textField($model,'unit_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'remoteness'); ?>
		<?php echo $form->textField($model,'remoteness',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'unit_value'); ?>
		<?php echo $form->textField($model,'unit_value',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'poligon'); ?>
		<?php echo $form->textArea($model,'poligon',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
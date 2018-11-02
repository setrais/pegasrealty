<?php
/* @var $this TypeSubscribeController */
/* @var $model TypeSubscribe */
/* @var $form CActiveForm */
?>

<div class="wide form l150">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<?/*<div class="row">
		<?php echo $form->label($model,'grid'); ?>
		<?php echo $form->textField($model,'grid'); ?>
	</div>*/?>

	<div class="row">
		<?php echo $form->label($model,'name', array('label'=>'Символьный Ид')); ?>
		<?php echo $form->textField($model,'name',array('width'=>120,/*'size'=>60,*/'maxlength'=>75)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>75)); ?>
	</div>

    	<div class="row">
		<?php echo $form->label($model,'act'); ?>
                <?php// echo $form->checkBox($model,'act',array('value'=>null)); ?>
                <?php echo $form->dropDownList($model,'act',  
                                     array(""=>"все","0"=>"нет","1"=>"да")); ?>
		<?php// echo $form->textField($model,'act'); ?>
	</div>
    
    	<div class="row">
		<?php echo $form->label($model,'sort'); ?>
		<?php echo $form->textField($model,'sort',array('width'=>80,/*'size'=>60,*/'maxlength'=>11)); ?>
	</div>
    
	<?/*<div class="row">
		<?php echo $form->label($model,'keywords'); ?>
		<?php echo $form->textArea($model,'keywords',array('rows'=>6, 'cols'=>50)); ?>
	</div>*/?>

	<?/*<div class="row">
		<?php echo $form->label($model,'icon'); ?>
		<?php echo $form->textField($model,'icon',array('size'=>60,'maxlength'=>255)); ?>
	</div>*/?>

	<div class="row">
		<?php echo $form->label($model,'del'); ?>
                <?php// echo $form->checkBox($model,'del',array('value'=>null)); ?>
                <?php echo $form->dropDownList($model,'del',  
                                     array(""=>"все","0"=>"нет","1"=>"да")); ?>
		<?php// echo $form->textField($model,'del'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'template'); ?>
		<?php echo $form->textArea($model,'template',array('rows'=>6, 'cols'=>50)); ?>
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
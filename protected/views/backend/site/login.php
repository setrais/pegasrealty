<?php
$this->pageTitle=Yii::app()->name . ' - ' . Yii::t('menu','Login');
$this->breadcrumbs=array(
	Yii::t('menu','Login'),
);
?>

<center>
    <h2>
<?php 
    echo 'Вход в <span  style="text-transform: uppercase;color:#069cd3;"  >"Недвижимость"</span>';
?>
    </h2>
</center>    

<p><?=Yii::t('all','Please fill out the following form with your login credentials:');?></p>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note"><?=Yii::t('form','*');?></p>

        <div>
            <div class="row fl m-r10i">
                <?php echo str_replace( 'Username', Yii::t('form','Username'), $form->labelEx($model,'username')); ?>
		<?php echo $form->textField($model,'username'); ?>
		<?php echo $form->error($model,'username'); ?>
            </div>
            <div class="row fr">
                <?php echo str_replace( 'Password', Yii::t('form','Password'), $form->labelEx($model,'password')); ?>            
		<?php echo $form->passwordField($model,'password'); ?>
		<?php echo $form->error($model,'password'); ?>
		<p class="hint">
			<? /*Hint: You may login with <tt>demo/demo</tt> or <tt>admin/admin</tt>.*/ ?>
		</p>
	   </div>
            <div class="clear"></div> 
        </div>

	<div class="row rememberMe">
		<?php echo $form->checkBox($model,'rememberMe'); ?>
                <?php echo str_replace( 'Remember me next time', Yii::t('form','Remember me next time'), $form->label($model,'rememberMe')); ?>
		<?php echo $form->error($model,'rememberMe'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton(Yii::t('form','Login')); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->

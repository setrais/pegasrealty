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
		<?php echo $form->label($model,'uid'); ?>
		<?php echo $form->textField($model,'uid',array('size'=>60,'maxlength'=>75)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>45,'maxlength'=>45)); ?>
	</div>
    
        <div class="row">
            <?php echo $form->labelEx($model,'usersRoles'); ?> 
            <?php $data = CHtml::listData(AuthItem::model()->findAll(), 'id', 'name'); ?> 
            <?php // Свойства недвижемости ?>
            <?php $this->widget('ext.widgets.EchMultiSelect', array(
                          // the data model associated with this widget:
                          'model' => $model,
                          // the attribute associated with drop down list of this widget:
                          'dropDownAttribute' => 'usersRoles',     
                          // data for generating the options of the drop down list:
                          'data' => $data,                            
                          // the name of the drop down list (this must be set if 'model' and 'dropDownAttribute' are not set):
                          'name' => 'Realestates_usersRoles',    
                          // additional HTML attributes for the drop down list: 
                          'dropDownHtmlOptions'=> array(
                            'style'=>'width:auto'/*'width:378px;'*/,
                            'multiple'=>true,
                            //'options'=>(isset($selProperties) ? $selProperties : array()),                              
                          ),
                          // options for the jQuery UI MultiSelect Widget
                          // (see the project page for available options):
                          'options' => array( 
                            'selectedList'=>5,
                            'header'=>false,
                            // set this to true, if you want to use the Filter Plugin
                            'filter'=>false,
                            'height'=>100,                               
                          ),
            )); ?>      
	</div>
    
	<div class="row">
		<?php echo $form->label($model,'sort'); ?>
		<?php echo $form->textField($model,'sort'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'del'); ?>
		<?php// echo $form->textField($model,'del'); ?>
                <?php echo $form->dropDownList($model,'del',  
                                     array(""=>"все","0"=>"нет","1"=>"да")); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'act'); ?>
		<?php// echo $form->textField($model,'act'); ?>
                <?php echo $form->dropDownList($model,'del',  
                                       array(""=>"все","0"=>"нет","1"=>"да")); ?>
	</div>
    
	<div class="row">
		<?php echo $form->label($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'send_email'); ?>
		<?php echo $form->textField($model,'send_email',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php// echo $form->label($model,'register_date'); ?>
		<?php// echo $form->textField($model,'register_date'); ?>
                <label for="register_date_from"><?=Yii::t('all','Дата создания от');?></label>		
                <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'language'=> Yii::app()->params->language,                                        
                    'name'=>'register_date_from',
                    //'model'=>$model,
                    //'attribute'=>'create_date',
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
            <?php// echo CHtml::textField('register_date_from','',array('size'=>10,'maxlength'=>10));  ?>
            <b> <?=Yii::t('all','on');?> </b>
            <?php// echo CHtml::textField('register_date_to','',array('size'=>10,'maxlength'=>10));  ?>
            <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'language'=> Yii::app()->params->language,                                        
                    'name'=>'register_date_to',
                    //'model'=>$model,
                    //'attribute'=>'register_date',
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
            <?php// echo $form->label($model,'lastvisit_date'); ?>
            <?php// echo $form->textField($model,'lastvisit_date'); ?>
            <label for="lastvisit_date_from"><?=Yii::t('all','Дата создания от');?></label>		
            <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'language'=> Yii::app()->params->language,                                        
                    'name'=>'lastvisit_date_from',
                    //'model'=>$model,
                    //'attribute'=>'lastvisit_date',
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
            <?php// echo CHtml::textField('lastvisit_date_from','',array('size'=>10,'maxlength'=>10));  ?>
            <b> <?=Yii::t('all','on');?> </b>
            <?php// echo CHtml::textField('lastvisit_date_to','',array('size'=>10,'maxlength'=>10));  ?>
            <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'language'=> Yii::app()->params->language,                                        
                    'name'=>'lastvisit_date_to',
                    //'model'=>$model,
                    //'attribute'=>'lastvisit_date',
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
		<?php echo $form->textField($model,'description',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
            <?php// echo $form->label($model,'create_date'); ?>
            <label for="create_date_from"><?=Yii::t('all','Дата создания от');?></label>		
            <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'language'=> Yii::app()->params->language,                                        
                    'name'=>'create_date_from',
                    //'model'=>$model,
                    //'attribute'=>'create_date',
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
            <?php// echo CHtml::textField('createdate-from','',array('size'=>10,'maxlength'=>10));  ?>
            <b> <?=Yii::t('all','on');?> </b>
            <?php// echo CHtml::textField('createdate-to','',array('size'=>10,'maxlength'=>10));  ?>
            <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'language'=> Yii::app()->params->language,                                        
                    'name'=>'create_date_to',
                    //'model'=>$model,
                    //'attribute'=>'date_rang',
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
            <?php// echo $form->label($model,'update_date'); ?>            
            <label for="update_date_from"><?=Yii::t('all','Дата создания от');?></label>		
            <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'language'=> Yii::app()->params->language,                                        
                    'name'=>'update_date_from',
                    //'model'=>$model,
                    //'attribute'=>'update_date',
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
            <?php// echo CHtml::textField('update_date_from','',array('size'=>10,'maxlength'=>10));  ?>
            <b> <?=Yii::t('all','on');?> </b>
            <?php// echo CHtml::textField('update_date_to','',array('size'=>10,'maxlength'=>10));  ?>
            <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'language'=> Yii::app()->params->language,                                        
                    'name'=>'update_date_to',
                    //'model'=>$model,
                    //'attribute'=>'update_date',
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
		<?php// echo $form->textField($model,'update_date'); ?>
	</div>

	<?/*<div class="row">
		<?php echo $form->label($model,'param_id'); ?>
		<?php echo $form->textField($model,'param_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'param_uid'); ?>
		<?php echo $form->textField($model,'param_uid',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'phpBBLogin'); ?>
		<?php echo $form->textField($model,'phpBBLogin',array('size'=>60,'maxlength'=>75)); ?>
	</div>*/?>

	<div class="row buttons">
		<?php echo CHtml::submitButton(Yii::t('form','Search')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
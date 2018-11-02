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
		<?php echo $form->label($model,'anons'); ?>
		<?php echo $form->textArea($model,'anons',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'infocode'); ?>
		<?php echo $form->textArea($model,'infocode',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ddog'); ?>
		<?php echo $form->textField($model,'ddog'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ndog'); ?>
		<?php echo $form->textField($model,'ndog',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'site'); ?>
		<?php echo $form->textField($model,'site',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'phone'); ?>
		<?php echo $form->textField($model,'phone',array('size'=>25,'maxlength'=>25)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'address'); ?>
		<?php echo $form->textField($model,'address',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'contact'); ?>
		<?php echo $form->textField($model,'contact',array('size'=>60,'maxlength'=>125)); ?>
	</div>

	<?/*<div class="row">
		<?php echo $form->label($model,'login'); ?>
		<?php echo $form->textField($model,'login',array('size'=>25,'maxlength'=>25)); ?>
	</div>*/?>

	<div class="row">
		<?php echo $form->label($model,'mypage'); ?>
		<?php echo $form->textField($model,'mypage',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
            <label for="date-from"><?=Yii::t('all','Date of create from');?></label>		
            <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'language'=> Yii::app()->params->language,                                        
                    'name'=>'create_date_from',
                    /*'model'=>$model,
                    'attribute'=>'create_date',*/   
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
            <b> <?=Yii::t('all','on');?> </b>
            <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'language'=> Yii::app()->params->language,                                        
                    'name'=>'create_date_to',
                    /*'model'=>$model,
                    'attribute'=>'date_rang',*/   
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
		<?php// echo $form->textField($model,'create_date'); ?>
	</div>

    	<div class="row">
		<?php echo $form->label($model,'create_user'); ?>         
                <?php $data = CHtml::listData(Users::model()->findAll("",
                                array("order"=>"sort")), 'id', 'username'); 
                      $this->widget('ext.widgets.EchMultiSelect', array(
                                    // the data model associated with this widget:
                                    'model' => $model,
                                    // the attribute associated with drop down list of this widget:
                                    'dropDownAttribute' => 'create_user',     
                                    // data for generating the options of the drop down list:
                                    'data' => $data,    
                                    // the name of the drop down list (this must be set if 'model' and 'dropDownAttribute' 
                                    // are not set):
                                    'name' => 'Clients_create_user',
                                    // additional HTML attributes for the drop down list:                           
                                    'dropDownHtmlOptions'=> array(
                                        'style'=>'width:auto',//'width:378px;', 
                                        'multiple'=>true,  
                                        //'prompt'=>Yii::t('application','Select Options').'...',
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
                                    //'foptions' => array(
                                    //'autoReset'=>false,
                                    //)
                        )); ?>   		                        
		<?php// echo $form->textField($model,'create_user'); ?>
	</div>
    
	<div class="row">
            <?php// echo $form->label($model,'update_date'); ?>
            <label for="date-from"><?=Yii::t('all','Date of update from');?></label>		
            <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'language'=> Yii::app()->params->language,                                        
                    'name'=>'update_date_from',
                    /*'model'=>$model,
                    'attribute'=>'update_date',*/   
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
            <b> <?=Yii::t('all','on');?> </b>
            <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'language'=> Yii::app()->params->language,                                        
                    'name'=>'update_date_to',
                    /*'model'=>$model,
                    'attribute'=>'date_rang',*/   
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

    	<div class="row">
		<?php echo $form->label($model,'update_user'); ?>         
                <?php $data = CHtml::listData(Users::model()->findAll("",
                                array("order"=>"sort")), 'id', 'username'); 
                      $this->widget('ext.widgets.EchMultiSelect', array(
                                    // the data model associated with this widget:
                                    'model' => $model,
                                    // the attribute associated with drop down list of this widget:
                                    'dropDownAttribute' => 'update_user',     
                                    // data for generating the options of the drop down list:
                                    'data' => $data,    
                                    // the name of the drop down list (this must be set if 'model' and 'dropDownAttribute' 
                                    // are not set):
                                    'name' => 'Clients_update_user',
                                    // additional HTML attributes for the drop down list:                           
                                    'dropDownHtmlOptions'=> array(
                                        'style'=>'width:auto',//'width:378px;', 
                                        'multiple'=>true,  
                                        //'prompt'=>Yii::t('application','Select Options').'...',
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
                                    //'foptions' => array(
                                    //'autoReset'=>false,
                                    //)
                        )); ?>   		                        
		<?php// echo $form->textField($model,'update_user'); ?>
	</div>
    
	<div class="row">
		<?php echo $form->label($model,'desc'); ?>
		<?php echo $form->textArea($model,'desc',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<?/*<div class="row">
		<?php echo $form->label($model,'logo_id'); ?>
		<?php echo $form->textField($model,'logo_id'); ?>
	</div>*/?>

	<div class="row">
		<?php echo $form->label($model,'client_type_id'); ?>
                <?php $data = CHtml::listData(ClientTypes::model()->findAll(), 'id', 'title'); ?>
                <?php $this->widget('ext.widgets.EchMultiSelect', array(
                              // the data model associated with this widget:
                              'model' => $model,
                              // the attribute associated with drop down list of this widget:
                              'dropDownAttribute' => 'client_type_id',     
                              // data for generating the options of the drop down list:
                              'data' => $data,    
                              // the name of the drop down list (this must be set if 'model' and 'dropDownAttribute' are not set):
                              'name' => 'Clients_client_type_id',
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
		<?php// echo $form->textField($model,'client_type_id'); ?>
	</div>

    	<div class="row">
		<?php echo $form->label($model,'client_id'); ?>
                <?php $data = CHtml::listData(Clients::model()->findAll(), 'id', 'email'); ?>
                <?php $this->widget('ext.widgets.EchMultiSelect', array(
                              // the data model associated with this widget:
                              'model' => $model,
                              // the attribute associated with drop down list of this widget:
                              'dropDownAttribute' => 'client_id',     
                              // data for generating the options of the drop down list:
                              'data' => $data,    
                              // the name of the drop down list (this must be set if 'model' and 'dropDownAttribute' are not set):
                              'name' => 'Clients_client_id',
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
		<?php// echo $form->textField($model,'client_id'); ?>
	</div>    

	<div class="row buttons">
		<?php echo CHtml::submitButton(Yii::t('form','Search')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
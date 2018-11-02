<div class="wide form l150">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'post',
        'id'=>'mainSearch',
        'htmlOptions'=>array('name'=>'mainSearch')
)); ?>

	<div class="row">
            <?php echo $form->label($model,'id'); ?>
            <?php echo $form->textField($model,'id'); ?>
	</div>
	<div class="row">
            <?php echo $form->label($model,'sid'); ?>
            <?php echo $form->textField($model,'sid',array('size'=>60,'maxlength'=>75)); ?>
	</div>    
	<div class="row">
            <?php echo $form->label($model,'nid'); ?>
            <?php echo $form->textField($model,'nid'); ?>
	</div>        
    	<div class="row">
            <?php echo $form->label($model,'space_type_id'); ?>            
            <?php $data = CHtml::listData(SpaceTypes::model()->findAll(), 'id', 'title'); ?>
            <?php $this->widget('ext.widgets.EchMultiSelect', array(
                          // the data model associated with this widget:
                          'model' => $model,
                          // the attribute associated with drop down list of this widget:
                          'dropDownAttribute' => 'space_type_id',     
                          // data for generating the options of the drop down list:
                          'data' => $data,    
                          // the name of the drop down list (this must be set if 'model' and 'dropDownAttribute' are not set):
                          'name' => 'Spaces_space_type_id',
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

            <?php /*echo $form->dropDownList($model,'space_type_id',                             
                                CHtml::listData( SpaceTypes::model()->findAll("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                            array("order"=>"sort")), 'id', 'title'), array('prompt'=>Yii::t('all','Select').'...'));*/?>                         
            <?php// echo $form->textField($model,'space_type_id'); ?>
	</div>
        <div class="row">
            <?php echo $form->labelEx($model,'operation_id'); ?>
            <?php $data = CHtml::listData(Operations::model()->findAll("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                         array("order"=>"sort")), 'id', 'title'); ?>
            <?php $this->widget('ext.widgets.EchMultiSelect', array(
                          // the data model associated with this widget:
                          'model' => $model,
                          // the attribute associated with drop down list of this widget:
                          'dropDownAttribute' => 'operation_id',     
                          // data for generating the options of the drop down list:
                          'data' => $data,    
                          // the name of the drop down list (this must be set if 'model' and 'dropDownAttribute' are not set):
                          'name' => 'Spaces_operation_id',
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
            <?php/* echo $form->dropDownList($model,'operation_id',                           
                            CHtml::listData(Operations::model()->findAll("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                         array("order"=>"sort")), 'id', 'title'), array('prompt'=>Yii::t('all','Select').'...')); */?>   
            <?php// echo $form->textField($model,'operation_id'); ?>
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
                          'name' => 'Spaces_district_id',
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
    
	<?/*<div class="row">
            <?php echo $form->label($model,'metro_id'); ?>
            <?php $data = CHtml::listData(Metros::model()->findAll(), 'id', 'title'); ?>
            <?php $this->widget('ext.widgets.EchMultiSelect', array(
                          // the data model associated with this widget:
                          'model' => $model,
                          // the attribute associated with drop down list of this widget:
                          'dropDownAttribute' => 'metro_id',     
                          // data for generating the options of the drop down list:
                          'data' => $data,    
                          // the name of the drop down list (this must be set if 'model' and 'dropDownAttribute' are not set):
                          'name' => 'Spaces_metro_id',
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
                            'filter'=>true,
                            'height'=>100,                               
                            'multiple'=>true, 
                          ),
                          //'foptions' => array(
                          //   'autoReset'=>false,
                          //)
                )); ?>   
                <?php echo CHtml::label(Yii::t('all','many'),'Manies_id',array('class'=>'many')); ?>
                <?php $data = CHtml::listData(Manies::model()->findAll(), 'id', 'title'); ?>
                <?php $this->widget('ext.widgets.EchMultiSelect', array(
                          // the data model associated with this widget:
                          'model' => Manies::model(),
                          // the attribute associated with drop down list of this widget:
                          'dropDownAttribute' => 'id',
                          // data for generating the options of the drop down list:
                          'data' => $data,    
                          // the name of the drop down list (this must be set if 'model' and 'dropDownAttribute' are not set):
                          //'name' => 'Many_metros',
                          // additional HTML attributes for the drop down list:                           
                          'dropDownHtmlOptions'=> array(
                            'style'=>'width:auto',//'width:378px;', 
                            'multiple'=>true,  
                            //'prompt'=>Yii::t('application','Select Options').'...',
                            'onchange'=>'getAjaxMetroManies();',  
                          ),
                          // options for the jQuery UI MultiSelect Widget
                          // (see the project page for available options):
                          'options' => array( 
                            'selectedList'=>5,
                            'header'=>false,
                            // set this to true, if you want to use the Filter Plugin
                            'filter'=>false,
                            'height'=>100,                               
                            'multiple'=>true, 
                          ),
                          //'foptions' => array(
                          //   'autoReset'=>false,
                          //)
                )); ?>                         
            <?php// echo $form->textField($model,'metro_id'); ?>
	</div>
        <script>
            function getAjaxMetroManies() {
                var action = "/bax.php/metroManies/getajaxmetromanies/";
                var manies_id = $("#Manies_id").val();
                $.ajax({    url: action,
                           data: { manies_id : manies_id },
                           type: "POST",
                        success: function(data) 
                                 {
                                    var res = jQuery.parseJSON(data);
                                                                                                           
                                    if (res["result"] == true ) {                                                                              
                                        $("#Spaces_metro_id").multiselect("uncheckAll"); 
                                        $("#Spaces_metro_id option").each(
                                          function()
                                          {
                                             var metros = res["metros"];
                                             var value = $(this).val();
                                             if ( metros.indexOf(parseInt(value))>=0 ) 
                                             {
                                               $(this).attr("selected","selected");
                                             }
                                          }
                                        );
                                      $("#Spaces_metro_id").multiselect("refresh"); 
                                    }
                                 },
                          error: function(XMLHttpRequest, textStatus, errorThrown) {
                                         alert(XMLHttpRequest.responseText);
                                 }
                        });
            }
        </script>*/?>    
	<div class="row">
                <label for="price-from"><?=Yii::t('all','From ungr');?></label>
		<?php// echo $form->label($model,'price')?>                 
                <?php echo CHtml::textField('remoteness-from','',array('size'=>10,'maxlength'=>10));  ?>
                <b> <?=Yii::t('all','to');?> </b>
                <?php echo CHtml::textField('remoteness-to','',array('size'=>10,'maxlength'=>10));  ?>                
                <?php echo $form->dropDownList($model,'unit_id',  
                         CHtml::listData(Units::model()->findAll("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                         array("order"=>"sort")), 'id', 'short_title'), array('prompt'=>Yii::t('all','Select').'...')); ?>                  
		<?php// echo $form->label($model,'remoteness'); ?>
		<?php// echo $form->textField($model,'remoteness',array('size'=>10,'maxlength'=>10)); ?>
	</div>
    
       	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
                  <?php $autocompleteConfig = array(
                     'model'=>$model, // модель
                     'attribute'=>'title', // атрибут модели
                     // "источник" данных для выборки
                     // может быть url, который возвращает JSON, массив
                     // или функция JS('js: alert("Hello!");')
                    'source' =>Yii::app()->createUrl('spaces/autocompletetitle'),
                     // параметры, подробнее можно посмотреть на сайте
                     // http://jqueryui.com/demos/autocomplete/
                    'options'=>array(
                         // минимальное кол-во символов, после которого начнется поиск
                        'minLength'=>'2',
                        'showAnim'=>'fold',
                        // обработчик события, выбор пункта из списка
                        'change' =>'js: function(event, ui) {
                            $(\'input#Spaces_title[type="hidden"]\').val($(\'input#Spaces_title\').val());
                        }',
                        'select' =>'js: function(event, ui) {
                        // действие по умолчанию, значение текстового поля
                        // устанавливается в значение выбранного пункта
                        this.value = ui.item.label;
                        // устанавливаем значения скрытого поля                        
                        $("#Spaces_title").val(ui.item.title);
                        return true;
                        }',
                  ),
                 'htmlOptions' => array(
                    'maxlength'=>75,
                    'size'=>60, 
                  ),
                );
                ?>
                <?php $this->widget('zii.widgets.jui.CJuiAutoComplete', $autocompleteConfig); ?>
                <?php echo $form->hiddenField($model,'title', array('style'=>'display: none;width:150px;')); ?>
                <script>
                  $( function () {
                        $('input[type="submit"]').click(
                            function() {
                                $('input#Spaces_title[type="hidden"]').val($('input#Spaces_title').val()); 
                            }
                        );
                   });
                </script>
		<?php// echo $form->textField($model,'title',array('size'=>60,'maxlength'=>75)); ?>
	</div>        
	<div class="row">
		<?php echo $form->labelEx($model,'address'); ?>

                <?php $autocompleteConfig = array(
                     'model'=>$model, // модель
                     'attribute'=>'address', // атрибут модели
                     // "источник" данных для выборки
                     // может быть url, который возвращает JSON, массив
                     // или функция JS('js: alert("Hello!");')
                    'source' =>Yii::app()->createUrl('spaces/autocompleteaddress'),
                     // параметры, подробнее можно посмотреть на сайте
                     // http://jqueryui.com/demos/autocomplete/
                    'options'=>array(
                         // минимальное кол-во символов, после которого начнется поиск
                        'minLength'=>'2',
                        'showAnim'=>'fold',
                        // обработчик события, выбор пункта из списка
                        'select' =>'js: function(event, ui) {
                        // действие по умолчанию, значение текстового поля
                        // устанавливается в значение выбранного пункта
                        this.value = ui.item.label;
                        // устанавливаем значения скрытого поля
                        $("#Spaces_address").val(ui.item.address);
                        return true;
                    }',
                  ),
                 'htmlOptions' => array(
                    'maxlength'=>255,
                    'size'=>75, 
                  ),
                );
                ?>
                <?php $this->widget('zii.widgets.jui.CJuiAutoComplete', $autocompleteConfig); ?>
                <?php echo $form->hiddenField($model,'address', array('style'=>'display: none;width:255px;')); ?>
		<?php// echo $form->textField($model,'address',array('size'=>60,'maxlength'=>255)); ?>
                <script>
                  $( function () {
                        $('input[type="submit"]').click(
                            function() {
                                $('input#Spaces_address[type="hidden"]').val($('input#Spaces_address').val()); 
                            }
                        );
                   });
                </script>
                                            
	</div>

        <div class="row">
            <?php echo $form->labelEx($model,'space_vid_id'); ?>
            <?php $data = CHtml::listData(SpaceVids::model()->findAll("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                                array("order"=>"sort")), 'id', 'title'); ?>            
            <?php $this->widget('ext.widgets.EchMultiSelect', array(
                          // the data model associated with this widget:
                          'model' => $model,
                          // the attribute associated with drop down list of this widget:
                          'dropDownAttribute' => 'space_vid_id',     
                          // data for generating the options of the drop down list:
                          'data' => $data,    
                          // the name of the drop down list (this must be set if 'model' and 'dropDownAttribute' are not set):
                          'name' => 'Spaces_space_vid_id',
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
                <?php/* echo $form->dropDownList($model,'space_vid_id',    
                              CHtml::listData(SpaceVids::model()->findAll("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                                array("order"=>"sort")), 'id', 'title'), array('prompt'=>Yii::t('all','Select').'...')); */?>                                     
		<?php// echo $form->textField($model,'space_vid_id'); ?>
	</div>
        
	<div class="row" >
            <?php echo $form->labelEx($model,'space_class_id'); ?>
            <?php $data = CHtml::listData(SpaceClasses::model()->findAll("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                                array("order"=>"sort")), 'id', 'abbr'); ?>            
            <?php $this->widget('ext.widgets.EchMultiSelect', array(
                          // the data model associated with this widget:
                          'model' => $model,
                          // the attribute associated with drop down list of this widget:
                          'dropDownAttribute' => 'space_class_id',     
                          // data for generating the options of the drop down list:
                          'data' => $data,    
                          // the name of the drop down list (this must be set if 'model' and 'dropDownAttribute' are not set):
                          'name' => 'Spaces_space_class_id',
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
                <?php/* echo $form->dropDownList($model,'space_class_id',  
                              CHtml::listData(SpaceClasses::model()->findAll("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                                array("order"=>"sort")), 'id', 'abbr'), array('prompt'=>Yii::t('all','Select').'...')); */?>                                     
		<?php// echo $form->textField($model,'space_class_id'); ?>
	</div>


	<div class="row">
            <label for="date-rang-from"><?=Yii::t('all','Date of call from');?></label>		
            <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'language'=> Yii::app()->params->language,                                        
                    'name'=>'date_rang-from',
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
            <?php// echo CHtml::textField('date_rang-from','',array('size'=>10,'maxlength'=>10));  ?>
            <b> <?=Yii::t('all','on');?> </b>
            <?php// echo CHtml::textField('date_rang-to','',array('size'=>10,'maxlength'=>10));  ?>
            <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'language'=> Yii::app()->params->language,                                        
                    'name'=>'date_rang-to',
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
            <?php// echo $form->label($model,'date_rang'); ?>
            <?php// echo $form->textField($model,'date_rang'); ?>
	</div>

	<div class="row">
            <label for="date-from"><?=Yii::t('all','Date of release from');?></label>		
            <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'language'=> Yii::app()->params->language,                                        
                    'name'=>'date_release-from',
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
            <b> <?=Yii::t('all','on');?> </b>
            <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'language'=> Yii::app()->params->language,                                        
                    'name'=>'date_release-to',
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
		<?php// echo $form->label($model,'date_release'); ?>
		<?php// echo $form->textField($model,'date_release'); ?>
	</div>

	<div class="row">
            <?php echo $form->labelEx($model,'in_stock'); ?>
            <?php// echo $form->checkBox($model,'in_stock',array('value'=>null)); ?>
            <?php echo $form->dropDownList($model,'in_stock',  
                                     array(""=>"все","0"=>"нет","1"=>"да")); ?>
            <?php// echo $form->checkBox($model,'in_stock',array('value'=>null)); ?>
	</div>
    
	<div class="row">
                <label for="area-from"><?=Yii::t('all','Area from');?></label>
		<?php// echo $form->label($model,'area')?>                 
                <?php echo CHtml::textField('area-from','',array('size'=>10,'maxlength'=>10));  ?>
                <b> <?=Yii::t('all','to');?> </b>
                <?php echo CHtml::textField('area-to','',array('size'=>10,'maxlength'=>10));  ?>
                <b> м2</b>
		<?php// echo $form->textField($model,'area',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<?php/*<div class="row">
                <label for="price-from"><?=Yii::t('all','Price from');?></label>                
		<?php// echo $form->label($model,'price')?>                 
                <?php echo CHtml::textField('price-from','',array('size'=>10,'maxlength'=>10));  ?>
                <b> <?=Yii::t('all','to');?> </b>
                <?php echo CHtml::textField('price-to','',array('size'=>10,'maxlength'=>10));  ?>                
                <?php $data = CHtml::listData(Valutes::model()->findAll("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",                              
                                array("order"=>"sort")), 'id', 'abbr');?>
		<?php echo $form->dropDownList($model,'valute_id',$data, array('prompt'=>Yii::t('all','Select').'...')); ?> 
                <?php echo CHtml::label(Yii::t('all','конвертация'),'is_curs',array('class'=>'many')); ?>
                <?php echo CHtml::dropDownList('is_curs', array(), array("0"=>"нет","1"=>"да"),
                                                          array('class'=>'many')); ?>
                
                
		<?php// echo $form->label($model,'price'); ?>
		<?php// echo $form->textField($model,'price',array('size'=>10,'maxlength'=>10)); ?>
	</div>*/?>
        <?php $this->renderPartial( '/spaces/_currency_search', array('model'=>$model,
                                                       'form' =>$form,
                                                       'is_curs'=>true));
        ?>
	<?/*<div class="row">
		<?php echo $form->label($model,'pic_scr_id'); ?>
		<?php echo $form->textField($model,'pic_scr_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pic_anons_id'); ?>
		<?php echo $form->textField($model,'pic_anons_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pic_detile_id'); ?>
		<?php echo $form->textField($model,'pic_detile_id'); ?>
	</div>*/?>

	<?/*<div class="row">
		<?php echo $form->label($model,'unit_id'); ?>
		<?php echo $form->textField($model,'unit_id'); ?>
	</div>*/?>

	<?/*<div class="row">
		<?php echo $form->label($model,'unit_value'); ?>
		<?php echo $form->textField($model,'unit_value',array('size'=>10,'maxlength'=>10)); ?>
	</div>*/?>
    
        <?php/* print_r(CHtml::listData(Plannings::model()->findAll("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",                        
                                array("order"=>"sort")),'id','title')); */?>
                                
	<div class="row">
            <?php echo $form->label($model,'planning_id'); ?>
            <?php $data = CHtml::listData(Plannings::model()->findAll("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",                        
                                array("order"=>"sort")), 'id', 'title'); ?>            
            <?php $this->widget('ext.widgets.EchMultiSelect', array(
                          // the data model associated with this widget:
                          'model' => $model,
                          // the attribute associated with drop down list of this widget:
                          'dropDownAttribute' => 'planning_id',     
                          // data for generating the options of the drop down list:
                          'data' => $data,    
                          // the name of the drop down list (this must be set if 'model' and 'dropDownAttribute' are not set):
                          'name' => 'Spaces_planning_id',
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
            <?php/* echo $form->dropDownList($model,'planning_id',                                                                                 
                               CHtml::listData(Plannings::model()->findAll("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",                        
                                array("order"=>"sort")), 'id', 'title'), array('prompt'=>Yii::t('all','Select').'...')); */?>             
            <?php// echo $form->textField($model,'planning_id'); ?>
	</div>

        <div class="row">
            <?php echo $form->labelEx($model,'coefficient_corridor'); ?>
            <?php echo $form->dropDownList($model,'coefficient_corridor', 
                            array_merge( array('' => '--'),                                        
                             array_combine(range(1,26,1),range(5,30,1)))); ?> %
	</div> 
                
        <div class="row">
            <?php echo $form->labelEx($model,'is_separate_entrance'); ?>
            <?php echo $form->dropDownList($model,'is_separate_entrance',  
                                     array(""=>"все","0"=>"нет","1"=>"да")); ?>            
            <?php// echo $form->checkBox($model,'is_separate_entrance',array('value'=>null)); ?>
	</div> 
        
        <div class="row">
            <?php echo $form->labelEx($model,'Свойства недвижемости'); ?> 
            <?php $data = CHtml::listData(Properties::model()->findAll("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                                array("order"=>"sort")), 'id', 'title'); ?> 
            <?php // Свойства недвижемости ?>
            <?php $this->widget('ext.widgets.EchMultiSelect', array(
                          // the data model associated with this widget:
                          'model' => $model,
                          // the attribute associated with drop down list of this widget:
                          'dropDownAttribute' => 'spaceProperties',     
                          // data for generating the options of the drop down list:
                          'data' => $data,                            
                          // the name of the drop down list (this must be set if 'model' and 'dropDownAttribute' are not set):
                          'name' => 'Spaces_spaceProperties',    
                          // additional HTML attributes for the drop down list: 
                          'dropDownHtmlOptions'=> array(
                            'style'=>'width:auto'/*'width:378px;'*/,
                            'multiple'=>true,
                            'options'=>(isset($selProperties) ? $selProperties : array()),                              
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
            
            <?php echo CHtml::label(Yii::t('all','many'),'is_many_properties',array('class'=>'many')); ?>
            <?php echo CHtml::dropDownList('is_many_properties', array(), 
                                            array("0"=>"нет","1"=>"да"),
                                            array('class'=>'many')); ?>
    
            <?php/* echo $form->listBox($model,'spaceProperties',
                                               CHtml::listData(Properties::model()->findAll(), 'id', 'title'),
                                               array("multiple"=>"multiple","size"=>"2")); */?>
            <?php// echo $form->error($model,'spaceProperties'); ?>
	</div>
    
	<div class="row">
            <?php echo $form->label($model,'tax_id'); ?>
            <?php $data = CHtml::listData(Taxs::model()->findAll("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                                array("order"=>"sort")), 'id', 'abbr'); ?>            
            <?php $this->widget('ext.widgets.EchMultiSelect', array(
                          // the data model associated with this widget:
                          'model' => $model,
                          // the attribute associated with drop down list of this widget:
                          'dropDownAttribute' => 'tax_id',     
                          // data for generating the options of the drop down list:
                          'data' => $data,    
                          // the name of the drop down list (this must be set if 'model' and 'dropDownAttribute' are not set):
                          'name' => 'Spaces_tax_id',
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
            <?php/* echo $form->dropDownList($model,'tax_id',                                    
                                CHtml::listData(Taxs::model()->findAll("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                                array("order"=>"sort")), 'id', 'abbr'), array('prompt'=>Yii::t('all','Select').'...')); */?>              
            <?php// echo $form->textField($model,'tax_id'); ?>
	</div>
    
	<div class="row">
            <?php echo $form->label($model,'number_tax'); ?>
            <?php echo $form->textField($model,'number_tax',array('size'=>11,'maxlength'=>11)); ?>
	</div>
    
	<div class="row">
            <?php echo $form->label($model,'parking_id'); ?>
            <?php $data = CHtml::listData(Parkings::model()->findAll("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                                array("order"=>"sort")), 'id', 'title'); ?>            
            <?php $this->widget('ext.widgets.EchMultiSelect', array(
                          // the data model associated with this widget:
                          'model' => $model,
                          // the attribute associated with drop down list of this widget:
                          'dropDownAttribute' => 'parking_id',     
                          // data for generating the options of the drop down list:
                          'data' => $data,    
                          // the name of the drop down list (this must be set if 'model' and 'dropDownAttribute' are not set):
                          'name' => 'Spaces_parking_id',
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
            <?php/* echo $form->dropDownList($model,'parking_id',   
                                               CHtml::listData(Parkings::model()->findAll("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                                array("order"=>"sort")), 'id', 'title'), array('prompt'=>Yii::t('all','Select').'...')); */?>               
            <?php// echo $form->textField($model,'parking_id'); ?>
	</div>

	<div class="row">
            <?php echo $form->label($model,'cnt_parking_place'); ?>
            <?php echo $form->textField($model,'cnt_parking_place',array('style'=>'width:60px')); ?>
	</div>

	<?php/*<div class="row">
		<?php echo $form->label($model,'telephone'); ?>
		<?php echo $form->textField($model,'telephone',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'site'); ?>
		<?php echo $form->textField($model,'site',array('size'=>60,'maxlength'=>255)); ?>
	</div>*/?>

	<div class="row">
            <?php echo $form->label($model,'representative_id'); ?>
            <?php $data = CHtml::listData(Representatives::model()->findAll(), 'id', 'name'); ?>
            <?php $this->widget('ext.widgets.EchMultiSelect', array(
                          // the data model associated with this widget:
                          'model' => $model,
                          // the attribute associated with drop down list of this widget:
                          'dropDownAttribute' => 'representative_id',     
                          // data for generating the options of the drop down list:
                          'data' => $data,    
                          // the name of the drop down list (this must be set if 'model' and 'dropDownAttribute' are not set):
                          'name' => 'Spaces_representative_id',    
                          // additional HTML attributes for the drop down list: 
                          'dropDownHtmlOptions'=> array(
                            'style'=>'width:auto'/*'width:378px;'*/,                        
                            'prompt'=>Yii::t('application','Select Options').'...',    
                          ),
                          // options for the jQuery UI MultiSelect Widget
                          // (see the project page for available options):
                          'options' => array( 
                            'selectedList'=>5,
                            'header'=>false,
                            // set this to true, if you want to use the Filter Plugin
                            'filter'=>false,
                            'height'=>100,                               
                            'multiple'=>false, 
                          ),
            )); ?>                
            <?php// echo $form->textField($model,'representative_id'); ?>
	</div>

        <div class="row">            
            <?php echo $form->labelEx( $model, 'spaceRepresentatives'); ?>    
            <?php $data = CHtml::listData(Representatives::model()->findAll(), 'id', 'name')  ?>
            <?php // Представители недвижемости ?>
            <?php $this->widget('ext.widgets.EchMultiSelect', array(
                          // the data model associated with this widget:
                          'model' => $model,
                          // the attribute associated with drop down list of this widget:
                          'dropDownAttribute' => 'spaceRepresentatives',     
                          // data for generating the options of the drop down list:
                          'data' => $data,    
                          // the name of the drop down list (this must be set if 'model' and 'dropDownAttribute' are not set):
                          'name' => 'Spaces_spaceRepresentatives',    
                          // additional HTML attributes for the drop down list: 
                          'dropDownHtmlOptions'=> array(
                            'style'=>'width:auto'/*'width:378px;'*/,
                            'multiple'=>true,    
                            'options'=>(isset($selRepresentatives) ? $selRepresentatives : array()),                              
                          ),
                          // options for the jQuery UI MultiSelect Widget
                          // (see the project page for available options):
                          'options' => array( 
                            'selectedList'=>5,
                            'header'=>false,
                            // set this to true, if you want to use the Filter Plugin
                            'filter'=>true,
                            'height'=>100,                               
                            'multiple'=>true,  
                          ),
            )); ?>    
            <?php echo CHtml::label(Yii::t('all','many'),'is_many_representatives',array('class'=>'many')); ?>
            <?php echo CHtml::dropDownList('is_many_representatives', array(), 
                                            array("0"=>"нет","1"=>"да"),
                                            array('class'=>'many')); ?>
            <?php// echo $form->textField($model,'representative_id'); ?>            
	</div>

        <div class="row">               
            <?php echo CHtml::label(Yii::t('all','Phone Contact'),'Contact_telephone'); ?>
            <?php
                              $this->widget('CMaskedTextField', array(
                                    //'model' => $model_representatives,
                                    'name' => 'Contact_telephone',
                                    'attribute' => 'telephone',
                                    'mask' => '8(xxx)xxx-xx-xx',
                                    'charMap' => array('x'=>'[x0-9]','9'=>'[0-9]'),
                                    'htmlOptions' => array('size' => 11),
                                    'placeholder'=>'x'
                                    ));
                                    ?>
            <?php// echo $form->textField($model,'representative_id'); ?>            
	</div>
        
	<div class="row">
            <?php echo $form->label($model,'commission_id'); ?>
            <?php $data = CHtml::listData(Commissions::model()->findAll("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                                array("order"=>"sort")), 'id', 'title'); ?>            
            <?php $this->widget('ext.widgets.EchMultiSelect', array(
                          // the data model associated with this widget:
                          'model' => $model,
                          // the attribute associated with drop down list of this widget:
                          'dropDownAttribute' => 'commission_id',     
                          // data for generating the options of the drop down list:
                          'data' => $data,    
                          // the name of the drop down list (this must be set if 'model' and 'dropDownAttribute' are not set):
                          'name' => 'Spaces_commission_id',
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
            <?php/* echo $form->dropDownList($model,'commission_id',                                                    
                             CHtml::listData(Commissions::model()->findAll("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                                array("order"=>"sort")), 'id', 'title'), array('prompt'=>Yii::t('all','Select').'...')); */?>             
            <?php// echo $form->textField($model,'commission_id'); ?>
	</div>

	<div class="row">
            <?php echo $form->label($model,'procent_commission'); ?>
            <?php echo $form->textField($model,'procent_commission',
                                            array('style'=>'width:20px;')
                                           ); ?> 
	</div>

	<?/*<div class="row">
		<?php echo $form->label($model,'contract_type_id'); ?>
		<?php echo $form->textField($model,'contract_type_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'contract_number'); ?>
		<?php echo $form->textField($model,'contract_number',array('size'=>60,'maxlength'=>255)); ?>
	</div>*/?>

	<div class="row">
            <?php echo $form->label($model,'tax_number'); ?>
            <?php echo $form->textField($model,'tax_number',array('size'=>20,'maxlength'=>255)); ?>
	</div>

	<div class="row">
            <?php echo $form->label($model,'fav'); ?>
            <?php echo $form->dropDownList($model,'fav',  
                                     array(""=>"все","0"=>"нет","1"=>"да")); ?>
            <?php// echo $form->checkBox($model,'fav',array('value'=>null)); ?>                        
            <?php// echo $form->textField($model,'fav'); ?>
	</div>
        <div class="row">
            <?php echo $form->labelEx($model,'spaceSimilarities1'); ?>                		
            <?php $data =  CHtml::listData(Spaces::model()->findAll($isId ? 'not id='.$model->id : ''), 'id', 'title'); ?>
            <?php // Другая площадь ?>
            <?php $this->widget('ext.widgets.EchMultiSelect', array(
                          // the data model associated with this widget:
                          'model' => $model,
                          // the attribute associated with drop down list of this widget:
                          'dropDownAttribute' => 'spaceSimilarities1',     
                          // data for generating the options of the drop down list:
                          'data' => $data,    
                          // the name of the drop down list (this must be set if 'model' and 'dropDownAttribute' are not set):
                          'name' => 'Spaces_spaceSimilarities1',    
                          // additional HTML attributes for the drop down list: 
                          'dropDownHtmlOptions'=> array(
                            'style'=>'width:auto',/*'width:378px;'*/
                            'multiple'=>true,
                            'options'=>(isset($selSimilarities1) ? $selSimilarities1 : array()),
                          ),
                          // options for the jQuery UI MultiSelect Widget
                          // (see the project page for available options):
                          'options' => array( 
                            'selectedList'=>5,                            
                            'header'=>true,  
                            // set this to true, if you want to use the Filter Plugin
                            'filter'=>true,
                            'height'=>100, 
                            'multiple'=>true,    
                          ),
            )); ?>          
            
            <?php echo CHtml::label(Yii::t('all','many'),'is_many_similarities1',array('class'=>'many')); ?>
            <?php echo CHtml::dropDownList('is_many_similarities1', array(), 
                                            array("0"=>"нет","1"=>"да"),
                                            array('class'=>'many')); ?>
	</div>

        <div class="row">
            <?php echo $form->labelEx($model,'spaceSimilarities'); ?>                		
            <?php $data =  CHtml::listData(Spaces::model()->findAll($isId ? 'not id='.$model->id : ''), 'id', 'title'); ?>
            <?php // Схожие предложения ?>
            <?php $this->widget('ext.widgets.EchMultiSelect', array(
                          // the data model associated with this widget:
                          'model' => $model,
                          // the attribute associated with drop down list of this widget:
                          'dropDownAttribute' => 'spaceSimilarities',     
                          // data for generating the options of the drop down list:
                          'data' => $data,    
                          // the name of the drop down list (this must be set if 'model' and 'dropDownAttribute' are not set):
                          'name' => 'Spaces_spaceSimilarities',       
                          // additional HTML attributes for the drop down list: 
                          'dropDownHtmlOptions'=> array(
                            'style'=>'width:auto',/*'width:378px;'*/
                            'multiple'=>true,
                            'options'=>(isset($selSimilarities) ? $selSimilarities : array()),  
                          ),
                          // options for the jQuery UI MultiSelect Widget
                          // (see the project page for available options):
                          'options' => array( 
                            'selectedList'=>5,
                            'header'=>true,  
                            // set this to true, if you want to use the Filter Plugin
                            'filter'=>true,
                            'height'=>100, 
                            'multiple'=>true,  
                          ),
            )); ?>         
            <?php echo CHtml::label(Yii::t('all','many'),'is_many_similarities',array('class'=>'many')); ?>
            <?php echo CHtml::dropDownList('is_many_similarities', array(), 
                                            array("0"=>"нет","1"=>"да"),
                                            array('class'=>'many')); ?>
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
    
        <?php echo CHtml::hiddenField('polygon');?>
    
        <div class="row">               
            <div class="checks">
               <label for="location" ><?php echo Yii::t('all','Расположение') ?></label>
               <?php $data = array("1"=>"метро","2"=>"карта");  ?>                                            
                <?php echo "<nobr>".CHtml::checkBoxList("map_id", ( trim($_POST["map_id"])<>'' ? $_POST["map_id"] : "1"), $data, array("separator"=>"&nbsp;"))."</nobr>" ;?>
               <div class="panel-map <?/*w-660"*/?>" >  
                    <div class="contenerGoogleMap vsearch bg-blue radius-5" >
                        <? /* Выберите район поиска*/ ?>
                        <div id="mapsearch" class="cke_skin_kama" width="918px" >
                            <?php $map->appendMapTo('#mapsearch');?>
                            <?php echo $map->registerAjaxMapScript(array(),Yii::app()->language);?> 
                        </div>
                    </div>
                    <div class="contenerMap" style="display:block;">
                            <?php $this->renderPartial( '/spaces/_map_metros',                                                
                                     array('metros'=>$metros)
                                  ); 
                            ?>
                        <div id="metro"></div>
                    </div>
              </div>
            </div>    
        </div>  
        
        <? /* Выберите район поиска?>
        <div class="row" style="padding-bottom:5px;" >
            <center class="plashka" ><b><?=Yii::t('all','Select area in map');?>:</b></center>                        
            <div id="mapsearch" class="cke_skin_kama" width="962" >
                <?php echo $map->renderMap(array(),Yii::app()->language);?>     
            </div>    
        </div>*/?>    
    
	<?/*<div class="row">
		<?php echo $form->label($model,'map_latitude'); ?>
		<?php echo $form->textField($model,'map_latitude',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'map_longitude'); ?>
		<?php echo $form->textField($model,'map_longitude',array('size'=>60,'maxlength'=>255)); ?>
	</div>*/?>

	<div class="row buttons">
		<?php echo CHtml::submitButton(Yii::t('form','Search'),array("id"=>"mainSearchButton")); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
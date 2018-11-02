<?php echo CHtml::label('Фильтр','Subscribe_fid',array()); ?>          
<?php $data = empty($model) ? array() : CHtml::listData($model,'id', 'text', 'group');  ?>
<?php// print_r($data);?>
<?php $this->widget('ext.widgets.EchMultiSelect', array(
    // the data model associated with this widget:
    //'model' => $model,
    // the attribute associated with drop down list of this widget:
    'dropDownAttribute' => 'fid',     
    // data for generating the options of the drop down list:
    'id'=> 'Subscribe_fid',
    'data' => $data,    
    // the name of the drop down list (this must be set if 'model' and 'dropDownAttribute' are not set):
    'name' => 'Subscribe[fid]',
    // additional HTML attributes for the drop down list:                           
    'dropDownHtmlOptions'=> array(
        'style'=>'width:auto',//'width:378px;', 
        'multiple'=>false, 
        /*'onchange'=>'getAjaxObject();',*/
        'prompt'=>Yii::t('application','Select Options').'...',  
    ),
    // options for the jQuery UI MultiSelect Widget
    // (see the project page for available options):
    'options' => array( 
        'selectedList'=>5,
        'header'=>false,
         // set this to true, if you want to use the Filter Plugin
        'checkAllText' => Yii::t('EchMultiSelect.EchMultiSelect','Выбрать все'),
        'uncheckAllText' => Yii::t('EchMultiSelect.EchMultiSelect','Отмена'),
        'selectedText' =>Yii::t('EchMultiSelect.EchMultiSelect','# выбрано'),
        'noneSelectedText'=>Yii::t('EchMultiSelectEchMultiSelect','Выбор фильтра...'),                                
         // set this to true, if you want to use the Filter Plugin
        'filter'=>false,
        'height'=>100,                               
        'multiple'=>false, 
        'ajax'=>true,
        //'ajaxRefresh'=>true,
        //'autoReset'=>true,
    ),
    'filterOptions'=>array(
    'label' => Yii::t('EchMultiSelect.EchMultiSelect','Фильтр:'),
         'placeholder'=>Yii::t('EchMultiSelect.EchMultiSelect','Ввод слов'),
    )       
)); ?> 

<script>
   function getAjaxObject() {
      var action = "/admin.php/subscribe/getajaxobject/";
      var section = $("#Subscribe_gid").val();
          if (section) {
              $.ajax({    url: action,
                               data: { gid : section },
                               type: "POST",
                            success: function(data) 
                                     {    
                                        $('#Subscribe_oid').multiselect('clear');  
                                        $('#oid').html(data);                                                                                                           
                                        $('#oid').removeClass('hidden'); 
                                     },
                              error: function(XMLHttpRequest, textStatus, errorThrown) {
                                             alert(XMLHttpRequest.responseText);
                                     }
                            });
          }else{
              $('#oid').addClass('hidden');
              $('#Subscribe_oid').val(null);
          }            
  }
</script>
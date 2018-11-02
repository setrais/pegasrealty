	<?php /*<div class="row">
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
        <div id="block-currency" class="row" style="position:relative" >            
            <div class="fl" >
                <label for="price_from"><?=Yii::t('all','Price from');?></label>                
                <?php $curr_valute = Valutes::model()->findByPk($model->valute_id);?>
                
                <?php echo CHtml::textField('price_from', 
                                            (isset($price_from) ? round($price_from) : ""),
                                            array('size'=>10,'maxlength'=>10));  ?>
                
                <b> <?=Yii::t('all','to');?> </b>
                <?php echo CHtml::textField('price_to', 
                                            (isset($price_to) ? round($price_to) : ""),
                                            array('size'=>10,'maxlength'=>10));  ?>                

		<?/*<?php echo $form->textField($model,'price',array('size'=>10,'maxlength'=>10,
                                                                 'value'=>($model->price===null ? $model->price : round($model->price )),
                                                                 'title'=>$curr_valute->title,
                                                                )); ?> кв.м.год*/?>
            </div>    
            <div class="fl " >
               <?php echo CHtml::label(Yii::t('all','Валюта'),'valute_id',array("class"=>"many")); ?>
               <?php $data = CHtml::listData(Valutes::model()->findAll("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",                              
                                array("order"=>"sort")), 'id', 'title');?>
                <?php $curr_valute = Valutes::model()->findByPk($model->valute_id);?>
		<?php echo $form->dropDownList($model,'valute_id',$data, 
                                    array('prompt'=>Yii::t('all','Select').'...','title'=>$curr_valute->title)); ?> 
                <span id="conv_value" class="hidden many" >
                <?php echo CHtml::label(Yii::t('all','конв-ия'),'is_conv',array('class'=>'many')); ?>                
                
                <?php echo CHtml::dropDownList('is_conv', (isset($select) ? $select : array()), 
                                                array("0"=>"нет","1"=>"да"), array()); ?>
                </span>    
            </div>
            <?php if ( $model->valute_id && isset($is_curs) && $is_curs ) : ?> 
                <div class="clear"></div>
                <div class="currency value" style="padding:2px 0px 5px;" >
                     <label for="currency">Курсы:</label>  
                     <?php $curs = $curr = Yii::app()->currency->from; ?>
                     <?php foreach ( $curr as $rkey=>$val) { ?>                                       
                           <span style="color: #0078ae;vertical-align: middle;" id="curs_valute_<?=$rkey+1;?>" ><?php echo $val["name"];?></span>:&nbsp;
                           <i id="curs_valute_value_<?php echo $val["name"];?>" style="vertical-align:middle;" ><?php echo round(Yii::app()->currency->$val["name"],5);?></i>&nbsp;
                     <?php }?>
                </div>  
                <div class="currency value">
                   <label for="currency">Цена согласно курса:</label>                  
                   <?php foreach ( $curs as $skey=>$val) { ?>                         
                         <span style="color:#169EA5;vertical-align: middle;" id="curr_value_<?=$skey+1;?>"><?php echo $val["name"];?></span>:&nbsp;
                         <b>от:</b>
                         
                         <i id="cost_from_<?php echo $val["name"];?>" class="info-field" ><?php echo Yii::app()->currency->$val["name"] && $price_from  ? round($price_from/Yii::app()->currency->$val["name"],5)<>0 
                                        ? round($price_from/Yii::app()->currency->$val["name"],5) : "" : "" ;?></i>&nbsp;
                         <b>до:</b>
                         <i id="cost_to_<?php echo $val["name"];?>" class="info-field" ><?php echo Yii::app()->currency->$val["name"] && $price_from ? round($price_to/Yii::app()->currency->$val["name"],5)<>0 
                                        ? round($price_to/Yii::app()->currency->$val["name"],5) : "" : "";?>
                         </i>&nbsp;
                   <?php } ?>                            
                </div>  
            <?php endif; ?>               
	</div>  
        <? if ( !isset($is_ajax) ) { ?>
        <script>
            
            $('#price_from').live('keyup',
                function() {
                    changePromCurrency();
                }
            ); 
            $('#price_to').live('keyup',
                function() {
                    changePromCurrency();
                }
            );                 
            function changePromCurrency() {
                var price_from = parseInt($('#price_from').val());
                var price_to = parseInt($('#price_to').val());
                
                var evt1 = $('#curs_valute_1').text();                
                var evt2 = $('#curs_valute_2').text();
                
                var val1  = parseFloat($('#curs_valute_value_'+evt1).text());
                var val2  = parseFloat($('#curs_valute_value_'+evt2).text());
                       
                $('#cost_from_'+evt1).text(''+(price_from/val1).toFixed(5));                
                $('#cost_to_'+evt1).text(''+(price_to/val1).toFixed(5));                         
                
                $('#cost_from_'+evt2).text(''+(price_from/val2).toFixed(5));                
                $('#cost_to_'+evt2).text(''+(price_to/val2).toFixed(5));       
            }
            
            function loadBlockPromCurrency(price_from,price_to,currency_title,currency_id,is_conv) {                                    
                   var url = '/bax.php/realestates/ajaxshowpromcurrenty?'
                                +'vid='+currency_id+'&'
                                +'price_from='+price_from+'&'
                                +'price_to='+price_to+'&'
                                +'is_conv='+is_conv;
                   
                   var loading = $( "<div>", { "class" : "ads-loading" });
		   $(loading).css("top", ($('#block-currency').height()/2)/*($(loading).height()/2)*/)
                             .css("left", ($('#block-currency').width()/2)+($(loading).width()));                             
                             //.css("top", ($(window).height()/2)-($(loading).height()/2))
                             //.css("left", ($(document).width()/2)-($(loading).width()/2));                             
                             //.css("right",10);
                             //.css("left",-10);
		   $("#block-currency").append(loading);
			
                   $('#block-currency').load(url, function(response, status, xhr) {
                       if ( status =="error") {
                            var msg = "<?=Yii::t('form','Sorry but there was an error');?>:";
                            alert(msg);
                            //$("#error").html(msg + xhr.status + " " + xhr.statusText);
                       }else{
                            if (currency_id.length>0) {
                                $('#Realestates_valute_id').attr('title',currency_title);
                            }else{
                                $('#Realestates_valute_id').removeAttr('title');
                            }
                            if (currency_id.length>0) {
                                $('#conv_value').removeClass();
                            }else{
                                $('#conv_value').addClass("hidden");
                            }
                            //$(".ds-loading").detach();
                       }
                   });                   
            }
                        
            
            $('#Realestates_valute_id').live('change',
                 
                 function() 
                 {                      
                   var curr_currency = $('#Realestates_valute_id').attr('title');
                   var currency_id = $('#Realestates_valute_id').val();
                   var currency_title = $('#Realestates_valute_id option[value="'+currency_id+'"]').text();                   
                   var is_curr = ( curr_currency==currency_title );  
                   var is_conv = $('#is_conv').val();
                   var price_from;
                   var price_to;
                   
                   if ( !is_curr) 
                   { 
                       if (curr_currency && currency_id.length>0) {
                           price_from = encodeURIComponent($('#cost_from_'+currency_title).text());
                           price_to = encodeURIComponent($('#cost_to_'+currency_title).text());
                       }else{
                           price_from = $('#price_from').val();
                           price_to = $('#price_to').val();                           
                       }
                       loadBlockPromCurrency(price_from, price_to,currency_title,currency_id,is_conv);                       
                   }                       
                 }
            );
               
            <?php
            /*    loadBlockCurrency(<?=$model->price;?>,<?=$model->Valutes->title;?>,<?=$model->valute_id;?>);*/
            ?>
    
        </script>
        <? } ?>

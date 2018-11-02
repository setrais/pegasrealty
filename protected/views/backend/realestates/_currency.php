        <div id="block-currency" class="row" style="position:relative" >
            <div class="fl" >
		<?php echo $form->labelEx($model,'price'); ?>
                <?php $curr_valute = Valutes::model()->findByPk($model->valute_id);?>
		<?php echo $form->textField($model,'price',array('size'=>10,'maxlength'=>10,
                                                                 'value'=>($model->price===null ? $model->price : round($model->price )),
                                                                 'title'=>$curr_valute->title,
                                                                )); ?> кв.м.год
		<?php echo $form->error($model,'price'); ?>
            </div>    
            <div class="fl " >
		<?php echo $form->labelEx($model,'valute_id',array("style"=>"width:62px;display:inline-block;")); ?>
                <?php $data = CHtml::listData(Valutes::model()->findAll("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                                array("order"=>"sort")), 'id', 'title');?>
		<?php echo $form->dropDownList($model,'valute_id',
                                               $data); ?> 
		<?php echo $form->error($model,'valute_id'); ?>
            </div>
            <?php if ( isset($is_curs) && $is_curs ) : ?> 
                <div class="fl" style="padding-left:5px;" >	                   
                  <div class="currency curs">
                     <label for="currency">Курсы:</label>  
                     <?php $curs = $curr = Yii::app()->currency->from; ?>
                     <?php foreach ( $curr as $rkey=>$val) { ?>                                       
                           <span style="color: #0078ae;" id="curs_valute_<?=$rkey+1;?>" ><?php echo $val["name"];?></span>:&nbsp;<i id="curs_valute_value_<?php echo $val["name"];?>" ><?php echo round(Yii::app()->currency->$val["name"],5);?></i>&nbsp;
                     <?php } ?>
                 </div>  
                </div>              
                <div class="clear"></div>
                <div class="currency value">
                   <label for="currency">Стоимость согласно Курса&nbsp;валют:</label>                  
                   <?php foreach ( $curs as $skey=>$val) { ?>
                         <span style="color:#169EA5;" id="curr_value_<?=$skey+1;?>"><?php echo $val["name"];?></span>:&nbsp;<i id="cost_<?php echo $val["name"];?>"><?php echo round($model->price/Yii::app()->currency->$val["name"],5);?></i>&nbsp;
                   <?php } ?>                            
                </div>  
            <?php endif; ?>               
	</div>  
        <? if ( !isset($is_ajax) ) { ?>
        <script>
            
            $('#Realestates_price').live('keyup',
                function() {
                    changeCurrency();
                }
            ); 
            
            function changeCurrency() {
                var price = parseInt($('#Realestates_price').val());
                var evt1 = $('#curs_valute_1').text();
                var evt2 = $('#curs_valute_2').text();
                var val1  = parseFloat($('#curs_valute_value_'+evt1).text());
                var val2  = parseFloat($('#curs_valute_value_'+evt2).text());
                       
                $('#cost_'+evt1).text(''+(price/val1).toFixed(5));
                $('#cost_'+evt2).text(''+(price/val2).toFixed(5));                         
            }
            
            function loadBlockCurrency(price,currency_title,currency_id) {                                    
                   var url = '/bax.php/realestates/ajaxshowcurrenty?'
                                +'vid='+currency_id+'&'
                                +'price='+price;
                   
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
                            $('#Realestates_price').attr('title',currency_title);
                            //$(".ds-loading").detach();
                       }
                   });                   
            }
                        
            
            $('#Realestates_valute_id').live('change',
                 
                 function() 
                 {                      
                   var curr_currency = $('#Realestates_price').attr('title');
                   var currency_id = $('#Realestates_valute_id').val();
                   var currency_title = $('#Realestates_valute_id option[value="'+currency_id+'"]').text();                   
                   var is_curr =( curr_currency==currency_title );                       
                   var price;
                   
                   if ( !is_curr) 
                   {
                       price = $('#cost_'+currency_title).text();
                       loadBlockCurrency(price,currency_title,currency_id);
                   }                       
                 }
            );
               
            <?php
            /*    loadBlockCurrency(<?=$model->price;?>,<?=$model->Valutes->title;?>,<?=$model->valute_id;?>);*/
            ?>
    
        </script>
        <? } ?>

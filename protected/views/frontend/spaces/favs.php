<?php
$this->breadcrumbs=array(	
	Yii::t('menu','FAV'),
);
?>

<div id="content"  >
<div class="content fs-13 ff-tahoma" > 
    
<h1><?=Yii::t('menu','FAV');?></h1>

<?php
$js_sendfav =<<< EOD
function() {
    var url = $(this).attr('href');
    $.get(url, function(data) {
        $('.popup').dialog({title:'Оформление заявки',
                            modal: true});                         
        $('#ClaimSendForm_nid').val(data);                               
    });
    return false;
}
EOD;
?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'spaces-grid',
	'dataProvider'=>$dataProvider,        
	//'filter'=>$filtersForm,
        'summaryText'=>Yii::t('core',                 
                              'Displaying Items {start} - {end} of {count} results', 
                               $dataProvider->getTotalItemCount()),
        'emptyText'=>Yii::t('core','No results found.'),
        /*'htmlOptions'=>array('style'=>'width:auto;overflow-x:scroll'),  */
	'columns'=>array(
            array(
                'class'=>'CCheckBoxColumn',
            ),
            array( 'name'=>'id', 'type'=>'text',
                  'headerHtmlOptions'=>array('width'=>'60'),
                  'htmlOptions'=>array('style'=>'width:60px;'),
                  'visible'=>false,
                ),               
            array('name'=>'nid', 'type'=>'text',
                  'header'=>'Номер',//Yii::t('label','Unique ID'),
                  'headerHtmlOptions'=>array('width'=>'80'),
                  'htmlOptions'=>array('style'=>'width:80px;'),
                  'visible'=>true,
                ),   
           array( 'name'=>'fav',
                  'header'=>Yii::t('all','Fav'),
                  'type'=>'text',
                  //'filter'=>CHtml::activecheckBox($model,'fav'),
                  'value'=>'($data->fav ? "x" : "")',                     
                  'htmlOptions'=>array('style'=>'width:10px;text-align:center;'),
                  'headerHtmlOptions'=>array('width'=>'10'),
                  'visible'=>false,
                ),   
            array(
                   'name'=>'pic_scr_id',
                   'header'=>Yii::t('label','Pic Scr'),
                   //'htmlOptions'=>array("width"=>60),
                   'type'=>'raw',
                    //тут самое интересное: если файла картинки нет, 
                    // то отображается файл no_photo.gif
                    // Значение value обрабатывается функцией eval() поэтому 
                    // тут такие странные ковычки.
                    /*'value'=> '"/".( trim($data->picOreginal->original_name)<>"" 
                                     && file_exists($_SERVER[DOCUMENT_ROOT]."/".str_replace("_original","_src",trim($data->picOreginal->original_name)))
                                     ? str_replace("_original","_src",trim($data->picOreginal->original_name))
                                     : ( trim($data->picScr->original_name)<>"" 
                                         && file_exists($_SERVER[DOCUMENT_ROOT]."/".str_replace("_original","_src",trim($data->picScr->original_name)))
                                         ? str_replace("_original","_src",trim($data->picScr->original_name)) 
                                         : "images/no_foto_small.png" ))',*/
                    /*'value'=> '"/".( trim($data->picScr->original_name)<>"" 
                                     && file_exists($_SERVER[DOCUMENT_ROOT]."/".str_replace("_original","_src",trim($data->picScr->original_name)))
                                     ? str_replace("_original","_src",trim($data->picScr->original_name))
                                     : ( trim($data->picOreginal->original_name)<>"" 
                                         && file_exists($_SERVER[DOCUMENT_ROOT]."/".str_replace("_original","_src",trim($data->picOreginal->original_name)))
                                         ? str_replace("_original","_src",trim($data->picOreginal->original_name)) 
                                         : "images/no_foto_small.png" ))',*/
                    'value'=> 'CHtml::link(CHtml::image( 
                                   "/".( trim($data->picScr->original_name)<>"" 
                                     && file_exists($_SERVER[DOCUMENT_ROOT]."/".str_replace("_original","_src",trim($data->picScr->original_name)))
                                     ? str_replace("_original","_src",trim($data->picScr->original_name))
                                     : ( trim($data->picOreginal->original_name)<>"" 
                                         && file_exists($_SERVER[DOCUMENT_ROOT]."/".str_replace("_original","_src",trim($data->picOreginal->original_name)))
                                         ? str_replace("_original","_src",trim($data->picOreginal->original_name)) 
                                         : "images/no_foto_small.png" )),"", 
                                         array("title"=>$data->picOreginal->name )), 
                                         "/".$data->picOreginal->original_name, array("class"=>"fancyImage"))',
                    'filter'=>'',
                    'headerHtmlOptions'=>array('width'=>'60'),
                    'htmlOptions'=>array('style'=>'width:60px;text-align: center;vertical-align: middle;'),
                    'visible'=>true,
                 ),	
           array( 'name'=>'title', 'type'=>'text',
                  'header'=>Yii::t('label','Title'),
                  'headerHtmlOptions'=>array('width'=>'150'),
                  'htmlOptions'=>array('style'=>'width:150px;'),
                  'visible'=>true,
                ),   
         array(   'name'=>'operation_id',
                  'header'=>Yii::t('all','Operation'),
                  'type'=>'text',
                  'filter'=>CHtml::listData(Operations::model()->findAll(), 'id', 'title'), 
                  'value'=>'$data->operation->title;',                     
                  'htmlOptions'=>array('style'=>'width:80px;text-align:center;'),
                  'headerHtmlOptions'=>array('width'=>'80'),
                  'visible'=>true,
                ),                             
           array( 'name'=>'space_vid_id',
                  'header'=>Yii::t('all','View'),
                  'type'=>'text',
                  'htmlOptions'=>array('style'=>'text-align:center;width:25'/*60px;'/*25px*/),
                  'value'=>'$data->spaceVid->abbr;',                   
                  'filter'=>CHtml::listData(SpaceVids::model()->findAll("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                                array("order"=>"sort")), 'id', 'abbr'),
                  'headerHtmlOptions'=>array('width'=>'25'/*'60'/*25px*/),
                  'visible'=>true,
                ),
           array( 'name'=>'space_class_id',
                  'header'=> Yii::t('grid','Class'),
                  'type'=>'text',
                  'value'=>'$data->spaceClass->abbr;',
                  'htmlOptions'=>array('style'=>'text-align:center;width:30px;'/*30px*/),
                  'filter'=>CHtml::listData(SpaceClasses::model()->findAll("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                                array("order"=>"sort")), 'id', 'abbr'),
                  'headerHtmlOptions'=>array('width'=>'30'/*30px*/),
                  'visible'=>true,
                ),            
           array( 'name'=>'district_id',
                  'header'=>Yii::t('all','District'),
                  'type'=>'text',
                  'value'=>'$data->district->title;',
                  'htmlOptions'=>array('style'=>'width:100px;'/*60px*/),
                  'filter'=>CHtml::listData(Districts::model()->findAll("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                          array("order"=>"sort")), 'id', 'title'),
                  'headerHtmlOptions'=>array('width'=>'100'/*60px*/),
                  'visible'=>true,
                ),  
           array( 'name'=>'metro_id',
                  'header'=>Yii::t('all','Metro'),
                  'type'=>'text',
                  'value'=>'$data->metro->title;',
                  'htmlOptions'=>array('style'=>'width:100px;'/*60px*/),               
                  //'filter'=>CHtml::activeListBox( $model, 'metro_id', CHtml::listData(Metros::model()->findAll(), 'id', 'title'), array("multiple"=>"multiple","size"=>3)),               
                  'filter'=>CHtml::listData(Metros::model()->findAll(), 'id', 'title'),
                  'headerHtmlOptions'=>array('width'=>'100px'/*60px*/),
                  'visible'=>true,
                ),  
           array( 'name'=>'remoteness',
                  'header'=>Yii::t('all','From ungr'),
                  'type'=>'html',
                  //'value'=>'round($data->remoteness)."<span style=padding-left:2px;color:#0078ae;font-family:Tahoma;font-size:9px;font-weight:bold;vertical-align:middle; >".$data->unit->short_title;',
                  'value'=>'round($data->remoteness)',
                  'htmlOptions'=>array('style'=>'width:60px;text-align:right;'),
                  'headerHtmlOptions'=>array('width'=>'60'),
                  'visible'=>true,
                ),              
           array( 'name'=>'unit_id',
                  'header'=>Yii::t('all','Ed.'),
                  'type'=>'html',
                  'value'=>'$data->unit->short_title',
                  'htmlOptions'=>array('style'=>'width:60px'/*60px*/.';text-align:right;'),
                  'headerHtmlOptions'=>array('width'=>'60'/*'60'*/),
                  'filter'=>CHtml::listData(Units::model()->findAll("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                                array("order"=>"sort")), 'id', 'short_title'),
                  'visible'=>true,
                ),  
          array(  'name'=>'area',
                  'header'=>Yii::t('all','Area'),
                  'type'=>'text',
                  'value'=>'round($data->area).""',                     
                  'htmlOptions'=>array('style'=>'width:30px;text-align:right;'),
                  'headerHtmlOptions'=>array('width'=>'30'),
                  'visible'=>true,
                ),                          
          array(  'name'=>'price',
                  'header'=>Yii::t('all','Price'),
                  'type'=>'text',
                  'value'=>'round($data->price)',         
                  'htmlOptions'=>array('style'=>'width:60px;text-align:right;'),
                  'headerHtmlOptions'=>array('width'=>'60'),
                  'visible'=>true,
                ),   
          array(  'name'=>'valute_id',
                  'header'=>Yii::t('all','Valute'),
                  'type'=>'text',
                  'filter'=>CHtml::listData(Valutes::model()->findAll(), 'id', 'title'),              
                  'value'=>'$data->valute->title',
                  'htmlOptions'=>array('style'=>'width:50px;text-align:right;'),
                  'headerHtmlOptions'=>array('width'=>'50'),
                  'visible'=>false,
                ),                           
          array(
                'class'=>'CButtonColumn',
                'template'=>'{view} {sendfav} {delete}',
                'buttons'=>array( 'sendfav'=>
                                  array( 'label'=>'Send',
                                         'url'=>'Yii::app()->controller->createUrl("createfavsend",array("id"=>$data->primaryKey))',
                                         'imageUrl'=>Yii::app()->request->baseUrl.'/images/mail-send.png',    
                                         'click'=>$js_sendfav,
                                         'visible'=>'true', 
                                         'options'=>array('id'=>'sendfav'.$data->primaryKey),
                                  ),
                                 'delete'=>
                                  array( 'label'=>'Delete',
                                         'url'=>'Yii::app()->controller->createUrl("favdelete",array("id"=>$data->primaryKey))',
                                         //'imageUrl'=>Yii::app()->request->baseUrl.'/images/view.png',    
                                         //'click'=>$js_preview,
                                         'visible'=>'true',    
                                  ),
                           ),                
                ),
                /*array(
                    'class'=>'CButtonColumn',                
                ),*/
	),
)); ?>


<?php $this->renderPartial('_send',array('model'=>$model));?>


    </div>
</div>
<script>
    $(document).ready(function() {
    $(".fancyImage").fancybox(
       {'overlayShow': true, 'hideOnContentClick': true});
    }); 
</script>  

<?    
$js_security = "                
                document.onselectstart=function(){return false}
                document.oncontextmenu=function(){return false}
                $('.items tbody').bind('mousedown',function(){return false});
               ";

  Yii::app()->getClientScript()->registerScript('Security'.$this->getId(), 
              $js_security, CClientScript::POS_READY);
?>    

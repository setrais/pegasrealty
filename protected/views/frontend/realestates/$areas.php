<?php $short = false;
$this->pageTitle = ( false// $model->areas->seo_title 
                      ? $model->areas->seo_title
                      : Yii::t('all','Каталог коммерческой недвижимости')
                        .(  $model->areas->title 
                        ? ": аренда коммерческой недвижимости Москвы в районе ".$model->areas->title//." - ".str_replace('офисов','офиса', Yii::t('all',Yii::app()->name)) 
                        : ": аренда коммерческой недвижимости Москвы, все районы"));//." - ".str_replace('офисов','офиса', Yii::t('all',Yii::app()->name))));

if ($model->areas->title) $this->pageDescription= trim($model->areas->seo_desc)<>'' 
                                                     ? Yii::t('all','Здесь отобраны предложения по аренде коммерческой недвижимости Москвы ')." в районе ".$model->areas->title.
                                                       '. '.$model->areas->seo_desc
                                                     : Yii::t('all','Здесь отобран предложения по аренде коммерческой недвижимости Москвы ')." в районе ".$model->areas->title;                   
else $this->pageDescription=Yii::t('all','Здесь отобраны предложения по аренде коммерческой недвижимости Москвы включая все районы');

if ($model->areas->title) $this->pageKeywords= trim($model->areas->seo_keywords)<>''
                                                  ? array_merge(explode(',', 
                                                                        "аренда ".mb_strtolower($model->areas->title,'UTF-8')." район москвы"                                                                        
                                                                        //.", аренда офисов района ".mb_strtolower($model->areas->title,'UTF-8')." москвы"
                                                                        //.", аренда офисов в москве ".mb_strtolower($model->areas->title,'UTF-8')." район"
                                                                        //.", аренда офисов москва ".mb_strtolower($model->areas->title,'UTF-8')." район"
                                                                        .", аренда ".mb_strtolower($model->areas->title,'UTF-8')." район москва"
                                                          
                                                                        .", аренда в москве район ".mb_strtolower($model->areas->title,'UTF-8')
                                                          
                                                                        .", аренда в районе ".mb_strtolower($model->areas->title,'UTF-8')
                                                          
                                                                        .", аренда москва район ".mb_strtolower($model->areas->title,'UTF-8')
                                                                        .", аренда район ".mb_strtolower($model->areas->title,'UTF-8')
                                                          
                                                                        .", аренда ".mb_strtolower($model->areas->title,'UTF-8')." район"
                                                          
                                                                        .", аренда в москве ".mb_strtolower($model->areas->title,'UTF-8')
                                                                        .", аренда москва ".mb_strtolower($model->areas->title,'UTF-8')
                                                                        .", ".mb_strtolower($model->areas->title,'UTF-8')
                                                                        .", каталог недвижимости, недвижимость, коммерческая недвижимость, аренда, район, москва, в москве, москвы,  район, метро, от метро, планировка, парковка, вид, класс, налоговая, налогообложение, отдельный вход, кк, свойства, арендная ставка, стоимость в месяц"),
                                                                        // Отсеиваиваем ключевые слова для короткой формы
                                                                        $short ? HRu::iskeyintxt(explode(',',$model->areas->seo_keywords),                                                   
                                                                                 HRu::cutstr($model->areas->anons,750, false, '.','. ')
                                                                            .' '.HRu::cutstr($model->areas->detile,1500, false, '.','. ')
                                                                            .' '.HRu::cutstr($model->areas->description,1000, false, '.','. '))
                                                                        : explode(',',$model->areas->seo_keywords)) 
                                                  : explode(',', 
                                                            "аренда ".mb_strtolower($model->areas->title,'UTF-8')." район москвы"                                                                        
                                                                        //.", аренда офисов района ".mb_strtolower($model->areas->title,'UTF-8')." москвы"
                                                                        //.", аренда офисов в москве ".mb_strtolower($model->areas->title,'UTF-8')." район"
                                                                        //.", аренда офисов москва ".mb_strtolower($model->areas->title,'UTF-8')." район"
                                                                        .", аренда ".mb_strtolower($model->areas->title,'UTF-8')." район москва"
                                                          
                                                                        .", аренда в москве район ".mb_strtolower($model->areas->title,'UTF-8')
                                                          
                                                                        .", аренда в районе ".mb_strtolower($model->areas->title,'UTF-8')
                                                          
                                                                        .", аренда москва район ".mb_strtolower($model->areas->title,'UTF-8')
                                                                        .", аренда район ".mb_strtolower($model->areas->title,'UTF-8')
                                                          
                                                                        .", аренда ".mb_strtolower($model->areas->title,'UTF-8')." район"
                                                          
                                                                        .", аренда в москве ".mb_strtolower($model->areas->title,'UTF-8')
                                                                        .", аренда москва ".mb_strtolower($model->areas->title,'UTF-8')
                                                                        .", ".mb_strtolower($model->areas->title,'UTF-8')
                                                                        .", каталог недвижимости, недвижимость, коммерческая недвижимость, аренда, район, москва, в москве, москвы,  район, метро, от метро, планировка, парковка, вид, класс, налоговая, налогообложение, отдельный вход, кк, свойства, арендная ставка, стоимость в месяц"
                                                          );                   
else $this->pageKeywords=explode(',', 'аренда в москве, каталог недвижимости, коммерческая недвижимость, недвижимость, аренда, офис, москва, в москве, москвы, районы, район, метро, от метро, планировка, парковка, вид, класс, налоговая, налогообложение, отдельный вход, кк, свойства, арендная ставка, стоимость в месяц');    

$this->pageKeywords= array_unique($this->pageKeywords);
natsort($this->pageKeywords);

$this->breadcrumbs=array(	
         Yii::t('menu-adm','List Realestates')=>array('index'),
	 ( $model->areas->title 
             ? /*"Аренда коммерческой недвижимости Москвы ".*/"в районе ".$model->areas->title
             : /*"Аренда коммерческой недвижимости Москвы, ".*/"все районы"
         )
);


Yii::app()->clientScript->registerScript('search', "
$('form#mainSearch').submit(function(){
	$.fn.yiiGridView.update('realestates-grid', {
                type: 'post', 
		data: $(this).serialize()
	});
        /*yaCounter15927313.hit(location.href, null, null);
        if(_gaq){
           _gaq.push(['_trackPageview', location.href]);
           _gaq.push(['_trackEvent', 'List Realestates', 'Click search button']);
        }*/
	return false;
});     
");
?>

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

<?
$js_addtofav =<<< EOD
function() {
    var url = $(this).attr('href');
    $.get(url, function(data) {
        //alert(response);
        /*var effect_in = 'scale';
        var easing_in = 'easeOutElastic';
        var effect_out = 'same';
        var easing_out = 'same';
        if (effect_out == 'same') effect_out = effect_in;
        if (easing_out == 'same') easing_out = easing_in;
        var speed = '700';
        if (speed.match(/^\d+$/)) speed = parseInt(speed);
        var options_in = {
            easing: easing_in
        };
        var options_out = {
            easing: easing_out
        };
        if (effect_in == 'scale') options_in.percent = 100;
        if (effect_out == 'scale') options_out.percent = 0;
        $.pnotify({
            pnotify_title: 'Информация',
            pnotify_text: 'Недвижимость №'+data+'успешно!</br>добавлена в избранное',
            pnotify_animate_speed: speed,
            pnotify_animation: {
                'effect_in': 'scale',
                'options_in': options_in,
                'effect_out': effect_out,
                'options_out': options_out
            }
        });*/
        $.pnotify({
            pnotify_width: 100,
            pnotify_nonblock: true,
            pnotify_title: 'Информация', 
            pnotify_text: 'Недвижимость №'+data+' успешно!<br/>добавлена в избранное',
            pnotify_animation: {
                effect_in: function(status, callback, pnotify) {
                    var source_note = 'Always call the callback when the animation completes.';
                    var cur_angle = 0;
                    var cur_opacity_scale = 0;
                    var timer = setInterval(function() {
                        cur_angle += 10;
                        if (cur_angle == 360) {
                            cur_angle = 0;
                            cur_opacity_scale = 1;
                            clearInterval(timer);
                        } else {
                            cur_opacity_scale = cur_angle / 360;
                        }
                        pnotify.css({
                            '-moz-transform': ('rotate(' + cur_angle + 'deg) scale(' + cur_opacity_scale + ')'),
                            '-webkit-transform': ('rotate(' + cur_angle + 'deg) scale(' + cur_opacity_scale + ')'),
                            '-o-transform': ('rotate(' + cur_angle + 'deg) scale(' + cur_opacity_scale + ')'),
                            '-ms-transform': ('rotate(' + cur_angle + 'deg) scale(' + cur_opacity_scale + ')'),
                            'filter': ('progid:DXImageTransform.Microsoft.BasicImage(rotation=' + (cur_angle / 360 * 4) + ')')
                        }).fadeTo(0, cur_opacity_scale);
                        if (cur_angle == 0) callback();
                    }, 20);
                },
                effect_out: function(status, callback, pnotify) {
                    var source_note = 'Always call the callback when the animation completes.';
                    var cur_angle = 0;
                    var cur_opacity_scale = 1;
                    var timer = setInterval(function() {
                        cur_angle += 10;
                        if (cur_angle == 360) {
                            cur_angle = 0;
                            cur_opacity_scale = 0;
                            clearInterval(timer);
                        } else {
                            cur_opacity_scale = cur_angle / 360;
                            cur_opacity_scale = 1 - cur_opacity_scale;
                        }
                        pnotify.css({
                            '-moz-transform': ('rotate(' + cur_angle + 'deg) scale(' + cur_opacity_scale + ')'),
                            '-webkit-transform': ('rotate(' + cur_angle + 'deg) scale(' + cur_opacity_scale + ')'),
                            '-o-transform': ('rotate(' + cur_angle + 'deg) scale(' + cur_opacity_scale + ')'),
                            '-ms-transform': ('rotate(' + cur_angle + 'deg) scale(' + cur_opacity_scale + ')'),
                            'filter': ('progid:DXImageTransform.Microsoft.BasicImage(rotation=' + (cur_angle / 360 * 4) + ')')
                        }).fadeTo(0, cur_opacity_scale);
                        if (cur_angle == 0) {
                            pnotify.hide();
                            callback();
                        }
                    }, 20);
                }
            }
        });
    });
    return false;
}
EOD;
?>

<div id="content"  >
<div class="content fs-13 ff-tahoma" > 
    
<h1><?=Yii::t('menu-adm','List Realestates');?><? echo ($model->areas->title 
                        ? //": ".
                          ": аренда коммерческой недвижимости Москвы в районе ".$model->areas->title//", ".mb_strtolower($model->areas->abbr,'UTF-8') 
                        : //": ".
                          ": аренда коммерческой недвижимости Москвы, все районы");?></h1>

<?php if ( $model->areas->anons ) {  ?>    
<div class="desc anons m-b18 fs-11 ff-Arial justify">    
    <?php if ($short) { ?>
    <?php echo str_replace(",","",HRu::cutstr($model->areas->anons,750, false, '.','. ')); ?>
    <?php } else { ?>
    <?php echo $model->areas->anons; ?>
    <?php } ?>     
</div>
<? } ?>  
    
<div class="search-form" >
<?php $this->renderPartial('_search',
                           array('metros'=>$metros, 
                                 'map'=>$map,
                                 'favs'=>$favs,
                                 'fav_cnt_row'=>$fav_cnt_row,
                                 'fav_cnt_col'=>$fav_cnt_col,
				 'model'=>$model 
                                )
                          );
?>
</div><!-- search-form -->
<script>
    
/* функция меняет содержимое адресной строки
   в "крутых" броузерах я решил использовать history.replaceState
   см. http://www.mokrushin.net/post/html5-history-object/)
   для остальных используем document.location.hash */
function changeBrowserUrl(url) {
    var url = url.split("?");
    var j = 0;
    if (url[1]) {
        var query = new Array();
        var params = url[1].split("&");
        var del = true;
        for (i in params) {
            var param = params[i].split("=");
            // удаляем параметр ajax, т. к. он не должен передаваться в ссылке
            if (param[0]=="ajax") {
                continue;
            }
            if (param[0].split(encodeURIComponent("[]")).length>1) {
            //if (param[0]=="metro"+encodeURIComponent("[]")) { 
                if (param[1]!=='') {
                    name = param[0].replace(encodeURIComponent("Realestates["),"").replace(encodeURIComponent("][]"),"").replace(encodeURIComponent("[]"),"");                               
                    if (typeof query[name]=="undefined") {
                      query[name] = param[1];                       
                    } else { 
                      /*if (query[name]===param[1]) {  !@TODO DOOBLE 
                        query[name] = param[1];  
                      }else{*/
                        query[name] = query[name]+','+param[1];    
                      /*}*/  
                    }
                } 
            }else{
                query[param[0]] = param[1];
            }    
        }
    }
    if (history.replaceState) {
        history.replaceState({}, "", buildUrl(url[0], query));
    } else {
        window.location.hash='#'+buildUrl(url[0], query);
    }
    return buildUrl(url[0], query);
}

// функция-аналог http_build_query в PHP
function buildUrl(url, parameters){
    var qs = "";
    for(var key in parameters) {
        var value = parameters[key];
        qs += key + "=" + encodeURIComponent(value) + "&";
    }
    if (qs.length > 0){
        qs = qs.substring(0, qs.length-1);
        url = url + "?" + qs;
    }
    return url;
}
/* Делаем редирект, если в hash имеется текст,
   начинающийся с / (т. е. потенциальная ссылка)*/
$(function() {
    var url = window.location.hash.split("#")[1];
    if (url && url[0]=='/') {
        window.location = url;
    }
})

</script>
<?php 
    $model->search()->pagination->route = Yii::app()->createUrl('/realestates/areas', array('id'=>$model->areas_id));
?>
<?php $this->renderPartial('/realestates/_social',array('model'=>(object)array('title'=>$this->pageTitle)));?>
<?php $this->widget('ext.groupgridview.GroupGridView'/*zii.widgets.grid.CGridView'*/, array(
	'id'=>'realestates-grid',          
	'dataProvider'=>$model->search(),
        /*'mergeColumns' => array('title'),
        'mergeType' => 'nested',*/
        /*'selectableRows'=>2,
        'selectionChanged'=>true,*/
        'extraRowColumns'=>array('anons'),
        'extraRowPos'=>'below',
        'extraRowExpression' => '"<div style=\"float:left; padding-right: 10px;\">".CHtml::link(CHtml::image( 
                                   "/".( trim($data->picScr->original_name)<>"" 
                                     && file_exists($_SERVER[DOCUMENT_ROOT]."/".str_replace("_original","_small",trim($data->picScr->original_name)))
                                     ? str_replace("_original","_small",trim($data->picScr->original_name))
                                     : ( trim($data->picOreginal->original_name)<>"" 
                                         && file_exists($_SERVER[DOCUMENT_ROOT]."/".str_replace("_original","_small",trim($data->picOreginal->original_name)))
                                         ? str_replace("_original","_small",trim($data->picOreginal->original_name)) 
                                         : "images/no_foto_small.png" )),"Недвижимость/Аренда/Офиса в Москве - ".$data->title, 
                                         array("title"=>"Недвижимость/Аренда/Офиса в Москве - ".$data->title)), 
                                         "/".str_replace("_original","_big",trim($data->picOreginal->original_name)), array("class"=>"fancyImage", "title"=>"Недвижимость/Аренда/Офиса в Москве - ".$data->title ))."
                                 </div>
                                 <div style=\"font-size: 0.95em;font-famely:Thahome;padding:0 5px;margin:0px 0;display:block;\">
                                         <div>
                                            <p class=\"anons m-0 p-b1 fs-11\">".CHtml::encode( str_replace(",","",HRu::cutstr($data->anons,'.($short ? 450 : 750).')))."</p>
                                            <p class=\"m-0 m-b4 m-t6 fs-'.($short ? 11 : 10).'\">".
                                                  ($data->areas_id ? 
                                                    "<b>".CHtml::encode($data->getAttributeLabel("areas_id")).":</b> "
                                                    .CHtml::encode($data->areas->title) : "")." ".
                                                  ($data->district_id ? 
                                                    "<b>".CHtml::encode($data->getAttributeLabel("district_id")).":</b> "
                                                    .CHtml::encode($data->district->title)." (".CHtml::encode($data->district->abbr).")" : "")." ".                                                      
                                                  ($data->street_id ? 
                                                    "<b>".CHtml::encode($data->street->getFullName(null,false,true)).":</b> "
                                                    .CHtml::encode($data->street->name) : "")." ".
                                                  ($data->metro_id ? 
                                                    "<b>".CHtml::encode($data->getAttributeLabel("metro_id")).":</b> "
                                                    .CHtml::encode($data->metro->title/*.":".$data->metro_id*/) : "")." ".                                                         
                                                    $data->getRemoteness()." ".                                                      
                                                  "<b>".CHtml::encode($data->getAttributeLabel("planning_id")).":</b> "
                                                    .CHtml::encode($data->planning->title)." ".
                                                  "<b>".CHtml::encode($data->getAttributeLabel("parking_id")).":</b> "
                                                    ."<span style=\"text-transform:lowercase;\">".CHtml::encode($data->parking->title)."-</span> "
                                                    .CHtml::encode($data->cnt_parking_place)." ".
                                                    "<span class=\"ed\">".Yii::t("all","м/м")."</span> ".                   
                                                  "<b>".Yii::t("all","View").":</b> "
                                                    .CHtml::encode($data->realestateVid->title)." ".
                                                  "<b>".Yii::t("all","класса")."</b> "
                                                    ."<span class=\"ed\" >".CHtml::encode($data->realestateClass->abbr)."</span> ".              
                                                  "<b>".CHtml::encode($data->getAttributeLabel("number_tax")).":</b> "
                                                    .CHtml::encode($data->taxReference->abbr)." ".                                                     
                                                  "<b>".CHtml::encode($data->getAttributeLabel("tax_id")).":</b> "
                                                    .CHtml::encode($data->tax->abbr)." ". 
                                                  "<b>".CHtml::encode($data->getAttributeLabel("is_separate_entrance")).":</b> "
                                                    .CHtml::encode($data->is_separate_entrance ? "есть" : "нет")." ".                                                                                                 
                                                  "<b>".CHtml::encode(Yii::t("label","КК")/*$data->getAttributeLabel("coefficient_corridor")*/).":</b> "
                                                    .CHtml::encode($data->coefficient_corridor ? "включен" : "отсутвует")
                                                    ." ".$data->getProperty()." "                                                     
                                                    //." ".$data->getDestination(true)." </br>".                                                  
                                                  ."<b>".CHtml::encode(Yii::t("label","Арендная ставка")).":</b> ".
                                                    "<span class=\"c-red fs-11\">".round($data->price)."</span> <span class=\"ed\">".$data->valute->abbr."</span>"." ".                                                     
                                                  "<b>".Yii::t("label","Стоимость&nbsp;в&nbsp;месяц").":</b>&nbsp;".
                                                   "<span class=\"c-red fs-11\">".round(($data->price*$data->area)/12)."</span>&nbsp;<span class=\"ed\">".$data->valute->abbr."</span>"                               
                                                  ."&nbsp;".CHtml::link("Подробнее...",Yii::app()->controller->createUrl("/realestates/".$data->primaryKey), array("title"=>"Недвижимость/Аренда/Офиса в Москве - ".$data->title, "class"=>"fs-11" ))."                                                     
                                            </p>        
                                        </div>"./*$data->anons.*/" 
                                 </div>"',                                                
        'ajaxUrl'=>Yii::app()->createUrl('/realestates/areas'),
        'beforeAjaxUpdate'=>" function(id, data) { 
              if ( typeof data.url=='undefined' ) { 
                data.url = changeBrowserUrl('?' + $('form#mainSearch').serialize());                                
              } else {
                data.url = changeBrowserUrl(data.url + '&' + $('form#mainSearch').serialize());                                
              }
            }",
        'afterAjaxUpdate'=>"
            function(id, data) {           
              //changeBrowserUrl($.fn.yiiGridView.getUrl(id));  
              //changeBrowserUrl($.fn.yiiGridView.getUrl(id));                              
              $('#Realestates_date_release').datepicker($.datepicker.regional['".Yii::app()->params->language."']);
              $('#Realestates_date_release').datepicker( 'option', 'altFormat', 'dd.mm.yy' );                                
              $('#Realestates_date_release').datepicker( 'option', 'dateFormat', 'dd.mm.yy' );
                                
              $('#Realestates_date_rang').datepicker($.datepicker.regional['".Yii::app()->params->language."']);
              $('#Realestates_date_rang').datepicker( 'option', 'altFormat', 'dd.mm.yy' );                                
              $('#Realestates_date_rang').datepicker( 'option', 'dateFormat', 'dd.mm.yy' );
              $('.fancyImage').fancybox(
                     {'overlayShow': true, 'hideOnContentClick': true}
              );    
              /*yaCounter15927313.hit(location.href, null, null);
              if(_gaq){
                 _gaq.push(['_trackPageview', location.href]);
                 _gaq.push(['_trackEvent', 'List Realestates', 'Click pages']);
              }*/
              $('tr.even').hover(
                 function() {                
                    $(this).next('tr.even').css('background-color', '#ECFBD4');                            
                 },
                 function() {                                            
                    $(this).next('tr.even').css('background-color', '#F8F8F8');
                 });
            
              $('tr.odd').hover(
                 function(){                                        
                    $(this).next('tr.odd').css('background-color', '#ECFBD4');
                 },
                 function() {                
                    $(this).next('tr.odd').css('background-color', '#E5F1F4');
                 });
              }",
	'filter'=>$model,
        'summaryText'=>Yii::t('core',                 
                              'Displaying Items {start} - {end} of {count} results', 
                               $model->search()->getTotalItemCount()),
        'emptyText'=>Yii::t('core','No results found.'),
        'pager'=>array(
              'header' => Yii::t('grid','Перейти к странице:'),
              //'firstPageLabel' => '&lt;&lt;',
              'prevPageLabel'  => Yii::t('grid','< Вперед'),//'<img src="images/pagination/left.png">',
              'nextPageLabel'  => Yii::t('grid','Назад >'),//'<img src="images/pagination/left.png">',
              //'nextPageLabel'  => '<img src="images/pagination/right.png">',
              //'lastPageLabel'  => '&gt;&gt;',
        ),  
        /*'htmlOptions'=>array('style'=>'width:auto;overflow-x:scroll'),  */
	'columns'=>array(
            /*array(
		'class'=>'CButtonColumn',                
	    ),*/
            /*array(
                'class'=>'CButtonColumn',
                'template'=>'{view} {update} {copy} {delete}',
                'buttons'=>array( 'copy'=>
                                  array( 'label'=>'Copy',
                                         'url'=>'Yii::app()->controller->createUrl("copy",array("id"=>$data->primaryKey))',
                                         'imageUrl'=>Yii::app()->request->baseUrl.'/images/copy.png',    
                                         //'click'=>$js_preview,
                                         'visible'=>'true',    
                                  ),
                           ),                
            ),*/
            /*array(
                'class'=>'CCheckBoxColumn',
            ),*/
            array( 'name'=>'id', 'type'=>'text',
                  'headerHtmlOptions'=>array('width'=>'60'),
                  'htmlOptions'=>array('style'=>'width:60px;'),
                  'visible'=>false,
                ),   
            array( 'name'=>'nid', 'type'=>'text',
                   'header'=>Yii::t('all','№ Лота'),
                   'headerHtmlOptions'=>array('width'=>'50'),
                   'htmlOptions'=>array('style'=>'width:50px;text-align:center'),
                   'visible'=>true,
                ),                
            array(
                   'name'=>'pic_scr_id',
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
                                         : "images/no_foto_small.png" )),"Недвижимость/Аренда/Офиса в Москве - ".$data->title, 
                                         array("title"=>"Недвижимость/Аренда/Офиса в Москве - ".$data->title/*$data->picOreginal->name*/)), 
                                         "/".str_replace("_original","_big",trim($data->picOreginal->original_name)), array("class"=>"fancyImage", "title"=>"Недвижимость/Аренда/Офиса в Москве - ".$data->title ))',
                    /*'value'=> 'CHtml::link(CHtml::image( 
                                   "/".( trim($data->picScr->original_name)<>"" 
                                     && file_exists($_SERVER[DOCUMENT_ROOT]."/".str_replace("_original","_small",trim($data->picScr->original_name)))
                                     ? str_replace("_original","_small",trim($data->picScr->original_name))
                                     : ( trim($data->picOreginal->original_name)<>"" 
                                         && file_exists($_SERVER[DOCUMENT_ROOT]."/".str_replace("_original","_small",trim($data->picOreginal->original_name)))
                                         ? str_replace("_original","_small",trim($data->picOreginal->original_name)) 
                                         : "images/no_foto_small.png" )),"Недвижимость/Аренда/Офиса в Москве - ".$data->title, 
                                         array("title"=>"Недвижимость/Аренда/Офиса в Москве - ".$data->title/*$data->picOreginal->name)), 
                                         "/".str_replace("_original","_big",trim($data->picOreginal->original_name)), array("class"=>"fancyImage", "title"=>"Недвижимость/Аренда/Офиса в Москве - ".$data->title ))',*/                                
                    'filter'=>'',
                    'headerHtmlOptions'=>array('width'=>'60'),
                    'htmlOptions'=>array('style'=>'width:60px;text-align: center;vertical-align: middle;'),
                    'visible'=>false,
                    //'headerHtmlOptions' => array('style' => 'display: none'),
                    //'htmlOptions' => array('style' => 'display: none'),
                 ),	
           array( 'name'=>'title', 'type'=>'raw',
                  'value'=> 'CHtml::link($data->title,Yii::app()->controller->createUrl("/realestates/".$data->primaryKey), array("title"=>"Недвижимость/Аренда/Офиса в Москве - ".$data->title ))',
                  'headerHtmlOptions'=>array('width'=>'150'),
                  'htmlOptions'=>array('style'=>'width:150px;'),
                  'visible'=>true,
                ),                  
           array( 'name'=>'realestate_vid_id',
                  'header'=>Yii::t('all','View'),
                  'type'=>'text',
                  'htmlOptions'=>array('style'=>'text-align:center;width:25'/*60px;'/*25px*/),
                  'value'=>'$data->realestateVid->abbr;',                   
                  'filter'=>CHtml::listData(RealestateVids::model()->findAll("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                                array("order"=>"sort")), 'id', 'abbr'),
                  'headerHtmlOptions'=>array('width'=>'25'/*'60'/*25px*/),
                  'visible'=>true,
                ),
           array( 'name'=>'realestate_class_id',
                  'header'=> Yii::t('grid','Class'),
                  'type'=>'text',
                  'value'=>'$data->realestateClass->abbr;',
                  'htmlOptions'=>array('style'=>'text-align:center;width:30px;'/*30px*/),
                  'filter'=>CHtml::listData(RealestateClasses::model()->findAll("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                                array("order"=>"sort")), 'id', 'abbr'),
                  'headerHtmlOptions'=>array('width'=>'30'/*30px*/),
                  'visible'=>true,
                ),    
           array( 'name'=>'areas_id',
                  'header'=>Yii::t('all','Areas'),
                  'type'=>'text',
                  'value'=>'$data->areas->title;',
                  'htmlOptions'=>array('style'=>'width:100px;'/*60px*/),
                  'filter'=>CHtml::listData(Areas::model()->findAll(array("condition"=>"(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                          "order"=>"sort")), 'id', 'title'),
                  'headerHtmlOptions'=>array('width'=>'100'/*60px*/),
                  'visible'=>false,
                ),             
           array( 'name'=>'district_id',
                  'header'=>Yii::t('all','District'),
                  'type'=>'text',
                  'value'=>'$data->district->title;',
                  'htmlOptions'=>array('style'=>'width:100px;'/*60px*/),
                  'filter'=>CHtml::listData(Districts::model()->findAll("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                          array("order"=>"sort")), 'id', 'title'),
                  'headerHtmlOptions'=>array('width'=>'100'/*60px*/),
                  'visible'=>false,
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
           /*array( 'name'=>'date_release',
                  'header'=>Yii::t('all','Delivery date'),
                  'type'=>'text',
                  'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', 
                    array( 'language'=> Yii::app()->params->language,                                        
                           'model'=>$model,
                           'attribute'=>'date_release',   
                           'theme'=>'ui-lightness',
                           'options'=>array(
                                'showAnim'=>'fold',
                                'dateFormat'=>'dd.mm.yy',                                 
                                'defaultDate'=>date('d.m.Y'),                                                
                                'showButtonPanel'=>true,
                                /*'showOn'=> "button",
                                'buttonImage'=> "/images/calendar.gif",
                                'buttonImageOnly'=> true,
                                //set calendar z-index higher then UI Dialog z-index 
                                'beforeShow'=>"js:function() {
                                  $('.ui-datepicker').css('font-size', '0.8em');
                                  $('.ui-datepicker').css('z-index', parseInt($(this).parents('.ui-dialog').css('z-index'))+1);
                                }",
                           ),   
                           'htmlOptions'=>array('size'=>8 ),
                    ),true),                                    
                  'value'=>'date("d.m.Y",strtotime($data->date_release))',
                  'htmlOptions'=>array('style'=>'width:110px;text-align:center;'),
                  'headerHtmlOptions'=>array('width'=>'110'),
                  'visible'=>true,
                ),*/  
          array(  'name'=>'date_rang',
                  'header'=>Yii::t('all','Date of call'),
                  'type'=>'text',
                  'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', 
                    array( 'language'=> Yii::app()->params->language,                                        
                           'model'=>$model,
                           'attribute'=>'date_rang',   
                           'theme'=>'ui-lightness',
                           'options'=>array(
                                'showAnim'=>'fold',
                                'dateFormat'=>'dd.mm.yy',                                 
                                'defaultDate'=>date('d.m.Y'),                                                
                                'showButtonPanel'=>true,
                                /*'showOn'=> "button",
                                'buttonImage'=> "/images/calendar.gif",
                                'buttonImageOnly'=> true,*/
                                //set calendar z-index higher then UI Dialog z-index 
                                'beforeShow'=>"js:function() {
                                  $('.ui-datepicker').css('font-size', '0.8em');
                                  $('.ui-datepicker').css('z-index', parseInt($(this).parents('.ui-dialog').css('z-index'))+1);
                                }",
                           ),   
                           'htmlOptions'=>array('size'=>8 ),
                    ),true),                                    
                  'value'=>'date("d.m.Y",strtotime($data->date_rang))',
                  'htmlOptions'=>array('style'=>'width:'/*110*/.'70px;text-align:center;'),
                  'headerHtmlOptions'=>array('width'=>'70'/*'110'*/),
                  'visible'=>false,
                ),            
          array(  'name'=>'in_stock',
                  'header'=>Yii::t('all','H'),
                  'type'=>'text',
                  'filter'=>CHtml::activecheckBox($model,'in_stock'),
                  'value'=>'($data->in_stock ? "x" : "")',                     
                  'htmlOptions'=>array('style'=>'width:10px;text-align:center;'),
                  'headerHtmlOptions'=>array('width'=>'10'),
                  'visible'=>false,
                ),  
          array(  'name'=>'area',
                  //'header'=>Yii::t('all','Area'),
                  'header'=>Yii::t('all','Площадь'),             
                  'type'=>'raw',
                  'value'=>'round($data->area)."&nbsp;<span class=\"c-red\" >м2</span>"',                     
                  'htmlOptions'=>array('style'=>'width:30px;text-align:right;'),
                  'headerHtmlOptions'=>array('width'=>'30'),
                  'visible'=>true,
                ),             
          array(  'name'=>'planning_id',
                  'header'=>Yii::t('all','Pl-ing'),
                  'type'=>'text',
                  'value'=>'$data->planning->abbr',          
                  'filter'=>CHtml::listData(Plannings::model()->findAll(), 'id', 'abbr'),              
                  'htmlOptions'=>array('style'=>'width:40px;/*20px;*/text-align:center;'),
                  'headerHtmlOptions'=>array('width'=>'40'/*20*/),
                  'visible'=>false,
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
                  'visible'=>true,
                ),     
          array(  'name'=>'tax_id',
                  'header'=>Yii::t('all','Tax'),
                  'type'=>'text',
                  'filter'=>CHtml::listData(Taxs::model()->findAll(), 'id', 'abbr'),              
                  'value'=>'$data->tax->abbr',                     
                  'htmlOptions'=>array('style'=>'width:20px;text-align:center;'),
                  'headerHtmlOptions'=>array('width'=>'20'),
                  'visible'=>false,
                ),             
          array(  'name'=>'parking_id',
                  'header'=>Yii::t('all','Parking'),
                  'type'=>'text',
                  'value'=>'$data->parking->abbr',                     
                  'filter'=>CHtml::listData(Parkings::model()->findAll(), 'id', 'abbr'), 
                  'htmlOptions'=>array('style'=>'width:10px;text-align:center;'),
                  'headerHtmlOptions'=>array('width'=>'10'),
                  'visible'=>false,
                ),    
          array(  'name'=>'representative_id',
                  'header'=>Yii::t('all','Owner'),
                  'type'=>'html',
                  'filter'=>CHtml::listData(Representatives::model()->findAll(), 'id', 'name'), 
                  'value'=>'$data->representative->name."<br/>".$data->representative->telephone;',                     
                  'htmlOptions'=>array('style'=>'width:80px;text-align:center;'),
                  'headerHtmlOptions'=>array('width'=>'80'),
                  'visible'=>false,
                ),                      
          array(  'name'=>'realestateRepresentatives',
                  'header'=>Yii::t('all','Representative'),
                  'type'=>'html',
                  'filter'=>CHtml::listData(Representatives::model()->findAll(), 'id', 'name'),                     
                  'value'=>'( $data->realestateRepresentatives[0]->id==null ? $data->representative->name."<br/>".$data->representative->telephone/*."<br/>".$data->representative->site*/ : Representatives::model()->findByPk($data->realestateRepresentatives[0]->representative_id)->name."<br/>".Representatives::model()->findByPk($data->realestateRepresentatives[0]->representative_id)->telephone/*."<br/>".Representatives::model()->findByPk($data->realestateRepresentatives[0]->representative_id)->site*/ );',
                  'htmlOptions'=>array('style'=>'width:80px;text-align:center;'),
                  'headerHtmlOptions'=>array('width'=>'80'),
                  'visible'=>false,
                ),  
          array(  'name'=>'cnt_parking_place',
                  'header'=>Yii::t('all','№ parking'),
                  'type'=>'text',
                  'value'=>'$data->cnt_parking_place',         
                  'htmlOptions'=>array('style'=>'width:60px;text-align:right;'),
                  'headerHtmlOptions'=>array('width'=>'60'),
                  'visible'=>false,
                ),   
          array(  'name'=>'commission_id',
                  'header'=>Yii::t('all','Type commission'),
                  'type'=>'text',
                  'filter'=>CHtml::listData(Commissions::model()->findAll(), 'id', 'abbr'), 
                  'value'=>'$data->commission->abbr;',                     
                  'htmlOptions'=>array('style'=>'width:80px;text-align:center;'),
                  'headerHtmlOptions'=>array('width'=>'80'),
                  'visible'=>false,
                ),               
          array(  'name'=>'procent_commission',
                  'header'=>Yii::t('all','% commission'),
                  'type'=>'text',                  
                  'value'=>'$data->procent_commission;',                     
                  'htmlOptions'=>array('style'=>'width:80px;text-align:center;'),
                  'headerHtmlOptions'=>array('width'=>'80'),
                  'visible'=>false,
                ),  
         array(   'name'=>'is_separate_entrance',
                  'header'=>Yii::t('all','Sep'),
                  'type'=>'text',
                  'filter'=>CHtml::activecheckBox($model,'is_separate_entrance'),
                  'value'=>'($data->is_separate_entrance  ? "x" : "")',                     
                  'htmlOptions'=>array('style'=>'width:10px;text-align:center;'),
                  'headerHtmlOptions'=>array('width'=>'10'),
                  'visible'=>false,
                ),              
          array(  'name'=>'fav',
                  'header'=>Yii::t('all','Fav'),
                  'type'=>'text',
                  'filter'=>CHtml::activecheckBox($model,'fav'),
                  'value'=>'($data->fav ? "x" : "")',                     
                  'htmlOptions'=>array('style'=>'width:10px;text-align:center;'),
                  'headerHtmlOptions'=>array('width'=>'10'),
                  'visible'=>false,
                ),  
          array(  'name'=>'number_tax',
                  'header'=>Yii::t('all','Tax code'),
                  'type'=>'text',                  
                  'value'=>'$data->number_tax;',                     
                  'htmlOptions'=>array('style'=>'width:80px;text-align:center;'),
                  'headerHtmlOptions'=>array('width'=>'80'),
                  'visible'=>false,
                ),                           
          array(  'name'=>'realestate_type_id',
                  'header'=>Yii::t('all','Type'),
                  'type'=>'text',
                  'filter'=>CHtml::listData(RealestateTypes::model()->findAll(), 'id', 'abbr'), 
                  'value'=>'$data->realestateType->abbr;',                     
                  'htmlOptions'=>array('style'=>'width:80px;text-align:center;'),
                  'headerHtmlOptions'=>array('width'=>'80'),
                  'visible'=>false,
                ),   
         array(   'name'=>'operation_id',
                  'header'=>Yii::t('all','Operation'),
                  'type'=>'text',
                  'filter'=>CHtml::listData(Operations::model()->findAll(), 'id', 'abbr'), 
                  'value'=>'$data->operation->abbr;',                     
                  'htmlOptions'=>array('style'=>'width:80px;text-align:center;'),
                  'headerHtmlOptions'=>array('width'=>'80'),
                  'visible'=>false,
                ),               
          array(  'name'=>'coefficient_corridor', 
                  'type'=>'text',
                  'filter'=>CHtml::listData(array_combine(range(1,26,1),range(5,30,1)),'id','coefficient_corridor'), 
                  'value'=>'$data->getCoefficientCorridor();',                                                    
                  'headerHtmlOptions'=>array('width'=>'50'),
                  'htmlOptions'=>array('style'=>'width:50px;'),
                  'visible'=>false,
                ),             
          array(  'name'=>'address', 'type'=>'text',
                  'headerHtmlOptions'=>array('width'=>'100'),
                  'htmlOptions'=>array('style'=>'width:100px;'),
                  'visible'=>false,
                ),               
          array(  'name'=>'map_latitude',
                  //'header'=>Yii::t('all','Широта'),
                  'type'=>'text',                  
                  'value'=>'$data->map_latitude;',                     
                  'htmlOptions'=>array('style'=>'width:80px;text-align:center;'),
                  'headerHtmlOptions'=>array('width'=>'80'),
                  'visible'=>false,
                ),    
          array(  'name'=>'map_longitude',
                  //'header'=>Yii::t('all','Долгота'),
                  'type'=>'text',                  
                  'value'=>'$data->map_longitude;',                     
                  'htmlOptions'=>array('style'=>'width:80px;text-align:center;'),
                  'headerHtmlOptions'=>array('width'=>'80'),
                  'visible'=>false,
                ),    
         array(   'name'=>'sid', 'type'=>'text',
                  'headerHtmlOptions'=>array('width'=>'100'),
                  'htmlOptions'=>array('style'=>'width:100px;'),
                  'visible'=>false,
                ),                             
         array(
                  'class'=>'CButtonColumn',
                  'template'=>'{view} {sendfav} {addtofav}',
                  'buttons'=>array( 'sendfav'=>                      
                                     array(  'label'=>'Отправить заявку',//'Send',
                                             'url'=>'Yii::app()->controller->createUrl("createfavsend",array("id"=>$data->primaryKey))',
                                             'imageUrl'=>Yii::app()->request->baseUrl.'/images/mail-send.png',    
                                             'click'=>$js_sendfav,
                                             'visible'=>'true',    
                                             'options'=>array('id'=>'sendfav'.$data->primaryKey),
                                      ),
                                     'addtofav'=>
                                      array( 'label'=>'Добавить в избранное', //AddToFav
                                             'url'=>'Yii::app()->controller->createUrl("favadd",array("id"=>$data->primaryKey))',
                                             'imageUrl'=>Yii::app()->request->baseUrl.'/images/addtofav.png',    
                                             'click'=>$js_addtofav/*"function() {
                                                        $.fn.yiiGridView.update('{$this->grid->id}', {
                                                            type:'POST',
                                                        url:$(this).attr('href'), 
                                                        success:function() {
                                                        $.fn.yiiGridView.update('{$this->grid->id}');
                                                                        }
                                                                });
                                                                return false;
                                                      }"*/,
                                             'visible'=>'true',    
                                             'options'=>array('id'=>'addtofav'.$data->primaryKey),
                                      ),
                           ),                
                ),
               
		/* Скрытые поля 
                 * 'id',
                   'pic_scr_id',
                   'pic_anons_id',
                   'pic_detile_id',
                   'telephone', // Удалить
                   'site',      // Удалить
                   'unit_value',// Удалить
                 
		/* Не используються
                 * 'contract_type_id', 
                   'contract_number',
                 
                /* Вывести в инфо через иконки anons, detile, decription
                 * при этом фильтр filter=>''
                 * 
                   'anons',
                   'detile',
                   'description',
                
                 * Множественные поля
                   'realestateProperties',
                   'realestateRepresentatives',
                   'realestateOthers',
                   'realestateSimilarities',
                   'picScr'
                   'picAnons'
                   'picDetile'
                   'realestateFotos',
                   'realestatePresentations',
		*/            
            
	),
)); ?>

    <?php   $this->renderPartial('_send',array('model'=>$model_claim));?>

    </div>    
    <br/>
    <?php   $this->renderPartial('/site/_list_metros', array('model'=>$model)); ?>  
    <?php if ( $model->areas->detile ) {  ?>    
    <div class="desc detile m-t16 m-b18 fs-10 ff-tahoma">   
            <?php if ($short) { ?>
            <?php echo str_replace(",","",HRu::cutstr($model->areas->detile,1500, false, '.','. ')); ?>
            <?php } else { ?>
            <?php echo $model->areas->detile; ?>
            <?php } ?>   
    </div>
    <? } ?>  
    <?php   $this->renderPartial('/site/_list_streets', array('model'=>$model)); ?>  
    <?php if ( $model->areas->description ) {  ?>    
    <div class="desc detile m-b18 fs-10 ff-tahoma">   
            <?php if ($short) { ?>
            <?php echo str_replace(",","",HRu::cutstr($model->areas->description,1000, false, '.','. ')); ?>
            <?php } else { ?>
            <?php echo $model->areas->description; ?>
            <?php } ?>           
    </div>
    <? } ?>  
</div>
<script>
    $(document).ready(function() {
        $(".fancyImage").fancybox(
           {'overlayShow': true, 'hideOnContentClick': true}
        );
        
        /*jQuery('.popup.tipsy').livequery(function(){
            enable_tipsy(jQuery(this));
        });

        function enable_tipsy(tag)
        {
            tag.tipsy( {
            //content: hkShowPopUp,
            trigger:'manual',
            isOut:true,
            delayOut:0
          } );
        }*/  

    }); 
</script>  

<?    
$js_security = "                
                document.onselectstart=function(){return false};
                document.oncontextmenu=function(){return false};
                $('.items tbody').bind('mousedown',function(){return false});
               ";

Yii::app()->getClientScript()->registerScript('Security'.$this->getId(), $js_security, CClientScript::POS_READY);

Yii::app()->getClientScript()->registerScript('_collapse', "               
            
            /*$('tr.even.extrarow').hover(
                        function() {    
                            $(this).prev().css('background-color', '#ECFBD4');                            
                        },
                        function() {                                            
                            $(this).prev().css('background-color', '#F8F8F8');
            });
            
            $('tr.odd.extrarow').hover(
                    function(){                                        
                        $(this).prev().css('background-color', '#ECFBD4');
                    },
                    function() {                
                        $(this).prev().css('background-color', '#E5F1F4');
            });*/
            
            $('tr.even').hover(
                        function() {                
                            $(this).next('tr.even').css('background-color', '#ECFBD4');                            
                        },
                        function() {                                            
                            $(this).next('tr.even').css('background-color', '#F8F8F8');
            });
            
            $('tr.odd').hover(
                    function(){                                        
                        $(this).next('tr.odd').css('background-color', '#ECFBD4');
                    },
                    function() {                
                        $(this).next('tr.odd').css('background-color', '#E5F1F4');
            });
      ");        
?>    

<?php 
$short = false;
$is_list = false;

$this->pageTitle= Yii::t('all','Коммерческая недвижимость')
                    .($model->taxReference 
                    ? ' | Аренда коммерческой недвижимости по '.$model->taxReference->abbr.' в Москве без комиссии.'
                     .' Снять нежилое помещение либо здание целиком c регистрацией в '.str_replace('инспекция','инспекции',mb_strtolower($model->taxReference->title,'UTF-8')).' ('.$model->taxReference->abbr.')'
                     .' без посредников стоимостью аренды от собственника Москвы.'
                    : ' | Аренда коммерческой недвижимости по ИФНС в Москве без комиссии. Снять нежилое офисное, банковское, торговое' 
                     .' помещение либо бизнес центр, банк, здание, особняк по инспециям федеральной налоговой службы, без посредников стоимостью аренды от собственника Москвы.');

if ($model->taxReference) $this->pageDescription= trim($model->taxReference->seo_desc)<>'' 
                                        ? 'Здесь отобраны предложения по аренде коммерческой недвижимости Москвы, c регистрацией в '.str_replace('инспекция','инспекции',mb_strtolower($model->taxReference->title,'UTF-8')).' ('.$model->taxReference->abbr.')'
                                          .'. '.$model->taxReference->seo_desc  
                                        : 'Здесь отобраны предложения по аренде коммерческой недвижимости Москвы, c регистрацией в '.str_replace('инспекция','инспекции',mb_strtolower($model->taxReference->title,'UTF-8')).' ('.$model->taxReference->abbr.').'
                                         .' Предложения включают аренду офисов, банковских, торговых помещений в бизнес центре, парке, жилом комплексе, доме, особняке, здании,'
                                         .' медцентре, банке Москвы, а также аренду бизнес центров, банков, особняков и зданий целиком по '.$model->taxReference->abbr.'.'
                                         .' Аренда коммерческой недвижимости '.$model->taxReference->abbr
                                         .' также отличается видом, объектом размещения, классом, адресом, назначением, свойствами, удаленностью от метро, площадью, стоимостью, валютой.';                   
else $this->pageDescription=Yii::t('all','Здесь отобраны предложения аренды коммерческой недвижимости по ИФНС в Москве. Предложения включают аренду' 
                                        .' офисов, банковских, торговых помещений в бизнес центре, парке, жилом комплексе, доме, особняке, здании, медцентре, банке Москвы, а также'
                                        .' аренду бизнес центров, банков, особняков и зданий целиком отличающихся между регистрацией в ИФНС. Кроме того аренда коммерческой недвижимости отличается '
                                        .' между собой свойствами, видом, объектом размещения, классом, расположением в москве, назначением, удаленностью от метро, площадью, арендной ставкой, стоимостью, валютой расчетов.');

if ($model->taxReference->title) $this->pageKeywords= trim($model->taxReference->seo_keywords)<>'' 
                                        ? array_merge( explode(',', 'аренда '.mb_strtolower($model->taxReference->abbr,'UTF-8')
                                                                 //.', аренда '.mb_strtolower($model->taxReference->title,'UTF-8')
                                                                 //.', аренда москва '.mb_strtolower($model->taxReference->abbr,'UTF-8')
                                                                 .', аренда москва '.mb_strtolower($model->taxReference->abbr,'UTF-8')
                                                                 //.', аренда москва '.mb_strtolower($model->taxReference->title,'UTF-8')
                                                                 .', аренда в москве '.mb_strtolower($model->taxReference->abbr,'UTF-8')
                                                                 //.', аренда в москве '.mb_strtolower($model->taxReference->title,'UTF-8')                                                
                                                                 .', аренда '.mb_strtolower($model->taxReference->abbr,'UTF-8').' москва'
                                                                 //.', аренда офисов '.mb_strtolower($model->taxReference->title,'UTF-8').' москвы'  
                                                .                ','.mb_strtolower($model->taxReference->title,'UTF-8')
                                                                 .', '.mb_strtolower($model->taxReference->abbr,'UTF-8')
                                                                 .', снять, каталог недвижимости, недвижимость, коммерческая недвижимость, аренда, инспекция, ифнс, москва, в москве, москвы, офис, район, метро, от метро, планировка, парковка, вид, класс, налоговая, налогообложение, отдельный вход, кк, свойства, арендная ставка, стоимость в месяц'
                                                               ),
                                                                        // Отсеиваиваем ключевые слова для короткой формы
                                                                        $short ? HRu::iskeyintxt(explode(',',$model->areas->seo_keywords),                                                   
                                                                                 HRu::cutstr($model->taxReference->anons,750, false, '.','. ')
                                                                            .' '.HRu::cutstr($model->taxReference->detile,1500, false, '.','. ')
                                                                            .' '.HRu::cutstr($model->taxReference->description,1000, false, '.','. '))
                                                                        : explode(',',$model->taxReference->seo_keywords))                          
                                        : explode(',', 'аренда '.mb_strtolower($model->taxReference->abbr,'UTF-8')
                                                                 //.', аренда '.mb_strtolower($model->taxReference->title,'UTF-8')
                                                                 //.', аренда москва '.mb_strtolower($model->taxReference->abbr,'UTF-8')
                                                                 .', аренда москва '.mb_strtolower($model->taxReference->abbr,'UTF-8')
                                                                 //.', аренда москва '.mb_strtolower($model->taxReference->title,'UTF-8')
                                                                 .', аренда в москве '.mb_strtolower($model->taxReference->abbr,'UTF-8')
                                                                 //.', аренда в москве '.mb_strtolower($model->taxReference->title,'UTF-8')                                                
                                                                 .', аренда '.mb_strtolower($model->taxReference->abbr,'UTF-8').' москва'
                                                                 //.', аренда офисов '.mb_strtolower($model->taxReference->title,'UTF-8').' москвы'  
                                                .                ','.mb_strtolower($model->taxReference->title,'UTF-8')
                                                                 .', '.mb_strtolower($model->taxReference->abbr,'UTF-8')
                                                                 .', снять, каталог недвижимости, недвижимость, коммерческая недвижимость, аренда, инспекция, ифнс, москва, в москве, москвы, офис, район, метро, от метро, планировка, парковка, вид, класс, налоговая, налогообложение, отдельный вход, кк, свойства, арендная ставка, стоимость в месяц');                   
else $this->pageKeywords=explode(',', 'снять, в москве, москва, москвы, каталог недвижимости, коммерческая недвижимоcть, недвижимость, аренда, офис, ифнс, инспеция, федеральная налоговая служба, москва, в москве, москвы, офис, район, метро, от метро, планировка, парковка, вид, класс, налоговая, налогообложение, отдельный вход, кк, свойства, арендная ставка, стоимость в месяц');    

$this->pageKeywords= array_unique($this->pageKeywords);
natsort($this->pageKeywords);

if ($model->taxReference) {
    $this->breadcrumbs=array(	
         Yii::t('menu-adm','List Realestates')=>array('index'),
         'по ИФНС'=>array('realestates/taxReference'),
	 "Аренда коммерческой недвижимости ".$model->taxReference->abbr." в Москве",
    );
} else {
    $this->breadcrumbs=array(	
         Yii::t('menu-adm','List Realestates')=>array('index'),
	 'Аренда коммерческой недвижимости по ИФНС',
    );
}
?>

<?php  
    // Подключение скрипта обработки кнопки поиска и кнопок елемента
    $this->renderPartial('/realestates/include/_script_sub');
?>

<?php
    // Переменная $extraRowExpression    
    include __DIR__ . '/include/_var_fav.php';
?>


<div id="content"  >
<div class="content fs-13 ff-tahoma" >   
<h1>
<?php echo //Yii::t('all','Коммерческая недвижимость').' | '.
           ($model->taxReference 
                    ? 'Аренда коммерческой недвижимости по '.$model->taxReference->abbr.' в Москве без комиссии.'
                     .' Снять нежилое помещение в торговом, бизнес центре, особняке, банке, здании, жилом доме, комлексе, парке либо здание целиком c регистрацией в '.str_replace('инспекция','инспекции',mb_strtolower($model->taxReference->title,'UTF-8'))
                     .' без посредников стоимостью аренды от собственника Москвы.'
                    : 'Аренда коммерческой недвижимости по ИФНС в Москве без комиссии. Снять нежилое офисное, банковское, торговое' 
                     .' помещение либо бизнес центр, банк, здание, особняк целиком по инспециям федеральной налоговой службы, без посредников стоимостью аренды от собственника Москвы.');
?>    
</h1>
<?php if ( $model->taxReference->anons ) {  ?>    
<div class="desc m-b18 fs-11 ff-Arial justify">    
    <?php if ($short) { ?>
    <?php echo str_replace(",","",HRu::cutstr($model->taxReference->anons,750, false, '.','. ')); ?>
    <?php } else { ?>
    <?php echo $model->taxReference->anons; ?> 
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
<?php  
    // Подключение скрипта обработки url для нормализации передачи параметров
    $this->renderPartial('/realestates/include/_script_geturl');
?>

<?php 
    // Подключение социальной сети
    $this->renderPartial('/realestates/_social',array('model'=>(object)array('title'=>$this->pageTitle)));?>

<?php
    // Переменная $extraRowExpression    
    include __DIR__ . '/include/_var_extrowexp_tax_reference.php';
?>

<?php
    // Переменная $AprsPicScrID - массив свойств поля картинки для грида
    include __DIR__ . '/include/_var_picscrid.php';
?>

<?php
    // Переменная $beforeAjaxUpdate       
    include __DIR__ . '/include/_var_befajaxupdate.php';
?> 

<?php
    // Переменная $beforeAjaxUpdate       
    include __DIR__ . '/include/_var_aftajaxupdate.php';
?> 

<?php 
    $model->search()->pagination->route = Yii::app()->createUrl('/realestates/taxReference', array('id'=>$model->number_tax));
?>

<?php $this->widget('ext.groupgridview.GroupGridView'/*zii.widgets.grid.CGridView'*/, array(
	'id'=>'realestates-grid',          
	'dataProvider'=>$model->search($short ? 8 : 10),
        /*'mergeColumns' => array('title'),
        'mergeType' => 'nested',*/
        /*'selectableRows'=>2,
        'selectionChanged'=>true,*/
        'extraRowColumns'=>array('anons'),
        'extraRowPos'=>'below',
        'extraRowExpression'=> $extraRowExpression,                                             
        //'ajaxUrl'=>Yii::app()->createUrl('/realestates/class'),
        'ajaxUrl'=>$property->is_all ? Yii::app()->createUrl('/realestates/taxReference') : Yii::app()->createUrl('/realestates/taxReference',array('id'=>$model->number_tax)),
        'beforeAjaxUpdate'=> $beforeAjaxUpdate,
        'afterAjaxUpdate'=> $afterAjaxUpdate,
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
           $AprsPicScrID, // Массив свойств колонки с картинкой  
           array( 'name'=>'title', 'type'=>'raw',
                  'value'=> 'CHtml::link($data->title,Yii::app()->controller->createUrl("/realestates/".$data->primaryKey), array("title"=>"Коммерческая недвижимость / Аренда ".mb_strtolower($data->realestateVid->namewhat,"UTF-8")." в Москве - ".$data->title ))',
                  'headerHtmlOptions'=>array('width'=>'150'),
                  'htmlOptions'=>array('style'=>'width:150px;'),
                  'visible'=>true,
                ),                  
           array( 'name'=>'realestate_vid_id',
                  'header'=>Yii::t('all','Снять'),
                  'type'=>'text',
                  'htmlOptions'=>array('style'=>'text-align:center;width:25'/*60px;'/*25px*/),
                  'value'=>'$data->realestateVid->abbr;',                   
                  'filter'=>CHtml::listData(RealestateVids::model()->findAll(
                                                array("condition"=>"(t.act IS NULL OR t.act=1) AND (t.del IS NULL OR t.del=0)",
                                                      "select"=>'t.id,t.abbr',
                                                      "order"=>"sort_main")
                                            ), 'id', 'abbr'),
                  'headerHtmlOptions'=>array('width'=>'25'/*'60'/*25px*/),
                  'visible'=>true,
                ),
           array( 'name'=>'realestate_type_id',
                  'header'=>Yii::t('all','в/цел'),
                  'type'=>'text',
                  'htmlOptions'=>array('style'=>'text-align:center;width:25;'/*60px;'/*25px*/),
                  'value'=>'$data->realestateType->abbr;',                   
                  'filter'=>CHtml::listData(RealestateTypes::model()->findAll(
                                                array("condition"=>"(t.act IS NULL OR t.act=1) AND (t.del IS NULL OR t.del=0)",
                                                      "select"=>'t.id,t.abbr',
                                                      "order"=>"sort_main")
                                            ), 'id', 'abbr'),
                  'headerHtmlOptions'=>array('width'=>'25'/*'60'/*25px*/),
                  'visible'=>true,
                ),   
           array( 'name'=>'number_tax',
                  'header'=>Yii::t('all','№ ИФНС'),  
                  'type'=> 'html',
                  'filter'=>CHtml::activeHiddenField($model,'number_tax'),                  
                  'value'=>'$data->number_tax;',  
                  'htmlOptions'=>array('style'=>'text-align:center;width:30px;'),
                  'headerHtmlOptions'=>array('width'=>'30'),
                  'visible'=>!$property->is_all,
                ),              
          array(  'name'=>'number_tax',
                  'header'=>Yii::t('all','№ ИФНС'),
                  'type'=>'text',                  
                  'value'=>'$data->number_tax;',                     
                  'htmlOptions'=>array('style'=>'width:30px;text-align:center;'),
                  'headerHtmlOptions'=>array('width'=>'30'),
                  'visible'=>$property->is_all,
                ),               
           array( 'name'=>'realestate_class_id',
                  'header'=> Yii::t('grid','Class'),
                  'type'=>'text',
                  'value'=>'$data->realestateClass->abbr;',
                  'htmlOptions'=>array('style'=>'text-align:center;width:30px;'/*30px*/),
                  'filter'=>CHtml::listData(RealestateClasses::model()->findAll(
                                                array("condition"=>"(t.act IS NULL OR t.act=1) AND (t.del IS NULL OR t.del=0)",
                                                      "select"=>'t.id,t.abbr',
                                                      "order"=>"sort")
                                            ), 'id', 'abbr'),
                  'headerHtmlOptions'=>array('width'=>'30'/*30px*/),
                  'visible'=>false,
                ),            
           array( 'name'=>'district_id',
                  'header'=>Yii::t('all','District'),
                  'type'=>'text',
                  'value'=>'$data->district->title;',
                  'htmlOptions'=>array('style'=>'width:100px;'/*60px*/),
                  'filter'=>CHtml::listData(Districts::model()->findAll(
                                                array("condition"=>"(t.act IS NULL OR t.act=1) AND (t.del IS NULL OR t.del=0)",
                                                      "select"=>'t.id,t.title',
                                                      "order"=>"sort")
                                            ), 'id', 'title'),
                  'headerHtmlOptions'=>array('width'=>'100'/*60px*/),
                  'visible'=>true,
                ),  
           array( 'name'=>'areas_id',
                  'header'=>Yii::t('all','Areas'),
                  'type'=>'text',
                  'value'=>'$data->areas->title;',
                  'htmlOptions'=>array('style'=>'width:100px;'/*60px*/),
                  'filter'=>CHtml::listData(Areas::model()->findAll(
                                                array("condition"=>"(t.act IS NULL OR t.act=1) AND (t.del IS NULL OR t.del=0)",
                                                      "select"=>'t.id,t.title',
                                                      "order"=>"sort")
                                            ), 'id', 'title'),
                  'headerHtmlOptions'=>array('width'=>'100'/*60px*/),
                  'visible'=>false,
                ),              
           array( 'name'=>'metro_id',
                  'header'=>Yii::t('all','Metro'),
                  'type'=>'text',
                  'value'=>'$data->metro->title;',
                  'htmlOptions'=>array('style'=>'width:100px;'/*60px*/),               
                  //'filter'=>CHtml::activeListBox( $model, 'metro_id', CHtml::listData(Metros::model()->findAll(), 'id', 'title'), array("multiple"=>"multiple","size"=>3)),               
                  'filter'=>CHtml::listData(Metros::model()->findAll(
                                                array('select'=>'t.id,t.title')
                                            ), 'id', 'title'),
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
                  'filter'=>CHtml::listData(Units::model()->findAll(
                                                array("condition"=>"(t.act IS NULL OR t.act=1) AND (t.del IS NULL OR t.del=0)",
                                                      "select"=>'t.id,t.short_title',
                                                      "order"=>"sort")
                                            ), 'id', 'short_title'),
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
                  'filter'=>CHtml::listData(Plannings::model()->findAll(
                                                array("condition"=>"(t.act IS NULL OR t.act=1) AND (t.del IS NULL OR t.del=0)",
                                                      "select"=>'t.id,t.abbr',
                                                      "order"=>"sort")                          
                                            ), 'id', 'abbr'),              
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
                  'filter'=>CHtml::listData(Valutes::model()->findAll(
                                                array("condition"=>"(t.act IS NULL OR t.act=1) AND (t.del IS NULL OR t.del=0)",
                                                      "select"=>'t.id,t.title',
                                                      "order"=>"sort")                          
                                            ), 'id', 'title'),              
                  'value'=>'$data->valute->title',
                  'htmlOptions'=>array('style'=>'width:50px;text-align:right;'),
                  'headerHtmlOptions'=>array('width'=>'50'),
                  'visible'=>true,
                ),     
          array(  'name'=>'tax_id',
                  'header'=>Yii::t('all','Tax'),
                  'type'=>'text',
                  'filter'=>CHtml::listData(Taxs::model()->findAll(
                                                array("condition"=>"(t.act IS NULL OR t.act=1) AND (t.del IS NULL OR t.del=0)",
                                                      "select"=>'t.id,t.abbr',
                                                      "order"=>"sort")                          
                                            ), 'id', 'abbr'),              
                  'value'=>'$data->tax->abbr',                     
                  'htmlOptions'=>array('style'=>'width:20px;text-align:center;'),
                  'headerHtmlOptions'=>array('width'=>'20'),
                  'visible'=>false,
                ),             
          array(  'name'=>'parking_id',
                  'header'=>Yii::t('all','Parking'),
                  'type'=>'text',
                  'value'=>'$data->parking->abbr',                     
                  'filter'=>CHtml::listData(Parkings::model()->findAll(
                                                array("condition"=>"(t.act IS NULL OR t.act=1) AND (t.del IS NULL OR t.del=0)",
                                                      "select"=>'t.id,t.abbr',
                                                      "order"=>"sort")                          
                                            ), 'id', 'abbr'), 
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
                  'filter'=>CHtml::listData(Commissions::model()->findAll(
                                                array("condition"=>"(t.act IS NULL OR t.act=1) AND (t.del IS NULL OR t.del=0)",
                                                      "select"=>'t.id,t.abbr',
                                                      "order"=>"sort")                          
                                            ), 'id', 'abbr'), 
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
          array(  'name'=>'operation_id',
                  'header'=>Yii::t('all','Operation'),
                  'type'=>'text',
                  'filter'=>CHtml::listData(Operations::model()->findAll(
                                                array("condition"=>"(t.act IS NULL OR t.act=1) AND (t.del IS NULL OR t.del=0)",
                                                      "select"=>'t.id,t.abbr',
                                                      "order"=>"sort")                          
                                            ), 'id', 'abbr'), 
                  'value'=>'$data->operation->abbr;',                     
                  'htmlOptions'=>array('style'=>'width:80px;text-align:center;'),
                  'headerHtmlOptions'=>array('width'=>'80'),
                  'visible'=>false,
                ),               
          array(  'name'=>'coefficient_corridor', 
                  'type'=>'text',
                  'filter'=>array_combine(range(1,26,1),range(5,30,1)), 
                  'value'=>'$data->getCoefficient();',                                                    
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
  
<?php $isbr = false; ?>    
<?php if ($is_list) { // Вывод линков аренды вида рядом со станцией метро ?>
<?php      if (!$isbr) { $isbr = true; ?> <br/> <?php } ?>   
<?php      $this->renderPartial('/site/_list_metros', array('model'=>$model)); ?>             
<?php } ?> 
    
<?php if ( $model->realestateClass->detile ) {  ?>    
<?php $isbr = true; ?>
    <div class="desc detile m-t16 m-b18 fs-10 ff-tahoma">   
        <?php if ($short) { ?>
        <?php echo str_replace(",","",HRu::cutstr($model->taxReference->detile,1500, false, '.','. ')); ?>
        <?php } else { ?>
        <?php echo $model->realestateClass->detile; ?>
        <?php } ?>                   
    </div>
<? } ?>  
      
<?php if (!$is_list) { // Вывод линков аренды вида располагающихся на улица, проезде и т.д. ?>
<?php      if (!$isbr) { $isbr = true; ?> <br/> <?php } ?>   
<?php     $this->renderPartial('/site/_list_streets', array('model'=>$model)); ?> 
<?php } ?>
            
<?php if ( $model->realestateClass->description ) {  ?>    
<?php $isbr = true; ?>
   <div class="desc detile m-b18 fs-10 ff-tahoma">    
        <?php if ($short) { ?>
        <?php echo str_replace(",","",HRu::cutstr($model->taxReference->description,1000, false, '.','. ')); ?>
        <?php } else { ?>
        <?php echo $model->realestateClass->description; ?>
        <?php } ?>                      
   </div>
<? } ?>   
      
<?php if (!$is_list) { // Вывод линков аренды вида по районам ?>
<?php      if (!$isbr) { $isbr = true; ?> <br/> <?php } ?>   
<?php     $this->renderPartial('/site/_list_areas', array('model'=>$model)); ?>              
<?php } ?>

</div>

<? $this->renderPartial('/realestates/include/_script_vimg_i_sec'); ?>    

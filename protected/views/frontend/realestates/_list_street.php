<?php 
$short = true;
$is_list = false;

$this->pageTitle=Yii::t('all','Коммерческая недвижимость')
                .($model->street 
                  ? ($property->is_ceil 
                     ? ' | Аренда '.mb_strtolower($property->namewhats,'UTF-8').' '.$model->street->getFullName('на').' в Москве без комиссии.'
                      .' Снять '.mb_strtolower($property->title,'UTF-8').' '.$model->street->getFullName('по').' целиком, без посредников'
                      .' от собственника Москвы.'
                     : ' | Аренда '.mb_strtolower($property->namewhats,'UTF-8').' '.$model->street->getFullName('на').' в Москве без комиссии.'
                      .' Снять '.mb_strtolower($property->title,'UTF-8').' в бизнес центре, особняке, банке, административном здании, жилом доме,'
                      .' комлексе, парке, торговом центре '.$model->street->getFullName('по').', без посредников по стоимости аренды от собственника Москвы.')
                  : ($property->is_ceil 
                     ? ' | Аренда '.mb_strtolower($property->namewhats,'UTF-8').' по расположению в Москве без комиссии.'
                      .' Снять '.mb_strtolower($property->title,'UTF-8').' различных классов, без посредников по стоимости аренды от собственника Москвы.' 
                     : ' | Аренда '.mb_strtolower($property->namewhats,'UTF-8').' по расположению в Москве без комиссии.'
                      .' Снять '.mb_strtolower($property->title,'UTF-8').' на улице, аллее, бульваре, городке, шоссе, квартале, набережной, переулке,'
                      .' площаде, проспекте, проезде, просеке, тупике Москвы, без посредников по стоимости аренды от собственника. Москвы.'));
                  //.($property->seo_title ? ', '.$property->seo_title : '');
                  //." - ".str_replace('офисов','офиса', Yii::t('all',Yii::app()->name));    

if ($model->street) $this->pageDescription= trim($model->street->seo_desc)<>'' 
                                        ? 'Здесь отобраны предложения по аренде '.mb_strtolower($property->namewhats,'UTF-8').' '.$model->street->getFullName('на')
                                          .' в Москве. '                                          
                                          .$model->street->seo_desc 
                                        : 'Здесь отобраны предложения по аренде '.mb_strtolower($property->namewhats,'UTF-8').' '.$model->street->getFullName('на')
                                          .' в Москве.';                   
else $this->pageDescription= 'Здесь отобраны предложения по аренде '.mb_strtolower($property->namewhats,'UTF-8').' по разположению в Москве. ';
$this->pageDescription=$this->pageDescription.($property->seo_description ? ' '.$property->seo_description : '');
if ( !$property->seo_description && !$model->street->seo_desc) {
    if ($model->street) {
        $this->pageDescription = ($property->is_ceil 
                                  ? 'Предложения включают аренду '.mb_strtolower($property->namewhats,'UTF-8').' '.$model->street->getFullName('на')
                                   .' в Москве. Аренда '.mb_strtolower($property->namewhats,'UTF-8').' по '.$model->street->title
                                   .' отличается адресом, назначением, свойствами, удаленностью от метро, площадью, стоимостью, валютой.'
                                  : 'Предложения включают аренду '.mb_strtolower($property->namewhats,'UTF-8').' '.$model->street->getFullName('на')
                                   .' в бизнес центре, парке, жилом комплексе, доме, особняке, здании, медцентре, банке Москвы.'
                                   .' Аренда '.mb_strtolower($property->namewhats,'UTF-8').' по '.$model->street->title.' отличается объектом размещения,'
                                   .' адресом, назначением, свойствами, удаленностью от метро, площадью, стоимостью, валютой.');
    }else{
        $this->pageDescription = ($property->is_ceil 
                                  ? 'Предложения включают аренду '.mb_strtolower($property->namewhats,'UTF-8').' целиком по расположению'
                                   .' в Москве. Аренда '.mb_strtolower($property->namewhats,'UTF-8').' на улице, аллее, бульваре,'
                                   .' городке, шоссе, квартале, набережной, переулке, площаде, проспекте, проезде, просеке, тупике Москвы'
                                   .' классом, назначением, свойствами, удаленностью от метро, площадью, стоимостью, валютой.'
                                  : 'Предложения включают аренду '.mb_strtolower($property->namewhats,'UTF-8').' на улице, аллее, бульваре,'
                                   .' городке, шоссе, квартале, набережной, переулке, площаде, проспекте, проезде, просеке, тупике Москвеы.'
                                   .' Аренда '.mb_strtolower($property->namewhats,'UTF-8').' по расположению в Москве отличается объектом размещения, классом,'
                                   .' назначением, свойствами, удаленностью от метро, площадью, стоимостью, валютой.');
        
    }
}

if ($model->street->title) $this->pageKeywords= trim($model->street->seo_keywords)<>''
                                                  ? array_merge( 
                                                          explode(',', mb_strtolower($model->street->getFullName(),'UTF-8') //улица Мира
                                                                      .", ".mb_strtolower($model->street->getFullName('на'),'UTF-8')//на улице Мира
                                                                      .", ".mb_strtolower($model->street->title,'UTF-8') // ул.Мира
                                                                      .", ".mb_strtolower($model->street->name,'UTF-8') // Мира
                                                                      .", ".mb_strtolower($model->street->SOCR,'UTF-8') // ул.
                                                                  
                                                                    .($property->title 
                                                                       ?  ", аренда ".mb_strtolower($property->namewhats,'UTF-8')." ".mb_strtolower($model->street->getFullName('на'),'UTF-8') // аренда офиса на улице мира
                                                                         .", аренда ".mb_strtolower($property->namewhat,'UTF-8')." ".mb_strtolower($model->street->getFullName('на'),'UTF-8')  // аренда офисов на улице мира  
                                                                         //.", аренда ".mb_strtolower($property->namewhat,'UTF-8')." в москве"   // аренда офиса в москве          
                                                                         //.", аренда ".mb_strtolower($property->namewhats,'UTF-8')." в москве"  // аренда офисов в москве      
                                                                         //.", аренда ".mb_strtolower($property->namewhat,'UTF-8')." москвы"   // аренда офиса москвы    
                                                                         //.", аренда ".mb_strtolower($property->namewhat,'UTF-8')." москвы"   // аренда офисов москвы                                                                                
                                                                         //+.", аренда ".mb_strtolower($property->title,'UTF-8')      // аренда офис
                                                                         //+.", аренда ".mb_strtolower($property->namewhats,'UTF-8')  // аренда офиса  
                                                                         //+.", аренда ".mb_strtolower($property->namewhat,'UTF-8')   // аренда офисов                                                                      
                                                                         //+.", ".mb_strtolower($model->street->title,'UTF-8')." аренда ".mb_strtolower($property->namewhat,'UTF-8') // ул.мира аренда офиса                                                                                                                                                     
                                                                         //+.", ".mb_strtolower($model->street->title,'UTF-8')." аренда ".mb_strtolower($property->namewhats,'UTF-8') // ул.мира аренда офисов                                                                              
                                                                         .", ".mb_strtolower($model->street->getFullName(),'UTF-8')." аренда ".mb_strtolower($property->namewhat,'UTF-8') //улица мира аренда офиса                                                                                                                                                                                                                                     
                                                                         .", ".mb_strtolower($model->street->getFullName(),'UTF-8')." аренда ".mb_strtolower($property->namewhats,'UTF-8') //улица мира аренда офисов
                                                                         .", ".mb_strtolower($property->title,'UTF-8')." ".mb_strtolower($model->street->getFullName('на'),'UTF-8') // офис на ул.Мира 
                                                                         .", ".mb_strtolower($property->title,'UTF-8')  // офис   
                                                                         .", ".mb_strtolower($property->namewhats,'UTF-8') // офисов
                                                                         .", ".mb_strtolower($property->namewhat,'UTF-8')  // офиса                                                                                 
                                                                         : "")          
                                                                    .($property->abbr 
                                                                       ? //+", аренда ".mb_strtolower($property->abbr,'UTF-8')    // аренда бц
                                                                         //+.", аренда ".mb_strtolower($property->abbr,'UTF-8')." в москве"  // аренда бц в москве   
                                                                         ", ".mb_strtolower($property->abbr,'UTF-8')." ".mb_strtolower($model->street->getFullName('на'),'UTF-8') // бц на улице мира
                                                                         .", ".mb_strtolower($property->abbr,'UTF-8') // бц    
                                                                         : "")                                                                                                                                                      
                                                                      .", снять, каталог недвижимости, недвижимость, аренда в москве, аренда, москва, москвы, москве, класса, коммерческой недвижимости, округ, район, улица, метро, удаленность, вид, свойства, площадь, м2, планировка, парковка, стоимость в месяц, налогооблажение"),                   
                                                                 // Отсеиваиваем ключевые слова для короткой формы
                                                                 $short ? HRu::iskeyintxt(explode(',',$model->street->seo_keywords),                                                   
                                                                                 HRu::cutstr($model->street->anons,750, false, '.','. ')
                                                                            .' '.HRu::cutstr($model->street->detile,1500, false, '.','. ')
                                                                            .' '.HRu::cutstr($model->street->description,1000, false, '.','. '))
                                                                         : explode(',',$model->street->seo_keywords) )
                                                  : explode(',', mb_strtolower($model->street->getFullName(),'UTF-8') //улица Мира
                                                                      .", ".mb_strtolower($model->street->getFullName('на'),'UTF-8')//на улице Мира
                                                                      .", ".mb_strtolower($model->street->title,'UTF-8') // ул.Мира
                                                                      .", ".mb_strtolower($model->street->name,'UTF-8') // Мира
                                                                      .", ".mb_strtolower($model->street->SOCR,'UTF-8') // ул.
                                                                  
                                                                    .($property->title 
                                                                       ?  ", аренда ".mb_strtolower($property->namewhats,'UTF-8')." ".mb_strtolower($model->street->getFullName('на'),'UTF-8') // аренда офиса на улице мира
                                                                         .", аренда ".mb_strtolower($property->namewhat,'UTF-8')." ".mb_strtolower($model->street->getFullName('на'),'UTF-8')  // аренда офисов на улице мира  
                                                                         //.", аренда ".mb_strtolower($property->namewhat,'UTF-8')." в москве"   // аренда офиса в москве          
                                                                         //.", аренда ".mb_strtolower($property->namewhats,'UTF-8')." в москве"  // аренда офисов в москве      
                                                                         //.", аренда ".mb_strtolower($property->namewhat,'UTF-8')." москвы"   // аренда офиса москвы    
                                                                         //.", аренда ".mb_strtolower($property->namewhat,'UTF-8')." москвы"   // аренда офисов москвы                                                                                
                                                                         //+.", аренда ".mb_strtolower($property->title,'UTF-8')      // аренда офис
                                                                         //+.", аренда ".mb_strtolower($property->namewhats,'UTF-8')  // аренда офиса  
                                                                         //+.", аренда ".mb_strtolower($property->namewhat,'UTF-8')   // аренда офисов                                                                      
                                                                         //+.", ".mb_strtolower($model->street->title,'UTF-8')." аренда ".mb_strtolower($property->namewhat,'UTF-8') // ул.мира аренда офиса                                                                                                                                                     
                                                                         //+.", ".mb_strtolower($model->street->title,'UTF-8')." аренда ".mb_strtolower($property->namewhats,'UTF-8') // ул.мира аренда офисов                                                                              
                                                                         .", ".mb_strtolower($model->street->getFullName(),'UTF-8')." аренда ".mb_strtolower($property->namewhat,'UTF-8') //улица мира аренда офиса                                                                                                                                                                                                                                     
                                                                         .", ".mb_strtolower($model->street->getFullName(),'UTF-8')." аренда ".mb_strtolower($property->namewhats,'UTF-8') //улица мира аренда офисов
                                                                         .", ".mb_strtolower($property->title,'UTF-8')." ".mb_strtolower($model->street->getFullName('на'),'UTF-8') // офис на ул.Мира 
                                                                         .", ".mb_strtolower($property->title,'UTF-8')  // офис   
                                                                         .", ".mb_strtolower($property->namewhats,'UTF-8') // офисов
                                                                         .", ".mb_strtolower($property->namewhat,'UTF-8')  // офиса                                                                                 
                                                                         : "")          
                                                                    .($property->abbr 
                                                                       ? //+", аренда ".mb_strtolower($property->abbr,'UTF-8')    // аренда бц
                                                                         //+.", аренда ".mb_strtolower($property->abbr,'UTF-8')." в москве"  // аренда бц в москве   
                                                                         ", ".mb_strtolower($property->abbr,'UTF-8')." ".mb_strtolower($model->street->getFullName('на'),'UTF-8') // бц на улице мира
                                                                         .", ".mb_strtolower($property->abbr,'UTF-8') // бц    
                                                                         : "")                                                                                                                                                      
                                                                      .", снять, каталог недвижимости, недвижимость, аренда в москве, аренда, москва, москвы, москве, класса, коммерческой недвижимости, округ, район, улица, метро, удаленность, вид, свойства, площадь, м2, планировка, парковка, стоимость в месяц, налогооблажение");                   
else $this->pageKeywords=explode(',', 'снять, аренда в москве, каталог недвижимости, коммерческая недвижимость, аренда, офис, москва, москве, москвы, улица, проезд, аллея, бульвар, городок, шоссе, квартал, набережная, переулок, площадь, проспект, проезд, просек, тупик, класса, коммерческой недвижимости, округ, район, улица, метро, удаленность, вид, свойства, площадь, м2, планировка, парковка, стоимость в месяц, налогооблажение');    
$this->pageKeywords=$property->seo_keywords 
                        ? array_merge($this->pageKeywords,
                                      // Отсеиваиваем ключевые слова для короткой формы
                                      $short ? HRu::iskeyintxt( explode(',',$property->seo_keywords),                                                   
                                                        HRu::cutstr($property->anons,750, false, '.','. ')
                                                   .' '.HRu::cutstr($property->detile,1500, false, '.','. ')
                                                   .' '.HRu::cutstr($property->description,1000, false, '.','. '))
                                             : explode(',',$property->seo_keywords)) 
                        : $this->pageKeywords;

$this->pageKeywords= array_unique($this->pageKeywords);
natsort($this->pageKeywords);

$this->breadcrumbs=array(	
         Yii::t('menu-adm','List Realestates')=>array('index'),
	 ( $model->street->title 
             /*? "Аренда офисов "               
               ." ".$model->street->getFullName('на')
               ." Москвы (".$model->street->title.")"
             : "Аренда офисов в Москве на всех улицах "*/
             ? $model->street->getFullName()
             : "все улицы "
         )=>Yii::app()->createUrl('realestates/street', array('id'=>$model->street->id)),
          ( $model->street->title 
             ? "Аренда ".mb_strtolower($property->namewhats,'UTF-8')            
               ." ".$model->street->getFullName('на')               
             : "Аренда ".mb_strtolower($property->namewhats,'UTF-8')." все улицы")//.($property->breadcrumbs ? ', '.$property->breadcrumbs : '').' в Москве '
);

if ($model->street&&$property->namewhats) {
    
        $this->breadcrumbs=array(	
             Yii::t('menu-adm','List Realestates')=>array('index'),
             'по расположению '=>array('realestates/street'),
             $model->street->title=>Yii::app()->createUrl('realestates/street',array('id'=>$model->street->id)),
             'по видам'=>array('realestates/vid'),
              mb_strtolower($property->nameov,'UTF-8')=>Yii::app()->createUrl('realestates/vid',array('id'=>$model->realestateVid->id)),
             'Аренда '.mb_strtolower($property->namewhats,'UTF-8')." ".$model->street->getFullName('на')." в Москве"
        );

} else if (!$model->street && $property->namewhats) {
    
        $this->breadcrumbs=array(	
             Yii::t('menu-adm','List Realestates')=>array('index'),
             'по расположению '=>array('realestates/street'),
             'по видам'=>array('realestates/vid'),
              mb_strtolower($property->nameov,'UTF-8')=>Yii::app()->createUrl('realestates/vid',array('id'=>$model->realestateVid->id)),
             'Аренда '.mb_strtolower($property->namewhats,'UTF-8')." в Москве по расположению"
        );
} else if ($model->realestateClass->abbr && !$property->namewhats) {

        $this->breadcrumbs=array(	
             Yii::t('menu-adm','List Realestates')=>array('index'),
             'по расположению '=>array('realestates/street'),
             $model->street->title=>Yii::app()->createUrl('realestates/street',array('id'=>$model->street->id)),
             'по видам'=>array('realestates/vid'),
             'Аренда '.mb_strtolower($property->namewhats,'UTF-8')." ".$model->street->getFullName('на')." в Москве"
        );    
} else {
        $this->breadcrumbs=array(	
             Yii::t('menu-adm','List Realestates')=>array('index'),
             //'по расположению'=>array('realestates/street'),
             'по видам'=>array('realestates/vid'),
             'Аренда коммерческой недвижимости в Москве по расположению'
        );
}

?>

<?php  
    // Подключение скрипта обработки url для нормализации передачи параметров
    $this->renderPartial('/realestates/include/_script_geturl');
?>

<?php
    // Переменная $extraRowExpression    
    include __DIR__ . '/include/_var_fav.php';
?>

<div id="content"  >
<div class="content fs-13 ff-tahoma" > 
<h1>
    <?php  echo //Yii::t('all','Коммерческая недвижимость')
                ($model->street->title 
                  ? ($property->is_ceil 
                     ? 'Аренда '.mb_strtolower($property->namewhats,'UTF-8').' '.$model->street->getFullName('на').' в Москве без комиссии.'
                      .' Снять '.mb_strtolower($property->title,'UTF-8').' по '.$model->street->title.' целиком, без посредников по стоимости аренды'
                      .' от собственника Москвы.'
                     : 'Аренда '.mb_strtolower($property->namewhats,'UTF-8').' '.$model->street->getFullName('на').' в Москве без комиссии.'
                      .' Снять '.mb_strtolower($property->title,'UTF-8').' в бизнес центре, особняке, банке, адм.здании, жилом доме,'
                      .' комлексе, парке по '.$model->street->title.', без посредников от собственника Москвы.')
                  : ($property->is_ceil 
                     ? 'Аренда '.mb_strtolower($property->namewhats,'UTF-8').' по расположению в Москве без комиссии.'
                      .' Снять '.mb_strtolower($property->title,'UTF-8').' целиком на улице, аллее, бульваре, городке, шоссе, квартале, набережной,'
                      .' переулке, площаде, проспекте, проезде, просеке, тупике, без посредников от собственника Москвы.' 
                     : 'Аренда '.mb_strtolower($property->namewhats,'UTF-8').' по расположению в Москве без комиссии.'
                      .' Снять '.mb_strtolower($property->title,'UTF-8').' в здании, комлексе, парке на улице, аллее, бульваре, городке, шоссе,'
                      .' квартале, набережной, переулке, площаде, проспекте, проезде, просеке, тупике, без посредников от собственника Москвы.'));
    ?>                          
</h1>

<?php if ( $model->street->anons || $property->anons) {  ?>    
<div class="desc anons m-b18 fs-11 ff-Arial justify">    
    <?php if ( $model->street->anons ) {  ?>      
    <div>
    <?php if ($short) { ?>    
    <?php echo str_replace(",","",HRu::cutstr($model->street->anons,750, false, '.','. ')); ?>    
    <?php } else { ?>    
    <?php echo $model->street->anons; ?>
    <?php } ?>    
    </div>    
    <?php } ?>
    <?php if ( $property->anons ) {  ?>    
    <div <?php echo ($model->street->anons ? 'class="m-t10"' : '') ?>>
    <?php if ($short) { ?>    
    <?php echo str_replace(",","",HRu::cutstr($property->anons,750, false, '.','. ')); ?>    
    <?php } else { ?>    
    <?php echo $property->anons; ?>
    <?php } ?>        
    </div>    
    <?php } ?>
</div>
<? } ?>  
    
<?php 

    //$model->search()->pagination->route = Yii::app()->createUrl('/realestates/street', array('id'=>$model->street->id)); 
    $model->search()->pagination->route = Yii::app()->createUrl('/ru/realestates/street/'.$model->street->id.'/vid/'.$model->realestateVid->id); 
    
    //$model->search()->pagination->setPageSize(20);  не срабатывает  
    //$model->search()->sort = 'unit.title';
?>
    
<?php $this->renderPartial('/realestates/_social',array('model'=>(object)array('title'=>$this->pageTitle)));?>
    
<?php
    // Переменная $beforeAjaxUpdate       
    include __DIR__ . '/include/_var_aftajaxupdate_list.php';
?> 

<?php
    // Переменная $beforeAjaxUpdate       
    include __DIR__ . '/include/_var_befajaxupdate_list.php';
?> 
    
<?php $this->widget('application.components.widgets.DSizerListView', array(
        'dataProvider'=>$model->search($short ? 10 : 16,
                array(
                        'unit'=>array(                                
                                'asc'=>'unit.title ASC',
                                'desc'=>'unit.title DESC',
                                'default'=>'desc',
                        ),
                        'areas'=>array(                                
                                'asc'=>'areas.title ASC',
                                'desc'=>'areas.title DESC',
                                'default'=>'desc',
                        ),
                        'district'=>array(                                
                                'asc'=>'district.title ASC',
                                'desc'=>'district.title DESC',
                                'default'=>'desc',
                        ),
                        /*'realestateVid'=>array(                                
                                'asc'=>'realestateVid.title ASC',
                                'desc'=>'realestateVid.title DESC',
                                'default'=>'desc',
                        ),*/
                        'realestateType'=>array(                                
                                'asc'=>'realestateType.title ASC',
                                'desc'=>'realestateType.title DESC',
                                'default'=>'desc',
                        ),                    
                        'realestateClass'=>array(                                
                                'asc'=>'realestateClass.title ASC',
                                'desc'=>'realestateClass.title DESC',
                                'default'=>'desc',
                        ),   
                        'valute'=>array(                                
                                'asc'=>'valute.title ASC',
                                'desc'=>'valute.title DESC',
                                'default'=>'desc',
                        ), 
                        /*'street'=>array(                                
                                'asc'=>'street.title ASC',
                                'desc'=>'street.title DESC',
                                'default'=>'desc',
                        ),*/                                              
                        'metro'=>array(                                
                                'asc'=>'metro.title ASC',
                                'desc'=>'metro.title DESC',
                                'default'=>'desc',
                        ),                          
                        'title',
                        'area',
                        'remoteness',
                        'price',                        
                        //'create_date'
                    )),                
	'itemView'=>'_view_column',
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
                //'lastPageLabel'  => '&gt;&gt;'
                //'pageSize'=>20, не сработает
        ),         
        'sortableAttributes'=>array(
            'title',
            //'create_date',
            'area',
            'remoteness',
            'price',
            'valute'=>'Валюта',
            'unit'=>'Способ',
            'district'=>'Округ',
            'areas'=>'Район',
            'metro'=>'Метро',
            //'realestateVid'=>'Вид',
            'realestateType'=>'В/цел',
            'realestateClass'=>'Класс', 
            //'street'=>'Улица',
        ),
        'sorterHeader'=>'Сортировать по:',
        'template'=>"<hr class='m-t5 m-b5' />{sizer}{sorter}\n<div style='float:left;display:inline-block;'>{pager}</div>{summary}\n<br/>{items}\n<div style='clear:both'></div><div style='float:left;display:inline-block;'>{pager}</div>{summary}",        
        'sizerVariants'=>  HRu::cutarray(array(8, 10, 12, 16, 20, 24, 30),$model->search()->getTotalItemCount()),
        'sizerAttribute'=>'size',
        'sizerHeader'=>'Выводить по: ',
        'short'=>$short,
        'beforeAjaxUpdate'=>$beforeAjaxUpdate,
        'afterAjaxUpdate'=>$afterAjaxUpdate,    
        //'ajaxUrl'=>Yii::app()->createUrl('/ru/realestates/street/'.$model->street->id.'/vid/'.$model->realestateVid->id)
)); ?>      

   <?php   $this->renderPartial('_send',array('model'=>$model_claim));?>

    </div>
    <hr class="m-t10 m-b8" />
    <?php if (!$is_list) { ?>
    <?php   $this->renderPartial('/site/_list_metros', array('model'=>$model)); ?>  
    <?php } ?>    
    
    <?php if ( $model->street->detile || $property->detile ) {  ?>    
    <div class="desc detile m-t8 m-b14 fs-10 ff-tahoma">    
        <?php if ( $model->street->detile ) {  ?>      
            <div>
            <?php if ($short) { ?>    
            <?php echo str_replace(",","",HRu::cutstr($model->street->detile,1500, false, '.','. ')); ?>    
            <?php } else { ?>    
            <?php echo $model->street->detile; ?>
            <?php } ?>                             
            </div>    
        <?php } ?>
        <?php if ( $property->detile ) {  ?>    
            <div <?php echo ($model->street->detile ? 'class="m-t10"' : '') ?>>
            <?php if ($short) { ?>    
            <?php echo str_replace(",","",HRu::cutstr($property->detile,1500, false, '.','. ')); ?>    
            <?php } else { ?>    
            <?php echo $property->detile; ?>
            <?php } ?>                   
            </div>    
        <?php } ?>        
    </div>
    <? } ?>  
    
    <?php//   $this->renderPartial('/site/_list_streets', array('model'=>$model)); ?>  
    
    <?php if ( $model->street->description || $property->description ) {  ?>    
    <div class="desc detile m-b18 fs-10 ff-tahoma">    
        <?php if ( $model->street->description ) {  ?>      
            <div>
            <?php if ($short) { ?>    
            <?php echo str_replace(",","",HRu::cutstr($model->street->description,1000, false, '.','. ')); ?>    
            <?php } else { ?>    
            <?php echo $model->street->description; ?>
            <?php } ?>                 
            </div>    
        <?php } ?>
        <?php if ( $property->description ) {  ?>    
            <div <?php echo ($model->street->description ? 'class="m-t10"' : '') ?>>
            <?php if ($short) { ?>    
            <?php echo str_replace(",","",HRu::cutstr($property->description,1000, false, '.','. ')); ?>    
            <?php } else { ?>    
            <?php echo $property->description; ?>
            <?php } ?>                 
            </div>    
        <?php } ?>                
    </div>
    <? } ?>  
    
    <?php if (!$is_list) { ?>
    <?php   $this->renderPartial('/site/_list_areas', array('model'=>$model)); ?>              
    <?php } ?>
    
</div>
<? $this->renderPartial('/realestates/include/_script_vimg_i_sec_list'); ?>  
<?php 
$short = true;
$is_list = false;

$this->pageTitle=Yii::t('all','Коммерческая недвижимость')
                .($model->district->title 
                  ? ($property->is_ceil 
                     ? ' | Аренда '.mb_strtolower($property->namewhats,'UTF-8').' '.(mb_strtolower($model->district->title,'UTF-8')=="центр" ? "в" : "на")." ".mb_strtolower($model->district->title,'UTF-8')
                      ."е (".mb_strtolower($model->district->abbr,'UTF-8').') Москвы без комиссии.'
                      .' Снять '.mb_strtolower($property->title,'UTF-8').' '.mb_strtolower(str_replace(array('ий','ый','округ'),array('ого','ого','округа'),$model->district->desc),'UTF-8')
                      .' целиком, без посредников по стоимости аренды от собственника в Москве.'
                     : ' | Аренда '.mb_strtolower($property->namewhats,'UTF-8').' '.(mb_strtolower($model->district->title,'UTF-8')=="центр" ? "в" : "на")." ".mb_strtolower($model->district->title,'UTF-8')
                      ."е (".mb_strtolower($model->district->abbr,'UTF-8').') Москвы без комиссии.'
                      .' Снять '.mb_strtolower($property->title,'UTF-8').' в бизнес центре, особняке, банке, здании, жилом доме,'
                      .' комлексе, парке, торговом центре '.mb_strtolower(str_replace(array('ий','ый','округ'),array('ого','ого','округа'),$model->district->desc),'UTF-8')
                      .', без посредников от собственника Москвы.')
                  : ($property->is_ceil 
                     ? ' | Аренда '.mb_strtolower($property->namewhats,'UTF-8').' по административным округам в Москве без комиссии.'
                      .' Снять '.mb_strtolower($property->title,'UTF-8').' в цао, вао, юзао, сао, ювао, зао, свао, юао, сзао целиком, без посредников по стоимости'
                      .' аренды от собственника г.Москвы.' 
                     : ' | Аренда '.mb_strtolower($property->namewhats,'UTF-8').' по административным округам в Москве без комиссии.'
                      .' Снять '.mb_strtolower($property->title,'UTF-8').' в бизнес центре, особняке, банке, здании, жилом доме, комлексе, парке,'
                      .' торговом центре цао, вао, юзао, сао, ювао, зао, свао, юао, сзао без посредников от собственника Москвы.'));
                  //.($property->seo_title ? ', '.$property->seo_title : '');
                  //." - ".str_replace('офисов','офиса', Yii::t('all',Yii::app()->name));     


if ($model->district->title) $this->pageDescription= trim($model->district->seo_desc)<>'' 
                                        ? 'Здесь отобраны предложения по аренде '.mb_strtolower($property->namewhats,'UTF-8')
                                          ." ".(mb_strtolower($model->district->title,'UTF-8')=="центр" ? "в" : "на")." ".mb_strtolower($model->district->title,'UTF-8')
                                          ."е (".mb_strtolower($model->district->abbr,'UTF-8').") Москвы. "                                          
                                          .$model->district->seo_desc 
                                        : 'Здесь отобраны предложения по аренде '.mb_strtolower($property->namewhats,'UTF-8')
                                          ." ".(mb_strtolower($model->district->title,'UTF-8')=="центр" ? "в" : "на")." ".mb_strtolower($model->district->title,'UTF-8')
                                          ."е (".mb_strtolower($model->district->abbr,'UTF-8').") Москвы.";                   
else $this->pageDescription= 'Здесь отобраны предложения аренды '.mb_strtolower($property->namewhats,'UTF-8').' в административных округах Москвы.';
$this->pageDescription=$this->pageDescription.($property->seo_description ? ' '.$property->seo_description : '');
if ( !$property->seo_description && !$model->district->seo_desc) {
    if ($model->district->title) {
        $this->pageDescription = ($property->is_ceil 
                                  ? 'Предложения включают аренду '.mb_strtolower($property->namewhats,'UTF-8')
                                   ." ".mb_strtolower($model->district->title,'UTF-8')
                                   ."а (".mb_strtolower($model->district->abbr,'UTF-8').") Москвы."
                                   .' Аренда '.mb_strtolower($property->namewhats,'UTF-8')
                                   .' '.mb_strtolower(str_replace(array('ий','ый','округ'),array('ого','ого','округа'),$model->district->desc),'UTF-8').' в Москве'
                                   .' отличается адресом, назначением, свойствами, удаленностью от метро, площадью, стоимостью, валютой.'
                                  : 'Предложения включают аренду '.mb_strtolower($property->namewhats,'UTF-8')
                                   .' в бизнес центре, парке, жилом комплексе, доме, особняке, здании, медцентре, банке'
                                   ." ".mb_strtolower($model->district->title,'UTF-8')
                                   ."а (".mb_strtolower($model->district->abbr,'UTF-8').") Москвы."
                                   .' Аренда '.mb_strtolower($property->namewhats,'UTF-8')
                                   .' '.mb_strtolower(str_replace(array('ий','ый','округ'),array('ого','ого','округа'),$model->district->desc),'UTF-8').' в Москве'
                                   .' отличается объектом размещения, адресом, назначением, свойствами, удаленностью от метро, площадью, стоимостью, валютой.');
    }else{
        $this->pageDescription = ($property->is_ceil 
                                  ? 'Предложения включают аренду '.mb_strtolower($property->namewhats,'UTF-8').' по административных округах в Москве.'
                                   .' Аренда '.mb_strtolower($property->namewhats,'UTF-8').' целиком в цао, вао, юзао, сао, ювао, зао, свао, юао, сзао Москвы '
                                   .' отличается адресом, назначением, свойствами, удаленностью от метро, площадью, стоимостью, валютой.'
                                  : 'Предложения включают аренду '.mb_strtolower($property->namewhats,'UTF-8').' по административных округах '
                                   .' в бизнес центре, парке, жилом комплексе, доме, особняке, здании, медцентре, банке Москвы.'
                                   .' Аренда '.mb_strtolower($property->namewhats,'UTF-8').' цао, вао, юзао, сао, ювао, зао, свао, юао, сзао в Москве'
                                   .' отличается объектом размещения, адресом, назначением, свойствами, удаленностью от метро, площадью, стоимостью, валютой.');
        
    }
}

if ($model->district->title) $this->pageKeywords= trim($model->district->seo_keywords)<>''
                                                  ? array_merge( explode(',', "аренда ".(mb_strtolower($model->district->title,'UTF-8')=="центр" ? "в" : "на")." ".mb_strtolower($model->district->title,'UTF-8')."е москвы"                                                                             
                                                                             //.", аренда ".mb_strtolower($model->district->title,'UTF-8')." москва"
                                                                             //.", аренда в москве ".mb_strtolower($model->district->title,'UTF-8')
                                                                             //.", аренда в москве ".mb_strtolower($model->district->abbr,'UTF-8')
                                                                             .", аренда ".mb_strtolower($model->district->title,'UTF-8')                                                          
                                                                             .", аренда ".mb_strtolower($model->district->abbr,'UTF-8')
                                                                             .", аренда в ".mb_strtolower($model->district->abbr,'UTF-8')                                                          
                                                                             .", ".mb_strtolower($model->district->title,'UTF-8')
                                                                             .", ".mb_strtolower($model->district->abbr,'UTF-8')
                                                          
                                                         .($property->title ? 
                                                                             //+/ ", аренда ".mb_strtolower($property->namewhats,'UTF-8')." в москве"
                                                                              ", аренда ".mb_strtolower($property->namewhats,'UTF-8')." ".(mb_strtolower($model->district->title,'UTF-8')=="центр" ? "в" : "на")." ".mb_strtolower($model->district->title,'UTF-8')."е москвы"
                                                                             .", аренда ".mb_strtolower($property->namewhats,'UTF-8')." ".(mb_strtolower($model->district->title,'UTF-8')=="центр" ? "в" : "на")." ".mb_strtolower($model->district->title,'UTF-8')."е"       
                                                                             //+ind.", аренда ".mb_strtolower($property->namewhat,'UTF-8')." ".(mb_strtolower($model->district->title,'UTF-8')=="центр" ? "в" : "на")." ".mb_strtolower($model->district->title,'UTF-8')."е"              
                                                                             .", аренда ".mb_strtolower($property->namewhats,'UTF-8')." в москве ".mb_strtolower($model->district->abbr,'UTF-8')
                                                                             .", аренда ".mb_strtolower($property->namewhats,'UTF-8')." ".mb_strtolower($model->district->abbr,'UTF-8')." москвы"
                                                                             .", аренда ".mb_strtolower($property->namewhat,'UTF-8')." в ".mb_strtolower($model->district->abbr,'UTF-8')        
                                                                             .", аренда ".mb_strtolower($property->namewhat,'UTF-8')." ".mb_strtolower($model->district->abbr,'UTF-8')                
                                                                             .", аренда ".mb_strtolower($property->namewhat,'UTF-8')." ".mb_strtolower($model->district->abbr,'UTF-8')." москва"    
                                                                             .", аренда ".mb_strtolower($property->namewhat,'UTF-8')." в ".mb_strtolower($model->district->abbr,'UTF-8')." москвы"         
                                                                             //+ind.", аренда ".mb_strtolower($property->namewhat,'UTF-8')." в москве ".mb_strtolower($model->district->abbr,'UTF-8')        
                                                                             .", аренда ".mb_strtolower($property->namewhats,'UTF-8')
                                                                             .", аренда ".mb_strtolower($property->namewhat,'UTF-8')                                                                                 
                                                                             .", аренда москва ".mb_strtolower($property->title,'UTF-8')        
                                                                             .", аренда ".mb_strtolower($property->title,'UTF-8')//." москва"   
                                                                             //.", аренда ".mb_strtolower($property->title,'UTF-8')." москвы"                                                                                                                                                                                                     
                                                                             .", ".mb_strtolower($property->title,'UTF-8')        
                                                                           : "")          
                                                         .($property->abbr ? //+/ ", аренда ".mb_strtolower($property->abbr,'UTF-8')." в москве"
                                                                              ", аренда москва ".mb_strtolower($property->abbr,'UTF-8')                   
                                                                             .", аренда ".mb_strtolower($property->abbr,'UTF-8')//." москва"                           
                                                                             //.", аренда ".mb_strtolower($property->abbr,'UTF-8')." москвы"                                                                                                                
                                                                             //.", аренда ".mb_strtolower($property->abbr,'UTF-8')                                                                             
                                                                             .", ".mb_strtolower($property->abbr,'UTF-8')                                                          
                                                                           : "")           
                                                                             .', недвижимость, коммерческая, аренда, в москве, москва, москвы, класса, коммерческой недвижимости, округ, район, улица, метро, удаленность, вид, свойства, площадь, м2, планировка, парковка, стоимость в месяц, налогооблажение, снять'),                    
                                                                 // Отсеиваиваем ключевые слова для короткой формы
                                                                 $short ? HRu::iskeyintxt(explode(',',$model->district->seo_keywords),                                                   
                                                                                 HRu::cutstr($model->district->anons,750, false, '.','. ')
                                                                            .' '.HRu::cutstr($model->district->detile,1500, false, '.','. ')
                                                                            .' '.HRu::cutstr($model->district->description,1000, false, '.','. '))
                                                                        : explode(',',$model->district->seo_keywords) )
                                                  : explode(',',  "аренда ".(mb_strtolower($model->district->title,'UTF-8')=="центр" ? "в" : "на")." ".mb_strtolower($model->district->title,'UTF-8')."е москвы"                                                                             
                                                                             //.", аренда ".mb_strtolower($model->district->title,'UTF-8')." москва"
                                                                             .", аренда в москве ".mb_strtolower($model->district->title,'UTF-8')
                                                                             .", аренда в москве ".mb_strtolower($model->district->abbr,'UTF-8')
                                                                             .", аренда ".mb_strtolower($model->district->title,'UTF-8')                                                          
                                                                             .", аренда ".mb_strtolower($model->district->abbr,'UTF-8')
                                                                             .", аренда в ".mb_strtolower($model->district->abbr,'UTF-8')                                                          
                                                                             .", ".mb_strtolower($model->district->title,'UTF-8')
                                                                             .", ".mb_strtolower($model->district->abbr,'UTF-8')                                                          
                                                         .($property->title ? 
                                                                             //+/ ", аренда ".mb_strtolower($property->namewhats,'UTF-8')." в москве"
                                                                              ", аренда ".mb_strtolower($property->namewhats,'UTF-8')." ".(mb_strtolower($model->district->title,'UTF-8')=="центр" ? "в" : "на")." ".mb_strtolower($model->district->title,'UTF-8')."е москвы"
                                                                             .", аренда ".mb_strtolower($property->namewhats,'UTF-8')." ".(mb_strtolower($model->district->title,'UTF-8')=="центр" ? "в" : "на")." ".mb_strtolower($model->district->title,'UTF-8')."е"       
                                                                             //+ind.", аренда ".mb_strtolower($property->namewhat,'UTF-8')." ".(mb_strtolower($model->district->title,'UTF-8')=="центр" ? "в" : "на")." ".mb_strtolower($model->district->title,'UTF-8')."е"              
                                                                             .", аренда ".mb_strtolower($property->namewhats,'UTF-8')." в москве ".mb_strtolower($model->district->abbr,'UTF-8')
                                                                             .", аренда ".mb_strtolower($property->namewhats,'UTF-8')." ".mb_strtolower($model->district->abbr,'UTF-8')." москвы"
                                                                             .", аренда ".mb_strtolower($property->namewhat,'UTF-8')." в ".mb_strtolower($model->district->abbr,'UTF-8')        
                                                                             .", аренда ".mb_strtolower($property->namewhat,'UTF-8')." ".mb_strtolower($model->district->abbr,'UTF-8')            
                                                                             .", аренда ".mb_strtolower($property->namewhat,'UTF-8')." ".mb_strtolower($model->district->abbr,'UTF-8')." москва"    
                                                                             .", аренда ".mb_strtolower($property->namewhat,'UTF-8')." в ".mb_strtolower($model->district->abbr,'UTF-8')." москвы"         
                                                                             //+ind.", аренда ".mb_strtolower($property->namewhat,'UTF-8')." в москве ".mb_strtolower($model->district->abbr,'UTF-8')        
                                                                             .", аренда ".mb_strtolower($property->namewhats,'UTF-8')
                                                                             .", аренда ".mb_strtolower($property->namewhat,'UTF-8')                                                                             
                                                                             .", аренда москва ".mb_strtolower($property->title,'UTF-8')        
                                                                             .", аренда ".mb_strtolower($property->title,'UTF-8')//." москва"   
                                                                             //.", аренда ".mb_strtolower($property->title,'UTF-8')." москвы"                                                                                                                                                                                                     
                                                                             .", ".mb_strtolower($property->title,'UTF-8')       
                                                                           : "")          
                                                         .($property->abbr ? //+/ ", аренда ".mb_strtolower($property->abbr,'UTF-8')." в москве"
                                                                              ", аренда москва ".mb_strtolower($property->abbr,'UTF-8')                   
                                                                             .", аренда ".mb_strtolower($property->abbr,'UTF-8')//." москва"                           
                                                                             //.", аренда ".mb_strtolower($property->abbr,'UTF-8')." москвы"                                                                                                                
                                                                             //.", аренда ".mb_strtolower($property->abbr,'UTF-8')                                                                             
                                                                             .", ".mb_strtolower($property->abbr,'UTF-8')                                                          
                                                                           : "")           
                                                                             .', недвижимость, коммерческая, аренда, в москве, москва, москвы, класса, коммерческой недвижимости, округ, район, улица, метро, удаленность, вид, свойства, площадь, м2, планировка, парковка, стоимость в месяц, налогооблажение, снять');                      
else $this->pageKeywords=explode(',', 'аренда в москве, каталог недвижимости, недвижимость, коммерческая недвижимость, аренда, в москве, москва, москвы, аренда недвижимости, аренда коммерческой недвижимости, аренда коммерческой недвижимости в москве, аренда коммерческой недвижимости москвы, аренда коммерческая недвижимость москва,'
                                     .' класса, коммерческой недвижимости, округ, район, улица, метро, удаленность, вид, свойства, площадь, м2, планировка, парковка, стоимость в месяц, налогооблажение, снять');    
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

if ($model->district->title&&$property->namewhats) {
    
        $this->breadcrumbs=array(	
             Yii::t('menu-adm','List Realestates')=>array('index'),
             'по округам'=>array('realestates/district'),
             mb_strtolower($model->district->abbr,'UTF-8')=>Yii::app()->createUrl('realestates/district',array('id'=>$model->district->id)),
             'по видам'=>array('realestates/vid'),
             mb_strtolower($property->nameov,'UTF-8')=>Yii::app()->createUrl('realestates/vid',array('id'=>$property->id)),
             "Аренда ".mb_strtolower($property->namewhats,'UTF-8').' в '.mb_strtolower($model->district->abbr,'UTF-8')." Москвы", 
        );

} else if (!$model->district && $property->namewhats) {
    
        $this->breadcrumbs=array(	
             Yii::t('menu-adm','List Realestates')=>array('index'),
             'по округам '=>array('realestates/district'),
             'по видам'=>array('realestates/vid'),
              mb_strtolower($property->nameov,'UTF-8')=>Yii::app()->createUrl('realestates/vid',array('id'=>$property->id)),
             'Аренда '.mb_strtolower($property->namewhats,'UTF-8')." по административным округам Москвы"
        );
} else if ($model->district && !$property->namewhats) {

        $this->breadcrumbs=array(	
             Yii::t('menu-adm','List Realestates')=>array('index'),
             'по округам '=>array('realestates/district'),
             mb_strtolower($model->district->abbr,'UTF-8')=>Yii::app()->createUrl('realestates/district',array('id'=>$model->district->id)),
             'по видам'=>array('realestates/vid'),              
             'Аренда коммерческой недвижимости в '.mb_strtolower($model->district->abbr,'UTF-8')." Москвы" 
        );    
} else {
        $this->breadcrumbs=array(	
             Yii::t('menu-adm','List Realestates')=>array('index'),
             'по округам '=>array('realestates/district'),
             'по видам'=>array('realestates/vid'),
             'Аренда коммерческой недвижимости в Москве различных административных округов'
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
                ($model->district->title  
                  ? ($property->is_ceil 
                     ? 'Аренда '.mb_strtolower($property->namewhats,'UTF-8').' '.(mb_strtolower($model->district->title,'UTF-8')=="центр" ? "в" : "на")
                      ." ".mb_strtolower($model->district->title,'UTF-8')."е (".mb_strtolower($model->district->abbr,'UTF-8').') Москвы без комиссии.'
                      .' Снять '.mb_strtolower($property->title,'UTF-8')
                      .' '.mb_strtolower(str_replace(array('ий','ый','округ'),array('ого','ого','округа'),$model->district->desc),'UTF-8')
                      .' целиком, без посредников от собственника в Москве.'
                     : 'Аренда '.mb_strtolower($property->namewhats,'UTF-8').' '.(mb_strtolower($model->district->title,'UTF-8')=="центр" ? "в" : "на")
                      ." ".mb_strtolower($model->district->title,'UTF-8')."е (".mb_strtolower($model->district->abbr,'UTF-8').') Москвы без комиссии.'
                      .' Снять '.mb_strtolower($property->title,'UTF-8').' в бизнес центре, особняке, банке, здании, жилом доме,'
                      .' комлексе, парке '
                      .mb_strtolower(str_replace(array('ий','ый','округ'),array('ого','ого','округа'),$model->district->desc),'UTF-8')
                      .', без посредников от собственника в Москве.')
                  : ($property->is_ceil 
                     ? 'Аренда '.mb_strtolower($property->namewhats,'UTF-8').' целиком по административным округам в Москве без комиссии.'
                      .' Снять '.mb_strtolower($property->title,'UTF-8').' цао, вао, юзао, сао, ювао, зао, свао, юао, сзао г.Москвы, без посредников от собственника' 
                     : 'Аренда '.mb_strtolower($property->namewhats,'UTF-8').' по административным округам в Москве без комиссии.'
                      .' Снять '.mb_strtolower($property->title,'UTF-8').' в бизнес центре, особняке, банке, здании, жилом доме, комлексе, парке'
                      .' цао, вао, юзао, сао, ювао, зао, свао, юао, сзао г.Москвы, без посредников от собственника.'));
                 //.($property->title ? ', '.$property->title : '')
   ?>  
</h1>

<?php if ( $model->district->anons || $property->anons) {  ?>    
<div class="desc anons m-b18 fs-11 ff-Arial justify">    
    <?php if ( $model->district->anons ) {  ?>      
    <div>
    <?php if ($short) { ?>    
    <?php echo str_replace(",","",HRu::cutstr($model->district->anons,750, false, '.','. ')); ?>    
    <?php } else { ?>    
    <?php echo $model->district->anons; ?>
    <?php } ?>         
    </div>    
    <?php } ?>
    <?php if ( $property->anons ) {  ?>    
    <div <?php echo ($model->district->anons ? 'class="m-t10"' : '') ?>>
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
    //$model->search()->pagination->route = Yii::app()->createUrl('/realestates/district', array('id'=>$model->district_id)); 
    $model->search()->pagination->route = Yii::app()->createUrl('/ru/realestates/district/'.$model->district_id->id.'/vid/'.$model->realestateVid->id); 
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
                        ),)
                + ( !$property ? array( 'realestateVid'=>array(                                
                                'asc'=>'realestateVid.title ASC',
                                'desc'=>'realestateVid.title DESC',
                                'default'=>'desc',
                        ),) : array() )            
                + array('realestateType'=>array(                                
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
                        'street'=>array(                                
                                'asc'=>'street.title ASC',
                                'desc'=>'street.title DESC',
                                'default'=>'desc',
                        ),                                              
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
            //'district'=>'Округ',
            //'areas'=>'Район',
            'metro'=>'Метро',)
          +( !$property ? array('realestateVid'=>'Вид',) : array())
          +array(
            'realestateType'=>'В/цел',  
            'realestateClass'=>'Класс', 
            'street'=>'Улица',
        ),
        'sorterHeader'=>'Сортировать по:',
        'template'=>"<hr class='m-t5 m-b5' />{sizer}{sorter}\n<div style='float:left;display:inline-block;'>{pager}</div>{summary}\n<br/>{items}\n<div style='clear:both'></div><div style='float:left;display:inline-block;'>{pager}</div>{summary}",        
        'sizerVariants'=>HRu::cutarray(array(8, 10, 12, 16, 20, 24, 30),$model->search()->getTotalItemCount()),
        'sizerAttribute'=>'size',
        'sizerHeader'=>'Выводить по: ',
        'beforeAjaxUpdate'=>$beforeAjaxUpdate,
        'afterAjaxUpdate'=>$afterAjaxUpdate,    
        //'ajaxUrl'=>Yii::app()->createUrl('/ru/realestates/district/'.$model->district_id->id.'/vid/'.$model->realestateVid->id),
)); ?>    

   <?php   $this->renderPartial('_send',array('model'=>$model_claim));?>

    </div>
    <hr class="m-t10 m-b8" />
    <?php if (!$is_list) { ?>
    <?php   $this->renderPartial('/site/_list_metros', array('model'=>$model)); ?>  
    <?php } ?>    
    
    <?php if ( $model->district->detile || $property->detile ) {  ?>    
    <div class="desc detile m-t8 m-b14 fs-10 ff-tahoma">    
        <?php if ( $model->district->detile ) {  ?>      
            <div>
            <?php if ($short) { ?>    
            <?php echo str_replace(",","",HRu::cutstr($model->district->detile,1500, false, '.','. ')); ?>    
            <?php } else { ?>    
            <?php echo $model->district->detile; ?>
            <?php } ?>                  
            </div>    
        <?php } ?>
        <?php if ( $property->detile ) {  ?>    
            <div <?php echo ($model->district->detile ? 'class="m-t10"' : '') ?>>
            <?php if ($short) { ?>    
            <?php echo str_replace(",","",HRu::cutstr($property->detile,1500, false, '.','. ')); ?>    
            <?php } else { ?>    
            <?php echo $property->detile; ?>
            <?php } ?>                  
            </div>    
        <?php } ?>        
    </div>
    <? } ?>  
    
    <?php if (!$is_list) { ?>
    <?php   $this->renderPartial('/site/_list_streets', array('model'=>$model)); ?>  
    <?php } ?>    
    
    <?php if ( $model->district->description || $property->description ) {  ?>    
    <div class="desc detile m-b18 fs-10 ff-tahoma">    
        <?php if ( $model->district->description ) {  ?>      
            <div>
            <?php if ($short) { ?>    
            <?php echo str_replace(",","",HRu::cutstr($model->district->description,1000, false, '.','. ')); ?>    
            <?php } else { ?>    
            <?php echo $model->district->description; ?>
            <?php } ?>                                  
            </div>    
        <?php } ?>
        <?php if ( $property->description ) {  ?>    
            <div <?php echo ($model->district->description ? 'class="m-t10"' : '') ?>>
            <?php if ($short) { ?>    
            <?php echo str_replace(",","",HRu::cutstr($property->description,1000, false, '.','. ')); ?>    
            <?php } else { ?>    
            <?php echo $property->description; ?>
            <?php } ?>                                                  
            </div>    
        <?php } ?>                
    </div>
    <? } ?>  
    
    <?php if ($is_list) { ?>
    <?php   $this->renderPartial('/site/_list_areas', array('model'=>$model)); ?>              
    <?php } ?>
</div>
<? $this->renderPartial('/realestates/include/_script_vimg_i_sec_list'); ?>  
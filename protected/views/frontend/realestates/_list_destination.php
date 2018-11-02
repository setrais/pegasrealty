<?php  
$short = true;
$is_list = false;

$destination = Destinations::model()->findByPk($model->realestateDestinations);
   
$this->pageTitle=Yii::t('all','Коммерческая недвижимость')
                .($destination 
                  ? ($property->is_ceil 
                     ? ' | Аренда '.mb_strtolower($property->namewhats,'UTF-8').' под '.mb_strtolower($destination->under,'UTF-8').' в Москве без комиссии.'
                      .' Снять '.mb_strtolower($property->title,'UTF-8').' целиком для '.mb_strtolower($destination->for,'UTF-8').' без посредников по стоимости аренды'
                      .' от собственника Москвы.'
                     : ' | Аренда '.mb_strtolower($property->namewhats,'UTF-8').' под '.mb_strtolower($destination->under,'UTF-8').' в Москве без комиссии.'
                      .' Снять '.mb_strtolower($property->title,'UTF-8').' в торговом, бизнес центре, особняке, банке, административном здании, жилом доме,'
                      .' комлексе, парке для '.mb_strtolower($destination->for,'UTF-8').', без посредников по стоимости аренды от собственника Москвы.')
                  : ($property->is_ceil 
                     ? ' | Аренда '.mb_strtolower($property->namewhats,'UTF-8').' по назначениям в Москве без комиссии.'
                      .' Снять '.mb_strtolower($property->title,'UTF-8').' целиком с разными назначениями, без посредников по стоимости аренды от собственника Москвы.' 
                     : ' | Аренда '.mb_strtolower($property->namewhats,'UTF-8').' по назначениям в Москве без комиссии.'
                      .' Снять '.mb_strtolower($property->title,'UTF-8').' в торговом, бизнес центре, особняке, банке, административном здании, жилом доме, комлексе, парке'
                      .' с разными назначениями, без посредников по стоимости аренды от собственника Москвы.'));
                  //.($property->seo_title ? ', '.$property->seo_title : '');
                  //." - ".str_replace('офисов','офиса', Yii::t('all',Yii::app()->name)); 

if ($destination) $this->pageDescription= trim($destination->seo_desc)<>'' 
                                        ? 'Здесь отобраны предложения по аренде '.mb_strtolower($property->namewhats,'UTF-8')
                                          .' в Москве с назначением под '.mb_strtolower($destination->under, 'UTF-8').'. '                                          
                                          .trim($destination->seo_desc ) 
                                        : 'Здесь отобраны предложения по аренде '.mb_strtolower($property->namewhats,'UTF-8')
                                          .' в Москве с назначением под '.mb_strtolower($destination->under, 'UTF-8').'.';                   

else $this->pageDescription= 'Здесь отобраны предложения аренды '.mb_strtolower($property->namewhats,'UTF-8').' по назначениям в Москве. ';

$this->pageDescription=$this->pageDescription.($property->seo_description ? ' '.$property->seo_description : '');



if ( !$property->seo_description && !$destination->seo_desc) {
    if ($destination) {
        $this->pageDescription = ($property->is_ceil 
                                  ? 'Предложения включают аренду '.mb_strtolower($property->namewhats,'UTF-8').' для '.mb_strtolower($destination->for, 'UTF-8')
                                   .' в Москве. Аренда '.mb_strtolower($property->namewhats,'UTF-8').' целиком с назначением '.mb_strtolower($destination->title, 'UTF-8')
                                   .' отличается адресом, удаленностью от метро, классом, площадью, стоимостью, валютой расчетов.'
                                  : 'Предложения включают аренду '.mb_strtolower($property->namewhats,'UTF-8').' для '.mb_strtolower($destination->for, 'UTF-8')
                                   .' в бизнес центре, парке, жилом комплексе, доме, особняке, здании, медцентре, банке Москвы.'
                                   .' Аренда '.mb_strtolower($property->namewhats,'UTF-8').' с назначением '.mb_strtolower($destination->title, 'UTF-8')
                                   .' отличается объектом размещения, адресом, удаленностью от метро, площадью, стоимостью, валютой.');
    }else{
        $this->pageDescription = ($property->is_ceil 
                                  ? 'Предложения включают аренду '.mb_strtolower($property->namewhats,'UTF-8').' по назначениям'
                                   .' в Москве. Аренда '.mb_strtolower($property->namewhats,'UTF-8').' целиком, с различными назначениями'
                                   .' отличается адресом, удаленностью от метро, площадью, стоимостью, валютой расчетов.'
                                  : 'Предложения включают аренду '.mb_strtolower($property->namewhats,'UTF-8').' по назначениям'
                                   .' в бизнес центре, парке, жилом комплексе, доме, особняке, здании, медцентре, банке Москвы.'
                                   .' Аренда '.mb_strtolower($property->namewhats,'UTF-8').' с различными назначениями отличается объектом'
                                   .' размещения, адресом, удаленностью от метро, площадью, стоимостью, валютой.');        
    }
}

if ($destination->title) $this->pageKeywords=trim($destination->seo_keywords)<>''                                              
                                        ? array_merge( explode(',',                                                                                                               
                                                                 //+.', аренда для '.mb_strtolower($destination->for,'UTF-8').' в москве'
                                                                 //+.', аренда под '.mb_strtolower($destination->under,'UTF-8').' в москве'
                                                                 //+.', аренда для '.mb_strtolower($destination->for,'UTF-8').' москва'
                                                                 //+.', аренда под '.mb_strtolower($destination->under,'UTF-8').' москва'
                                                                 
                                                                 //+.', аренда '.mb_strtolower($destination->title,'UTF-8').' москва'                                                
                                                                 //+.', аренда '.mb_strtolower($destination->title,'UTF-8').' москвe'                                                
                                                                 //+.', аренда москва '.mb_strtolower($destination->title,'UTF-8')                                                                                                                                  
                                                                 ' '.mb_strtolower($destination->title,'UTF-8')
                                                                 .', '.mb_strtolower($destination->for,'UTF-8')
                                                                 .', '.mb_strtolower($destination->under,'UTF-8')
                                                    .($property->title 
                                                                ?  ', аренда '.mb_strtolower($property->namewhats,'UTF-8').' в москве под '.mb_strtolower($destination->under,'UTF-8')
                                                                 //+.', аренда '.mb_strtolower($property->namewhat,'UTF-8').' в москве под '.mb_strtolower($destination->under,'UTF-8')                                                                 
                                                                 //+.', аренда '.mb_strtolower($property->namewhats,'UTF-8').' в москве под '.mb_strtolower($destination->title,'UTF-8')
                                                                 //+.', аренда '.mb_strtolower($property->namewhat,'UTF-8').' в москве под '.mb_strtolower($destination->title,'UTF-8')
                                                                 .', аренда '.mb_strtolower($property->namewhats,'UTF-8').' в москве для '.mb_strtolower($destination->for,'UTF-8')
                                                                 //+.', аренда '.mb_strtolower($property->namewhat,'UTF-8').' в москве для '.mb_strtolower($destination->for,'UTF-8')                                                
                                                                 .', аренда '.mb_strtolower($property->namewhats,'UTF-8').' для '.mb_strtolower($destination->for,'UTF-8')
                                                                 //+.', аренда '.mb_strtolower($property->namewhat,'UTF-8').' для '.mb_strtolower($destination->for,'UTF-8')    
                                                                 //+.', аренда '.mb_strtolower($property->namewhats,'UTF-8').' под '.mb_strtolower($destination->under,'UTF-8')
                                                                 //+.', аренда '.mb_strtolower($property->namewhat,'UTF-8').' под '.mb_strtolower($destination->under,'UTF-8')
                                                                 
                                                                 //+.', аренда '.mb_strtolower($property->namewhats,'UTF-8').' назначение '
                                                                 //+.', аренда '.mb_strtolower($property->namewhat,'UTF-8').' назначение '
                                                                 
                                                                 //+.', аренда '.mb_strtolower($property->namewhats,'UTF-8').' для '.mb_strtolower($destination->for,'UTF-8').' в москве'
                                                                 //+.', аренда '.mb_strtolower($property->namewhats,'UTF-8').' для '.mb_strtolower($destination->for,'UTF-8').' в москве'
                                                                 //+.', аренда '.mb_strtolower($property->namewhats,'UTF-8').' под '.mb_strtolower($destination->under,'UTF-8').' в москве'
                                                                 //+.', аренда '.mb_strtolower($property->namewhats,'UTF-8').' под '.mb_strtolower($destination->under,'UTF-8').' в москве' 
                                                                 
                                                                 //+.', аренда '.mb_strtolower($property->namewhats,'UTF-8')        
                                                                 //+.', аренда '.mb_strtolower($property->namewhat,'UTF-8')         
                                                                 //
                                                                 .', '.mb_strtolower($property->namewhats,'UTF-8')        
                                                                 .', '.mb_strtolower($property->namewhat,'UTF-8')         
                                                                         
                                                                 .', '.mb_strtolower($property->title,'UTF-8').' '.mb_strtolower($destination->title,'UTF-8')                                                               
                                                                 .", ".mb_strtolower($property->title,'UTF-8') : "")          
                                            
                                                     .($property->abbr 
                                                                ? ', аренда '.mb_strtolower($property->abbr,'UTF-8').' в москве под '.mb_strtolower($destination->under,'UTF-8')                                                                 
                                                                 //+.', аренда '.mb_strtolower($property->abbr,'UTF-8').' в москве под '.mb_strtolower($destination->title,'UTF-8')
                                                                 .', аренда '.mb_strtolower($property->abbr,'UTF-8').' в москве для '.mb_strtolower($destination->for,'UTF-8')
                                                                 .', аренда '.mb_strtolower($property->abbr,'UTF-8').' для '.mb_strtolower($destination->for,'UTF-8')
                                                                 //+.', аренда '.mb_strtolower($property->abbr,'UTF-8').' под '.mb_strtolower($destination->under,'UTF-8')                                                                 
                                                                 
                                                                 //+.', аренда '.mb_strtolower($property->abbr,'UTF-8').' для '.mb_strtolower($destination->for,'UTF-8').' в москве'
                                                                 //+.', аренда '.mb_strtolower($property->abbr,'UTF-8').' под '.mb_strtolower($destination->under,'UTF-8').' в москве'
                                                                         
                                                                 .', '.mb_strtolower($property->abbr,'UTF-8')." ".mb_strtolower($destination->title,'UTF-8')
                                                                 .", ".mb_strtolower($property->abbr,'UTF-8') : "")                                                               
                                                                 .', каталог недвижимости, недвижимость, аренда, под, для, в москве, москва, москвы, назначение, класса, коммерческой недвижимости, округ, район, метро, удаленность, вид, свойства, площадь, м2, планировка, парковка, стоимость в месяц, налогооблажение'                                            
                                                         ),
                                                         // Отсеиваиваем ключевые слова для короткой формы
                                                         $short ? HRu::iskeyintxt(explode(',',$destination->seo_keywords),                                                   
                                                                  HRu::cutstr($destination->anons,750, false, '.','. ')
                                                             .' '.HRu::cutstr($destination->detile,1500, false, '.','. ')
                                                             .' '.HRu::cutstr($destination->description,1000, false, '.','. '))
                                                         : explode(',',$destination->seo_keywords))                          
                                        : explode(',', //+.', аренда для '.mb_strtolower($destination->for,'UTF-8').' в москве'
                                                                 //+.', аренда под '.mb_strtolower($destination->under,'UTF-8').' в москве'
                                                                 //+.', аренда для '.mb_strtolower($destination->for,'UTF-8').' москва'
                                                                 //+.', аренда под '.mb_strtolower($destination->under,'UTF-8').' москва'
                                                                 
                                                                 //+.', аренда '.mb_strtolower($destination->title,'UTF-8').' москва'                                                
                                                                 //+.', аренда '.mb_strtolower($destination->title,'UTF-8').' москвe'                                                
                                                                 //+.', аренда москва '.mb_strtolower($destination->title,'UTF-8')                                                                                                                                  
                                                                 ' '.mb_strtolower($destination->title,'UTF-8')
                                                                 .', '.mb_strtolower($destination->for,'UTF-8')
                                                                 .', '.mb_strtolower($destination->under,'UTF-8')
                                                    .($property->title 
                                                                ?  ', аренда '.mb_strtolower($property->namewhats,'UTF-8').' в москве под '.mb_strtolower($destination->under,'UTF-8')
                                                                 //+.', аренда '.mb_strtolower($property->namewhat,'UTF-8').' в москве под '.mb_strtolower($destination->under,'UTF-8')                                                                 
                                                                 //+.', аренда '.mb_strtolower($property->namewhats,'UTF-8').' в москве под '.mb_strtolower($destination->title,'UTF-8')
                                                                 //+.', аренда '.mb_strtolower($property->namewhat,'UTF-8').' в москве под '.mb_strtolower($destination->title,'UTF-8')
                                                                 .', аренда '.mb_strtolower($property->namewhats,'UTF-8').' в москве для '.mb_strtolower($destination->for,'UTF-8')
                                                                 //+.', аренда '.mb_strtolower($property->namewhat,'UTF-8').' в москве для '.mb_strtolower($destination->for,'UTF-8')                                                
                                                                 .', аренда '.mb_strtolower($property->namewhats,'UTF-8').' для '.mb_strtolower($destination->for,'UTF-8')
                                                                 //+.', аренда '.mb_strtolower($property->namewhat,'UTF-8').' для '.mb_strtolower($destination->for,'UTF-8')    
                                                                 //+.', аренда '.mb_strtolower($property->namewhats,'UTF-8').' под '.mb_strtolower($destination->under,'UTF-8')
                                                                 //+.', аренда '.mb_strtolower($property->namewhat,'UTF-8').' под '.mb_strtolower($destination->under,'UTF-8')
                                                                 
                                                                 //+.', аренда '.mb_strtolower($property->namewhats,'UTF-8').' назначение '
                                                                 //+.', аренда '.mb_strtolower($property->namewhat,'UTF-8').' назначение '
                                                                 
                                                                 //+.', аренда '.mb_strtolower($property->namewhats,'UTF-8').' для '.mb_strtolower($destination->for,'UTF-8').' в москве'
                                                                 //+.', аренда '.mb_strtolower($property->namewhats,'UTF-8').' для '.mb_strtolower($destination->for,'UTF-8').' в москве'
                                                                 //+.', аренда '.mb_strtolower($property->namewhats,'UTF-8').' под '.mb_strtolower($destination->under,'UTF-8').' в москве'
                                                                 //+.', аренда '.mb_strtolower($property->namewhats,'UTF-8').' под '.mb_strtolower($destination->under,'UTF-8').' в москве' 
                                                                 
                                                                 //+.', аренда '.mb_strtolower($property->namewhats,'UTF-8')        
                                                                 //+.', аренда '.mb_strtolower($property->namewhat,'UTF-8')         
                                                                 //
                                                                 .', '.mb_strtolower($property->namewhats,'UTF-8')        
                                                                 .', '.mb_strtolower($property->namewhat,'UTF-8')         
                                                                         
                                                                 .', '.mb_strtolower($property->title,'UTF-8').' '.mb_strtolower($destination->title,'UTF-8')                                                               
                                                                 .", ".mb_strtolower($property->title,'UTF-8') : "")          
                                            
                                                     .($property->abbr 
                                                                ? ', аренда '.mb_strtolower($property->abbr,'UTF-8').' в москве под '.mb_strtolower($destination->under,'UTF-8')                                                                 
                                                                 //+.', аренда '.mb_strtolower($property->abbr,'UTF-8').' в москве под '.mb_strtolower($destination->title,'UTF-8')
                                                                 .', аренда '.mb_strtolower($property->abbr,'UTF-8').' в москве для '.mb_strtolower($destination->for,'UTF-8')
                                                                 .', аренда '.mb_strtolower($property->abbr,'UTF-8').' для '.mb_strtolower($destination->for,'UTF-8')
                                                                 //+.', аренда '.mb_strtolower($property->abbr,'UTF-8').' под '.mb_strtolower($destination->under,'UTF-8')                                                                 
                                                                 
                                                                 //+.', аренда '.mb_strtolower($property->abbr,'UTF-8').' для '.mb_strtolower($destination->for,'UTF-8').' в москве'
                                                                 //+.', аренда '.mb_strtolower($property->abbr,'UTF-8').' под '.mb_strtolower($destination->under,'UTF-8').' в москве'
                                                                         
                                                                 .', '.mb_strtolower($property->abbr,'UTF-8')." ".mb_strtolower($destination->title,'UTF-8')
                                                                 .", ".mb_strtolower($property->abbr,'UTF-8') : "")                                                           
                                                                 .', каталог недвижимости, недвижимость, аренда, под, для, в москве, москва, москвы, назначение, класса, коммерческой недвижимости, округ, район, метро, удаленность, вид, свойства, площадь, м2, планировка, парковка, стоимость в месяц, налогооблажение'                                            
                                                      );                                   
else $this->pageKeywords=explode(',', 'аренда в москве, каталог недвижимости, недвижимоcть, аренда, использование, назначение, для, под, в москве, москва, москвы, аренда недвижимости, аренда коммерческой недвижимости, аренда коммерческой недвижимости в москве, аренда коммерческой недвижимости москвы, аренда коммерческая недвижимость москва, класса, коммерческой недвижимости, округ, район, метро, удаленность, вид, свойства, площадь, м2, планировка, парковка, стоимость в месяц, налогооблажение');    

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

if ( $destination && $property->namewhats ) {
    
        $this->breadcrumbs=array(	
             Yii::t('menu-adm','List Realestates')=>array('index'),
             'по назначениям'=>array('realestates/destination'),
             'под '.mb_strtolower($destination->under,'UTF-8')=>Yii::app()->createUrl('realestates/destination',array('id'=>$destination->id)),
             'по видам'=>array('realestates/vid'),
              mb_strtolower($property->nameov,'UTF-8')=>Yii::app()->createUrl('realestates/vid',array('id'=>$model->realestateVid->id)),
             'Аренда '.mb_strtolower($property->namewhats,'UTF-8')." в Москве для ".mb_strtolower($destination->for,'UTF-8')
        );

} else if (!$destination && $property->namewhats) {
    
        $this->breadcrumbs=array(	
             Yii::t('menu-adm','List Realestates')=>array('index'),
             'по назначениям'=>array('realestates/destination'),
             'по видам'=>array('realestates/vid'),
              mb_strtolower($property->nameov,'UTF-8')=>Yii::app()->createUrl('realestates/vid',array('id'=>$model->realestateVid->id)),
             'Аренда '.mb_strtolower($property->namewhats,'UTF-8')." в Москве по назначениям"
        );
} else if ( $destination && !$property->namewhats ) {

        $this->breadcrumbs=array(	
             Yii::t('menu-adm','List Realestates')=>array('index'),
             'по назначениям'=>array('realestates/destination'),
             'под '.mb_strtolower($destination->under,'UTF-8')=>Yii::app()->createUrl('realestates/destination',array('id'=>$destination->id)),
             'по видам'=>array('realestates/vid'),
             'Аренда коммерческой недвижимости в Москве для '.mb_strtolower($destination->for,'UTF-8')
        );    
} else {
        $this->breadcrumbs=array(	
             Yii::t('menu-adm','List Realestates')=>array('index'),
             'по назначениям'=>array('realestates/destination'),
             'по видам'=>array('realestates/vid'),
             'Аренда коммерческой недвижимости в Москве по назначениям'
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
                ($destination 
                  ? ($property->is_ceil 
                     ? 'Аренда '.mb_strtolower($property->namewhats,'UTF-8').' под '.mb_strtolower($destination->under,'UTF-8').' в Москве без комиссии.'
                      .' Снять '.mb_strtolower($property->title,'UTF-8').' для '.mb_strtolower($destination->for,'UTF-8').' целиком, без посредников по стоимости аренды'
                      .' от собственника Москвы.'
                     : 'Аренда '.mb_strtolower($property->namewhats,'UTF-8').' под '.mb_strtolower($destination->under,'UTF-8').' в Москве без комиссии.'
                      .' Снять '.mb_strtolower($property->title,'UTF-8').' в бизнес центре, особняке, банке, адм.здании, жилом доме,'
                      .' комлексе, парке для '.mb_strtolower($destination->for,'UTF-8').', без посредников по стоимости аренды от собственника Москвы.')
                  : ($property->is_ceil 
                     ? 'Аренда '.mb_strtolower($property->namewhats,'UTF-8').' по назначениям в Москве без комиссии.'
                      .' Снять '.mb_strtolower($property->title,'UTF-8').' целиком с различными назначениями, без посредников по стоимости аренды от собственника Москвы.' 
                     : 'Аренда '.mb_strtolower($property->namewhats,'UTF-8').' по назначениям в Москве без комиссии.'
                      .' Снять '.mb_strtolower($property->title,'UTF-8').' в бизнес центре, особняке, банке, адм.здании, жилом доме, комлексе, парке'
                      .' с различными назначениями, без посредников по стоимости аренды от собственника Москвы.'));?>     
</h1>    
    
<?php if ( $destination->anons || $property->anons) {  ?>    
<div class="desc anons m-b18 fs-11 ff-Arial justify">    
    <?php if ( $destination->anons ) {  ?>      
    <div>
    <?php if ($short) { ?>    
    <?php echo str_replace(",","",HRu::cutstr($destination->anons,750, false, '.','. ')); ?>    
    <?php } else { ?>    
    <?php echo $destination->anons; ?>
    <?php } ?>    
    </div>    
    <?php } ?>
    <?php if ( $property->anons ) {  ?>    
    <div <?php echo ($destination->anons ? 'class="m-t10"' : '') ?>>
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
    //$model->search()->pagination->route = Yii::app()->createUrl('/realestates/destination', array('id'=>$destination->id)); 
    $model->search()->pagination->route = Yii::app()->createUrl('/ru/realestates/destination/'.$destination->id.'/vid/'.$property->id); 
    
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
                        /*'areas'=>array(                                
                                'asc'=>'areas.title ASC',
                                'desc'=>'areas.title DESC',
                                'default'=>'desc',
                        ),*/
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
            'district'=>'Округ',
            //'areas'=>'Район',
            'metro'=>'Метро',
            //'realestateVid'=>'Вид',
            'realestateType'=>'В/цел',
            'realestateClass'=>'Класс', 
            'street'=>'Улица',
        ),
        'sorterHeader'=>'Сортировать по:',
        'template'=>"<hr class='m-t5 m-b5' />{sizer}{sorter}\n<div style='float:left;display:inline-block;'>{pager}</div>{summary}\n<br/>{items}\n<div style='clear:both'></div><div style='float:left;display:inline-block;'>{pager}</div>{summary}",        
        'sizerVariants'=>  HRu::cutarray(array(6, 8, 10, 12, 16, 20, 24, 30),$model->search()->getTotalItemCount()),
        'sizerAttribute'=>'size',
        'sizerHeader'=>'Выводить по: ',
        'short'=>$short,
        'desc'=>$destination->title,
        'beforeAjaxUpdate'=>$beforeAjaxUpdate,
        'afterAjaxUpdate'=>$afterAjaxUpdate,    
        //'ajaxUrl'=>Yii::app()->createUrl('/ru/realestates/destination/'.$destination->id.'/vid/'.$property->id),
)); ?>    

   <?php   $this->renderPartial('_send',array('model'=>$model_claim));?>

    </div>
    <hr class="m-t10 m-b8" />
    <?php if (!$is_list) { ?>
    <?php   $this->renderPartial('/site/_list_metros', array('model'=>$model)); ?>  
    <?php } ?>
    
    <?php if ( $destination->detile || $property->detile ) {  ?>    
    <div class="desc detile m-t8 m-b14 fs-10 ff-tahoma">    
        <?php if ( $destination->detile ) {  ?>      
            <div>
            <?php if ($short) { ?>    
            <?php echo str_replace(",","",HRu::cutstr($destination->detile,1500, false, '.','. ')); ?>    
            <?php } else { ?>    
            <?php echo $destination->detile; ?>
            <?php } ?>                             
            </div>    
        <?php } ?>
        <?php if ( $property->detile ) {  ?>    
            <div <?php echo ($destination->detile ? 'class="m-t10"' : '') ?>>
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
    
    <?php if ( $destination->description || $property->description ) {  ?>    
    <div class="desc detile m-b18 fs-10 ff-tahoma">    
        <?php if ( $destination->description ) {  ?>      
            <div>
            <?php if ($short) { ?>    
            <?php echo str_replace(",","",HRu::cutstr($destination->description,1000, false, '.','. ')); ?>    
            <?php } else { ?>    
            <?php echo $destination->description; ?>
            <?php } ?>                 
            </div>    
        <?php } ?>
        <?php if ( $property->description ) {  ?>    
            <div <?php echo ($destination->description ? 'class="m-t10"' : '') ?>>
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
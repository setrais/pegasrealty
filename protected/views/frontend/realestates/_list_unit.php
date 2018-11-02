<?php 
$short = true;
$is_list = false;

$remotenes = ( Yii::app()->getRequest()->getParam('remotenes') ? Yii::app()->getRequest()->getParam('remotenes') : Yii::app()->getRequest()->getParam('remoteness-from')) ;

$this->pageTitle=Yii::t('all','Коммерческая недвижимость')
                .($model->unit 
                  ? ($property->is_ceil 
                     ? ' | Аренда '.mb_strtolower($property->namewhats,'UTF-8')
                      .' в Москве без комиссии с удаленностью от метро в '
                      .( $remotenes ? $remotenes.' минуту(ах)': 'минутах').' '.$model->unit->abbr." (".$model->unit->short_title.")."
                      .' Снять '.mb_strtolower($property->title,'UTF-8').' с расстоянием в '
                      .( $remotenes ? $remotenes.' мин. ': 'минутах ').$model->unit->abbr.' целиком, без посредников'
                      .' от собственника Москвы.'
                     : ' | Аренда '.mb_strtolower($property->namewhats,'UTF-8').' в Москве без комиссии с удаленностью от метро в '
                      .( $remotenes ? $remotenes.' минуту(ах)': 'минутах').' '.$model->unit->abbr." (".$model->unit->short_title.")."
                      .' Снять '.mb_strtolower($property->title,'UTF-8').' в бизнес центре, особняке, банке, здании, жилом доме,'
                      .' комлексе, парке с расстоянием в '
                      .( $remotenes ? $remotenes.' мин. ': 'минутах ').$model->unit->abbr.' без посредников от собственника Москвы.')
                 : ($property->is_ceil 
                    ? ' | Аренда '.mb_strtolower($property->namewhats,'UTF-8').' в Москве без комиссии с удаленностью '
                     .($remotenes ? 'в '.$remotenes.' минуту(ах)' : 'в минутах').'.'
                     .' Снять нежилое помещение либо здание целиком c расстоянием в '
                     .( $remotenes ? $remotenes.' мин.': 'минутах').' от метро,'
                     .' без посредников от собственника Москвы.' 
                    : ' | Аренда '.mb_strtolower($property->namewhats,'UTF-8').' в Москве без комиссии с удаленностью '
                     .($remotenes ? 'в '.$remotenes.' минуту(ах)' : 'в минутах').'.'  
                     .' Снять '.mb_strtolower($property->title,'UTF-8')
                     .' в бизнес центре, особняке, банке, здании, жилом доме, комлексе, парке c расстоянием в '
                     .( $remotenes ? $remotenes.' мин.': 'минутах').' от метро,'  
                     .' без посредников от собственника Москвы.'));
                  //.($property->seo_title ? ', '.$property->seo_title : '');
                  //." - ".str_replace('офисов','офиса', Yii::t('all',Yii::app()->name));    

if ($model->unit) 
    $this->pageDescription= trim($model->unit->desc)<>'' 
                                ? 'Здесь отобраны предложения по аренде '.mb_strtolower($property->namewhats,'UTF-8').' в Москве'
                                 .' c удаленностью от метро в '.( $remotenes ? $remotenes.' минуту(ах)': 'минутах ')
                                 .' '.$model->unit->abbr." (".$model->unit->short_title."). "
                                 .trim($model->unit->seo_desc)
                                : 'Здесь отобраны предложения по аренде '.mb_strtolower($property->namewhats,'UTF-8').' в Москве'
                                 .' c удаленностью от метро в '.( $remotenes ? $remotenes.' минуту(ах)': 'минутах ')
                                 .' '.$model->unit->abbr." (".$model->unit->short_title.").";                   
else $this->pageDescription= 'Здесь отобраны предложения по аренде '.mb_strtolower($property->namewhats,'UTF-8').' c удаленностью '.($remotenes ? 'в '.$remotenes.' минуту(ах)' : 'в минутах').' от метро в Москве.';

$this->pageDescription=$this->pageDescription.($property->seo_description ? ' '.$property->seo_description : '');

if ( !$property->seo_description && !$model->unit) {
    if ($model->unit) {
        $this->pageDescription = ($property->is_ceil 
                                  ? 'Предложения включают аренду '.mb_strtolower($property->namewhats,'UTF-8').' Москвы целиком'
                                   .' c расстоянием от метро в '.( $remotenes ? $remotenes.' мин. ': 'минутах ').$model->unit->abbr
                                   .'. Аренда '.mb_strtolower($property->namewhats,'UTF-8').' в '
                                   .( $remotenes ? $remotenes.' минуте(ах) ': 'минутах ' ).$model->unit->abbr
                                   .' к метро отличается адресом, назначением, свойствами, классом, площадью, стоимостью, валютой.'
                                  : 'Предложения включают аренду '.mb_strtolower($property->namewhats,'UTF-8').' '
                                   .' c расстоянием от метро в '.( $remotenes ? $remotenes.' мин. ': 'минутах ').$model->unit->abbr
                                   .' в бизнес центре, парке, жилом комплексе, доме, особняке, здании, медцентре, банке Москвы.'
                                   .' Аренда '.mb_strtolower($property->namewhats,'UTF-8').' в '
                                   .( $remotenes ? $remotenes.' минуте(ах) ': 'минутах ' ).$model->unit->abbr
                                   .' к метро отличается объектом размещения, адресом, назначением, свойствами, классом'
                                   .' площадью, стоимостью, валютой.');
    }else{
        $this->pageDescription = ($property->is_ceil 
                                  ? 'Предложения включают аренду '.mb_strtolower($property->namewhats,'UTF-8').' Москвы целиком с расстоянием от метро в '
                                   .( $remotenes ? $remotenes.' мин. ': 'минутах.')
                                   .' Аренда '.mb_strtolower($property->namewhats,'UTF-8').' в '
                                   .( $remotenes ? $remotenes.' минуте(ах) ': 'минутах ' ).' от метро'
                                   .' отличается адресом, назначением, свойствами, классом, площадью, стоимостью, валютой.'
                                  : 'Предложения включают аренду '.mb_strtolower($property->namewhats,'UTF-8')
                                   .' в бизнес центре, парке, жилом комплексе, доме, особняке, здании, медцентре, банке Москвы '
                                   .' с расстоянием к метро в '.( $remotenes ? $remotenes.' мин. ': 'минутах.')
                                   .' Аренда '.mb_strtolower($property->namewhats,'UTF-8').' в '
                                   .( $remotenes ? $remotenes.' минуте(ах) ': 'минутах ' ).' от метро'
                                   .' отличается объектом размещения, адресом, назначением, свойствами, классом, площадью, стоимостью, валютой.');
        
    }
}

if ($model->unit->title) $this->pageKeywords=explode(',', 
                                                        ' аренда '.mb_strtolower($property->namewhats,'UTF-8').' расстояние от метро '.( $remotenes ? 'в '.$remotenes.' минутах ' : 'в минутах ').mb_strtolower($model->unit->abbr,'UTF-8')                                                        
                                                        //.', аренда '.mb_strtolower($property->namewhat,'UTF-8').' расстояние от метро '.( $remotenes ? 'в '.$remotenes.' минутах ' : 'в минутах ').mb_strtolower($model->unit->abbr,'UTF-8')
                                                        .', аренда '.mb_strtolower($property->namewhats,'UTF-8').' удаленность от метро '.( $remotenes ? 'в '.$remotenes.' минутах ' : 'в минутах ').mb_strtolower($model->unit->abbr,'UTF-8')
                                                        //.', аренда '.mb_strtolower($property->namewhats,'UTF-8').' москвы расстояние от метро '.( $remotenes ? 'в '.$remotenes.' минутах ' : 'в минутах ').mb_strtolower($model->unit->abbr,'UTF-8')
                                                        //.', аренда '.mb_strtolower($property->namewhat,'UTF-8').' москва расстояние от метро '.( $remotenes ? 'в '.$remotenes.' минутах ' : 'в минутах ').mb_strtolower($model->unit->abbr,'UTF-8')
                                                        //.', аренда '.mb_strtolower($property->namewhats,'UTF-8').' москвы удаленность от метро '.( $remotenes ? 'в '.$remotenes.' минутах ' : 'в минутах ').mb_strtolower($model->unit->abbr,'UTF-8')
                                                        //.', аренда '.mb_strtolower($property->namewhat,'UTF-8').' москва удаленность от метро '.( $remotenes ? 'в '.$remotenes.' минутах ' : 'в минутах ').mb_strtolower($model->unit->abbr,'UTF-8')
                                                     //+.', аренда '.mb_strtolower($property->namewhats,'UTF-8').' в москве '.( $remotenes ? 'в '.$remotenes.' минутах ' : 'в минутах ').mb_strtolower($model->unit->abbr,'UTF-8')
                                                     //+.', аренда '.mb_strtolower($property->namewhats,'UTF-8').' москвы '.( $remotenes ? 'в '.$remotenes.' минутах ' : 'в минутах ').mb_strtolower($model->unit->abbr,'UTF-8')
                                                     //+.', аренда '.mb_strtolower($property->namewhats,'UTF-8').' москва '.( $remotenes ? 'в '.$remotenes.' минутах ' : 'в минутах ').mb_strtolower($model->unit->abbr,'UTF-8')
                                                     //+.', аренда '.mb_strtolower($property->namewhats,'UTF-8').' '.( $remotenes ? 'в '.$remotenes.' минутах ' : 'в минутах ').mb_strtolower($model->unit->abbr,'UTF-8')
                                                     //+.', аренда '.mb_strtolower($property->namewhats,'UTF-8').' '.( $remotenes ? 'в '.$remotenes : '').mb_strtolower($model->unit->short_title,'UTF-8')
                                                     //+.', аренда '.mb_strtolower($property->namewhats,'UTF-8').' в москве '.( $remotenes ? 'в '.$remotenes.' ' : '').mb_strtolower($model->unit->short_title,'UTF-8')
                                                     //+.', аренда '.mb_strtolower($property->namewhats,'UTF-8').' москва '.( $remotenes ? 'в '.$remotenes.' ' : '').mb_strtolower($model->unit->short_title,'UTF-8')
                                                     //+.', аренда '.mb_strtolower($property->namewhats,'UTF-8').' москвы '.( $remotenes ? 'в '.$remotenes : '').mb_strtolower($model->unit->short_title,'UTF-8')                                                        
                                                        .', расстояние от метро '.( $remotenes ? 'в '.$remotenes.' минутах ' : 'в минутах ').mb_strtolower($model->unit->abbr,'UTF-8')
                                                        .', удаленность от метро '.( $remotenes ? 'в '.$remotenes.' минутах ' : 'в минутах ').mb_strtolower($model->unit->abbr,'UTF-8')
                                                        .', аренда '.mb_strtolower($property->namewhats,'UTF-8')
                                                        //.', аренда '.mb_strtolower($property->namewhat,'UTF-8')
                                                        .', '.mb_strtolower($property->namewhats,'UTF-8')
                                                        .', '.mb_strtolower($property->namewhat,'UTF-8')
                                                        .( $remotenes ? ', в '.$remotenes.' минутах '.mb_strtolower($model->unit->abbr,'UTF-8') : ', в минутах ')
                                                        .( $remotenes ? ', в '.$remotenes.' минутах '.mb_strtolower($model->unit->short_title,'UTF-8') : ' в минутах '.mb_strtolower($model->unit->short_title,'UTF-8'))                                                                        
                                                        .', '.mb_strtolower($model->unit->short_title,'UTF-8')
                                                        .', '.mb_strtolower($model->unit->abbr,'UTF-8')
                                      .($property->title ? 
                                                     //-', '.mb_strtolower($property->title,'UTF-8').' */', расстояние от метро '.( $remotenes ? 'в '.$remotenes.' минутах ' : 'в минутах ').mb_strtolower($model->unit->abbr,'UTF-8')
                                                     //-.', аренда '.mb_strtolower($property->title,'UTF-8').' в москве '.( $remotenes ? 'в '.$remotenes.' минутах ' : 'в минутах ').mb_strtolower($model->unit->abbr,'UTF-8')
                                                     //-.', аренда '.mb_strtolower($property->title,'UTF-8').' москвы '.( $remotenes ? 'в '.$remotenes.' минутах ' : 'в минутах ').mb_strtolower($model->unit->abbr,'UTF-8')
                                                     //-.', аренда '.mb_strtolower($property->title,'UTF-8').' москва '.( $remotenes ? 'в '.$remotenes.' минутах ' : 'в минутах ').mb_strtolower($model->unit->abbr,'UTF-8')
                                                     //-.', аренда '.mb_strtolower($property->title,'UTF-8').' '.( $remotenes ? 'в '.$remotenes.' минутах ' : 'в минутах ').mb_strtolower($model->unit->abbr,'UTF-8')
                                                     //-.', аренда '.mb_strtolower($property->title,'UTF-8').' '.( $remotenes ? 'в '.$remotenes : ' ').mb_strtolower($model->unit->short_title,'UTF-8')
                                                     //-.', аренда '.mb_strtolower($property->title,'UTF-8').' в москве '.( $remotenes ? 'в '.$remotenes.' ' : '').mb_strtolower($model->unit->short_title,'UTF-8')
                                                     //-.', аренда '.mb_strtolower($property->title,'UTF-8').' москва '.( $remotenes ? 'в '.$remotenes.' ' : '').mb_strtolower($model->unit->short_title,'UTF-8')
                                                     //-.', аренда '.mb_strtolower($property->title,'UTF-8').' москвы '.( $remotenes ? 'в '.$remotenes : ' ').mb_strtolower($model->unit->short_title,'UTF-8')
                                                     //-.", ".mb_strtolower($property->title,'UTF-8').( $remotenes ? ' в '.$remotenes.' минутах '.mb_strtolower($model->unit->abbr,'UTF-8') : ' в минутах ')
                                                     //-.", ".mb_strtolower($property->title,'UTF-8').( $remotenes ? ' в '.$remotenes.' минутах '.mb_strtolower($model->unit->short_title,'UTF-8') : ' в минутах '.mb_strtolower($model->unit->short_title,'UTF-8'))
                                                     //-.', '.mb_strtolower($property->title,'UTF-8').' '.mb_strtolower($model->unit->short_title,'UTF-8')                                                             
                                                         ', '.mb_strtolower($property->title,'UTF-8')     
                                                        : "")          
                                     .($property->abbr ? //', аренда '.mb_strtolower($property->abbr,'UTF-8').' расстояние от метро '.( $remotenes ? 'в '.$remotenes.' минутах ' : 'в минутах ').mb_strtolower($model->unit->abbr,'UTF-8')                                                        
                                                        //.', аренда '.mb_strtolower($property->abbr,'UTF-8').' удаленность от метро '.( $remotenes ? 'в '.$remotenes.' минутах ' : 'в минутах ').mb_strtolower($model->unit->abbr,'UTF-8')                                                                                                                        
                                                     //+.', аренда '.mb_strtolower($property->abbr,'UTF-8').' в москве '.( $remotenes ? 'в '.$remotenes.' минутах ' : 'в минутах ').mb_strtolower($model->unit->abbr,'UTF-8')
                                                     //+.', аренда '.mb_strtolower($property->abbr,'UTF-8').' москвы '.( $remotenes ? 'в '.$remotenes.' минутах ' : 'в минутах ').mb_strtolower($model->unit->abbr,'UTF-8')
                                                     //+.', аренда '.mb_strtolower($property->abbr,'UTF-8').' москва '.( $remotenes ? 'в '.$remotenes.' минутах ' : 'в минутах ').mb_strtolower($model->unit->abbr,'UTF-8')
                                                     //+.', аренда '.mb_strtolower($property->abbr,'UTF-8').' '.( $remotenes ? 'в '.$remotenes.' минутах ' : 'в минутах ').mb_strtolower($model->unit->abbr,'UTF-8')
                                                     //+.', аренда '.mb_strtolower($property->abbr,'UTF-8').' '.( $remotenes ? 'в '.$remotenes : ' ').mb_strtolower($model->unit->short_title,'UTF-8')
                                                     //+.', аренда '.mb_strtolower($property->abbr,'UTF-8').' в москве '.( $remotenes ? 'в '.$remotenes.' ' : '').mb_strtolower($model->unit->short_title,'UTF-8')
                                                     //+.', аренда '.mb_strtolower($property->abbr,'UTF-8').' москва '.( $remotenes ? 'в '.$remotenes.' ' : '').mb_strtolower($model->unit->short_title,'UTF-8')
                                                     //-.', аренда '.mb_strtolower($property->abbr,'UTF-8').' москвы '.( $remotenes ? 'в '.$remotenes : ' ').mb_strtolower($model->unit->short_title,'UTF-8')
                                                        ", ".mb_strtolower($property->abbr,'UTF-8').( $remotenes ? ' в '.$remotenes.' минутах '.mb_strtolower($model->unit->abbr,'UTF-8') : ' в минутах ')
                                                        .", ".mb_strtolower($property->abbr,'UTF-8').( $remotenes ? ' в '.$remotenes.' минутах '.mb_strtolower($model->unit->short_title,'UTF-8') : ' в минутах '.mb_strtolower($model->unit->short_title,'UTF-8'))
                                                        .', '.mb_strtolower($property->abbr,'UTF-8').' '.mb_strtolower($model->unit->short_title,'UTF-8')   
                                                        .', аренда '.mb_strtolower($property->abbr,'UTF-8')        
                                                        .', '.mb_strtolower($property->abbr,'UTF-8')
                                                        : "")   
                                                        .', снять, удаленность, удаленность от метро, расстояние от метро, недвижимость, аренда, москва, москвы, в москве, расстояние, минут, минутах, район, метро, от метро, планировка, парковка, вид, класс, налогообложение, отдельный вход, кк, свойства, арендная ставка, стоимость в месяц');                   

else $this->pageKeywords=explode(',', 'снять, удаленность, удаленность от метро, аренда в москве, недвижимоcть, аренда, расстояние от метро, расстояние, минут, '.($remotenes ? 'расстояние от метро в '.$remotenes.' минутах ' : 'расстояние от метро в минутах ').', москва, москвы, в москве, минутах, район, метро, от метро, планировка, парковка, вид, класс, налогообложение, отдельный вход, кк, свойства, арендная ставка, стоимость в месяц');        
    
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

if ($model->unit&&$property->namewhats) {
    
        $this->breadcrumbs=array(	
             Yii::t('menu-adm','List Realestates')=>array('index'),
             'по удаленности'=>array('realestates/unit'),
             $model->unit->title=>Yii::app()->createUrl('realestates/unit', array('id'=>$model->unit->id)),
             'по видам'=>array('realestates/vid'),
              mb_strtolower($property->nameov,'UTF-8')=>Yii::app()->createUrl('realestates/vid',array('id'=>$model->realestateVid->id)),
             'Аренда '.mb_strtolower($property->namewhats,'UTF-8').' с расстоянием от метро '
             .($remotenes ? ' в '.$remotenes.' '.$model->unit->short_title : ' '.$model->unit->abbr.' ('.$model->unit->short_title.')') 
        );

} else if (!$model->unit && $property->namewhats) {
    
        $this->breadcrumbs=array(	
             Yii::t('menu-adm','List Realestates')=>array('index'),
             'по удаленности'=>array('realestates/unit'),
             'по видам'=>array('realestates/vid'),
              mb_strtolower($property->nameov,'UTF-8')=>Yii::app()->createUrl('realestates/vid',array('id'=>$model->realestateVid->id)),
             'Аренда '.mb_strtolower($property->namewhats,'UTF-8')." с расстоянием ".( $remotenes ? $remotenes.' минут(а)': 'в несколько минут').' от метро'
        );
} else if ($model->unit && !$property->namewhats) {

        $this->breadcrumbs=array(	
             Yii::t('menu-adm','List Realestates')=>array('index'),
             'по удаленности'=>array('realestates/unit'),
             $model->unit->title=>Yii::app()->createUrl('realestates/unit', array('id'=>$model->unit->id)),
             'по видам'=>array('realestates/vid'),
             'Аренда коммерческой недвижимости с расстоянием от метро '
             .($remotenes ? ' в '.$remotenes.' '.$model->unit->short_title : ' '.$model->unit->abbr.' ('.$model->unit->short_title.')') 
        );    
} else {
        $this->breadcrumbs=array(	
             Yii::t('menu-adm','List Realestates')=>array('index'),
             'по удаленности'=>array('realestates/unit'),
             'по видам'=>array('realestates/vid'),
             'Аренда коммерческой недвижимости с расстоянием '.( $remotenes ? $remotenes.' минут(а)': 'в несколько минут').' от метро'
        );
}
//.($property->breadcrumbs ? ', '.$property->breadcrumbs : '')
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
                ($model->unit 
                  ? ($property->is_ceil 
                     ? 'Аренда '.mb_strtolower($property->namewhats,'UTF-8')
                      .' в Москве без комиссии с удаленностью от метро в '
                      .( $remotenes ? $remotenes.' минуту(ах)': 'минутах').' '.$model->unit->abbr." (".$model->unit->short_title.")."
                      .' Снять '.mb_strtolower($property->title,'UTF-8').' с расстоянием от метро в '
                      .( $remotenes ? $remotenes.' мин. ': 'минутах ').$model->unit->abbr.' целиком, без посредников'
                      .' от собственника Москвы.'
                     : 'Аренда '.mb_strtolower($property->namewhats,'UTF-8').' в Москве без комиссии с удаленностью от метро в '
                      .( $remotenes ? $remotenes.' минуту(ах)': 'минутах').' '.$model->unit->abbr." (".$model->unit->short_title.")."
                      .' Снять '.mb_strtolower($property->title,'UTF-8').' в бизнес или торговом центре, особняке, банке, административном здании, жилом доме,'
                      .' комлексе, парке с расстоянием от метро в '
                      .( $remotenes ? $remotenes.' мин. ': 'минутах ').$model->unit->abbr.', без посредников от собственника Москвы.')
                 : ($property->is_ceil 
                    ? 'Аренда '.mb_strtolower($property->namewhats,'UTF-8').' в Москве без комиссии с удаленностью '
                     .($remotenes ? 'в '.$remotenes.' минуту(ах)' : 'в минутах').'.'
                     .' Снять нежилое помещение либо здание целиком c расстоянием в '
                     .( $remotenes ? $remotenes.' мин.': 'минутах').' от метро,'
                     .' без посредников по стоимости аренды от собственника Москвы.' 
                    : 'Аренда '.mb_strtolower($property->namewhats,'UTF-8').' в Москве без комиссии с удаленностью '
                     .($remotenes ? 'в '.$remotenes.' минуту(ах)' : 'в минутах').'.'  
                     .' Снять '.mb_strtolower($property->title,'UTF-8')
                     .' в бизнес или торговом центре, особняке, банке, административном здании, жилом доме, комлексе, парке c расстоянием в '
                     .( $remotenes ? $remotenes.' мин.': 'минутах').' от метро,'  
                     .' без посредников по стоимости аренды от собственника Москвы.'));?>     
</h1>

<?php if ( $property->anons) {  ?>    
<div class="desc anons m-b18 fs-11 ff-Arial justify">        
    <?php if ( $property->anons ) {  ?>    
    <div <?php echo ($model->realestateClass->anons ? 'class="m-t10"' : '') ?>>
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
    //if ($remotenes) $model->search()->pagination->route = Yii::app()->createUrl('/realestates/unit', array('id'=>$model->unit_id,'remotenes'=>$remotenes));
    //else $model->search()->pagination->route = Yii::app()->createUrl('/realestates/unit', array('id'=>$model->unit_id));
    
    if ($remotenes) $model->search()->pagination->route = Yii::app()->createUrl('/realestates/unit', array('id'=>$model->unit_id,'remotenes'=>$remotenes,'vid'=>$model->realestateVid->id));
    else $model->search()->pagination->route = Yii::app()->createUrl('/realestates/unit', array('id'=>$model->unit_id,'vid'=>$model->realestateVid->id));
    
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
                        //'remoteness',
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
            //'remoteness',
            'price',
            'valute'=>'Валюта',
            'unit'=>'Способ',
            'district'=>'Округ',
            'areas'=>'Район',
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
        'beforeAjaxUpdate'=>$beforeAjaxUpdate,
        'afterAjaxUpdate'=>$afterAjaxUpdate,  
        /*'ajaxUrl'=> $remotenes ? Yii::app()->createUrl('/realestates/unit', array('id'=>$model->unit_id,'remotenes'=>$remotenes,'vid'=>$model->realestateVid->id))
                                  : Yii::app()->createUrl('/realestates/unit', array('id'=>$model->unit_id,'vid'=>$model->realestateVid->id))*/
        
)); ?>    

   <?php   $this->renderPartial('_send',array('model'=>$model_claim));?>

    </div>
    <hr class="m-t10 m-b8" />
    
    <?php if (!$is_list) { ?>
    <?php   $this->renderPartial('/site/_list_metros', array('model'=>$model)); ?>  
    <?php } ?>
    
    <?php if ( $property->detile ) {  ?>    
    <div class="desc detile m-t8 m-b14 fs-10 ff-tahoma">    
        <?php if ( $property->detile ) {  ?>    
            <div>
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
    
    <?php if ( $property->description ) {  ?>    
    <div class="desc detile m-b18 fs-10 ff-tahoma">    
        <?php if ( $property->description ) {  ?>    
            <div>
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
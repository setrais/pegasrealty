<? if ($model) {
    
        $criteria = $model->criteria();        
        $criteria->group = 't.areas_id';
        $criteria->addCondition('t.areas_id IS NOT NULL AND ((t.act=1)OR(t.act is NULL))AND((t.del=0)OR(t.del is NULL))');
        $criteria->join = 'LEFT JOIN areas ON areas.id = t.areas_id';
        $criteria->order = 'areas.title ASC';        
        $criteria->select = 't.areas_id,areas.title,areas.id';        
        
        if ( $model->realestateDestinations ) {
            $criteria->addCondition('realestateDestinations.id='. $model->realestateDestinations);
            $criteria->with = 'realestateDestinations';
        }
        if ( $model->realestatesProperties ) {
            $criteria->addCondition('realestatesProperties.id='. $model->realestatesProperties);
            $criteria->with = 'realestatesProperties';
        }
        
        if (Yii::app()->getRequest()->getParam('area-from')&&Yii::app()->getRequest()->getParam('area-to')) {
            $criteria->addBetweenCondition('area', Yii::app()->getRequest()->getParam('area-from'), Yii::app()->getRequest()->getParam('area-to'));                   
        } 

        $areas =  $model->findAll($criteria);
   }else{
        /*$model = Realestates::model();
        $criteria = new CDbCriteria;
        $criteria->group = 't.street_id';
        $criteria->addCondition('t.street_id IS NOT NULL AND ((t.act=1)OR(t.act is NULL))AND((t.del=0)OR(t.del is NULL))');
        $criteria->join = 'LEFT JOIN streets ON streets.id = t.street_id';
        $criteria->order = 'streets.name ASC';
        $streets =  $model->findAll($criteria);*/
        $model = Areas::model()->sitemap();
        $criteria = new CDbCriteria;
        $criteria->order  = 't.title ASC';   
        $areas = $model->findAll($criteria);          
        $is_main = true;
   }
 
   $cntcol=7;  
   $cntrow = ceil(count($areas)/$cntcol);
   if ($areas) {
       foreach ($areas as $area) {
           if (!$is_main) {
              if (!isset($extvid)) {
                  $li_areas[]= Chtml::tag('li', array(), Chtml::link( $area->areas->title, 
                                                                      Yii::app()->createUrl('realestates/areas',array('id' => $area->areas->id )), 
                                                                      array('title'=>'Аренда коммерческой недвижимости в районе './*'Аренда офиса район '.$area->areas->title*/$area->areas->namewhat.' в Москве')));
              }else{
                  $li_areas[]= Chtml::tag('li', array(),Chtml::link( $area->areas->title, 
                                                                     Yii::app()->createUrl('realestates/areas',array('id' => $area->areas->id, 'property' =>$extvid->type, 'pid' => $extvid->id)),                        
                                                                     array('title'=>'Аренда '.$extvid->namewhats.' в районе './*'Аренда офиса район '.$area->areas->title*/$area->areas->namewhat.' в Москве')));
              }                           
           }else{
              if (!isset($extvid)) { 
                  $li_areas[]= Chtml::tag('li', array(),Chtml::link( $area->title,
                                                                      Yii::app()->createUrl('realestates/areas',array('id'=>$area->id )),
                                                                      array('title'=>'Аренда коммерческой недвижимости в районе './*'Аренда офиса район '.$area->title*/$area->namewhat.' в Москве')));           
              }else{
                  $li_areas[]= Chtml::tag('li', array(),Chtml::link( $area->title,
                                                                     Yii::app()->createUrl('realestates/areas',array('id'=>$area->id, 'property' =>$extvid->type, 'pid' => $extvid->id )),
                                                                     array('title'=>'Аренда '.$extvid->namewhats.' в районе './*'Аренда офиса район '.$area->title*/$area->namewhat.' в Москве')));                             
              }    
           }    
       }              

       $arli_areas=array_chunk($li_areas, $cntrow, false);
?>

    <?/*<h2 class="list <?php /*m-t16?>">Снять в аренду офис по районам, <?php echo CHtml::link(CHtml::encode('коммерческая недвижимость - аренда офиса Москвы:'), array('realestates/index'), array('title'=>'коммерческая недвижимость - аренда офиса Москвы:', 'class'=>"c-black"));?></h2>*/?>     
    <h2 class="list <?/*fs-11 m-0 p-0 c-black inline-valn ff-tahoma m-b5 bold*/?>">   
        <?php if ($extvid->head) { 
            echo $extvid->head;
        ?>        
        <?php } else { ?>
        Снять в аренду <?=isset($extvid) ? $extvid->namewhat 
                                         : 'коммерческую недвижимость'/*офис, нежилое помещение или здание'*/;?> в районе
        <?php } ?>                                 
    </h2>     
                                         
    <table>
       <tr>
         <?     
            foreach ( $arli_areas as $areas ) {
         ?>
         <td width="<?=100/$cntcol;?>%" class="valign-t fs-9 ff-Arial"><?=CHtml::tag('ul', array("style"=>"margin: 0 0em 1.2em 0;padding-left: 1.3em;list-style-type: circle;"),implode('',$areas));?></td> 
         <?    
            }
         ?>        
      </tr>        
    </table>    
<? } ?>
<? if ($model) {
    
        $criteria = $model->criteria();        
        $criteria->group = 't.district_id';
        $criteria->addCondition('t.district_id IS NOT NULL AND ((t.act=1)OR(t.act is NULL))AND((t.del=0)OR(t.del is NULL))');
        $criteria->join = 'LEFT JOIN districts ON districts.id = t.district_id';
        $criteria->order = 'districts.title ASC';  
        $criteria->select = 't.district_id,districts.id, districts.title, districts.abbr';  
        
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

        $records =  $model->findAll($criteria);
   }else{
        $model = Districts::model()->sitemap()->realex();
        $criteria = new CDbCriteria;
        $criteria->order  = 't.title ASC';   
        $records = $model->findAll($criteria);          
        $is_main = true;
   }
 
   $cntcol=3;  
   $cntrow = ceil(count($records)/$cntcol);
   if ($records) {
       foreach ($records as $record) {
           if (!$is_main) {
              if (!isset($extvid)) {
                  $li_record[]= Chtml::tag( 'li', 
                                            array(), 
                                            Chtml::link( 'Аренда коммерческой недвижимости '
                                                        .(mb_strtolower($record->district->title,'UTF-8')==mb_strtolower("центр",'UTF-8') ? "в" : "на")
                                                        .' '.mb_strtolower($record->district->title,'UTF-8').'е '.'('.$record->district->abbr.')', 
                                                        Yii::app()->createUrl( 'realestates/district', array( 'id' => $record->district->id )), 
                                                        array( 'title' => 'Аренда коммерческой недвижимости '
                                                                         .(mb_strtolower($record->district->title,'UTF-8')==mb_strtolower("центр",'UTF-8') ? "в" : "на")
                                                                         .' '.mb_strtolower($record->district->title,'UTF-8').'е '.'('.$record->district->abbr.')'.' в Москве')));
              }else{
                  $li_record[]= Chtml::tag('li', array(),
                                            Chtml::link( 'Аренда '.$extvid->namewhats
                                                        .' '.(mb_strtolower($record->district->title,'UTF-8')==mb_strtolower("центр",'UTF-8') ? "в" : "на")
                                                        .' '.mb_strtolower($record->district->title,'UTF-8').'е '.'('.$record->district->abbr.')', 
                                                        Yii::app()->createUrl( 'realestates/district', 
                                                            array( 'id' => $record->district->id, 
                                                             'property' => $extvid->type, 
                                                                  'pid' => $extvid->id)),                        
                                                        array(  'title' =>'Аренда '.$extvid->namewhats.' '.(mb_strtolower($record->district->title,'UTF-8')==mb_strtolower("центр",'UTF-8') ? "в" : "на")
                                                        .' '.mb_strtolower($record->district->title,'UTF-8').'е '.'('.$record->district->abbr.')'.' в Москве')));
              }                           
           }else{
              if (!isset($extvid)) { 
                  $li_record[]= Chtml::tag( 'li', 
                                            array(), 
                                            Chtml::link( 'Аренда коммерческой недвижимости '
                                                        .(mb_strtolower($record->title,'UTF-8')==mb_strtolower("центр",'UTF-8') ? "в" : "на")
                                                        .' '.mb_strtolower($record->title,'UTF-8').'е '.'('.$record->abbr.')', 
                                                        Yii::app()->createUrl( 'realestates/district', array( 'id' => $record->id )), 
                                                        array( 'title' => 'Аренда коммерческой недвижимости '
                                                                         .(mb_strtolower($record->title,'UTF-8')==mb_strtolower("центр",'UTF-8') ? "в" : "на")
                                                                         .' '.mb_strtolower($record->title,'UTF-8').'е '.'('.$record->abbr.')'.' в Москве')));
              }else{
                  $li_record[]= Chtml::tag('li', array(),
                                            Chtml::link( 'Аренда '.$extvid->namewhats
                                                        .' '.(mb_strtolower($record->title,'UTF-8')==mb_strtolower("центр",'UTF-8') ? "в" : "на")
                                                        .' '.mb_strtolower($record->title,'UTF-8').'е '.'('.$record->abbr.')', 
                                                        Yii::app()->createUrl( 'realestates/district', 
                                                            array( 'id' => $record->id, 
                                                             'property' => $extvid->type, 
                                                                  'pid' => $extvid->id)),                        
                                                        array(  'title' =>'Аренда '.$extvid->namewhats.' '.(mb_strtolower($record->title,'UTF-8')==mb_strtolower("центр",'UTF-8') ? "в" : "на")
                                                        .' '.mb_strtolower($record->title,'UTF-8').'е '.'('.$record->abbr.')'.' в Москве')));                       
              }    
           }    
       }              

       $arli_record=array_chunk($li_record, $cntrow, false);
?>

    <?/*<h2 class="list <?php /*m-t16?>">Снять в аренду офис по районам, <?php echo CHtml::link(CHtml::encode('коммерческая недвижимость - аренда офиса Москвы:'), array('realestates/index'), array('title'=>'коммерческая недвижимость - аренда офиса Москвы:', 'class'=>"c-black"));?></h2>*/?>     
    <h2 class="list <?/*fs-11 m-0 p-0 c-black inline-valn ff-tahoma m-b5 bold*/?>">   
        <?php if ($extvid->head) { 
            echo $extvid->head;
        ?>        
        <?php } else { ?>
        Снять в аренду <?=isset($extvid) ? $extvid->namewhat 
                                         : 'коммерческую недвижимость'/*офис, нежилое помещение или здание'*/;?> по округам в Москве:
        <?php } ?>                                 
    </h2>     
                                         
    <table>
       <tr>
         <?     
            foreach ( $arli_record as $record ) {
         ?>
         <td width="<?=100/$cntcol;?>%" class="valign-t fs-9 ff-Arial"><?=CHtml::tag('ul', array("style"=>"margin: 0 0em 1.2em 0;padding-left: 1.3em;list-style-type: circle;"),implode('',$record));?></td> 
         <?    
            }
         ?>        
      </tr>        
    </table>    
<? } ?>
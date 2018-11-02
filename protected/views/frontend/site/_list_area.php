<? if ($model) {
        
        $criteria = $model->criteria();                         
        $criteria->select = 't.id';          
        //$criteria->params = $model->dbCriteria->params;
        
        if ( $model->realestateDestinations ) {
            $criteria->addCondition('realestateDestinations.id='. $model->realestateDestinations);
            $criteria->with = 'realestateDestinations';
        }
        if ( $model->realestatesProperties ) {
            $criteria->addCondition('realestatesProperties.id='. $model->realestatesProperties);
            $criteria->with = 'realestatesProperties';
        }
        
        if (Yii::app()->getRequest()->getParam('area-from')&&Yii::app()->getRequest()->getParam('area-to')) {
            $criteria->addBetweenCondition('t.area', Yii::app()->getRequest()->getParam('area-from'), Yii::app()->getRequest()->getParam('area-to'));                   
        } 
        
        
        // Объединение скритериев    
        $newmodel = new Realestates();      
        $newmodel->getDbCriteria()->mergeWith( $criteria );
        
        //$reals = CHtml::listData($model->findAll($criteria), 'id', 'id');        
        
        $records = FareaOffers::model()->active()
                                     ->mapfields()
                                     ->firstcreate()
                                     //->realexin( implode( ',', $reals) ) 
                                     ->realexsel( $newmodel->getSqlText() )
                                     ->findAll();
        //$model = $oldmodel;
   }else{
        
        $records = FareaOffers::model()->active()
                                      ->mapfields()
                                      ->firstcreate()
                                      ->realex()
                                      ->findAll();        
   }
 
   $cntcol=( (!empty($extvid->from) ? 1 : 0)
            +(!empty($extvid->between) ? 1 : 0)
            +(!empty($extvid->to) ? 1 : 0) <3 
                ? ( count(explode(' ',$extvid->namewhats))>1 || empty($extvid)
                    ? 3 : 4 ) 
                : 3 
           );   
   
   $cntrow = ceil(count($records)*( (!empty($extvid->from) ? 1 : 0)+
                                    (!empty($extvid->between) ? 1 : 0)+
                                    (!empty($extvid->to) ? 1 : 0)
                                        ? (!empty($extvid->from) ? 1 : 0)+
                                          (!empty($extvid->between) ? 1 : 0)+
                                          (!empty($extvid->to) ? 1 : 0)
                                        : 3 
                                  )/$cntcol);
   $li_record = array();
   if ($records) {
       foreach ($records as $record) {
              if (!isset($extvid)) {
                  if (!empty($extvid->from)) {
                       $li_record[]= Chtml::tag('li', array(), Chtml::link( 'Аренда коммерческой недвижимости с площадью от '.trim($record->init_value)." м2", 
                                                                      Yii::app()->createUrl( 'realestates/areaFrom', array( 'id' => $record->id )), 
                                                                      array( 'title' => 'Аренда коммерческой недвижимости с площадью от '.trim($record->init_value)." м2".', в Москве',
                                                                             'alt' => 'Аренда коммерческой недвижимости с площадью от '.trim($record->init_value)." м2".', в Москве'
                                                                           )));
                  }
                  if (!empty($extvid->between)) {
                      $li_record[]= Chtml::tag('li', array(), Chtml::link( 'Аренда коммерческой недвижимости с площадью от '.trim($record->init_value)." м2 до ".trim($record->final_value).' м2', 
                                                                      Yii::app()->createUrl( 'realestates/area', array( 'id' => $record->id )), 
                                                                      array( 'title' => 'Аренда коммерческой недвижимости с площадью от '.trim($record->init_value)." м2 до ".trim($record->final_value).' м2, в Москве',
                                                                             'alt' => 'Аренда коммерческой недвижимости с площадью от '.trim($record->init_value)." м2 до ".trim($record->final_value).' м2, в Москве'
                                                                           )));
                  }    
                  if (!empty($extvid->to)) {
                      $li_record[]= Chtml::tag('li', array(), Chtml::link( 'Аренда коммерческой недвижимости с площадью до '.trim($record->final_value).' м2', 
                                                                      Yii::app()->createUrl( 'realestates/areaTo', array( 'id' => $record->id )), 
                                                                      array( 'title' => 'Аренда коммерческой недвижимости с площадью до '.trim($record->final_value).' м2, в Москве',
                                                                             'alt' => 'Аренда коммерческой недвижимости с площадью до '.trim($record->final_value).' м2, в Москве'
                                                                           )));
                  }    
              }else{
                  if (!empty($extvid->from)) {
                      $li_record[]= Chtml::tag('li', array(),Chtml::link( 'Аренда '.$extvid->namewhats.' с площадью от '.trim($record->init_value)." м2", 
                                                                     Yii::app()->createUrl( 'realestates/areaFrom', 
                                                                             array( 'id' => $record->id, 
                                                                              'property' => $extvid->type, 
                                                                                   'pid' => $extvid->id)),                        
                                                                     array('title'=>'Аренда '.$extvid->namewhats.' с площадью от '.trim($record->init_value).' м2, в Москве',
                                                                             'alt' => 'Аренда '.$extvid->namewhats.' с площадью от '.trim($record->init_value).' м2, в Москве'
                                                                            )));
                  }
                  if (!empty($extvid->between)) {
                      $li_record[]= Chtml::tag('li', array(),Chtml::link( 'Аренда '.$extvid->namewhats.' с площадью от '.trim($record->init_value)." м2 до ".trim($record->final_value).' м2', 
                                                                     Yii::app()->createUrl( 'realestates/area', 
                                                                             array( 'id' => $record->id, 
                                                                              'property' => $extvid->type, 
                                                                                   'pid' => $extvid->id)),                        
                                                                     array('title'=>'Аренда '.$extvid->namewhats.' с площадью от '.trim($record->init_value)." м2 до ".trim($record->final_value).' м2, в Москве',
                                                                             'alt' => 'Аренда '.$extvid->namewhats.' с площадью от '.trim($record->init_value)." м2 до ".trim($record->final_value).' м2, в Москве'
                                                                            )));
                  }
                  if (!empty($extvid->to)) {
                      $li_record[]= Chtml::tag('li', array(),Chtml::link( 'Аренда '.$extvid->namewhats.' с площадью до '.trim($record->final_value).' м2', 
                                                                     Yii::app()->createUrl( 'realestates/areaTo', 
                                                                             array( 'id' => $record->id, 
                                                                              'property' => $extvid->type, 
                                                                                   'pid' => $extvid->id)),                        
                                                                     array('title'=>'Аренда '.$extvid->namewhats.' с площадью до '.trim($record->final_value).' м2, в Москве',
                                                                             'alt' => 'Аренда '.$extvid->namewhats.' с площадью до '.trim($record->final_value).' м2, в Москве'
                                                                             )));
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
                                         : 'коммерческую недвижимость'/*офис, нежилое помещение или здание'*/;?> в Москве с площадью от и до м2:
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
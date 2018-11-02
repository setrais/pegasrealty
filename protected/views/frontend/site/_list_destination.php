<? if ($model) {
    
        $criteria = $model->criteria();                            
        $criteria->select = 't.id';                       
        
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
        
        // Объединение скритериев
        // Объединение скритериев     
        $newmodel = new Realestates();      
        $newmodel->getDbCriteria()->mergeWith( $criteria );
        
        //$reals = CHtml::listData($model->findAll($criteria), 'id', 'id');        
        
        $records = Destinations::model()->active()
                                        ->mapfields()                                                             
                                        ->firstcreate()
                                        //->realexin( implode( ',', $reals) ) 
                                        ->realexsel($newmodel->getSqlText())
                                        ->findAll();        
        //$records =  $model->findAll($criteria);
   }else{       
        $model = Destinations::model()->mapfields()                                                             
                                      ->realex()
                                      ->firstcreate()
                                      ->findAll();
        
        $criteria = new CDbCriteria;
        $criteria->order  = 't.title ASC';   
        $records = $model->findAll($criteria);          
   }
 
   $cntcol=3;  
   $cntrow = ceil(count($records)/$cntcol);
   if ($records) {
       
       foreach ($records as $record) {
              if (!isset($extvid)) {
                  $li_record[]= Chtml::tag('li', array(), Chtml::link( 'Аренда коммерческой недвижимости под '.mb_strtolower($record->under,'UTF-8')/*.' в Москве'*/, 
                                                                      Yii::app()->createUrl( 'realestates/destination', array( 'id' => $record->id )), 
                                                                      array( 'title' => 'Аренда коммерческой недвижимости c назначением под '.mb_strtolower($record->under,'UTF-8').' в Москве')));
              }else{
                  $li_record[]= Chtml::tag('li', array(),Chtml::link( 'Аренда '.$extvid->namewhats.' под '.mb_strtolower($record->under,'UTF-8')/*.' в Москве'*/, 
                                                                     Yii::app()->createUrl( 'realestates/destination', 
                                                                             array( 'id' => $record->id, 
                                                                              'property' => $extvid->type, 
                                                                                   'pid' => $extvid->id)),                        
                                                                     array('title'=>'Аренда '.$extvid->namewhats.' c назначением под '.mb_strtolower($record->under,'UTF-8').' в Москве')));
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
                                         : 'коммерческую недвижимость'/*офис, нежилое помещение или здание'*/;?> в Москве по назначениям:
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
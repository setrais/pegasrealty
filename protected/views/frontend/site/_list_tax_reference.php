<? if ($model) {
    
        $criteria = $model->criteria();        
        $criteria->group = 't.number_tax';
        $criteria->addCondition('t.number_tax IS NOT NULL AND ((t.act=1)OR(t.act is NULL))AND((t.del=0)OR(t.del is NULL))');
        $criteria->join = 'LEFT JOIN tax_reference ON tax_reference.id = t.number_tax';
        $criteria->order = 'tax_reference.abbr ASC';  
        $criteria->select = 't.number_tax, tax_reference.id, tax_reference.abbr';  
        
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
        $model = TaxReference::model()->sitemap();
        $criteria = new CDbCriteria;
        $criteria->order  = 't.abbr ASC';   
        $records = $model->findAll($criteria);          
        $is_main = true;
   }
 
   $cntcol=(count(explode(' ',$extvid->namewhats))>1 || empty($extvid) ? 3 : 4);  
   
   $cntrow = ceil(count($records)/$cntcol);
   if ($records) {
       foreach ($records as $record) {
           if (!$is_main) {
              if (!isset($extvid)) {
                  $li_record[]= Chtml::tag('li', array(), Chtml::link( 'Аренда коммерческой недвижимости '.$record->taxReference->abbr,'UTF-8'.' в Москве', 
                                                                      Yii::app()->createUrl( 'realestates/taxReference', array( 'id' => $record->taxReference->id )), 
                                                                      array( 'title' => 'Аренда коммерческой недвижимости '.$record->taxReference->abbr.' в Москве')));
              }else{
                  $li_record[]= Chtml::tag('li', array(),Chtml::link( 'Аренда '.$extvid->namewhats.' '.$record->taxReference->abbr.' в Москве', 
                                                                     Yii::app()->createUrl( 'realestates/taxReference', 
                                                                             array( 'id' => $record->taxReference->id, 
                                                                              'property' => $extvid->type, 
                                                                                   'pid' => $extvid->id)),                        
                                                                     array('title'=>'Аренда '.$extvid->namewhats.' '.$record->taxReference->abbr.' в Москве')));
              }                           
           }else{
              if (!isset($extvid)) { 
                   $li_record[]= Chtml::tag('li', array(), Chtml::link( 'Аренда коммерческой недвижимости '.$record->abbr.' в Москве', 
                                                                      Yii::app()->createUrl( 'realestates/taxReference', array( 'id' => $record->id )), 
                                                                      array( 'title' => 'Аренда коммерческой недвижимости '.$record->abbr.' в Москве')));
              }else{
                  $li_record[]= Chtml::tag('li', array(),Chtml::link( 'Аренда '.$extvid->namewhats.' '.$record->abbr.' в Москве', 
                                                                     Yii::app()->createUrl( 'realestates/taxReference', 
                                                                             array( 'id' => $record->id, 
                                                                              'property' => $extvid->type, 
                                                                                   'pid' => $extvid->id)),                        
                                                                     array('title'=>'Аренда '.$extvid->namewhats.' '.$record->abbr.' в Москве')));                           
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
                                         : 'коммерческую недвижимость'/*офис, нежилое помещение или здание'*/;?> в Москве по ИФНС:
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
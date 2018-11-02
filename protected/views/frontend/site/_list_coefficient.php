<? if ($model) {
    
        $criteria = $model->criteria();        
        $criteria->group = 't.coefficient_corridor';
        $criteria->addCondition('t.coefficient_corridor IS NOT NULL AND ((t.act=1)OR(t.act is NULL))AND((t.del=0)OR(t.del is NULL))');
        $criteria->order = 't.coefficient_corridor ASC';                       
        $criteria->select = 't.id, t.coefficient_corridor';                       
        
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

        $model = Realestates::model()->active()
                                     ->realex()
                                     ->findAll( array( 'select' => 't.id,t.coefficient_corridor',
                                                    'condition' => 't.coefficient_corridor > 0',
                                                        'group' => 't.coefficient_corridor',
                                                   //'distinct' => true,
                                                      ));
        $criteria = new CDbCriteria;
        $criteria->order  = 't.coefficient_corridor ASC';   
        $records = $model->findAll($criteria);          
   }
   
   $cntcol=4;  
   $cntrow = ceil(count($records)/$cntcol);
   $ascoef = array_combine(range(1,26,1),range(5,30,1));
   
   if ($records) {
       foreach ($records as $record) {
                                                   
           $coef = $ascoef[$record->coefficient_corridor]; 
           if (!isset($extvid)) {
               $li_record[]= Chtml::tag( 'li', array(), 
                                         Chtml::link( 'Аренда коммерческой недвижимости c кор.коэфф. '.$coef.'% в Москве'/*$clas->realestateClass->title*/, 
                                                       Yii::app()->createUrl( 'realestates/coefficient', array( 'id' => $record->coefficient_corridor )), 
                                                       array( 'title' => 'Аренда коммерческой недвижимости с коридорным коэффициентом '.$coef.'% в Москве')));
           }else{
               $li_record[]= Chtml::tag( 'li', array(), 
                                         Chtml::link( 'Аренда '.$extvid->namewhats.' c кор.коэфф. '.$coef.'% в Москве', 
                                                       Yii::app()->createUrl( 'realestates/coefficient', 
                                                                             array( 'id' => $record->coefficient_corridor, 
                                                                              'property' => $extvid->type, 
                                                                                   'pid' => $extvid->id)),                        
                                                       array('title'=>'Аренда '.$extvid->namewhats.' c кор.коэфф. '.$coef.'% в Москве')));
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
                                         : 'коммерческую недвижимость'/*офис, нежилое помещение или здание'*/;?> в Москве по коридорным коэффиентам:
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
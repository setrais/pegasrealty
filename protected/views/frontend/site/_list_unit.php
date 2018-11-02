<? if ($model) {
    
        $criteria = $model->criteria();        
        $criteria->group = 't.unit_id';
        $criteria->addCondition('t.unit_id IS NOT NULL AND ((t.act=1)OR(t.act is NULL))AND((t.del=0)OR(t.del is NULL))');
        $criteria->join = 'LEFT JOIN units ON units.id = t.unit_id';
        $criteria->order = 'units.abbr ASC';                       
        $criteria->select = 't.unit_id, units.id, units.abbr, units.short_title, units.title';                       
        
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
        if ($extvid->units || !isset($extvid->units)) $records =  $model->findAll($criteria);
            
        if ($extvid->remoteunits || !isset($extvid->remoteunits)) {
        
            $criteria->group = 't.remoteness,t.unit_id';
            $criteria->order = 't.remoteness,t.unit_id';                       
           $criteria->select = 't.unit_id, units.id, units.abbr, units.short_title, t.remoteness'; 
                
            $remoteunits = $model->findAll($criteria);
        }    
        
        if ($extvid->remoteness || !isset($extvid->remoteness)) {            
            $criteria->group = 't.remoteness';
            $criteria->order = 't.remoteness';                       
            $criteria->select = 't.remoteness'; 
                
            $remoteness = $model->findAll($criteria);
        }    
        
   }else{
       if ($extvid->units || !isset($extvid->units)) {
           $model = Units::model()->sitemap()
                                   ->realex()
                                   ->findAll();
           $criteria = new CDbCriteria;
           $criteria->order  = 't.abbr ASC';   
           $records = $model->findAll($criteria);                  
       }
       if ($extvid->remoteness || !isset($extvid->remoteness)) {
           $remoteunits = Realestates::model()->realex()
                          ->findAll( array( 'condition' => '((t.act=1)OR(t.act is NULL))AND((t.del=0)OR(t.del is NULL)) AND (t.unit_id IS NOT NULL)', 
                                            'select' => 't.unit_id,t.remoteness,unit.short_title,unit.abbr',
                                             'group' => 't.remoteness,t.unit_id',
                                             'order' => 't.remoteness,t.unit_id',
                                              'join' => 'LEFT JOIN units unit on unit.id=t.unit_id'));
       }
       if ($extvid->remoteunits || !isset($extvid->remoteunits)) {
           $remoteness = Realestates::model()->realex()
                         ->findAll( array( 'condition' => '((t.act=1)OR(t.act is NULL))AND((t.del=0)OR(t.del is NULL))',
                                                   'group' => 't.remoteness',
                                                  'select' => 't.remoteness',
                                                   'order' => 't.remoteness asc'));
       }                             
       $is_main = true;
   }
 
   $cntcol = 3;  
   $li_records = $li_remoteunits = $li_remoteness = array();
   
   if ($records ) {
       foreach ($records as $record) {
           if (!$is_main) {
              if (!isset($extvid)) {
                  $li_records[]= Chtml::tag('li', array(), Chtml::link( 'Аренда коммерческой недвижимости - от метро '.$record->unit->abbr." (".$record->unit->short_title.")", 
                                                                      Yii::app()->createUrl( 'realestates/unit', array( 'id' => $record->unit->id )), 
                                                                      array( 'title' => 'Аренда коммерческой недвижимости в Москве, с возможность добираться от метро '.$record->unit->abbr." (".$record->unit->short_title.")")));
              }else{
                  $li_records[]= Chtml::tag('li', array(),Chtml::link( 'Аренда '.$extvid->namewhats.' в Москве, от метро '.$record->unit->abbr." (".$record->unit->short_title.")", 
                                                                     Yii::app()->createUrl( 'realestates/unit', 
                                                                             array( 'id' => $record->unit->id, 
                                                                           $extvid->type => $extvid->id)),                        
                                                                     array('title'=>'Аренда '.$extvid->namewhats.' в Москве, с возможность добираться от метро '.$record->unit->abbr." (".$record->unit->short_title.")")));
              }                           
           }else{
              if (!isset($extvid)) {
                  $li_records[]= Chtml::tag('li', array(), Chtml::link( 'Аренда коммерческой недвижимости - от метро '.$record->abbr." (".$record->short_title.")", 
                                                                      Yii::app()->createUrl( 'realestates/unit', array( 'id' => $record->id )), 
                                                                      array( 'title' => 'Аренда коммерческой недвижимости в Москве, с возможность добираться от метро '.$record->abbr." (".$record->short_title.")")));
              }else{
                  $li_records[]= Chtml::tag('li', array(),Chtml::link( 'Аренда '.$extvid->namewhats.' в Москве, от метро '.$record->abbr." (".$record->short_title.")", 
                                                                     Yii::app()->createUrl( 'realestates/unit', 
                                                                             array( 'id' => $record->id, 
                                                                           $extvid->type => $extvid->id)),                       
                                                                     array('title'=>'Аренда '.$extvid->namewhats.' в Москве, с возможность добираться от метро '.$record->abbr." (".$record->short_title.")")));
              }                           
           }    
       }   
       $cntrow = ceil(count($li_records)/$cntcol);
       $arli_record=array_chunk($li_records, $cntrow, false); 

   }
   
   if ($remoteunits) {       
       foreach ($remoteunits as $remoteunit) {
           if (!isset($extvid)) {
                  $li_remoteunits[]= Chtml::tag('li', array(), 
                                            Chtml::link( 'Аренда коммерческой недвижимости c удаленностью '.round($remoteunit->remoteness)
                                                        .' '.$remoteunit->unit->short_title, 
                                                          Yii::app()->createUrl( 'realestates/unit', 
                                                              ( $remoteunit->unit->id  ? array( 'remotenes' => round($remoteunit->remoteness),
                                                                                               'id' => $remoteunit->unit->id ) 
                                                                                      : array( 'remotenes' => round($remoteunit->remoteness))
                                                              )
                                                          ), 
                                                          array( 'title' => 'Аренда коммерческой недвижимости с удаленностью '.round($remoteunit->remoteness)
                                                                           .' минут '.$remoteunit->unit->abbr." (".$remoteunit->unit->short_title.")".' в Москве')));
          }else{
                  $li_remoteunits[]= Chtml::tag('li', array(),
                                            Chtml::link( 'Аренда '.$extvid->namewhats.' c удаленностью '.round($remoteunit->remoteness)
                                                        .' '.$remoteunit->unit->short_title, 
                                                         Yii::app()->createUrl( 'realestates/unit', 
                                                              ( $remoteunit->unit->id  ? array( 'remotenes' => round($remoteunit->remoteness),
                                                                                              'id' => $remoteunit->unit->id, $extvid->type => $extvid->id ) 
                                                                                      : array( 'remotenes' => round($remoteunit->remoteness), $extvid->type => $extvid->id)
                                                              )
                                                         ),                        
                                                         array('title'=>'Аренда '.$extvid->namewhats.' с удаленностью '.round($remoteunit->remoteness)
                                                                           .' минут '.$remoteunit->unit->abbr." (".$remoteunit->unit->short_title.")".' в Москве')));
          }                           
       }   
       $cntcol = ( count(explode(' ',$extvid->namewhats))>1 || empty($extvid)
                    ? 3 : 4 );   
       $cntrow = ceil(count($li_remoteunits)/$cntcol);
       $arli_remoteunit=array_chunk($li_remoteunits, $cntrow, false);
   }   
   
   if ($remoteness) {
       foreach ($remoteness as $remotenes) {
           if (!isset($extvid)) {
               $li_remoteness[]= Chtml::tag('li', array(), 
                                         Chtml::link( 'Аренда коммерческой недвижимости с удаленностью '.round($remotenes->remoteness).' мин.', 
                                         Yii::app()->createUrl( 'realestates/unit',  array( 'remotenes' => round($remotenes->remoteness))), 
                                         array( 'title' => 'Аренда коммерческой недвижимости с удаленностью '.round($remotenes->remoteness).' минут(ы) в Москве')));
              }else{
                  $li_remoteness[]= Chtml::tag('li', array(),
                                        Chtml::link( 'Аренда '.$extvid->namewhats.' с удаленностью '.round($remotenes->remoteness).' мин.', 
                                        Yii::app()->createUrl( 'realestates/unit', 
                                                               array( 'remotenes' => round($remotenes->remoteness),
                                                                    $extvid->type => $extvid->id )),                        
                                        array('title'=>'Аренда '.$extvid->namewhats.' с удаленностью '.round($remotenes->remoteness).' минут(ы) в Москве')));
              }                           
       }  
       $cntcol = ( count(explode(' ',$extvid->namewhats))>1 || empty($extvid)
                    ? 3 : 4 );  
       $cntrow = ceil(count($li_remoteness)/$cntcol);
       $arli_remotenes=array_chunk($li_remoteness, $cntrow, false);
   }  

?>
<?php if (!empty($arli_record)) { ?>     
    <h2 class="list <?/*fs-11 m-0 p-0 c-black inline-valn ff-tahoma m-b5 bold*/?>">   
        <?php if ($extvid->head->units) { 
            echo $extvid->head->units;
        ?>        
        <?php } else { ?>
        Снять в аренду <?=isset($extvid) ? $extvid->namewhat 
                                         : 'коммерческую недвижимость'/*офис, нежилое помещение или здание'*/;?> в Москве по удаленностью от метро по способу:
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

<?php if (!empty($arli_remoteunit)) { ?>     
    <h2 class="list <?/*fs-11 m-0 p-0 c-black inline-valn ff-tahoma m-b5 bold*/?>">   
        <?php if ($extvid->head->remoteunits) { 
            echo $extvid->head->remoteunits;
        ?>        
        <?php } else { ?>
        Снять в аренду <?=isset($extvid) ? $extvid->namewhat 
                                         : 'коммерческую недвижимость'/*офис, нежилое помещение или здание'*/;?> в Москве с удаленностью от метро по способу и времени:
        <?php } ?>                                 
    </h2>     
                                         
    <table>
       <tr>
         <?     
            foreach ( $arli_remoteunit as $record ) {
         ?>
         <td width="<?=100/$cntcol;?>%" class="valign-t fs-9 ff-Arial"><?=CHtml::tag('ul', array("style"=>"margin: 0 0em 1.2em 0;padding-left: 1.3em;list-style-type: circle;"),implode('',$record));?></td> 
         <?    
            }
         ?>        
      </tr>        
    </table>    
<? } ?>

<?php if (!empty($arli_remotenes)) { ?>     
    <h2 class="list <?/*fs-11 m-0 p-0 c-black inline-valn ff-tahoma m-b5 bold*/?>">   
        <?php if ($extvid->head->remoteness) { 
            echo $extvid->head->remoteness;
        ?>        
        <?php } else { ?>
        Снять в аренду <?=isset($extvid) ? $extvid->namewhat 
                                         : 'коммерческую недвижимость'/*офис, нежилое помещение или здание'*/;?> в Москве c удаленностью от метро только по времени:
        <?php } ?>                                 
    </h2>     
                                         
    <table>
       <tr>
         <?     
            foreach ( $arli_remotenes as $record ) {
         ?>
         <td width="<?=100/$cntcol;?>%" class="valign-t fs-9 ff-Arial"><?=CHtml::tag('ul', array("style"=>"margin: 0 0em 1.2em 0;padding-left: 1.3em;list-style-type: circle;"),implode('',$record));?></td> 
         <?    
            }
         ?>        
      </tr>        
    </table>    
<? } ?>

<? if ($model) {
    
        $criteria = $model->criteria();
        
        $criteria->group = 't.street_id';
        $criteria->addCondition('t.street_id IS NOT NULL AND ((t.act=1)OR(t.act is NULL))AND((t.del=0)OR(t.del is NULL))');
        $criteria->join = 'LEFT JOIN streets ON streets.id = t.street_id';
        $criteria->order = 'streets.name ASC';
        $criteria->select = 't.id,t.street_id,streets.id';
        
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

        $streets =  $model->findAll($criteria);
   }else{
        /*$model = Realestates::model();
        $criteria = new CDbCriteria;
        $criteria->group = 't.street_id';
        $criteria->addCondition('t.street_id IS NOT NULL AND ((t.act=1)OR(t.act is NULL))AND((t.del=0)OR(t.del is NULL))');
        $criteria->join = 'LEFT JOIN streets ON streets.id = t.street_id';
        $criteria->order = 'streets.name ASC';
        $streets =  $model->findAll($criteria);*/
        $model = Streets::model()->sitemap();
        $criteria = new CDbCriteria;
        $criteria->order = 't.name ASC';
        $streets = $model->findAll($criteria);
        $is_main = true;
   }
 
   $cntcol=6;  
   $cntrow = ceil(count($streets)/$cntcol);
   if ($streets) {
       foreach ($streets as $street) {
           if (!$is_main) {
              if (!isset($extvid)) 
              {
                  $li_streets[]= Chtml::tag( 'li', array(),
                                     Chtml::link( $street->street->getSocrName(),
                                                  Yii::app()->createUrl('realestates/street',
                                                                  array('id'=>$street->street->id )),
                                                  array( 'title'=>'Аренда коммерческой недвижимости '.$street->street->getFullName('на').' в Москве'))
                                 );
              }else
              {
                 $li_streets[]= Chtml::tag( 'li', array(),
                                    Chtml::link( $street->street->getSocrName(),
                                                 Yii::app()->createUrl('realestates/street',
                                                                  array('id'=>$street->street->id, 'property'=>$extvid->type, 'pid'=>$extvid->id )),
                                                 array( 'title' => 'Аренда '.$extvid->namewhats.' '.$street->street->getFullName('на').' в Москве')
                                    )
                                );
              }                  
           }else{
              if (!isset($extvid)) 
              { 
                  $li_streets[]= Chtml::tag( 'li', array(),
                                   Chtml::link($street->getSocrName(),
                                               Yii::app()->createUrl('realestates/street',
                                                               array('id'=>$street->id )), 
                                               array('title'=>'Аренда коммерческой недвижимости '.$street->getFullName('на').' в Москве')
                                   )
                               );           
              }else
              {
                 $li_streets[]= Chtml::tag( 'li', array(),
                                   Chtml::link($street->getSocrName(),
                                               Yii::app()->createUrl('realestates/street',
                                                               array('id'=>$street->id, 'property'=>$extvid->type, 'pid'=>$extvid->id )), 
                                               array('title'=>'Аренда '.$extvid->namewhats.' '.$street->getFullName('на').' в Москве')
                                   )
                               );                             
              } 
           }    
       }              

       $arli_streets=array_chunk($li_streets, $cntrow, false);
?>

    <?/*<h2 class="list <?/*m-t16?>">Снять офис в аренду на <?php echo Streets::model()->getListType();?>, Коммерческая недвижимость - <?php echo CHtml::link(CHtml::encode('аренда офисов в Москве:'), array('realestates/index'), array('title'=>'коммерческая недвижимость - аренда офисов в Москве:', 'class'=>"c-black"));?></h2>*/?>     
    <h2 class="list">
        <?php if ($extvid->head) { 
            echo $extvid->head;
        ?>        
        <?php } else { ?>
            Снять <?=( isset($extvid) ? $extvid->namewhats : 'коммерческую недвижимость '/*'офис, бизнес центр, банк, особняк, нежилое помещение'*/ );?> в аренду на <?php echo Streets::model()->getListType();?>
        <?php } ?>    
    </h2>     
    <table>
       <tr>
         <?     
            foreach ( $arli_streets as $streets ) {
         ?>
         <td width="<?=100/$cntcol;?>%" class="valign-t fs-9 ff-Arial"><?=CHtml::tag('ul', array("style"=>"margin: 0 0em 1.5em 0;padding-left: 1.5em;list-style-type: circle;"),implode('',$streets));?></td> 
         <?    
            }
         ?>        
      </tr>        
    </table>    
<? } ?>
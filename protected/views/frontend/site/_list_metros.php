 <?php
 if ($model) {
     $criteria = $model->criteria();
     $criteria->group = 'metro_id';
     $criteria->addCondition('t.metro_id IS NOT NULL AND ((t.act=1)OR(t.act is NULL))AND((t.del=0)OR(t.del is NULL))');
     $criteria->join = 'LEFT JOIN metros ON metros.id = t.metro_id';
     $criteria->order = 'metros.title ASC';
     $criteria->select = 't.id,t.metro_id,metros.title,metros.id';   
     $rmetros =  $model->findAll($criteria);
 }else{
     /*$model = Realestates::model();
     $criteria = new CDbCriteria;
     $criteria->group = 'metro_id';
     $criteria->addCondition('metro_id IS NOT NULL AND ((t.act=1)OR(t.act is NULL))AND((t.del=0)OR(t.del is NULL))');
     $criteria->join = 'LEFT JOIN metros ON metros.id = t.metro_id';
     $criteria->order = 'metros.title ASC';
     $rmetros =  $model->findAll($criteria);*/
     $model = Metros::model()->sitemap();
     $criteria = new CDbCriteria;
     $criteria->order = 't.title ASC';
     $rmetros = $model->findAll($criteria);
     $is_main = true;
 } 
 if ($rmetros) {
     $cntcol=$col ? $col : 5;  
     $cntrow = ceil(count($rmetros)/$cntcol);
     foreach ($rmetros as $metro) {
        if (!$is_main) { 
             if (!isset($extvid)) 
             {
                  $li[]= Chtml::tag( 'li', array(), 
                             Chtml::link( $metro->metro->title, 
                                 Yii::app()->createUrl( 'realestates/metro', 
                                                  array('id'=>$metro->metro->id )), 
                                 array('title'=>'Аренда коммерческой недвижимости рядом с метро '.$metro->metro->title.' в Москве')
                             )
                        );                  
             }else{
                 
                  $li[]= Chtml::tag( 'li', array(), 
                             Chtml::link( $metro->metro->title, 
                                 Yii::app()->createUrl( 'realestates/metro', 
                                                 array( 'id'  => $metro->metro->id, 
                                                   'property' => $extvid->type, 
                                                        'pid' => $extvid->id )
                                 ), 
                                 array( 'title' => 'Аренда '.$extvid->namewhats.' рядом с метро '.$metro->metro->title.' в Москве')
                             )
                        );                  
            }      
            
        }else{
            if (!isset($extvid)) 
            {
                $li[]= Chtml::tag( 'li', array(), 
                           Chtml::link( $metro->title, 
                               Yii::app()->createUrl( 'realestates/metro', 
                                               array( 'id'=>$metro->id )),
                               array('title'=>'Аренда коммерческой недвижимости рядом с метро '.$metro->title.' в Москве')
                           )
                       );        
            }else{
                $li[]= Chtml::tag( 'li', array(), 
                           Chtml::link( $metro->title, 
                               Yii::app()->createUrl( 'realestates/metro', 
                                               array( 'id' => $metro->id, 
                                                'property' => $extvid->type, 
                                                     'pid' => $extvid->id )
                               ),
                               array('title'=>'Аренда '.$extvid->namewhats.' рядом с метро '.$metro->title.' в Москве')
                           )
                       );                        
            }    
        }    
     }                                                                 
     $arlis=array_chunk($li, $cntrow, false);
 ?>
 <?//=CHtml::tag('ul', array(), str_repeat(chtml::tag('li', array(), ''), 4));?>
 <?/*<h2 class="list <?/*m-t16/?>">Cдаем офис в аренду рядом с станцией метро, коммерческая недвижимость в Москве:</h2>*/?>
<h2 class="list <?/*m-t16*/?>">
        <?php if ($extvid->head) { 
            echo $extvid->head;
        ?>        
        <?php } else { ?>
        Cдаем в аренду <?=( isset($extvid) ? $extvid->namewhat 
                                                                  : 'коммерческую недвижимость '/*(офис, нежилое помещение, особняк или отдельно стоящее здания)*/);?> 
                              рядом с станциями метро:
        <?php } ?>                      
</h2>
 <?// $rmetros = RealestateMetros::model()->findAll(array('group'=>'metro_id')); По новому ?>
 <table>
  <tr>
    <?     
       foreach ( $arlis as $lis ) {
    ?>
    <td width="<?=100/$cntcol;?>%" class="valign-t fs-9 ff-Arial"><?=CHtml::tag('ul', array("style"=>"margin: 0 1em 1.5em 0;padding-left: 1.5em;list-style-type: circle;"),implode('',$lis));?></td> 
    <?    
       }
    ?>        
  </tr>        
</table>   
<? } ?> 
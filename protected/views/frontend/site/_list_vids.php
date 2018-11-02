 <?php
 if ($model) {
     $criteria = $model->criteria();
     $criteria->group = 'realestate_vid_id';
     $criteria->addCondition('t.realestate_vid_id IS NOT NULL AND ((t.act=1)OR(t.act is NULL))AND((t.del=0)OR(t.del is NULL))');
     $criteria->join = 'LEFT JOIN realestate_vids vids ON vids.id = t.realestate_vid_id';
     $criteria->order = 't.sort ASC';
     $rvids =  $model->findAll($criteria);
 }else{
     /*$model = Realestates::model();
     $criteria = new CDbCriteria;
     $criteria->group = 'metro_id';
     $criteria->addCondition('metro_id IS NOT NULL AND ((t.act=1)OR(t.act is NULL))AND((t.del=0)OR(t.del is NULL))');
     $criteria->join = 'LEFT JOIN metros ON metros.id = t.metro_id';
     $criteria->order = 'metros.title ASC';
     $rmetros =  $model->findAll($criteria);*/
     $model = RealestateVids::model()->sitemap();
     $criteria = new CDbCriteria;
     $criteria->order = 't.sort ASC';
     $rvids = $model->findAll($criteria);
     $is_main = true;
 } 
 if ($rvids) {
     $cntcol=$col ? $col : 4; 
     $cntrow = ceil(count($rvids)/$cntcol);
     foreach ($rvids as $vid) {
        if (!$is_main) { 
            $li[]= Chtml::tag('li', array(), Chtml::link('Аренда '.mb_strtolower($vid->realestateVid->namewhats,'utf-8').' в Москве',Yii::app()->createUrl('realestates/vid',array('id'=>$vid->realestateVid->id )),array('title'=>'Аренда '.mb_strtolower($vid->realestateVid->title,'utf-8').' в Москве')));
        }else{
            $li[]= Chtml::tag('li', array(), Chtml::link('Аренда '.mb_strtolower($vid->namewhats,'utf-8').' в Москве',Yii::app()->createUrl('realestates/vid',array('id'=>$vid->id )),array('title'=>'Аренда '.mb_strtolower($vid->namewhats,'utf-8').' в Москве')));        
        }    
     }                                                                 
     $arlis=array_chunk($li, $cntrow, false);
 ?>
 <?//=CHtml::tag('ul', array(), str_repeat(chtml::tag('li', array(), ''), 4));?>
 <?/*<h2 class="list <?/*m-t16/?>">Cдаем офис в аренду рядом с станцией метро, коммерческая недвижимость в Москве:</h2>*/?>
 <h2 class="list <?/*fs-12 m-0 p-0 c-black inline-valn ff-tahoma m-b5 bold*/?><?/*m-t16*/?>">
     Предложения аренды по видам коммерческой недвижимости:
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
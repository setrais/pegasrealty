<?php
   //$streets = Streets::model()->sitemap()->findAll(); 
   //foreach ($streets as $street) { echo $street->title; }
   $this->pageTitle=Yii::t('all','Карта сайта').' - '.Yii::t('all',Yii::app()->name);
   $this->pageDescription= Yii::t('all','Карта сайта портала pegasrealty.ru');
   $this->pageKeywords=explode(',','карта сайта, карта, особняк, бц, бизнес центр, осз, бизнес парк, административное здание, бп, статьи, недвижимость');
   $this->breadcrumbs=array(
        Yii::t('all','Карта сайта'),
   );
   

?>
<h1><?php echo Yii::t('all','Карта сайта'); ?> </h1>   
<table width="100%" border="0" class="sitemap" >    
    <tr>
<?
$cnt = count($list);
$cnt_col=2; // Кол-во елементов в колонке
$cnt_cel= ceil($cnt/$cnt_col); 
$cntc = $cnt_cel*$cnt_col;
$i=0;
$lev=null;
$memgrid = null;
//echo $cnt.':'.$cnt_cel.':'.$cntc;

function cmp($a,$b) {  return strcmp($a["lid"],  $b["lid"]); };
usort($list, "cmp");

echo count($list);
//echo "<pre>"; echo print_r($list); echo "</pre>";
foreach( $list as $key=>$row ):
?>     
        
<? if ($i==0 || $i%$cnt_cel==0) :         
    echo '<td './*'width="'.(100/$cnt_col).'%"'*/' class="fs-9"> 
             <ul class="lev-0">'; 
      if ( $i || $i==$cnt ) { 
          echo "<li><ul>";            
      }          
  endif; 
                                                                    
  if (isset($row['attr']["grid"]) && $row['attr']["grid"]>0) {   
      
      echo '<li '.(strlen($row['attr']['grid']) >= 13 ? (strlen($row['attr']['grid']) >= 16 ? 'class="lev-3"' : 'class="lev-2"') : '').'>'
              .CHtml::link( ( $row['link']['text'] ? /*$row['attr']["grid"]." : ".$row["lid"]." ".*/$row['link']['text'] 
                                                   : Yii::t('menu',HRu::cutstr(/*$row['attr']["grid"]." : ".$row["lid"]." ".*/$row['attr']['title'],125))).( $row['attr']['area'] ? ' - '.$row['attr']['area'].' м2' : ''), 
              $row['loc'],
              array( 'title'=>( $row['link']['title'] ? $row['link']['title'] 
                                                      : 'Пегас недвижимость | '.$row['attr']['title']).( $row['attr']['area'] ? ' - '.$row['attr']['area'].' м2' : ''),
                     'alt'=>( $row['link']['alt'] ? $row['link']['alt'] 
                                                  : $row['attr']['title']).( $row['attr']['area'] ? ' - '.$row['attr']['area'].' м2' : '')
              ))
           .'</li>';                   
            
      if (($i+1)%$cnt_cel==0 || ($i+1)==$cnt ) { 
          echo "</ul></li>";            
      }          
  } else {       
      if ($lev!==null) echo "</ul></li>";      
      echo '<li>'.CHtml::link( ( $row['link']['text'] ? $row['link']['text'] 
                                                      : Yii::t('menu',HRu::cutstr(/*$row['attr']["grid"]." : ".$row["lid"]." ".*/$row['attr']['title'],125))), 
              $row['loc'],
              array('title'=>($row['link']['title'] ? $row['link']['title'] 
                                                    : 'Пегас недвижимость | '.$row['attr']['title']).( $row['attr']['area'] ? ' - '.$row['attr']['area'].' м2' : ''),
                    'alt'=>($row['link']['alt'] ? $row['link']['alt'] 
                                                : $row['attr']['title']).( $row['attr']['area'] ? ' - '.$row['attr']['area'].' м2' : '')
                   )).'<ul>';                                                                                                                           
      $lev=1;      
  }
  
  if ( ($i<>0 && ($i+1)%$cnt_cel==0) || ($i+1)==$cnt ) :                      
   echo '</ul> 
        </td>';
  endif; 
  $i++;  
endforeach;
?>
      
    </tr>               
</table>

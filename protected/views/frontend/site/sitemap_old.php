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
$cnt = $cnt_cel*$cnt_col;

function cmp($a,$b) {  return strcmp($a["lid"],  $b["lid"]); };
usort($list, "cmp");
//echo "<pre>"; echo print_r($list); echo "</pre>";
foreach( $list as $key=>$row ):
?>     
        
<? if ( $key%$cnt_cel==0) : ?>
      <td width="<?=(100/$cnt_col);?>%"> 
         <div>
            <ul class="lev-0">          
            <? if ($lev==1) { ?>                
                  <ul>  
            <? } ?>                                
<? endif; ?>   
                      
<? if (isset($row['attr']["grid"]) && $row['attr']["grid"]>0) {
        if ($lev==0) { 
?> 
               <ul>
<?          
            $lev=1;  
        }
   }
   else  
   {
        if ($lev==1) { 
?>       
               </ul>               
<?      
            $lev=0;             
        }    
   }    
?>                              
<? if (isset($row['attr']["grid"]) && $row['attr']["grid"]>0) { ?>
<?        echo '<li>'.CHtml::link(Yii::t('menu',$row['attr']['title']).( $row['attr']['area'] ? ' - '.$row['attr']['area'].' м2' : ''), $row['loc'],array('title'=>'Аренда офисов в Москве / Пегас недвижимость - '.$row['attr']['title'].' / '.$row['attr']['area'].' м2')).'</li>'; ?>                                                                 
<? } else { ?>
<?        echo '<li>'.CHtml::link(Yii::t('menu',$row['attr']['title']), $row['loc'],array('title'=>'Аренда офисов в Москве / Пегас недвижимость - '.$row['attr']['title'])).'</li>'; ?>                                                                                       
<? } ?>                     
<? if ( ($key<>0 && ($key+1)%$cnt_cel==0) || ($key+1)==$cnt ) : ?>       
<?      if ($lev==1) { ?>
              </ul>                
<?      } ?>                
            </ul>
         </div> 
      </td>
<? endif; ?>                                
<?      
endforeach;
?>
      
    </tr>               
</table>

<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tbody>
    <tr>
      <td class="Image_map halign-c">
        <div class="Map_metro">
          <img src="/images/map_metro.png" usemap="#ImageMap" />
          <map name="ImageMap" id="ImageMap" >
          <?php foreach( $metros["stations"] as $key => $station ) { ?>
            <area id="link_<?=$station->mapid;?>" onclick="chSt(this);return false;" alt="<?=$station->title;?>" href="#" coords="<?=$station->coords_map;?>" shape="<?=$station->shape_map;?>" />
          <?php } ?>

        <?php foreach( $metros["lines_dok"] as $key => $line_dok ) { ?>
            <area title="Выбор станций до кольцевой линии" alt="Выбор станций до кольцевой линии" onclick="chP(this); return false;" id="link_<?=$line_dok->sid;?>" href="#" coords="<?=$line_dok->coords_map;?>" shape="<?=$line_dok->shape_map;?>" />
        <?php } ?> 
                                                        
        <?php foreach( $metros["lines"] as $key => $line ) { ?>
             <?php    if ($line->groups=="L") { ?>                                                            
                 <area alt="<?=$line->title;?>" id="link_<?=$line->sid;?>" href="#" onclick="chL(this); return false;" coords="<?=$line->coords_map;?>" shape="<?=$line->shape_map;?>" />
             <?php    } else { ?>
                 <?php if ($line->coords_map) { ?>
                 <area alt="" href="#" coords="<?=$line->coords_map;?>" shape="<?=$line->shape_map;?>" />                                                                 
                 <?php } ?>
             <?php    } ?>
        <?php } ?>     
        </map>
                                                
        <?php foreach( $metros["stations"] as $key => $station ) { ?>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_<?=$station->mapid;?>" style="<?=$station->style_pointer_map;?>"></div>                                                      
        <?php } ?>                                                         
        
             <div class="choice_station"></div>                                         
          </div>
      </td>
    </tr>
    <tr>
       <td class="text_map" style="padding-top:0px; text-align: left">  
           <div class="ul_regions fl p-r10">
              <b class="ttr-upper" >Округа и районы</b>
              <div style="overflow: auto; /*height: 220px;*/padding-bottom: 10px;">
                 <ul>
                     <?php $beg = true; ?>    
                     <?php foreach( $metros["saos"] as $key => $sao ) { ?>                                                            
                         <li id="mapMenu_<?=$sao->sid;?>" <?=($beg ? 'class="first"' : '');?>>                                                         
                         <?php if ($beg) {
                                   $beg = false;
                               } 
                         ?>    
                         <? if (array_key_exists($sao->sid,$metros["childs"])) { ?>
                              <span class="plus-minus" onclick="chPM(this)">  </span>
                         <? } ?>
                              <div><a id="link_<?=$sao->sid;?>" href="#" onclick="chR(this); return false"><?=$sao->title;?></a></div>
                         <? if (array_key_exists($sao->sid,$metros["childs"])) { ?>
                              <ul>
                              <? foreach( $metros["childs"][$sao->sid] as $sey => $child) { ?>
                                 <li><a href="#" id="link_<?=$child->sid;?>" onclick="chO(this); return false"><?=$child->title;?></a></li>
                              <?     } ?>
                              </ul>    
                         <? } ?>
                         </li>                
                     <?php } ?>  
                                                      
                    </ul>
                </div>
           </div>  
           <div class="ul_regions ul_line fl p-r10" style="padding-bottom: 10px;">
               <b class="ttr-upper">Линии метро</b>
               <div class="rows">
                   <ul class="ul1">
                   <?php foreach( $metros["slines"] as $key => $sline ) { ?>
                        <li id="line<?=$sline->linesort;?>"><span>M</span><a href="#" id="slink_<?=$sline->sid;?>" onclick="chL(this); return false;"><?=$sline->title;?></a></li>                                                            
                   <?php } ?> 
                   </ul>
               </div>
           </div>                    
           <div class="ul_regions ul_line fl" style="padding-bottom: 8px;width: 238px" >  
               <b class="ttr-upper" >Группы станций</b>
               <div class="rows">
                   <ul class="ul1">
                   <?php foreach( $metros["gstations"] as $gey => $gstation ) { ?>
                         <li id="line<?=$gstation->sid;?>"><span>M</span><a href="#" id="slink_<?=$gstation->sid;?>" onclick="chL(this); return false;"><nobr><?=$gstation->title;?></nobr></a></li>
                   <?php } ?>                                                       
                   
                   </ul>
               </div>
               <div class="ul_regions ul_line" style="padding-bottom: 8px;" >      
                   <div class="rows">
                        <div id="check_okrug" style="overflow: auto; height: 48px;">
                            <div class="whitezap"> </div>
                                <b class="ttr-upper">Выбранные Округа</b> 
                                <div id="districts_text"></div>
                        </div>
                   </div>
                   <div class="rows">
                        <div id="check_stancii" style="overflow: auto; height: 56px;">
                            <div class="whitezap"> </div>
                                <b class="ttr-upper" >Выбранные станции метро</b>
                                <div id="stantions_text"></div>  
                            </div>
                        </div>
                   <div class="rows" style="margin-top: 5px;">
                        <div class="buttons m-0">
                            <input onclick="metroMap.reset(); return false;" value="Очистить" class="button" style="width: 80px;" type="reset" />
                            <?/*<input value="Готово" style="width: 80px;" type="button" class="toggleMap button" />*/?>  
                        </div>
                   </div>
                   <div class="clear" ></div>
                </div>                        
           </div>    
           <div class="clear"></div>
       </td>
    </tr>
   </tbody>
</table>
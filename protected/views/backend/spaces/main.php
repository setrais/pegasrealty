<?php $this->pageTitle=Yii::app()->name; ?>

        <div class="content" >
             <div class="search-form" >
             <?php $this->renderPartial('/spaces/_search',
                           array('metros'=>$metros, 
                                 'map'=>$map,
                                 'favs'=>$favs,
                                 'fav_cnt_row'=>$fav_cnt_row,
                                 'fav_cnt_col'=>$fav_cnt_col,
				 'model'=>$model 
                                )
                          );
            ?>
            </div>			

            <div style="padding-top:24px" >            
                    <table width="100%" >
                    <?  $beg = 0; ?>    
                    <?  foreach( $favs as $fey => $fav ) { ?>                
                    <?  if ( $beg==0 ) { ?>   
                          <tr>                                               
                    <?  } ?>
                    <?  $beg++; ?>                             
                            <td style="text-align: center;vertical-align:middle;" >  
                              <div id="item-<?=$fav->id;?>" class="item" style="padding:10px;display:inline-block;text-align: center;">
                                 <div id="pic-item-<?=$fav->picOreginal->id;?>" class="pic" style="/*height:160px;line-height:160px;*/width:280px;vertical-align: middle;text-align: center;">
                                    <?php 

                                        $pic_width  ="280";
                                        $pic_height ="";

                                        if ( trim($fav->pic_oreginal_id)<>"" ) 
                                        {   
                                            $pathfrompic = str_replace('_original'.substr($fav->picOreginal->original_name,-4,4),
                                                                            '_big'.substr($fav->picOreginal->original_name,-4,4),
                                                                            $fav->picOreginal->original_name); 

                                            $pathtopic = str_replace('_original'.substr($fav->picOreginal->original_name,-4,4),
                                                                            '_'.$pic_width.'x'.$pic_height.substr($fav->picOreginal->original_name,-4,4),
                                                                            $fav->picOreginal->original_name); 

                                            $picOreginal = '/'.$pathtopic; 

                                            if( !file_exists($picOreginal) ) {
                                                $image = Yii::app()->image->load($pathfrompic);
                                                /*$image->resize(280,100)->rotate(-45)->quality(75)->sharpen(20);*/
                                                $image->resize($pic_width,null);
                                                $image->save($pathtopic); // or $image->save('images/small.jpg');
                                            }

                                            echo CHtml::link(CHtml::image( $picOreginal,'', 
                                                    array('title'=>$fav->picOreginal->name, 'width'=>$pic_width."px" )), 
                                                          //'/'.$fav->picOreginal->original_name, 
                                                          array('spaces/view','id'=>$fav->id), 
                                                          array('class'=>'fancyImage'));

                                        } else { 
                                            echo CHtml::link(CHtml::image( '/images/no_foto.png','', 
                                                    array('title'=>Yii::t('all','Без фото'),
                                                          'style'=>"height:100px;"),
                                                          array('spaces/view','id'=>$fav->id)
                                                         )
                                                 );

                                        }
                                     ?>  
                                 </div>
                                 <div>
                                    <a href="" class="title" ></a>
                                    <div class="properties">
                                       <div class="s-iteme"></div>
                                       <div class="s-price"></div>   
                                    </div>
                                 </div>
                              </div>                      
                            </td>                   
                    <?  if ( $beg%$fav_cnt_col==0 ) { ?>  
                          </tr>     
                    <?     $beg=0; ?>
                    <?  } ?>                                                          
                    <? } ?>    
                    </table>
            </div>    
        </div>

<?    
/*$js_security = "                
                document.onselectstart=function(){return false}
                document.oncontextmenu=function(){return false}
                document.onmousedown=function(){return false}
               ";

Yii::app()->getClientScript()->registerScript('Security'.$this->getId(), $js_security, CClientScript::POS_HEAD);

        
*/?>    

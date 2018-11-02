<?php $this->pageTitle=Yii::t('all',Yii::app()->name); ?>

        <div class="content" >
             <div class="search-form" >
             <?php $this->renderPartial('/realestates/_search',
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
            <?php $this->renderPartial('/realestates/_cascad',array('favs'=>$favs));?>
        </div>

<?    
/*$js_security = "                
                document.onselectstart=function(){return false}
                document.oncontextmenu=function(){return false}
                document.onmousedown=function(){return false}
               ";

Yii::app()->getClientScript()->registerScript('Security'.$this->getId(), $js_security, CClientScript::POS_HEAD);

        
*/?>    

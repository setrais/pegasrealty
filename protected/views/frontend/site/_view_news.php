<div class="view" style="margin:20px 0px;border:1px solid #999;">   
    <div>
        <div class="pic fl">
                         <? $pic_url = Files::model()->findByPk($data->pic_anons_id);
                            if ($pic_url) {
                                CHtml::link( CHtml::image( $pic_url->original_name, 
                                                           $data->title, array("class"=>"item-image")), 
                                             $data->url, array("class"=>"item-link fancy-box"));
                            } else {
                                CHtml::link( CHtml::image( 'images/no-fotos.png', 
                                                           $data->title, array("class"=>"item-image")), 
                                             $data->url, array("class"=>"item-link fancy-box"));
                            } 
                         ?>   
        </div>
        <div class="info pos-r">
             <h2 class="title bg-fiolet arial pos-a" style="font-family: Arial;font-size: 11px;margin: 3px 3px 3px 0;padding: 4px 6px;top: -25px;width: 916px;">
                 <?=date('d.m.Y H:i:s',strtotime($data->createdate));?>
                 <i><?=$data->title;?></i>
                 <?/*<span class="fr">
                 <?=CHtml::link( 'подробнее..',$data->url); ?>
                 </span>*/?>    
             </h2>
            <div class="anons">
                <?//=Ri::cutstr(Yii::t('acontent',$data->anons),300);?> 
                <?=Yii::t('acontent',$data->anons)?>                 
            </div>
        </div>                     
    </div>  
</div>      
<div class="view">
    <?php if ( $data->name ) : ?>
    <b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
    <?php echo CHtml::encode($data->name); ?>
    <br />
    <?php endif; ?>
    
    <?php if ( $data->fio ) : ?>
    <b><?php echo CHtml::encode($data->getAttributeLabel('fio')); ?>:</b>
    <?php echo CHtml::encode($data->fio); ?>
    <br />
    <?php endif; ?>
    
    <?php if ( $data->site ) : ?>
    <b><?php echo CHtml::encode($data->getAttributeLabel('site')); ?>:</b>
    <?php echo CHtml::link($data->site); ?>
    <br />      
    <?php endif; ?>
    
    <?php if ( $data->email ) : ?>
    <b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
    <?php echo CHtml::mailto($data->email); ?>
    <br />        
    <?php endif; ?>
    
    <?php if ( $data->telephone || $data->telephone_1 || $data->telephone_2 || $data->telephone_3) : ?>
    <b><?php echo CHtml::encode($data->getAttributeLabel('telephone')); ?>:</b>    
    <?php echo ($data->telephone ? CHtml::encode($data->telephone) : '');?>
    <?php echo ($data->telephone_1 ? ($data->telephone ? ' / ' : '').CHtml::encode($data->telephone_1) : ''); ?>
    <?php echo ($data->telephone_2 ? ($data->telephone || $data->telephone_1 ? ' / ' : '').CHtml::encode($data->telephone_2) : ''); ?>
    <?php echo ($data->telephone_3 ? ($data->telephone || $data->telephone_1 || $data->telephone_2 ? ' / ' : '').CHtml::encode($data->telephone_3) : ''); ?>
    <br />
    <?php endif; ?>
    
    <?php if ( $data->fax ) : ?>
    <b><?php echo CHtml::encode($data->getAttributeLabel('fax')); ?>:</b>
    <?php echo CHtml::encode($data->fax); ?>
    <br />        
    <?php endif; ?>
    
    <?php if ( $data->desc ) : ?>
    <b><?php echo CHtml::encode($data->getAttributeLabel('desc')); ?>:</b>
    <?php echo CHtml::encode($data->desc); ?>
    <br />
    <?php endif; ?>    
    
    <?php/* if ( $data->getRealestates() ) : ?>
    <b><?php echo CHtml::encode($data->getAttributeLabel('realestates')); ?>:</b>
    <?php echo $data->getRealestates(); ?>
    <br />
    <?php endif;*/ ?> 
    <?php if ($data->realestateOwners) {?>        
    <p>
    <div class="block bg-grey">
        <center><b>Предложения<?php// echo CHtml::encode($data->getAttributeLabel('realestates')); ?></b></center>        
        <table style="<?php /*border:1px solid #ccc;*/?> padding:2px;">
          <tr style="border:1px solid #ccc; padding:2px;background-color: #b7cee6; ">  
            <th class="center border-blue">Ид</th>
            <th class="center border-blue">Дата прозвона</th>
            <th class="center border-blue">Дата освобождения</th>
          </tr>    
    <?php foreach ($data->realestateOwners as $real) { ?>
          <tr>  
            <td class="center border-blue">
    <?php   echo CHtml::link( ($real->in_stock ? '<span class="c-red">'.$real->id.'</span>' : $real->id), '/'.$real->picOreginal->original_name /*Yii::app()->createUrl('/realestates/view', array('id'=>$real->id))*/,
                                                array('title'=>$real->title
                                                              .($real->date_rang || $real->date_release ? ' - ' : '')
                                                              .($real->date_rang ? 'Дата прозвона: '.date('d.m.Y',strtotime($real->date_rang)) : '')
                                                              .($real->date_release ? ' Дата освобождения: '.date('d.m.Y',strtotime($real->date_release)) : '')
                                                    , 'class'=>'fancyImage'));
    ?>
            </td>     
            <td class="center border-blue"><?php echo ($real->date_rang ? date('d.m.Y',strtotime($real->date_rang)) : '');?></td>                
            <td class="center border-blue"><?php echo ($real->date_release ? date('d.m.Y',strtotime($real->date_release)) : '');?></td>
          </tr>
    <?php  } ?>                           
        </table>
    </div>   
    </p>
    <?php } ?>                       
    <script>
        $(document).ready(function() {
            $(".fancyImage").fancybox(
            {'overlayShow': true, 'hideOnContentClick': false});
        }); 
    </script>    
</div>
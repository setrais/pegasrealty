<?php $data = CHtml::listData(Iblocks::model()->findAll("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0) ".( trim($model->types_iblocks_id)<>'' ? "AND (TYPES_IBLOCKS_ID='".$model->types_iblocks_id."')" : "")."AND ((GRID=0)OR(GRID IS NULL))",
         array("order"=>"sort")), 'id', 'name'); ?>
<?php if (!empty($data)) { ?>
<?php echo CHtml::activeLabel($model,'grid'); ?>               
<?php echo CHtml::activeDropDownList($model,'grid',$data); ?>                                                                                     
<?php echo CHtml::error($model,'grid'); ?>
<?php } ?>

<script>    
    $('#Iblocks_action').val('<?=$model->action;?>');
    $('#Iblocks_url').val('<?=$model->url;?>');
    $('#Iblocks_url_detile').val('<?=$model->url_detile;?>');
    $('#Iblocks_url_list').val('<?=$model->url_list;?>');
</script>


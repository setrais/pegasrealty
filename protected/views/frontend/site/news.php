<?php
$this->pageTitle=Yii::t('tcontent',$group->title).' - '.Yii::t('all',Yii::app()->name);
$this->breadcrumbs=array(
    Yii::t('tcontent',$group->title),
);
?>
<h1><?php echo Yii::t('tcontent',$group->title); ?> <?php echo $icons; ?></h1>

<div class="grid p-b10">
    <div class="gpic fl">
        <? $gpic_url = Files::model()->findByPk($item->pic_anons_id);
           if ($gpic_url) {
                 CHtml::link( CHtml::image( $gpic_url->original_name, 
                                $group->title, array("class"=>"group-image")), 
                                $group->url, array("class"=>"group-link fancy-box"));
           } else {
                                CHtml::link( CHtml::image( 'images/no-foto-group.png', 
                                             $group->title, array("class"=>"group-image")), 
                                             $group->url, array("class"=>"group-link fancy-box"));
          } 
        ?>   
    </div>
    <div class="ganons">
        <?=substr($group->anons,0/*,$gcnt_letter*/);?>
    </div>
    <div class="clear"></div>
</div>

<?php $this->renderPartial('/realestates/_social',array('model'=>(object)array('title'=>$this->pageTitle)));?>   

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view_news',
        'summaryText'=>Yii::t('core',                 
                              'Displaying Items {start} - {end} of {count} results', 
                              $dataProvider->getTotalItemCount()),
        'emptyText'=>Yii::t('core','No results found.'),
)); ?>

<script>
    $(document).ready(function() {
    $(".fancyImage").fancybox(
       {'overlayShow': true, 'hideOnContentClick': false});
    }); 
</script>  
<script>
    $(document).ready(function() {
          $(".fancyFrame").fancybox(
                        {'width': 800, 'height':600, 'frameWidth' : 800, 'frameHeight': 600, 'overlayShow': true, 'hideOnContentClick': false});
    }); 
</script>  
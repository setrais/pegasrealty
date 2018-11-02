<?php
$this->breadcrumbs=array(
	'Messages'=>array('index'),
	'Admin',
);
$this->menu=array(
	array('label'=>'List Messages', 'url'=>array('index')),
	array('label'=>'Create Messages', 'url'=>array('create')),
    
);
 
Yii::app()->clientScript->registerScript('search', "
    $('.search-button').click(function(){
            $('.search-form').toggle();
            return false;
    });
    $('.search-form form').submit(function(){
            $.fn.yiiGridView.update('messages-grid', {
                    data: $(this).serialize()
            });
            return false;
    });
");

?>
<?/*<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>*/?>

<h1>Manage Messages</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?
$this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'messages-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
        'id',
        'language',
        'translation',
        array(
            'class'=>'CButtonColumn',
            'template'=> ( Yii::app()->user->checkAccess('superadmin') ?  '{view} {update} {delete}' : '{view} {update} ' ) ,  
            'buttons'=>array( 'view'   => array( 'url'=>'Yii::app()->controller->createUrl("view",array("id"=>$data->id, "language"=>$data->language))'),
                              'update' => array( 'url'=>'Yii::app()->controller->createUrl("update",array("id"=>$data->id, "language"=>$data->language))'),
                              'delete' => array( 'url'=>'Yii::app()->controller->createUrl("delete",array("id"=>$data->id, "language"=>$data->language))'),
                             ),
        ),
     ),
 ));

?>
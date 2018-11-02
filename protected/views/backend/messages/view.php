<?php
$this->breadcrumbs=array(
	'Messages'=>array('index'),
	$model->id.'-'.$model->language,
);

$this->menu=array(
        array('label'=>'List Messages',   'url'=>array('index')),
        array('label'=>'Create Messages', 'url'=>array('create')),
        array('label'=>'Update Messages', 'url'=>array('update', 'id'=>$model->id, 'language'=>$model->language)),
        array('label'=>'Delete Messages', 'url'=>'delete', 
                                          'linkOptions'=>array('submit'=>array('delete', 'id'=>$model->id, 
                                                                'language'=>$model->language),
                                           'confirm'=>'Are you sure you want to delete this item?')),
        array('label'=>'Manage Messages', 'url'=>array('admin')),
);

?>

<h1>View Messages #<?php echo $model->id.'-'.$model->language; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
            'id',
            'language',
            'translation',
	),
)); ?>

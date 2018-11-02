<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'/site/_view',
        'pager'=>array(
            'header' => Yii::t('grid','Перейти к странице:'),
            //'firstPageLabel' => '&lt;&lt;',
            'prevPageLabel'  => Yii::t('grid','< Вперед'),//'<img src="images/pagination/left.png">',
            'nextPageLabel'  => Yii::t('grid','Назад >'),//'<img src="images/pagination/left.png">',
            //'nextPageLabel'  => '<img src="images/pagination/right.png">',
            //'lastPageLabel'  => '&gt;&gt;',
        ),    
        'summaryText'=>Yii::t('core',                 
                              'Displaying Items {start} - {end} of {count} results', 
                              $dataProvider->getTotalItemCount()),
        'emptyText'=>Yii::t('core','No results found.'),
        /*'summaryText'=>false/*Yii::t('core',                 
                              'Displaying Items {start} - {end} of {count} results', 
                              $dataProvider->getTotalItemCount()),
        'emptyText'=>false/*Yii::t('core','No results found.'),*/
)); ?>